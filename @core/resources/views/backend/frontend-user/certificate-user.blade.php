@extends('backend.admin-master')
@section('style')

	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/main.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
   شهادات الاعضاء
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <x-error-msg/>
                                    <x-flash-msg/>
                                    <h4 class="header-title">كل الشهادات</h4>
                                    <div class="data-tables datatable-primary">
                                        <table id="all_user_table" class="text-center">
                                            <thead class="text-capitalize">
                                            <tr>
                                                <th>المعرف</th>
                                                <th>الاسم</th>
                                                <th>اسم الجامعة</th>
                                                <th>التخصص</th>
                                                <th>تاريخ التخرج</th>
                                                <th>حالة الشهادة</th>
                                                <th>ملف مرفق</th>
                                                <th>العمليات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($certificate_user as $data)
                                                <tr>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->university_name}}</td>
                                                    <td>{{$data->specialization}}</td>
                                                    <td>{{$data->graduation_date}}</td>
                                                    <td>
                                                        @if ($data->certificate_status==0)
                                                        <span class="btn btn-warning btn-sm mb-3 mr-1">قيد الانتظار</span>
                                                        @endif
                                                        @if ($data->certificate_status==1)
                                                        <span class="btn btn-success btn-sm mb-3 mr-1">تم الموافقة</span>
                                                        @endif
                                                        @if ($data->certificate_status==2)
                                                        <span class="btn btn-danger btn-sm mb-3 mr-1">ملغاه</span>
                                                        @endif
                                                      
                                                    
                                                    </td>
                                                    <td><a download="" href="/assets/uploads/certificate-user/{{$data->attached_file}}" class="btn btn-info btn-sm mb-3 mr-1">{{__('File')}}</a></td>
                                                    <td>
                                                     
                                                        <a href="#"
                                                           data-id="{{$data->id}}"
                                                           data-state="{{$data->certificate_status}}"
                                                           data-toggle="modal"
                                                           data-target="#user_edit_modal"
                                                           class="btn btn-xs btn-primary btn-sm mb-3 mr-1 user_edit_modal"
                                                        >
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Primary table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل  حالة الشهادة</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.frontend.user.status.update')}}" id="user_edit_modal_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <input id="user_id" type="hidden" name="user_id" value="">
                        <div class="form-group">
                            <label for="state">الحالة</label>
                            <select name="certificate_status" class="form-control" id="state">
                                <option value="0">قيد الانتظار</option>
                                <option value="1">تم الموافقة</option>
                                <option value="2">ملغاه</option>
                            </select>
                            
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

    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {


            $(document).on('click','.user_edit_modal',function(e){
                e.preventDefault();
                var form = $('#user_edit_modal_form');
                var el = $(this);
                form.find('#user_id').val(el.data('id'));
                form.find('#state').val(el.data('state'));

            });


        } );
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
