@extends('backend.admin-master')
@section('style')
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
    {{__('Certificate Users')}}
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
                                    <h4 class="header-title">{{__('All Users')}}</h4>
                                    <div class="bulk-delete-wrapper">
                                        <div class="select-box-wrap">
                                            <select name="bulk_option" id="bulk_option">
                                                <option value="">{{{__('Bulk Action')}}}</option>
                                                <option value="delete">{{{__('Delete')}}}</option>
                                            </select>
                                            <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                                        </div>
                                    </div>
                                    <div class="data-tables datatable-primary">
                                        <table id="all_user_table" class="text-center">
                                            <thead class="text-capitalize">
                                            <tr>
                                                <th class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th>{{__('ID')}}</th>
                                                <th>{{__('Name')}}</th>
                                                <th>{{__('University Name')}}</th>
                                                <th>{{__('Specialization')}}</th>
                                                <th>{{__('Graduation Date')}}</th>
                                                <th>{{__('Certificate Status')}}</th>
                                                <th>{{__('Attached File')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($certificate_user as $data)
                                                <tr>
                                                    <td>
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                        </div>
                                                    </td>
                                                    <td>{{$data->id}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->university_name}}</td>
                                                    <td>{{$data->specialization}}</td>
                                                    <td>{{$data->graduation_date}}</td>
                                                    <td>
                                                        @if ($data->certificate_status==0)
                                                        <span class="btn btn-warning btn-sm mb-3 mr-1">{{__('Pending')}}</span>
                                                        @endif
                                                        @if ($data->certificate_status==1)
                                                        <span class="btn btn-success btn-sm mb-3 mr-1">{{__('Approved')}}</span>
                                                        @endif
                                                        @if ($data->certificate_status==2)
                                                        <span class="btn btn-danger btn-sm mb-3 mr-1">{{__('Canceled')}}</span>
                                                        @endif
                                                      
                                                    
                                                    </td>
                                                    <td><a download="" href="/assets/uploads/certificate-user/{{$data->attached_file}}" class="btn btn-info btn-sm mb-3 mr-1">{{__('File')}}</a></td>
                                                    <td>
                                                     
                                                        <a href="#"
                                                           data-state="{{$data->state}}"
                                                           data-toggle="modal"
                                                           data-target="#user_edit_modal"
                                                           class="btn btn-xs btn-primary btn-sm mb-3 mr-1 user_edit_btn"
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
                    <h5 class="modal-title">{{__('User Details Edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.frontend.user.status.update')}}" id="user_edit_modal_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$data->id}}">
                        <div class="form-group">
                            <label for="state">{{__('State')}}</label>
                            <select name="certificate_status" class="form-control" id="certificate_status">
                                <option value="0">{{__('Pending')}}</option>
                                <option value="1">{{__('Approved')}}</option>
                                <option value="2">{{__('Canceled')}}</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_change_password_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Change Admin Password')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('admin.frontend.user.password.change')}}" id="user_password_change_modal_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="ch_user_id" id="ch_user_id">
                        <div class="form-group">
                            <label for="password">{{__('Password')}}</label>
                            <input type="password" class="form-control" name="password" placeholder="{{__('Enter Password')}}">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{__('Confirm Password')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Change Password')}}</button>
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

            $(document).on('click','.user_change_password_btn',function(e){
                e.preventDefault();
                var el = $(this);
                var form = $('#user_password_change_modal_form');
                form.find('#ch_user_id').val(el.data('id'));
            });
            $('#all_user_table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );

            $(document).on('click','.user_edit_btn',function(e){
                e.preventDefault();
                var form = $('#user_edit_modal_form');
                var el = $(this);

                form.find('#user_id').val(el.data('id'));
                form.find('#name').val(el.data('name'));
                form.find('#username').val(el.data('username'));
                form.find('#email').val(el.data('email'));
                form.find('#phone').val(el.data('phone'));
                form.find('#state').val(el.data('state'));
                form.find('#city').val(el.data('city'));
                form.find('#zipcode').val(el.data('zipcode'));
                form.find('#address').val(el.data('address'));
                form.find('#country option[value="'+el.data('country')+'"]').attr('selected',true);

            });

            $(document).on('click','#bulk_delete_btn',function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox =  $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function(index,value){
                    allIds.push($(this).val());
                });
                if(allIds != '' && bulkOption == 'delete'){
                    $(this).text('{{__('Deleting...')}}');
                    $.ajax({
                        'type' : "POST",
                        'url' : "{{route('admin.all.frontend.user.bulk.action')}}",
                        'data' : {
                            _token: "{{csrf_token()}}",
                            ids: allIds
                        },
                        success:function (data) {
                            location.reload();
                        }
                    });
                }

            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });


        } );
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
