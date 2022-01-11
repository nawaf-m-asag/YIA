@extends('frontend.frontend-page-master')
@section('page-title')
    تاكيد الطلب
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-confirm-area">
                        <h4 class="title">تفاصيل الطلب</h4>
                        <x-error-msg/>
                        <x-flash-msg/>
                        <form action="{{route('frontend.order.payment.form')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @php
                            $custom_fields = unserialize( $order_details->custom_fields);
                            $payment_gateway = !empty($custom_fields['selected_payment_gateway']) ? $custom_fields['selected_payment_gateway'] : '';
                            $name = auth()->check() ? auth()->user()->name : '';
                            $email = auth()->check() ? auth()->user()->email :'';
                            @endphp
                            <input type="hidden" name="order_id" value="{{$order_details->id}}">
                            <input type="hidden" name="payment_gateway" value="{{$payment_gateway}}">
                             <input type="hidden" name="captcha_token" id="gcaptcha_token">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td>الاسم</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="name" value="{{$name}}" class="form-control" placeholder="ادخل الاسم">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>البريد الالكتروني</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="email" name="email" value="{{$email}}" class="form-control" placeholder="ادخل البريد الالكتروني">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>اسم العضوية</td>
                                    <td>{{$order_details->package_name}}</td>
                                </tr>
                                <tr>
                                    <td>السعر</td>
                                    <td>
                                        @if ($order_details->branche_id!=0)
                                        <table border="1" style="width: 100%;">
                                            <tr>
                                                <td> {{$order_details->package_name}}</td> 
                                                <td>{{amount_with_currency_symbol($order_details->package_price-$order_details->branches->price)}}</td>   
                                            </tr>
                                            <tr>
                                                <td> {{ $order_details->branches->name}}</td> 
                                                <td>{{ amount_with_currency_symbol($order_details->branches->price)}}</td>   
                                            </tr>    
                                            <tr>
                                                <td>الاجمالي</td> 
                                                <td>{{amount_with_currency_symbol($order_details->package_price)}}</td>   
                                            </tr>  
                                    </table>
                                        @else
                                        <strong>{{amount_with_currency_symbol($order_details->package_price)}}</strong>
                                        @endif
                                  
                                        @if(!check_currency_support_by_payment_gateway($payment_gateway))
                                            <br>
                                            <small> <strong>{{get_charge_amount($order_details->package_price,$payment_gateway).get_charge_currency($payment_gateway)}}</strong></small>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>طريقة الدفع</td>
                                    <td class="text-capitalize">
                                        @if($payment_gateway == 'manual_payment')
                                            {{get_static_option('site_manual_payment_name')}}
                                        @else
                                            {{$payment_gateway}}
                                        @endif
                                    </td>
                                </tr>
                                @if($payment_gateway == 'manual_payment')
                                    <tr>
                                        <td>رقم المعاملة</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="trasaction_id" class="form-control">
                                                <small>{!! get_manual_payment_description() !!}</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="btn-wrapper">
                            <button type="submit" class="submit-btn style-01">دفع الان</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if(!empty(get_static_option('site_google_captcha_v3_site_key')) && !empty(get_static_option('site_google_captcha_status')))
        <script
            src="https://www.google.com/recaptcha/api.js?render={{get_static_option('site_google_captcha_v3_site_key')}}"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute("{{get_static_option('site_google_captcha_v3_site_key')}}", {action: 'homepage'}).then(function (token) {
                    document.getElementById('gcaptcha_token').value = token;
                });
            });
        </script>
    @endif
@endsection
