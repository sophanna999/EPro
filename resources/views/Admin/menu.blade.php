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
        <button class="btn btn-xs btn-success btn-add">
            + Add {{$title or 'New Data'}}
        </button>
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
                <table class="table table-hover" id="TableMenu">
                    <thead>
                        <tr>
                            <th>N0</th>
                            <th>Main Manu</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Status</th>
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
                <h4 class="modal-title" id="myModalLabel">Add Data {{$title or 'New Data'}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="main_menu_id">Main Menu</label>
                            <select name="main_menu_id" id="main_menu_id" class="form-control main_menu_id">
                                <option value="0">Select Menu</option>
                                @foreach($menu_all as $key=>$val)
                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Menu Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Menu Name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" name="link" id="link" placeholder="Link">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sort_id">Sort By</label>
                            <input type="text" class="form-control" name="sort_id" id="sort_id" placeholder="Sort by">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="show" value="T" checked> แสดง
                            </label>
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
            <input type="hidden" name="id" id="edit_id" placeholder="ชื่อ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Data {{$title or 'New Data'}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_main_menu_id">Main Menu</label>
                            <select name="main_menu_id" id="edit_main_menu_id" class="form-control main_menu_id">
                                <option value="0">Select Menu</option>
                                @foreach($menu_all as $key=>$val)
                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_name">Menu Name</label>
                            <input type="text" class="form-control" name="name" id="edit_name" placeholder="Menu Name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_link">Link</label>
                            <input type="text" class="form-control" name="link" id="edit_link" placeholder="Link">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_icon">Icon</label>
                            <input type="text" class="form-control" name="icon" id="edit_icon" placeholder="Icon">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_sort_id">Sort by</label>
                            <input type="text" class="form-control" name="sort_id" id="edit_sort_id" placeholder="Sort by">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="show" id="edit_show" value="T" checked> Show
                            </label>
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
@endsection
@section('js_bottom')
<script>
     var TableMenu = $('#TableMenu').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url_gb+"/admin/menu/ListMenu",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "main_menu_id"  },
            { "data": "name" },
            { "data": "link" },
            { "data": "show" },
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
            method : "GET",
            url : url_gb+"/admin/menu/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_id').val(rec.id);
            $('#edit_main_menu_id').val(rec.main_menu_id);
            $('#edit_name').val(rec.name);
            $('#edit_link').val(rec.link);
            $('#edit_sort_id').val(rec.sort_id);
            $('#edit_icon').val(rec.icon);
            if(rec.show=='T'){
                $('#edit_show').prop('checked');
            }else{
                $('#edit_show').removeAttr();
            }
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

    $('#FormAdd').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            name: {
                required: true,
            },
            link: {
                required: true,
            },
            sort_id: {
                number: true,
            }
        },
        messages: {
            name: {
                required: 'กรุณาระบุ',
            },
            link: {
                required: 'กรุณาระบุ',
            },
            sort_id: {
                number: 'ตัวเลขเท่านั้น',
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
                url : url_gb+"/admin/menu",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableMenu.api().ajax.reload();
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
                    if(rec.menus!==undefined){
                        $('.main_menu_id').empty();
                        $('.main_menu_id').append('<option value="0">เลือกเมนูหลัก</option>');
                        $.each(rec.menus,function(i,val){
                            $('.main_menu_id').append('<option value="'+val.id+'">'+val.name+'</option>');
                        });
                    }
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
            var id = $('#edit_id').val();
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/menu/checkedit/"+id,
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableMenu.api().ajax.reload();
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
                    if(rec.menus!==undefined){
                        $('.main_menu_id').empty();
                        $('.main_menu_id').append('<option value="0">เลือกเมนูหลัก</option>');
                        $.each(rec.menus,function(i,val){
                            $('.main_menu_id').append('<option value="'+val.id+'">'+val.name+'</option>');
                        });
                    }
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

$("body").on("click",".btn-delete",function(){
        var id = $(this).data("id");
        swal({
            title: "Are your sure to delete?",
            text: "Delete Menu",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, I should be delete",
            cancelButtonText: "Cancel",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(data) {
            if(data){
                $.ajax({
                    method : "POST",
                    url : url_gb+"/admin/menu/delete/"+id,
                    data : {ID : id}
                }).done(function(data){
                    if(data){
                        var rec = $.parseJSON(data);
                        if(rec.menus!==undefined){
                            $('.main_menu_id').empty();
                            $('.main_menu_id').append('<option value="0">เลือกเมนูหลัก</option>');
                            $.each(rec.menus,function(i,val){
                                $('.main_menu_id').append('<option value="'+val.id+'">'+val.name+'</option>');
                            });
                        }
                        if(rec.status==1){
                            swal(rec.title,rec.content,"success");
                            TableMenu.api().ajax.reload();
                        }else{
                            swal(rec.title,rec.content,"error");
                        }
                    }else{
                        swal("ระบบมีปัญหา","กรุณาติดต่อผู้ดูแล","error");
                    }
                }).error(function(data){
                    swal("ระบบมีปัญหา","กรุณาติดต่อผู้ดูแล","error");
                });
            }
        });
    });

</script>
@endsection