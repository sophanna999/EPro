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
                <table class="table table-hover" id="TableApprovePromotion">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Retailer Name</th>
                            <th>Promotion Name</th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th>status</th>
                            <th>Create Date</th>
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
<div class="modal fade" id="PromotionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="EditPromotion" enctype="multipart/form-data">
            <input type="hidden" name="id" id="user_id" >
            <input type="hidden" name="pomotion_id" id="pomotion_id" placeholder="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Promotions Detail</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_name">Promotion name</label>
                    <input type="text" class="form-control" name="edit_name" id="edit_name" placeholder="" value="">
                </div>
                <div class="form-group">
                    <label for="edit_title">Title</label>
                    <input type="text" class="form-control" name="edit_title" id="edit_title" placeholder="" value="">
                </div>
                <div class="form-group">
                    <label for="edit_detail">Detail</label>
                    <input type="text" class="form-control" name="edit_detail" id="edit_detail" placeholder="" value="">
                </div>
                <div class="form-group">
                    <label for="edit_image">Image</label>
                    <div class="edit_image"></div>
                </div>
                <div class="form-group">
                    <label for="edit_file">File</label>
                    <div class="edit_file"></div>
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
     var TableApprovePromotion = $('#TableApprovePromotion').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url_gb+"/admin/Promotion/ListPromotion",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_Row_Index", "className": "text-center", "orderable": false, "searchable": false},
            { "data": "retailer_id" },
            { "data": "name" },
            { "data": "title" },
            { "data": "detail" },
            { "data": "status" },
            { "data": "created_at" },
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
    $("body").on("click",".btn-delete",function(){
        var id = $(this).data("id");
        swal({
            title: "Are you sure to delete this data?",
            text: "Yes, Of course!",
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
                    url : url_gb+"/admin/Promotion/delete/"+id,
                    data : {ID : id}
                }).done(function(data){
                    if(data){
                        var rec = $.parseJSON(data);
                        if(rec.status==1){
                            swal(rec.title,rec.content,"success");
                            TableApprovePromotion.api().ajax.reload();
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
    $('body').on('click','.btn-update',function(data){
        $('#PromotionModal').modal('show');
    });

    $('body').on('click','.btn-update',function(data){
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/Promotion/Edit/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#pomotion_id').val(rec.id);
            $('#edit_name').val(rec.name);
            $('#edit_title').val(rec.title);
            $('#edit_detail').val(rec.detail);
            $('.edit_image').empty();
            $('.edit_image').append('<input type="file" class="form-control edit_image" name="edit_image"><div class="images"></div>'+'<br>'+
                    '<img class="img_preview" src="'+asset_gb+'uploads/promotions/'+rec.images+'" alt="your image" width="200px" height="200px" style="width: 200px, height:200px;"/></br></br>');
            $('.edit_file').empty();
            $('.edit_file').html('<input type="file" class="form-control edit_file" name="edit_file"><div class="images"></div>'+'<br>'+
                    '<iframe class="file_preview" id="Edit_viewer" src="" frameborder="0" scrolling="no" width="0" height="0"></iframe>');
            if (rec.files) {
            $('.edit_file').html('<input type="file" class="form-control edit_file" name="edit_file"><div class="images"></div>'+'<br>'+
                    '<iframe class="file_preview" id="Edit_viewer" src="'+asset_gb+'uploads/promotions/'+rec.files+'" frameborder="0" scrolling="no" width="400" height="600"></iframe>');
            }
            btn.button("reset");
            $('#PromotionModal').modal('show');
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });
    function readURLImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.img_preview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('body').on('change','.edit_image', function(){
        $(this).next().next().removeAttr('src');
        readURLImage(this);
    });
    function readURLFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.file_preview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('body').on('change','.edit_file', function(){
        $('iframe.file_preview').removeAttr('src width height').attr({width:400,height:600});
        // $(this).next().next().removeAttr('src width height').attr({width:400,height:600});
        readURLFile(this);
    });

$('#EditPromotion').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            edit_name: {
                required: true,
            },
            edit_title: {
                required: true,
            },
            edit_detail: {
                required: true,
            }
        },
        messages: {
            edit_name: {
                required: 'This field is required',
            },
            edit_title: {
                required: 'This field is required',
            },
            edit_detail: {
                required: 'This field is required',
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
            $('#PromotionModal').modal('hide');
            var formData = new FormData(form);
            var id = $('#pomotion_id').val();
            // btn.button("loading");
            swal({
                title: "Are you agree to update this promotion ?",
                text:  " ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel",
                showLoaderOnConfirm: true,
                closeOnConfirm: false
            }, function(data) {
                if(data){
                    $.ajax({
                        url: url_gb+"/admin/Promotion/Update/"+id,
                        data: formData,
                        type: 'POST',
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success : function(rec){
                            var data = JSON.parse(rec);
                            if (data.status == 1) {
                                swal({
                                    position: 'center',
                                    type: 'success',
                                    title: data.title,
                                    text:  data.content,
                                    showConfirmButton: true
                                },function(){
                                    window.location = url_gb+"/admin/Promotion";
                                });
                            }else{
                                swal({
                                    position: 'center',
                                    type: 'error',
                                    title: data.title,
                                    text:  data.content,
                                    showConfirmButton: true
                                });
                            }
                            btn.button('reset');
                        }
                    });
                }
            });
        },
        invalidHandler: function (form) {

        }
    });

</script>
@endsection