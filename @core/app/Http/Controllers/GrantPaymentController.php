<?php

namespace App\Http\Controllers;

use App\Events\GrantApplication;
use App\Http\Traits\PaytmTrait;
use App\GrantApplicant;
use App\Grants;
use App\Mail\BasicMail;
use App\Mail\ContactMessage;
use App\Order;
use App\PaymentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use KingFlamez\Rave\Facades\Rave;
use Mollie\Laravel\Facades\Mollie;
use Razorpay\Api\Api;
use Stripe\Charge;
use Stripe\Stripe;
use function App\Http\Traits\getChecksumFromArray;

class GrantPaymentController extends Controller
{
    private const CANCEL_ROUTE = 'frontend.grant.payment.cancel';
    private const SUCCESS_ROUTE = 'frontend.grant.payment.success';

    public function store_grants_applicant_data(Request $request)
    {
        
        $grants_details = Grants::find($request->grants_id);
        $this->validate($request,[
            'email' => 'required|email',
            'name' => 'required|string',
            'grants_id' => 'required',
        ],[
            'email.required' => __('email is required'),
            'email.email' => __('enter valid email'),
            'name.required' => __('name is required'),
            'grants_id.required' => __('must apply to any Grant'),
        ]);
        if (!empty($grants_details->application_fee_status) && $grants_details->application_fee > 0){
            $this->validate($request,[
                'selected_payment_gateway' => 'required|string'
            ],
                ['selected_payment_gateway.required' => __('You must have to select a payment gateway')]);
        }

        if (!empty($grants_details->application_fee_status) && $grants_details->application_fee > 0 && $request->selected_payment_gateway == 'manual_payment'){
            $this->validate($request,[
                'transaction_id' => 'required|string'
            ],
           ['transaction_id.required' => __('You must have to provide your transaction id')]);
        }

        $grant_applicant_id = GrantApplicant::create([
            'grants_id' => $request->grants_id,
            'payment_gateway' => $request->selected_payment_gateway,
            'email' => $request->email,
            'name' => $request->name,
            'application_fee' => $request->application_fee,
            'track' => Str::random(30),
            'payment_status' => 'pending',
        ])->id;

        $all_attachment = [];
        $all_quote_form_fields = (array) json_decode(get_static_option('apply_grant_page_form_fields'));
        $all_field_type = isset($all_quote_form_fields['field_type']) ? $all_quote_form_fields['field_type'] : [];
        $all_field_name = isset($all_quote_form_fields['field_name']) ? $all_quote_form_fields['field_name'] : [];
        $all_field_required = isset($all_quote_form_fields['field_required']) ? $all_quote_form_fields['field_required'] : [];
        $all_field_required = (object) $all_field_required;
        $all_field_mimes_type = isset($all_quote_form_fields['mimes_type']) ? $all_quote_form_fields['mimes_type'] : [];
        $all_field_mimes_type = (object) $all_field_mimes_type;

        //get field details from, form request
        $all_field_serialize_data = $request->all();
        unset($all_field_serialize_data['_token'],$all_field_serialize_data['grants_id'],$all_field_serialize_data['name'],$all_field_serialize_data['email'],$all_field_serialize_data['selected_payment_gateway']);

        if (!empty($all_field_name)){
            foreach ($all_field_name as $index => $field){
                $is_required = property_exists($all_field_required,$index) ? $all_field_required->$index : '';
                $mime_type = property_exists($all_field_mimes_type,$index) ? $all_field_mimes_type->$index : '';
                $field_type = isset($all_field_type[$index]) ? $all_field_type[$index] : '';
                $validation_rules = [];
                $validation_rules[] = !empty($is_required) ? 'required': 'nullable';
                if (!empty($field_type) && $field_type === 'file'){
                    unset($all_field_serialize_data[$field]);
                    if (!empty($mime_type)){
                        $validation_rules[]  = $mime_type;
                        $validation_rules[]  = 'max:200000';
                    }
                }
                if ($field_type === 'email'){
                    $validation_rules[]  = 'email';
                }

                //validate field

                $this->validate($request,[
                    $field => implode('|',$validation_rules)
                ]);

                if ($field_type == 'file' && $request->hasFile($field)) {
                    $filed_instance = $request->file($field);
                    $file_extenstion = $filed_instance->getClientOriginalExtension();
                    $attachment_name = 'attachment-'.$grant_applicant_id.'-'. $field .Str::random(10).'.'. $file_extenstion;
                    $filed_instance->move('assets/uploads/attachment/applicant', $attachment_name);
                    $all_attachment[$field] = 'assets/uploads/attachment/applicant/' . $attachment_name;
                }
            }
        }


        //update database
         GrantApplicant::where('id',$grant_applicant_id)->update([
            'form_content' => serialize($all_field_serialize_data),
            'attachment' => serialize($all_attachment)
        ]);
        $grant_applicant_details = GrantApplicant::where('id',$grant_applicant_id)->first();

        //check it application fee applicable or not
        if (!empty($grants_details->application_fee_status) && $grants_details->application_fee > 0){
            //have to redirect  to payment gateway route


            if($grant_applicant_details->payment_gateway === 'paypal'){

                /**
                 * @required param list
                 * $args['amount']
                 * $args['description']
                 * $args['item_name']
                 * $args['ipn_url']
                 * $args['cancel_url']
                 * $args['payment_track']
                 * return redirect url for paypal
                 * */
                $redirect_url =  paypal_gateway()->charge_customer([
                    'amount' => $grant_applicant_details->application_fee,
                    'description' => __('Payment For Grant Application Id:'). '#'.$grant_applicant_details->id.' '.__('grants Title:').' '.$grants_details->title.' '.__('Applicant Name:').' '.$grant_applicant_details->name.' '.__('Applicant Email:').' '.$grant_applicant_details->email,
                    'item_name' => __('Payment For Grant Application Id:'). '#'.$grant_applicant_details->id,
                    'ipn_url' => route('frontend.grant.paypal.ipn'),
                    'cancel_url' => route(self::CANCEL_ROUTE,$grant_applicant_details->id),
                    'payment_track' => $grant_applicant_details->track,
                ]);
                session()->put('grant_application_id',$grant_applicant_details->id);
                return redirect()->away($redirect_url);

            }elseif ($grant_applicant_details->payment_gateway === 'paytm'){
                /**
                 *
                 * charge_customer()
                 * @required params
                 * int order_id
                 * string name
                 * string email
                 * int/float amount
                 * string/url callback_url
                 * */
                $redirect_url =  paytm_gateway()->charge_customer([
                    'order_id' => $grant_applicant_details->id,
                    'email' => $grant_applicant_details->email,
                    'name' => $grant_applicant_details->name,
                    'amount' => $grant_applicant_details->application_fee,
                    'callback_url' => route('frontend.grant.paytm.ipn')
                ]);
                return $redirect_url;

            }elseif ($grant_applicant_details->payment_gateway === 'manual_payment'){

                event(new GrantApplication([
                    'transaction_id' => $request->transaction_id,
                    'grant_application_id' => $grant_applicant_details->id
                ]));

                return redirect()->route(self::SUCCESS_ROUTE,random_int(666666,999999).$grant_applicant_details->id.random_int(999999,999999));

            }elseif ($grant_applicant_details->payment_gateway === 'stripe'){
                $stripe_data['order_id'] = $grant_applicant_details->id;
                $stripe_data['route'] = route('frontend.grant.stripe.charge');
                return view('payment.stripe')->with('stripe_data' ,$stripe_data);

            }elseif ($grant_applicant_details->payment_gateway === 'razorpay'){

                /**
                 *
                 * @param array $args
                 * @paral list
                 * price
                 * title
                 * description
                 * route
                 * order_id
                 *
                 * @return @view with param
                 */
                $redirect_url = razorpay_gateway()->charge_customer([
                    'price' => $grant_applicant_details->application_fee,
                    'title' => $grants_details->title,
                    'description' => __('Payment For Grant Application Id:'). '#'.$grant_applicant_details->id.' '.__('grants Title:').' '.$grants_details->title.' '.__('Applicant Name:').' '.$grant_applicant_details->name.' '.__('Applicant Email:').' '.$grant_applicant_details->email,
                    'route' => route('frontend.grant.razorpay.ipn'),
                    'order_id' => $grant_applicant_details->id
                ]);
                return $redirect_url;

            }elseif ($grant_applicant_details->payment_gateway === 'paystack'){

                /**
                 * @required param list
                 * 'amount'
                 * 'package_name'
                 * 'name'
                 * 'email'
                 * 'order_id'
                 * 'track'
                 * */
                $view_file = paystack_gateway()->charge_customer([
                    'amount' => $grant_applicant_details->application_fee,
                    'package_name' => $grants_details->title,
                    'name' => $grant_applicant_details->name,
                    'email' => $grant_applicant_details->email,
                    'order_id' => $grant_applicant_details->id,
                    'track' => $grant_applicant_details->track,
                    'type' => 'grant',
                    'route' => route('frontend.paystack.pay'),
                ]);

                return $view_file;

            }elseif ($grant_applicant_details->payment_gateway === 'mollie'){


                /**
                 * @required param list
                 * amount
                 * description
                 * redirect_url
                 * order_id
                 * track
                 * */
                $return_url =  mollie_gateway()->charge_customer([
                    'amount' => $grant_applicant_details->application_fee,
                    'description' => __('Payment For Grant Application Id:'). '#'.$grant_applicant_details->id.' '.__('grants Title:').' '.$grants_details->title.' '.__('Applicant Name:').' '.$grant_applicant_details->name.' '.__('Applicant Email:').' '.$grant_applicant_details->email,
                    'web_hook' => route('frontend.grant.mollie.webhook'),
                    'order_id' => $grant_applicant_details->id,
                    'track' => $grant_applicant_details->track,
                ]);
                return $return_url;

            }elseif ($grant_applicant_details->payment_gateway === 'flutterwave'){


                /**
                 * @required params
                 * name
                 * email
                 * ipn_route
                 * amount
                 * description
                 * order_id
                 * track
                 *
                 * */
                $view_file =  flutterwaverave_gateway()->charge_customer([
                    'name' => $grant_applicant_details->name,
                    'email' => $grant_applicant_details->email,
                    'order_id' => $grants_details->id,
                    'amount' => $grant_applicant_details->application_fee,
                    'track' => $grant_applicant_details->track,
                    'description' =>  __('Payment For Grant Application Id:'). '#'.$grant_applicant_details->id.' '.__('grants Title:').' '.$grants_details->title.' '.__('Applicant Name:').' '.$grant_applicant_details->name.' '.__('Applicant Email:').' '.$grant_applicant_details->email,
                    'callback' => route('frontend.grant.flutterwave.callback'),
                ]);
                return $view_file;
            }

            return redirect()->route('homepage');

        }else{
            $succ_msg = get_static_option('apply_grant_' . get_user_lang() . '_success_message');
            $success_message = !empty($succ_msg) ? $succ_msg : __('Your Application Is Submitted Successfully!!');
             event(new GrantApplication([
                'transaction_id' => '',
                'grant_application_id' => $grant_applicant_details->id
            ]));
            return redirect()->back()->with(['msg' => $success_message, 'type' => 'success']);
        }
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function flutterwave_callback(Request $request)
    {

        /**
         *
         * @param array $args
         * @required param list
         * request
         *
         * @return array
         */
        $payment_data = flutterwaverave_gateway()->ipn_response([
            'request' => $request
        ]);

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            $grant_applicant = GrantApplicant::where( 'track', $payment_data['track'] )->first();
            event(new GrantApplication([
                'transaction_id' => $payment_data['transaction_id'],
                'grant_application_id' => $grant_applicant->id
            ]));
            $order_id = Str::random(6) . $grant_applicant->id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);
        }
        abort(404);
    }


    public function paypal_ipn(Request $request)
    {
        $grant_application_id = session()->get('grant_application_id');
        session()->forget('grant_application_id');
        /**
         * @required param list
         * $args['request']
         * $args['cancel_url']
         * $args['success_url']
         *
         * return @void
         * */
        $payment_data = paypal_gateway()->ipn_response([
            'request' => $request,
            'cancel_url' => route(self::CANCEL_ROUTE,$grant_application_id),
            'success_url' => route(self::SUCCESS_ROUTE,$grant_application_id)
        ]);

        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            //register and fire event
            event(new GrantApplication([
                'transaction_id' => $payment_data['transaction_id'],
                'grant_application_id' => $grant_application_id
            ]));

            $order_id = Str::random(6) . $grant_application_id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);
        }
    }

    public function paytm_ipn(Request $request){

        $grant_application_id = $request['ORDERID'];
        /**
         *
         * ipn_response()
         *
         * @return array
         * @param
         * transaction_id
         * status
         * */
        $payment_data = paytm_gateway()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            event(new GrantApplication([
                'transaction_id' => $payment_data['transaction_id'],
                'grant_application_id' => $grant_application_id
            ]));

            $order_id = Str::random(6) . $grant_application_id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);
        }
        return redirect()->route(self::CANCEL_ROUTE,$grant_application_id);
    }

    public function stripe_charge(Request $request){
        $grant_applicant_details = GrantApplicant::findOrFail($request->order_id);
        $grant_details = Grants::findOrFail($grant_applicant_details->grants_id);
        /**
         * @require params
         *
         * product_name
         * amount
         * description
         * ipn_url
         * cancel_url
         * order_id
         *
         * */

        $stripe_session =  stripe_gateway()->charge_customer([
            'product_name' => $grant_details->title,
            'amount' => $grant_applicant_details->application_fee,
            'description' => __('Payment For Grant Application Id:'). '#'.$grant_applicant_details->id.' '.__('grants Title:').' '.$grant_details->title.' '.__('Applicant Name:').' '.$grant_applicant_details->name.' '.__('Applicant Email:').' '.$grant_applicant_details->email,
            'ipn_url' => route('frontend.grant.stripe.ipn'),
            'order_id' => $request->order_id,
            'cancel_url' => route(self::CANCEL_ROUTE,$request->order_id)
        ]);
        return response()->json(['id' => $stripe_session['id']]);
    }

    public function stripe_ipn(Request $request)
    {

        /**
         * @require params
         * */
        $grant_applicant_id = session()->get('stripe_order_id');
        session()->forget('stripe_order_id');

        $payment_data = stripe_gateway()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            event(new GrantApplication([
                'transaction_id' => $payment_data['transaction_id'],
                'grant_application_id' => $grant_applicant_id
            ]));
            $order_id = Str::random(6) . $grant_applicant_id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);
        }
        return redirect()->route(self::CANCEL_ROUTE,$grant_applicant_id);
    }

    public function razorpay_ipn(Request $request){

        $grant_applicant_id = $request->order_id;
        /**
         *
         * @param array $args
         * require param list
         * request
         * @return array|string[]
         *
         */
        $payment_data = razorpay_gateway()->ipn_response(['request' => $request]);
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            event(new GrantApplication([
                'transaction_id' => $payment_data['transaction_id'],
                'grant_application_id' => $grant_applicant_id
            ]));
            $order_id = Str::random(6) . $grant_applicant_id. Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);
        }
        return redirect()->route(self::CANCEL_ROUTE,$grant_applicant_id);
    }

    public function mollie_webhook(){

        /**
         *
         * @param array $args
         * require param list
         * request
         * @return array|string[]
         *
         */
        $payment_data = mollie_gateway()->ipn_response();
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            event(new GrantApplication([
                'transaction_id' => $payment_data['transaction_id'],
                'grant_application_id' =>$payment_data['order_id']
            ]));
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);
        }
        abort(404);
    }

}
