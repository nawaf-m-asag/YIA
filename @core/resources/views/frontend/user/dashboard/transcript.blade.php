@extends('frontend.user.dashboard.user-master')
@section('style')

	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/main.css')}}">
    <style>
        body{
            background:#e6e6e6f3;
        }
        .div-input{
            float: right;
            display: inline-block
        }
        .div-input input{
            height: 40px;
            border-radius: 3px;
            border: 1px solid #4b1515 !important;
       
        }
        .div-input input:hover {

            border: 1px solid  #dd0e0e !important;
        }
        .div-input span{
            float: right;
            position: relative;
            right:40px;
            top: -15px;
            background:#fff;
            padding-left:3px; 
            padding-right:3px; 
        }
        .container-table100{
            background: #fff;
            border-radius: 3px;
            margin-bottom: 20px;
        }
        table{
            border:solid 1px #555;
        }
        #download{
            position: relative;
            left: 10px;
            top:50px;
        }
        .search{
            display: inline;
        }
        .search button{
            margin-right: 10px;
            float: right;
            height: 40px;
            background:var(--main-color-one);
        }
    </style>
@endsection
@section('section')
    @if(!empty(get_static_option('course_module_status')))
        @if(count($all_enrolls) > 0)
        <div class="limiter">
            <form id="download" action="{{route('frontend.course.transcript.generate')}}"  method="post">
                @csrf
                <input id="start_date" type="hidden" name="start_date">
                <input id="end_date" type="hidden" name="end_date">
                <input type="hidden" name="id" id="invoice_generate_order_field" value="">
                <button class="btn btn-xs btn-small margin-top-10" name="print" value="print" type="submit" ><i class="fas fa-print"></i></button>
                <button class="btn btn-xs btn-small" name="download" value="download" type="submit"><i class="fas fa-download"></i></button>
               
            </form>
            <div class="container-table100">
                <div class="wrap-table100">
                    <div class="row">
                    <div class="col-9 m-3 search">
                        <form  action="{{route('user.home.course.transcript.post')}}"  method="post">
                            @csrf
                            <div class="div-input">
                                <span>مـن</span>
                                <input id="input_start" name="input_start" type="date" value="{{$input_start}}" required>
                            </div>
                            <div class="div-input">
                                <span>الـى</span>
                                <input id="input_end" name="input_end" type="date" value="{{$input_end}}" required>
                            </div>
                            <button class="btn btn-xs btn-small"><i class="fas fa-search"></i></button>
                        </form>    
                    </div>

                    </div>
                    <div class="table100">
                        <table>
                            <thead>
                                <tr class="table100-head">
                                    <th class="column1">تاريخ الدورة</th>
                                    <th class="column2">رقم الدوره</th>
                                    <th class="column3">اسم الدوره</th>
                                    <th class="column4">مدة الدورة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_enrolls as $data)
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
    
        @else
            <div class="alert alert-warning">{{__('Nothing Found')}}</div>
        @endif
    @endif
@endsection
@section('scripts')
    <script>
        $(document).on("change", "#input_start", function () {
           $('#start_date').val($('#input_start').val());
        });
        $(document).on("change", "#input_end", function () {
           $('#end_date').val($('#input_end').val());
        });

    </script>
@endsection
