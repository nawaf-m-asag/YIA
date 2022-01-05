@extends('backend.admin-master')
@section('site-title')
discounts
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
                        <h4 class="header-title">الكل</h4>
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value="">اجراء جماعي</option>
                                    <option value="delete">حذف</option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">تطبيق</button>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                            <thead>
                            <th class="no-sort">
                                <div class="mark-all-checkbox">
                                    <input type="checkbox" class="all-checkbox">
                                </div>
                            </th>
                            <th>المعرف</th>
                            <th>العنوان</th>
                            <th>الرابط</th>
                            <th>الصورة</th>
                            <th>العمليات</th>
                            </thead>
                            <tbody>
                            @foreach($all_discount as $data)
                                <tr>
                                    <td>
                                        <div class="bulk-checkbox-wrapper">
                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                        </div>
                                    </td>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->title}}</td>
                                    <td>{{$data->url}}</td>
                                    <td>
                                        @php
                                            $discount_img = get_attachment_image_by_id($data->image,null,true);
                                            $img_url = '';
                                        @endphp
                                        @if (!empty($discount_img))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$discount_img['img_url']}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            @php  $img_url = $discount_img['img_url']; @endphp
                                        @endif
                                    </td>
                                    <td>
                                        <x-delete-popover :url="route('admin.discounts.delete',$data->id)"/>
                                        <a href="#"
                                           data-toggle="modal"
                                           data-target="#discount_item_edit_modal"
                                           class="btn btn-xs btn-primary btn-sm mb-3 mr-1 discount_edit_btn"
                                           data-id="{{$data->id}}"
                                           data-title="{{$data->title}}"
                                           data-url="{{$data->url}}"
                                           data-imageid="{{$data->image}}"
                                           data-image="{{$img_url}}"
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
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">اضافة جديد</h4>
                        <form action="{{route('admin.discounts')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">العنوان</label>
                                <input type="text" class="form-control"  id="title"  name="title" placeholder="العنوان">
                            </div>
                            <div class="form-group">
                                <label for="url">الرابط</label>
                                <input type="text" class="form-control"  id="url"  name="url" placeholder="الرابط">
                            </div>
                            <div class="form-group">
                                <label for="image">الصورة</label>
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap"></div>
                                    <input type="hidden" name="image">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="تحديد" data-modaltitle="رفع صورة" data-toggle="modal" data-target="#media_upload_modal">
                                        رفع صورة
                                    </button>
                                </div>
                               
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">اضافة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="discount_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تحرير</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('admin.discounts.update')}}" id="discount_edit_modal_form"  method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" class="form-control" name="id"  id="discount_id" >
                        <div class="form-group">
                            <label for="edit_title">العنوان</label>
                            <input type="text" class="form-control"  id="edit_title"  name="title" placeholder="العنوان">
                        </div>
                        <div class="form-group">
                            <label for="edit_url">الرابط</label>
                            <input type="text" class="form-control"  id="edit_url"  name="url" placeholder="الرابط">
                        </div>
                        <div class="form-group">
                            <label for="edit_image">الصورة</label>
                            <div class="media-upload-btn-wrapper">
                                <div class="img-wrap"></div>
                                <input type="hidden" id="edit_image" name="image" value="">
                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="تحديد" data-modaltitle="رفع صورة" data-toggle="modal" data-target="#media_upload_modal">
                                   رفع صورة
                                </button>
                            </div>
                          
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
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
                        'url' : "{{route('admin.discounts.bulk.action')}}",
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

            $(document).on('click','.discount_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var form = $('#discount_edit_modal_form');
                var image = el.data('image');
                var imageid = el.data('imageid');

                form.find('#discount_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_url').val(el.data('url'));

                if(imageid != ''){
                    form.find('.media-upload-btn-wrapper .img-wrap').html('<div class="attachment-preview"><div class="thumbnail"><div class="centered"><img class="avatar user-thumb" src="'+image+'" > </div></div></div>');
                    form.find('.media-upload-btn-wrapper input').val(imageid);
                    form.find('.media-upload-btn-wrapper .media_upload_form_btn').text('Change Image');
                }
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
