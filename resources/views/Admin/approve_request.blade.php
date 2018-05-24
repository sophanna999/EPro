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
                <table class="table table-hover" id="TableApproveRequest">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Customer Name</th>
                            <th>Business Type</th>
                            <th>Premise Address</th>
                            <th>status</th>
                            <th>Create Date</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->

<!-- Modal Request Detail -->
<div class="modal fade" id="ModalRequestDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Request Detail</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">ID :</label>
                            <div class="col-sm-6">
                                <p class="form-control-static random_id"></p>
                            </div>
                        </div>
                        <div class="form-group company">
                            <label class="col-sm-6 control-label">Company Name :</label>
                            <div class="col-sm-6">
                                <p class="form-control-static company_name"></p>
                            </div>
                        </div>
                        <div class="form-group uen">
                            <label class="col-sm-6 control-label">UEN Number :</label>
                            <div class="col-sm-6">
                                <p class="form-control-static uen_number"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Premise Address :</label>
                            <div class="col-sm-6">
                                <p class="form-control-static premise_address"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Billing Address :</label>
                            <div class="col-sm-6">
                                <p class="form-control-static billing_address"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Average Consumption kWh :</label>
                            <div class="col-sm-6">
                                <p class="form-control-static avg_consumption"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Existing Retailer :</label>
                            <div class="col-sm-6">
                                <p class="form-control-static ex_reatiler"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Price Model :</label>
                            <div class="col-sm-6">
                                <p class="form-control-static price_model"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Bills Images :</label>
                            <div class="col-sm-6 bills_images">

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js_bottom')
<script>
     var TableApproveRequest = $('#TableApproveRequest').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url_gb+"/admin/ApproveRequest/ListApproveRequest",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_Row_Index", "className": "text-center", "orderable": false, "searchable": false},
            { "data": "customer_id" },
            { "data": "type_id" },
            { "data": "premise_address" },
            { "data": "status" },
            { "data": "created_at" },
            // { "data": "lastname" , visible : false },
            // { "data": "nickname" , visible : false},
            { "data": "action","className":"action", "searchable":false}
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

     $('body').on('click','.btn-detail',function(){
        var id  = $(this).data('id');
        var btn = $(this);
        btn.button("loading");
        $.ajax({
            method      : "GET",
            url         : url_gb+"/admin/PendingRequest/RequestDetail/"+id,
            dataType    : 'json'
        }).done(function(rec){
            $('.company').empty();
            $('.uen').empty();
            if (rec.type_id ==1) {
                $('.company').append('<label class="col-sm-6 control-label">Company Name :</label>'+
                '<div class="col-sm-6">'+
                '<p class="form-control-static company_name">'+rec.company_name+'</p>'+
                '</div>');
                $('.uen').append('<label class="col-sm-6 control-label">UEN Number :</label>'+
                '<div class="col-sm-6">'+
                '<p class="form-control-static company_name">'+rec.uen_no+'</p>'+
                '</div>');
            }

            $('.premise_address').text(rec.premise_address);
            $('.billing_address').text(rec.bill_address);
            $('.avg_consumption').text(rec.avr_consumtion);
            $('.ex_retailer').text(rec.ex_retailer);
            $('.random_id').text(rec.random_request_id);
            $('.ex_reatiler').text(rec.existing.name);
            $('.bills_images').empty();
            $.each(rec.request_photo, function(k,v){
                $('.bills_images').append('<img id="img_preview" class="img_preview" src="'+asset_gb+'uploads/requests/'+v.photo_name+'" alt="your image" height="200px" width="200px"/></br></br>');
            });

            var i = '';
            var index = 1;
            $.each(rec.request_estimate,function(key,val){
                i+= index+') '+val.estimate_commencement.name+'<br>';
                index++;
            });
            $('.price_model').html(i);
            btn.button("reset");
            $('#ModalRequestDetail').modal('show');
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });
</script>
@endsection