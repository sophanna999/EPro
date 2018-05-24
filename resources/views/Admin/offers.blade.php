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
    <!-- <div class="nav-search" id="nav-search">
        <button class="btn btn-xs btn-success btn-add">
            + Add{{$title or 'New Data'}}
        </button>
    </div> -->
    <!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
</div>
@endsection
@section('body')
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="table-responsive">
                <table class="table table-hover" id="TableOffers">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Retailer Name</th>
                            <th>Username</th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th>Promotion Start</th>
                            <th>Promotion End</th>
                            <th>Contact Person</th>
                            <th>Phone</th>
                            <th>Email</th>
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
<!-- <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            <div id="photo" orakuploader="on"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div id="photo" orakuploader="on"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" name="link" id="link" placeholder="Enter Your Link">
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
</div> -->
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
                            <div id="edit_photo" orakuploader="on"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_name">Retailer Name</label>
                            <input type="text" class="form-control" name="edit_name" id="edit_name" placeholder="Enter Your Name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_title">Title</label>
                            <input type="text" class="form-control" name="edit_title" id="edit_title" placeholder="Enter Your Title">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_detail">Detail</label>
                            <input type="text" class="form-control" name="edit_detail" id="edit_detail" placeholder="Enter Your Detail">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_promotion_start">Promotion Start</label>
                            <input type="text" class="form-control" name="edit_promotion_start" id="edit_promotion_start" placeholder="Enter Your Promotion Start">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_promotion_end">Promotion End</label>
                            <input type="text" class="form-control" name="edit_promotion_end" id="edit_promotion_end" placeholder="Enter Your Promotion End">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_contact_person">Contact Person</label>
                            <input type="text" class="form-control" name="edit_contact_person" id="edit_contact_person" placeholder="Enter Your Contact Person">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_contact_number">Phone</label>
                            <input type="text" class="form-control" name="edit_contact_number" id="edit_contact_number" placeholder="Enter Your Contact Number">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_contact_email">Email</label>
                            <input type="text" class="form-control" name="edit_contact_email" id="edit_contact_email" placeholder="Enter Your Email">
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
     var TableOffers = $('#TableOffers').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url_gb+"/admin/Offers/ListOffers",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            { "data": "post_offer_id" },
            { "data": "user_id"},
            { "data": "retailer_name"},
            { "data": "title" },
            { "data": "detail" },
            { "data": "promotion_start" },
            { "data": "promotion_end" },
            { "data": "contact_person" },
            { "data": "contact_number" },
            { "data": "contact_email" },
            { "data": "photo" },
            { "data": "action","className":"action text-center" }
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
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/Offers/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_id').val(rec.post_offer_id);
            $('#edit_name').val(rec.retailer_name);
            $('#edit_title').val(rec.title);
            $('#edit_detail').val(rec.detail);
            $('#edit_promotion_start').val(rec.promotion_start);
            $('#edit_promotion_end').val(rec.promotion_end);
            $('#edit_contact_person').val(rec.contact_person);
            $('#edit_contact_number').val(rec.contact_number);
            $('#edit_contact_email').val(rec.contact_email);

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

    // $('#FormAdd').validate({
    //     errorElement: 'span',
    //     errorClass: 'help-block',
    //     focusInvalid: false,
    //     rules: {
    //         name: {
    //             required: true,
    //         },
    //         link: {
    //             required: true,
    //         }
    //     },
    //     messages: {
    //         name: {
    //             required: 'Enter your name please',
    //         },
    //         link: {
    //             required: 'Enter your link please',
    //         }
    //     },
    //     highlight: function (e) {
    //         validate_highlight(e);
    //     },
    //     success: function (e) {
    //         validate_success(e);
    //     },

    //     errorPlacement: function (error, element) {
    //         validate_errorplacement(error, element);
    //     },
    //     submitHandler: function (form) {
    //         var btn = $(form).find('[type="submit"]');

    //         btn.button("loading");
    //         $.ajax({
    //             method : "POST",
    //             url : url_gb+"/admin/Banner",
    //             dataType : 'json',
    //             data : $(form).serialize()
    //         }).done(function(rec){
    //             btn.button("reset");
    //             if(rec.status==1){
    //                 TableBanner.api().ajax.reload();
    //                 resetFormCustom(form);
    //                 swal(rec.title,rec.content,"success");
    //                 $('#ModalAdd').modal('hide');
    //             }else{
    //                 swal(rec.title,rec.content,"error");
    //             }
    //         }).error(function(){
    //             swal("system.system_alert","system.system_error","error");
    //             btn.button("reset");
    //         });
    //     },
    //     invalidHandler: function (form) {

    //     }
    // });

    $('#FormEdit').validate({
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
            },
            edit_promotion_start: {
                required: true,
            },
            edit_promotion_end: {
                required: true,
            },
            edit_contact_person: {
                required: true,
            },
            edit_contact_number: {
                required: true,
            },
            edit_contact_email: {
                required: true,
            }
        },
        messages: {
            edit_name: {
                required: 'Enter Name please',
            },
            edit_title: {
                required: 'Enter title please',
            },
            edit_detail: {
                required: 'Enter detail please',
            },
            edit_promotion_start: {
                required: 'Enter promotion start please',
            },
            edit_promotion_end: {
                required: 'Enter promotion end please',
            },
            edit_contact_person: {
                required: 'Enter contact person please',
            },
            edit_contact_number: {
                required: 'Enter phone please',
            },
            edit_contact_email: {
                required: 'Enter email please',
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
                url : url_gb+"/admin/Offers/CheckEdit/"+id,
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableOffers.api().ajax.reload();
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
                    url : url_gb+"/admin/Offers/Delete/"+id,
                    data : {ID : id}
                }).done(function(data){
                    if(data){
                        var rec = $.parseJSON(data);
                        if(rec.status==1){
                            swal(rec.title,rec.content,"success");
                            TableOffers.api().ajax.reload();
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
    orakuploader_main_path : 'uploads/banners/',
    orakuploader_thumbnail_path : 'uploads/banners/',                
    orakuploader_thumbnail_real_path : asset_gb+'uploads/banners/',  
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
        orakuploader_main_path : 'uploads/banners/',
        orakuploader_thumbnail_path : 'uploads/banners/',                
        orakuploader_thumbnail_real_path : asset_gb+'uploads/banners/',  
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