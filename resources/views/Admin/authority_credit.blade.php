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

    <!-- #section:basics/content.searchbox -->
    <div class="nav-search" id="nav-search">
        
    </div><!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
</div>
@endsection
@section('body')
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="table-responsive">
                <table class="table table-hover" id="TableBuyCredit">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Retailer Name</th>
                            <th>Credit Name</th>
                            <th>Credit</th>
                            <th>Price</th>
                            <!-- <th>Bill File</th> -->
                            <th>Status</th>
                            <th>Action</th>
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
                <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูล {{$title or 'ข้อมูลใหม่'}}</h4>
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
                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your Firstname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="LEnter your Lastname">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nickname">Nickname</label>
                            <input type="text" class="form-control" name="nickname" id="nickname" placeholder="Enter your Nickname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile">Phone</label>
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="เบอร์โทร">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter your Address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
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
                <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล {{$title or 'ข้อมูลใหม่'}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" name="firstname" id="edit_firstname" placeholder="Enter your Firstname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" name="lastname" id="edit_lastname" placeholder="Enter your lastname">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nickname">Nickname</label>
                            <input type="text" class="form-control" name="nickname" id="edit_nickname" placeholder="Enter your Nickname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile">Phone</label>
                            <input type="text" class="form-control" name="mobile" id="edit_mobile" placeholder="Enter your Phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="edit_address" placeholder="Enter your Address">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="edit_email" placeholder="Enter your Email">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
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
            <input type="hidden" name="id" id="user_id" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">เปลีย่นรหัสผ่าน</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="username">รหัสผ่านใหม่</label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="รหัสผ่านใหม่">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js_bottom')
<script>
     var TableBuyCredit = $('#TableBuyCredit').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url_gb+"/admin/AuthorityCredit/ListAuthorityCredit",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_Row_Index", "className": "text-center", "orderable": false, "searchable": false},
            { "data": "user_id" },
            { "data": "credit_id" },
            { "data": "credit" },
            { "data": "price" },
            // { "data": "file_name" },
            { "data": "status" },
            // { "data": "lastname" , visible : false },
            // { "data": "nickname" , visible : false},
            { "data": "action","className":"action", "searchable":false }
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
            method : "GET",
            url : url_gb+"/admin/Retailers/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_firstname').val(rec.firstname);
            $('#edit_lastname').val(rec.lastname);
            $('#edit_nickname').val(rec.nickname);
            $('#edit_mobile').val(rec.mobile);
            $('#edit_address').val(rec.address);
            $('#edit_email').val(rec.email);
            btn.button("reset");
            $('#ModalEdit').modal('show');
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });

    $('body').on('click','.btn-cancel',function(data){
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/AuthorityCredit/StatusCancel/"+id,
            dataType : 'json'
        }).done(function(rec){
            btn.button("reset");
            if(rec.status==1){
                TableBuyCredit.api().ajax.reload();
                swal(rec.title,rec.content,"success");
            }else{
                swal(rec.title,rec.content,"error");
            }
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });

    $('body').on('click','.btn-change-password',function(data){
        $('#ModalChangePassword').modal('show');
    });

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
            password: {
                required: true,
            }
        },
        messages: {
            firstname: {
                required: 'Enter your firstname',
            },
            nickname: {
                required: 'Enter your lastname',
            },
            mobile: {
                required: 'Enter your mobile',
            },
            password: {
                required: 'Enter your password',
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
                url : url_gb+"/admin/Retailers",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableRetailer.api().ajax.reload();
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
            },
            address: {
                required: true,
            },
            email: {
                required: true,
            }
        },
        messages: {
            firstname: {
                required: 'Enter your firstname',
            },
            nickname: {
                required: 'Enter your nickname',
            },
            mobile: {
                required: 'Enter your mobile',
            },
            address: {
                required: 'Enter your address',
            },
            email: {
                required: 'Enter your email',
            },
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
                url : url_gb+"/admin/Retailers/CheckEdit/"+id,
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableRetailer.api().ajax.reload();
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
            password: {
                required: true,
            }
        },
        messages: {
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
                url : url_gb+"/admin/user/change_password",
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
                    url : url_gb+"/admin/Retailers/Delete/"+id,
                    data : {ID : id}
                }).done(function(data){
                    if(data){
                        var rec = $.parseJSON(data);
                        if(rec.status==1){
                            swal(rec.title,rec.content,"success");
                            TableRetailer.api().ajax.reload();
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
$('#photo').orakuploader({
    orakuploader_path         : url_gb+'/',
    orakuploader_ckeditor         : true,
    orakuploader_use_dragndrop       : true,
    orakuploader_main_path : 'uploads/',
    orakuploader_thumbnail_path : 'uploads/',
    orakuploader_thumbnail_real_path : asset_gb+'uploads/',
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

$('body').on('click','.btn-changeStatus',function(data){
    var id = $(this).data('id');
        var btn = $(this);
        swal({
            title: "Are you sure to Approve this data?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes I should be Approve",
            cancelButtonText: "Cancel",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(data) {
            if(data){
                $.ajax({
                    method : "POST",
                    url : url_gb+"/admin/ApproveCredit/"+id,
                    data : {ID : id}
                }).done(function(data){
                    if(data){
                        var rec = $.parseJSON(data);
                        if(rec.status==1){
                            swal(rec.title,rec.content,"success");
                            TableBuyCredit.api().ajax.reload();
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
</script>
@endsection