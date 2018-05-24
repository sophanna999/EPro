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
                <table class="table table-hover" id="TableSubscribe">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Email</th>
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
     var TableAdmin = $('#TableSubscribe').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url_gb+"/admin/Subscribe/show",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data": "DT_Row_Index", "className": "text-center", "orderable": false, "searchable": false},
            { "data": "sub_email" },
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
</script>
@endsection