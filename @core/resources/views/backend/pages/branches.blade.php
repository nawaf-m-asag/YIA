@extends('backend.admin-master')
@section('site-title')
    {{__('branches')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 60px;
            display: inline-block;
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('branches Items')}}</h4>
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value="">{{{__('Bulk Action')}}}</option>
                                    <option value="delete">{{{__('Delete')}}}</option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                            </div>
                        </div>
                      
                        <div class="tab-content margin-top-40" id="myTabContent">
               
                                <div >
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default">
                                        <thead>
                                        <th class="no-sort">
                                            <div class="mark-all-checkbox">
                                                <input type="checkbox" class="all-checkbox">
                                            </div>
                                        </th>
                                        <th>{{__('ID')}}</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('price')}}</th>
                                        <th>{{__('Phone')}}</th>
                                        <th>{{__('Address')}}</th>
                                        <th>العمليات</th>
                                        </thead>
                                        <tbody>
                                        @foreach($all_branches as $data)
                                            <tr>
                                                <td>
                                                    <div class="bulk-checkbox-wrapper">
                                                        <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                    </div>
                                                </td>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->price}}</td>
                                                <td>{{$data->phone}}</td>
                                                <td>{{$data->address}}</td>

                                                <td>
                                                    <x-delete-popover :url="route('admin.branches.delete',$data->id)"/>
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#branches_item_edit_modal"
                                                       class="btn btn-primary btn-xs mb-3 mr-1 branches_edit_btn"
                                                       data-id="{{$data->id}}"
                                                       data-name="{{$data->name}}"
                                                       data-price="{{$data->price}}"
                                                       data-phone="{{$data->phone}}"
                                                       data-address="{{$data->address}}"
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
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('New branches')}}</h4>
                        <form action="{{route('admin.branches')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control"  id="name"  name="name" placeholder="{{__('Name')}}">
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('price')}}</label>
                                <input type="text" class="form-control"  id="price"  name="price" placeholder="{{__('Price')}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{__('Phone')}}</label>
                                <input type="text" class="form-control"  id="phone"  name="phone" placeholder="{{__('Phone')}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('Address')}}</label>
                                <input type="text" class="form-control"  id="address"  name="address" placeholder="{{__('Address')}}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New branches')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="branches_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit branches Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.branches.update')}}" id="branches_edit_modal_form" enctype="multipart/form-data"  method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="branches_id" value="">
                        <div class="form-group">
                            <label for="name">{{__('Name')}}</label>
                            <input type="text" class="form-control"  id="edit_name"  name="name" placeholder="{{__('Name')}}">
                        </div>
                        <div class="form-group">
                            <label for="price">{{__('price')}}</label>
                            <input type="text" class="form-control"  id="edit_price"  name="price" placeholder="{{__('Price')}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">{{__('Phone')}}</label>
                            <input type="text" class="form-control"  id="edit_phone"  name="phone" placeholder="{{__('Phone')}}">
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('Address')}}</label>
                            <input type="text" class="form-control"  id="edit_address"  name="address" placeholder="{{__('Address')}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                        </div>
                  
                    </div>
                        
                </form>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script>
        $(document).ready(function () {

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
                        'url' : "{{route('admin.branches.bulk.action')}}",
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



            $(document).on('click','.branches_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var name = el.data('name');
                var form = $('#branches_edit_modal_form');
                form.find('#branches_id').val(id);
                form.find('#edit_name').val(name);
                form.find('#edit_price').val(el.data('price'));
                form.find('#edit_phone').val(el.data('phone'));
                form.find('#edit_address').val(el.data('address'));

            });

        });
    </script>

    <!-- Start datatable js -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.table-wrap > table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );
        } );
    </script>
     <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
