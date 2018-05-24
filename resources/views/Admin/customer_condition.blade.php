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
        <div class="nav-search" id="nav-search">
        <!-- <button class="btn btn-xs btn-success btn-add">
            + Add {{$title or 'New Data'}}
        </button> -->
    </div>
    </ul><!-- /.breadcrumb -->
</div>
@endsection
@section('body')
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="table-responsive">
                <table class="table table-hover" id="TableCustCondition">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Condition Name</th>
                            <th>File</th>
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
            <input type="hidden" name="id" id="edit_id" placeholder="ชื่อ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add {{$title or 'New Data'}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Condition Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Condition Name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="file_name">File</label>
                            <input type="file" class="form-control" name="file_name" id="file_name">
                            <div style="clear:both">
                               <iframe id="viewer" frameborder="0" scrolling="no" width="400" height="600"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormEdit">
            <input type="hidden" name="id" id="edit_id" placeholder="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Data {{$title or 'New Data'}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_name">Condition Name</label>
                            <input type="text" class="form-control" name="edit_name" id="edit_name" placeholder="Enter Your Name">
                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_email">File</label>
                            <input type="file" class="form-control" name="edit_file" id="edit_file" placeholder="Enter Your value">
                            <div style="clear:both" id="preview_file">
                            </div>
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
<div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormDetail">
            <input type="hidden" name="id" id="edit_id" placeholder="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">SP Tariff Detail</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">SP Tariff</label>
                            <input type="text" class="form-control" name="name" id="name" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Value</label>
                            <input type="text" class="form-control" name="value" id="value" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js_bottom')
<script>
    $('#file_name').change(function() {
        pdffile = document.getElementById("file_name").files[0];
        pdffile_url= URL.createObjectURL(pdffile);
        $('#viewer').attr('src',pdffile_url);
    });
     var TableCustCondition = $('#TableCustCondition').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url_gb+"/admin/CustomerCondition/ListCustCondition",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_Row_Index", "className": "text-center", "orderable": false, "searchable": false},
            { "data": "name"  },
            { "data": "file" },
            { "data": "action","className":"action text-center" , "searchable":false}
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
    $('body').on('submit','#FormAdd', function(e){
        e.preventDefault();
        var btn = $(this).find('[type="submit"]');
        btn.button('loading');
        var form = $(this)[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        $.ajax({
          url: url_gb+"/admin/CustomerCondition/Store",
          data: formData,
          type: 'POST',
          contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
          processData: false, // NEEDED, DON'T OMIT THIS
          success : function(rec){
            console.log(rec);
            var data = JSON.parse(rec);
            if (data.status == 1) {
              swal({
                position: 'center',
                type: 'success',
                title: data.title,
                text:  data.content,
                showConfirmButton: true
              },function(){
                window.location = url_gb+'/admin/CustomerCondition';
              });
            }else{
              swal({
                position: 'center',
                type: 'error',
                title: data.title,
                text:  data.content,
                showConfirmButton: true
              },function(){
                window.location = url_gb+"/admin/CustomerCondition";
              });
            }
            btn.button('reset');
          }
        });
    });

    $('body').on('click','.btn-edit',function(data){
        // $('#ModalEdit').modal('show');
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/CustomerCondition/edit/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_id').val(rec.id);
            $('#edit_name').val(rec.name);
            if (rec.file!=null) {
                $('#preview_file').empty();
                $('#preview_file').append('<iframe id="Edit_viewer" src="{{asset('uploads/conditions/')}}/'+rec.file +'" frameborder="0" scrolling="no" width="400" height="600"></iframe>');
            }
            btn.button("reset");
            $('#ModalEdit').modal('show');
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });
    $('#edit_file').change(function() {
        pdffile = document.getElementById("edit_file").files[0];
        pdffile_url= URL.createObjectURL(pdffile);
        $('#Edit_viewer').attr('src',pdffile_url);
    });
    $('body').on('submit','#FormEdit', function(e){
        e.preventDefault();
        var id = $('#edit_id').val();
        console.log(id);
        var btn = $(this).find('[type="submit"]');
        btn.button('loading');
        var form = $(this)[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        $.ajax({
          url: url_gb+"/admin/CustomerCondition/update/"+id,
          data: formData,
          type: 'POST',
          contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
          processData: false, // NEEDED, DON'T OMIT THIS
          success : function(rec){
            console.log(rec);
            var data = JSON.parse(rec);
            if (data.status == 1) {
              swal({
                position: 'center',
                type: 'success',
                title: data.title,
                text:  data.content,
                showConfirmButton: true
              },function(){
                window.location = url_gb+'/admin/CustomerCondition';
              });
            }else{
              swal({
                position: 'center',
                type: 'error',
                title: data.title,
                text:  data.content,
                showConfirmButton: true
              },function(){
                window.location = url_gb+"/admin/CustomerCondition";
              });
            }
            btn.button('reset');
          }
        });
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
                    url : url_gb+"/admin/CustomerCondition/delete/"+id,
                    data : {ID : id}
                }).done(function(data){
                    if(data){
                        var rec = $.parseJSON(data);
                        if(rec.status==1){
                            swal(rec.title,rec.content,"success");
                            TableCustCondition.api().ajax.reload();
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

    // $('#FormEdit').validate({
    //     errorElement: 'span',
    //     errorClass: 'help-block',
    //     focusInvalid: false,
    //     rules: {
    //         edit_name: {
    //             required: true,
    //         },
    //         edit_file: {
    //             required: true,
    //         }
    //     },
    //     messages: {
    //         edit_name: {
    //             required: 'This filed is required',
    //         },
    //         edit_file: {
    //             required: 'This filed is required',
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
    //         var id = $('#edit_id').val();
    //         console.log(id);
    //         btn.button("loading");
    //         $.ajax({
    //             method : "POST",
    //             url : url_gb+"/admin/SP_Tariff/CheckEdit/"+id,
    //             dataType : 'json',
    //             data : $(form).serialize()
    //         }).done(function(rec){
    //             btn.button("reset");
    //             if(rec.status==1){
    //                 TableSPTariff.api().ajax.reload();
    //                 resetFormCustom(form);
    //                 swal(rec.title,rec.content,"success");
    //                 $('#ModalEdit').modal('hide');
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

</script>
@endsection