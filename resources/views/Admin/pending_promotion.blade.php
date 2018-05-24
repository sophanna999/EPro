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
                <table class="table table-hover" id="TablePendingPromotion">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Retailer Name</th>
                            <th>Images/th>
                            <th>Promotion Name</th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th>Created date</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->
@endsection
@section('js_bottom')
<script>
     var TablePendingPromotion = $('#TablePendingPromotion').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url_gb+"/admin/PendingPromotion/ListPending",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_Row_Index", "className": "text-center", "orderable": false, "searchable": false},
            { "data": "retailer_id" },
            { "data": "images" },
            { "data": "name" },
            { "data": "title" },
            { "data": "detail" },
            { "data": "created_at" },
            { "data": "action","className":"action" , "searchable":false}
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

    $('body').on('click','.btn-changeStatus',function(data){
        var btn = $(this);
        // btn.button('loading');
        var id = $(this).data('id');
        swal({
            title: "Have you verifield Prmotion's details?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Approve",
            cancelButtonText: "Cancel",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(data) {
            if(data){
                $.ajax({
                    method : "GET",
                    url : url_gb+"/admin/PendingPromotion/ChangeStatus/"+id,
                    dataType : 'json'
                }).done(function(rec){
                    btn.button("reset");
                    if(rec.status==1){
                        TablePendingPromotion.api().ajax.reload();
                        swal(rec.title,rec.content,"success");
                    }else{
                        swal(rec.title,rec.content,"error");
                    }
                }).error(function(){
                    swal("system.system_alert","system.system_error","error");
                    btn.button("reset");
                });    
            }
            
        });
    });
    $('body').on('click','.btn-cancel',function(data){
        var btn = $(this);
        // btn.button('loading');
        var id = $(this).data('id');
        swal({
            title: "Have you verifield Prmotion's details?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Approve",
            cancelButtonText: "Cancel",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(data) {
            if(data){
                $.ajax({
                    method : "GET",
                    url : url_gb+"/admin/PendingPromotion/Cancel/"+id,
                    dataType : 'json'
                }).done(function(rec){
                    btn.button("reset");
                    if(rec.status==1){
                        TablePendingPromotion.api().ajax.reload();
                        swal(rec.title,rec.content,"success");
                    }else{
                        swal(rec.title,rec.content,"error");
                    }
                }).error(function(){
                    swal("system.system_alert","system.system_error","error");
                    btn.button("reset");
                });    
            }
            
        });
    });
</script>
@endsection