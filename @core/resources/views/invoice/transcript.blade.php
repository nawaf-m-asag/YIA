<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title>{{__('transcript')}}</title>
    <style>

    body { font-family: "DejaVu Sans", sans-serif; 
text-align: right}

        table, td, th {
            border: 1px solid #ddd;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 15px;
        }

        /* cart page */
        .cart-wrapper table .thumbnail {
            max-width: 50px;
        }

        .cart-wrapper table .product-title {
            font-size: 16px;
            line-height: 26px;
            font-weight: 600;
            transition: 300ms all;
        }

        .cart-wrapper table .quantity {
            max-width: 80px;
            border: 1px solid #e2e2e2;
            height: 40px;
            padding-left: 10px;
        }

        .cart-wrapper table {
            color: #656565;
        }

        .cart-wrapper table th {
            color: #333;
        }

        .cart-total-wrap .title {
            font-size: 30px;
            line-height: 40px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .cart-total-table table td {
            color: #333;
        }

        .billing-details-wrapper .login-form {
            max-width: 450px;
        }

        .billing-details-wrapper {
            margin-bottom: 80px;
        }

        .billing-details-fields-wrapper .title {
            font-size: 30px;
            line-height: 40px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .product-orders-summery-warp .title {
            font-size: 24px;
            text-align: left;
            margin-bottom: 7px;
        }

        #pdf_content_wrapper {
            max-width: 1000px;
        }

        .cart-wrapper table .thumbnail img {
            width: 80px;
        }

        .cart-total-table-wrap .title {
            font-size: 25px;
            line-height: 34px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .billing-and-shipping-details div:first-child {
            margin-bottom: 30px;
        }

        .billing-and-shipping-details div ul {
            margin: 0;
            padding: 0;
        }

        .billing-and-shipping-details div ul li {
            font-size: 16px;
            line-height: 30px;
        }

        .billing-and-shipping-details div .title {
            font-size: 22px;
            line-height: 26px;
            font-weight: 600;
        }

        .billing-and-shipping-details {
            margin-top: 40px;
        }

        .billing-wrap ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .header .logo img{
            height: 100px;
            width: 100px;
            float: right;
        }
        .header{
            padding-top: 30px;
            width: 100%;
            height: 120px;
            border-bottom:solid 2px #cc0a0a ;
        }
        .header-left{
            width: 50%;
            float: right;
            text-align: center
        }
        .header-right{
            width: 50%;
            float: right;
        }
        .title{
            text-align: center;
        }
    </style>
</head>
<body>
<div id="pdf_content_wrapper">


    <div class="cart-table-wrapper cart-wrapper">
        <div class="header">
        <div class="header-right">
            <div class="logo">
                {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
            </div>
        </div>
        <div class="header-left">
            <h3>موقع المهندسين اليمنيين</h3>
        </div>
          
        </div>
       

    </div>

    <div class="cart-total-table-wrap">

        <h4 class="title">الدورات التدريبية</h4>
        <h4 class=""> كشف  لــ  {{$user_name}} </h4>
        @if (!empty($start_date ||$end_date))
        <h4 class="">
            @if (!empty($start_date))
           من تاريخ  {{$start_date}} 
            @endif
            @if (!empty($end_date))
           الى تاريخ {{$end_date}} 
            @endif
        
        </h4>
        @endif
       
        <hr>
        <div class="cart-total-table table-responsive">
            <div class="table100">
                <table dir="rtl">
                    <thead>
                        <tr class="table100-head">
                            <th class="column1">تاريخ الدورة</th>
                            <th class="column2">رقم الدوره</th>
                            <th class="column3">اسم الدوره</th>
                            <th class="column4">مدة الدورة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_course as $data)
                            <tr>
                                <td class="column1">{{date_format($data->created_at,'d M Y')}}</td>
                                <td class="column2">{{$data->course_id}}</td>
                                <td class="column3">{{optional(optional($data->course)->lang_front)->title}}</td>
                                <td class="column4">{{$data->course->duration}} {{$data->course->duration_type}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@if($print==true)
<script>
window.print();
</script>
@endif
</body>
</html>
