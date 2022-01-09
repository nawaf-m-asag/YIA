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
        .div-input input,#self_reports_edit_modal input{
            height: 40px;
            border-radius: 3px;
            border: 1px solid #4b1515 !important;
       
        }
        .div-input input:hover ,#self_reports_edit_modal input:hover{

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
        .btn-add{
            height: 40px;
            width: 60px;
            background: #1a8d0b94;
            float: right;
            color: #fff;
        }
        #self_reports_edit_modal{
            text-align: right;
        }
        .close{
            display: contents;
        }
    </style>
@endsection
@section('section')
    @if(!empty(get_static_option('course_module_status')))
        @if(count($all_self_reports) > 0)
        <div class="limiter">
            <form id="download" action="{{route('frontend.course.self_reports.generate')}}"  method="post">
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
                    <div class="col-7 m-3 search">
                        <form  action="{{route('user.home.self_reports.post')}}"  method="post">
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
                    <div class="col-4 m-3">
                        <button  
                         data-toggle="modal"
                        data-target="#self_reports_edit_modal" class="btn btn-xs btn-add">أضافة</button>
                    </div>    


                    </div>
                    <div class="table100">
                        <table>
                            <thead>
                                <tr class="table100-head">
                                    <th class="column1">تاريخ الدورة</th>
                                    <th class="column2">رقم الدوره</th>
                                    <th class="column3">اسم الدوره</th>
                                    <th class="column2">النوع</th>
                                    <th class="column2">ملف</th>
                                    <th class="column2">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_self_reports as $data)
                                    <tr>
                                        <td class="column1">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->submitted_on)->format('Y/m/d') }}</td>
                                        <td class="column2">{{$data->credit}}</td>
                                        <td class="column3">{{$data->course_name}}</td>
                                        <td class="column2">{{$data->credit_type}}</td>
                                        <td><a  @if(!empty($data->file)) download="" href="/assets/uploads/certificate-user/{{$data->file}}" @endif class="btn btn-info btn-sm mb-3 mr-1">{{__('File')}}</a></td>
                                        <td class="column2">
                                            @if ($data->status==0)
                                            <span class="btn btn-warning btn-sm mb-3 mr-1">قيد الانتظار</span>
                                            @endif
                                            @if ($data->status==1)
                                            <span class="btn btn-success btn-sm mb-3 mr-1">تم الموافقة</span>
                                            @endif
                                            @if ($data->status==2)
                                            <span class="btn btn-danger btn-sm mb-3 mr-1">ملغاه</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="self_reports_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">  اضافة شهادة الشهادة</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{route('user.home.self_reports.stor')}}" id="self_reports_edit_modal_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="credit">رقم الدورة</label>
                                    <input type="text" class="form-control"  id="credit" name="credit" placeholder="رقم الدورة">
                                </div>
                                <div class="form-group">
                                    <label for="course_name">اسم الدورة</label>
                                    <input type="text" class="form-control"  id="course_name" name="course_name" placeholder="اسم الدورة">
                                </div>
                                <div class="form-group">
                                    <label for="credit_type">النوع</label>
                                    <input type="text" class="form-control"  id="credit_type" name="credit_type" placeholder="النوع">
                                </div>
                                <div class="form-group">
                                    <label for="submitted_on"> تاريخ الدورة</label>
                                    <input type="date" class="form-control"  id="submitted_on" name="submitted_on" placeholder="تاريخ الدورة">
                                </div>
                                <div class="form-group">
                                    <label for="file">ملف مرفق</label>
                                    <input type="file" class="form-control"  id="file" name="file" placeholder="ملف">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ التغيير</button>
                        </div>
                    </form>
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
