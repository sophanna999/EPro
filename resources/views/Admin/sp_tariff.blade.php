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
            + เพิ่ม{{$title or 'ข้อมูลใหม่'}}
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
                <table class="table table-hover" id="TableSPTariff">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>SP Tariff</th>
                            <th>Value</th>
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
                            <label for="edit_name">SP Tariff</label>
                            <input type="text" class="form-control" name="edit_name" id="edit_name" placeholder="Enter Your Name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit_email">Value</label>
                            <input type="text" class="form-control" name="edit_value" id="edit_value" placeholder="Enter Your value">
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
     var TableSPTariff = $('#TableSPTariff').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url_gb+"/admin/SP_Tariff/ListSPTariff",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "key"  },
            { "data": "value" },
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
    $('body').on('click','.btn-edit',function(data){
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/SP_Tariff/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_id').val(rec.id);
            $('#edit_name').val(rec.key);
            $('#edit_value').val(rec.value);
            btn.button("reset");
            $('#ModalEdit').modal('show');
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });

    $('body').on('click','.btn-detail',function(data){
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/SP_Tariff/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#name').val(rec.key);
            $('#value').val(rec.value);
            btn.button("reset");
            $('#ModalDetail').modal('show');
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });

    $('#FormEdit').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            edit_name: {
                required: true,
            },
            edit_value: {
                required: true,
            }
        },
        messages: {
            edit_name: {
                required: 'Enter your sp tariff name',
            },
            edit_value: {
                required: 'Enter your value',
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
            console.log(id);
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/SP_Tariff/CheckEdit/"+id,
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableSPTariff.api().ajax.reload();
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
                    url : url_gb+"/admin/CustomerContact/Delete/"+id,
                    data : {ID : id}
                }).done(function(data){
                    if(data){
                        var rec = $.parseJSON(data);
                        if(rec.status==1){
                            swal(rec.title,rec.content,"success");
                            TableCustomerContact.api().ajax.reload();
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