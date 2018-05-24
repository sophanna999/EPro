@extends('Admin.layouts.layouts')
@section('breadcrumbs')
<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="#">Home</a>
        </li>

        <li>
            <a href="#">Other Pages</a>
        </li>
        <li class="active">Blank Page</li>
    </ul><!-- /.breadcrumb -->
    @if($permission['C']=='T')
    <!-- #section:basics/content.searchbox -->
    <div class="nav-search" id="nav-search">
        <button class="btn btn-xs btn-success btn-add">
            + Add {{$title or 'New Data'}}
        </button>
    </div><!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
    @endif
</div>
@endsection
@section('body')
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="table-responsive">
                <table class="table table-hover" id="TableAdmin">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Nickname</th>
                            <th>Mobile</th>
                            <th>Username</th>
                            <th>Photo</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->
<!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormAdd">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add data {{$title or 'New Data'}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div >
                             <div id="photo" orakuploader="on"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nickname">Nickname</label>
                            <input type="text" class="form-control" name="nickname" id="nickname" placeholder="Nickname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile">Phone</label>
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="Password">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormEdit">
            <input type="hidden" name="id" id="edit_user_id" placeholder="ชื่อ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Data {{$title or 'New Data'}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="edit_photo" orakuploader="on"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" name="firstname" id="edit_firstname" placeholder="Firstname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" name="lastname" id="edit_lastname" placeholder="Lastname">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nickname">Nickname</label>
                            <input type="text" class="form-control" name="nickname" id="edit_nickname" placeholder="Nickname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile">Phone</label>
                            <input type="text" class="form-control" name="mobile" id="edit_mobile" placeholder="Phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="edit_username" placeholder="Username">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="edit_address" placeholder="Address">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalChangePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormChangePassword">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="username">Current Password</label>
                    <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password">
                </div>
                <div class="form-group">
                    <label for="username">New Password</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="username">Confirm New Password</label>
                    <input type="password" class="form-control" name="conf_new_password" id="conf_new_password" placeholder="Confirm New Password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>Change Password</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalPermission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormChangePermssion">
                <input type="hidden" name="id" id="permssion_user_id" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Admin Authority</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center">No.</th>
                            <th rowspan="2" class="text-center">Menus</th>
                            <th colspan="4" class="text-center">Authorities</th>
                        </tr>
                        <tr>
                            <th class="text-center">Direct Access</th>
                            <th class="text-center">Create</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menu_all as $key=>$menu)
                            <tr class="main">
                                <td class="text-center">{{$menu->id}}</td>
                                <td>{{$menu->name}}</td>
                                <td class="text-center">
                                    <label class="block">
                                        <input name="read[{{$menu->id}}]" value="{{$menu->id}}" type="checkbox" class="ace input read_{{$menu->id}}" />
                                        <span class="lbl bigger-120"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="block">
                                        <input name="create[{{$menu->id}}]" value="{{$menu->id}}" type="checkbox" class="ace input create_{{$menu->id}}" />
                                        <span class="lbl bigger-120"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="block">
                                        <input name="edit[{{$menu->id}}]" value="{{$menu->id}}" type="checkbox" class="ace input update_{{$menu->id}}" />
                                        <span class="lbl bigger-120"></span>
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="block">
                                        <input name="delete[{{$menu->id}}]" value="{{$menu->id}}" type="checkbox" class="ace input delete_{{$menu->id}}" />
                                        <span class="lbl bigger-120"></span>
                                    </label>
                                </td>
                            </tr>
                            @if($menu->SubMenu)
                                @foreach($menu->SubMenu as $key=>$sub_menu)
                                    <tr class="sub">
                                        <td class="text-center">{{$sub_menu->id}}</td>
                                        <td>{{$menu->name}} > {{$sub_menu->name}}</td>
                                        <td class="text-center">
                                            <label class="block">
                                                <input name="read[{{$sub_menu->id}}]" value="{{$sub_menu->id}}" type="checkbox" class="ace input read_{{$sub_menu->id}}" />
                                                <span class="lbl bigger-120"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="block">
                                                <input name="create[{{$sub_menu->id}}]" value="{{$sub_menu->id}}" type="checkbox" class="ace input create_{{$sub_menu->id}}" />
                                                <span class="lbl bigger-120"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="block">
                                                <input name="edit[{{$sub_menu->id}}]" value="{{$sub_menu->id}}" type="checkbox" class="ace input update_{{$sub_menu->id}}" />
                                                <span class="lbl bigger-120"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="block">
                                                <input name="delete[{{$sub_menu->id}}]" value="{{$sub_menu->id}}" type="checkbox" class="ace input delete_{{$sub_menu->id}}" />
                                                <span class="lbl bigger-120"></span>
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js_bottom')
<script>
     var TableAdmin = $('#TableAdmin').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url_gb+"/admin/AdminUser/ListAdmin",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_Row_Index", "className": "text-center", "orderable": false, "searchable": false},
            { "data": "firstname" },
            { "data": "lastname" },
            { "data": "nickname" },
            { "data": "mobile" },
            { "data": "username" },
            { "data": "photo" },
            // { "data": "lastname" , visible : false },
            // { "data": "nickname" , visible : false},
            { "data": "action","className":"action text-center", "searchable":false }
        ],

        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        "language": {
            "aria": {
                "sortAscending": ": เรียงจากน้อยไปมาก",
                "sortDescending": ": เรียงจากมากไปน้อย"
            },
            "emptyTable": "No matching records found",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": " ",
            "infoFiltered": "(filtered1 from _MAX_ total entries)",
            "lengthMenu": "_MENU_ entries",
            "search": "Search:",
            "zeroRecords": "No matching records found"
        },
        responsive: true,
        "drawCallback": function( settings ) {
            $('.btn-tooltip').tooltip({
                placement : 'top',
                trigger : 'hover',
            });
        }
    });
    $('body').on('click','.btn-add',function(data){
        $('#ModalAdd').modal('show');
    });
    $('body').on('click','.btn-edit',function(data){
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $('#edit_user_id').val(id);
        $.ajax({
            method : "POST",
            url : url_gb+"/admin/AdminUser/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_firstname').val(rec.firstname);
            $('#edit_lastname').val(rec.lastname);
            $('#edit_nickname').val(rec.nickname);
            $('#edit_mobile').val(rec.mobile);
            $('#edit_username').val(rec.username);
            $('#edit_address').val(rec.address);
            if (rec.photo) {
                    var max =0;
                    var img = rec.photo;
                } else {

                    var max =1;
                    var img = null;
                }
                $('#edit_photo').parent().html('<div id="edit_photo" orakuploader="on"></div>');
                 image_reload(max,img);
            btn.button("reset");
            $('#ModalEdit').modal('show');
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });

    $('body').on('click','.btn-change-password',function(data){
        $('#ModalChangePassword').modal('show');
    });

    // $('body').on('click','.btn-authority',function(data){
    //     $('#ModalAuthority').modal('show');
    // });

    $('#FormAdd').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            firstname: {
                required: true,
            },
            nickname: {
                required: true,
            },
            mobile: {
                required: true,
            },
            username: {
                required: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            firstname: {
                required: 'กรุณาระบุ',
            },
            nickname: {
                required: 'กรุณาระบุ',
            },
            mobile: {
                required: 'กรุณาระบุ',
            },
            username: {
                required: 'กรุณาระบุ',
            },
            password: {
                required: 'กรุณาระบุ',
            }
        },
        highlight: function (e) {
            validate_highlight(e);
        },
        success: function (e) {
            validate_success(e);
        },

        errorPlacement: function (error, element) {
            validate_errorplacement(error, element);
        },
        submitHandler: function (form) {
            var btn = $(form).find('[type="submit"]');

            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/AdminUser",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableAdmin.api().ajax.reload();
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
                    $('#ModalAdd').modal('hide');
                }else{
                    swal(rec.title,rec.content,"error");
                }
            }).error(function(){
                swal("system.system_alert","system.system_error","error");
                btn.button("reset");
            });
        },
        invalidHandler: function (form) {

        }
    });

    $('#FormEdit').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            firstname: {
                required: true,
            },
            nickname: {
                required: true,
            },
            mobile: {
                required: true,
            }
        },
        messages: {
            firstname: {
                required: 'กรุณาระบุ',
            },
            nickname: {
                required: 'กรุณาระบุ',
            },
            mobile: {
                required: 'กรุณาระบุ',
            }
        },
        highlight: function (e) {
            validate_highlight(e);
        },
        success: function (e) {
            validate_success(e);
        },

        errorPlacement: function (error, element) {
            validate_errorplacement(error, element);
        },
        submitHandler: function (form) {
            var btn = $(form).find('[type="submit"]');
            var id = $('#edit_user_id').val();
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/AdminUser/Checkedit/"+id,
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableAdmin.api().ajax.reload();
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
                    $('#ModalEdit').modal('hide');
                }else{
                    swal(rec.title,rec.content,"error");
                }
            }).error(function(){
                swal("system.system_alert","system.system_error","error");
                btn.button("reset");
            });
        },
        invalidHandler: function (form) {

        }
    });

    $('#FormChangePassword').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            current_password: {
                required: true,
            },
            new_password: {
                required: true,
                minlength: 4,
                maxlength: 16,
            },
            conf_new_password: {
                required: true,
                equalTo: "#new_password",
            }

        },
        messages: {
            current_password: {
                required: 'Please fill your current password',
            },
            new_password: {
                required: 'Please fill your new password',
                minlength: 'Please enter password between 4 - 16',
                maxlength: 'Please enter password between 4 - 16',
            }

        },
        highlight: function (e) {
            validate_highlight(e);
        },
        success: function (e) {
            validate_success(e);
        },

        errorPlacement: function (error, element) {
            validate_errorplacement(error, element);
        },
        submitHandler: function (form) {
            var btn = $(form).find('[type="submit"]');

            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/AdminUser/Change_password",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
                    $('#ModalChangePassword').modal('hide');
                }else{
                    swal(rec.title,rec.content,"error");
                }
            }).error(function(){
                swal("system.system_alert","system.system_error","error");
                btn.button("reset");
            });
        },
        invalidHandler: function (form) {

        }
    });

    $("body").on("click",".btn-delete",function(){
        var id = $(this).data("id");
        swal({
            title: "Are you sure to delete this data?",
            text: "If you have deleted this data you can not revert it back!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes I should be delete",
            cancelButtonText: "Cancel",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(data) {
            if(data){
                $.ajax({
                    method : "POST",
                    url : url_gb+"/admin/AdminUser/Delete/"+id,
                    data : {ID : id}
                }).done(function(data){
                    if(data){
                        var rec = $.parseJSON(data);
                        if(rec.status==1){
                            swal(rec.title,rec.content,"success");
                            TableAdmin.api().ajax.reload();
                        }else{
                            swal(rec.title,rec.content,"error");
                        }
                    }else{
                        swal("System have problem","Contact to admin please","error");
                    }
                }).error(function(data){
                    swal("System have problem","Contact to admin please","error");
                });
            }
        });
    });

$('body').on('click','.btn-change-permission',function(){
        var id  = $(this).data('id');
        var btn = $(this);
        btn.button("loading");
        $('#permssion_user_id').val(id);
        $('#FormChangePermssion')[0].reset();
        $.ajax({
            method      : "POST",
            url         : url_gb+"/admin/GetPermission/"+id,
            dataType    : 'json'
        }).done(function(rec){
            $.each(rec , function(){
                var menu_id = this.menu_id;
                var read    = this.readed;
                var create  = this.created;
                var update  = this.updated;
                var deleted = this.deleted;
                console.log(update+' '+ deleted);

                if(create == 'T'){
                    $('.create_'+menu_id).prop('checked','checked');
                }
                if(update == 'T'){
                    $('.update_'+menu_id).prop('checked','checked');
                }
                if(deleted == 'T'){
                    $('.delete_'+menu_id).prop('checked','checked');
                }
                if(read == 'T'){
                    $('.read_'+menu_id).prop('checked','checked');
                }
            });
            btn.button("reset");
            ShowModal('ModalPermission');
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
});


    $('body').on('submit','#FormChangePermssion',function(e){
        e.preventDefault();
        var form = this;
        var btn = $(form).find('[type="submit"]');
        btn.button("loading");
        $.ajax({
            method : "POST",
            url : url_gb+"/admin/SetPermission",
            dataType : 'json',
            data : $(form).serialize()
        }).done(function(rec){
            btn.button("reset");
            if(rec.status==1){
                resetFormCustom(form);
                TableAdmin.api().ajax.reload();
                swal(rec.title,rec.content,"success");
                $('#ModalPermission').modal('hide');
            }else{
                swal(rec.title,rec.content,"error");
            }
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });

$('#photo').orakuploader({
    orakuploader_path         : url_gb+'/',
    orakuploader_ckeditor         : true,
    orakuploader_use_dragndrop       : true,
    orakuploader_main_path : 'uploads/admin',
    orakuploader_thumbnail_path : 'uploads/admin',
    orakuploader_thumbnail_real_path : asset_gb+'uploads/admin',
    orakuploader_add_image       : asset_gb+'images/add.png',
    orakuploader_loader_image       : asset_gb+'images/loader.gif',
    orakuploader_no_image       : asset_gb+'images/no-image.jpg',
    orakuploader_add_label       : 'เลือกรูปภาพ',
    orakuploader_use_rotation: true,
    orakuploader_maximum_uploads : 99999,
    orakuploader_hide_on_exceed : true,

    orakuploader_finished : function(){
        $(".file").addClass("multi_file");
    }
});

function image_reload(max,img){
    $('#edit_photo').orakuploader({
        orakuploader_path         : url_gb+'/',
        orakuploader_ckeditor         : true,
        orakuploader_use_dragndrop       : true,
        orakuploader_main_path : 'uploads/admin/',
        orakuploader_thumbnail_path : 'uploads/admin/',
        orakuploader_thumbnail_real_path : asset_gb+'uploads/admin/',
        orakuploader_add_image       : asset_gb+'images/add.png',
        orakuploader_loader_image       : asset_gb+'images/loader.gif',
        orakuploader_no_image       : asset_gb+'images/no-image.jpg',
        orakuploader_add_label       : 'Select Picture',
        orakuploader_use_rotation: true,
        orakuploader_maximum_uploads :max,
        orakuploader_hide_on_exceed : true,

        orakuploader_attach_images: [img],
    });
}
</script>
@endsection