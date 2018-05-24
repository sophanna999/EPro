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
                <table class="table table-hover" id="TablePendingRequest">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Customer Name</th>
                            <th>Business Type</th>
                            <th>Premise Address</th>
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
                                <input type="password" class="form-control" name="password" placeholder="Enter Password">
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
                    <h4 class="modal-title" id="myModalLabel">Edit {{$title or 'New Data'}}</h4>
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
<!--History Modal-->
<div class="modal fade" id="ModalHistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="">
                <input type="hidden" name="id" id="user_id" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Request history</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered Request_Data">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Types</th>
                            <th class="text-center">Premise Address</th>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

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
<!-- Modal -->
<div class="modal fade" id="ModalEditRequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="EditRequest" enctype="multipart/form-data">
                <input type="hidden" name="customer_id" id="customer_id" placeholder="">
                <input type="hidden" name="type_id" id="type_id" placeholder="">
                <input type="hidden" name="random_request_id" id="random_request_id" placeholder="">
                <input type="hidden" name="request_id" id="request_id" placeholder="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update  Request Data Of <b class="type_business"></b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group dewellings">
                                <label><b>Types of Dwellings</b></label>
                                <select class="form-control" name="dwellings" id="dwellings">
                                    <option value="">Choose Dwellings</option>
                                    @foreach($dwellings as $key => $value)
                                    <option value="{{$value->id}}">{{$value->dwe_name.' '.$value->dwe_detail}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group company">
                                <label><b>Company Name</b></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group uen">
                                <label><b>UEN Number</b></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Premise Address</b></label>
                                <textarea class="form-control" row="5" name="premise_address" id="premise_address"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Billing Address</b></label>
                                <textarea class="form-control" row="5" name="bill_address" id="bill_address"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Average Consumption kWh</b></label>
                                <input type="text" class="form-control" name="avg" id="avg">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group dewellings">
                                <label><b>Existing Retailers</b></label>
                                <select class="form-control" name="existing" id="Existing">
                                    <option value="">Choose Existing</option>
                                    @foreach($existing as $key => $value)
                                    <option value="{{$value->existing_id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><b>Price Model</b></label></br>
                                @foreach($estimate as $key => $value)
                                <input type="checkbox" class="price_model" name="price_model[]" id="price_model{{$value->id}}" value="{{$value->id}}"> {{$value->name}} </br>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group bills_images">
                                <!-- <label>Bills Images</label> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js_bottom')
<script>
var TablePendingRequest = $('#TablePendingRequest').dataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": url_gb+"/admin/PendingRequest/ListPendingRequest",
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

$('body').on('click','.btn-approve',function(data){
    var btn = $(this);
    // btn.button('loading');
    var id = $(this).data('id');
    swal({
        title: "Approve Customer’s Request?",
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
                method : "POST",
                url : url_gb+"/admin/PendingRequest/Approve/"+id,
                dataType : 'json'
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TablePendingRequest.api().ajax.reload();
                    swal(rec.title,"success");
                }else{
                    swal(rec.title,"error");
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
    var id = $(this).data('id');
    swal({
        title: "Do you want to Cancel it?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Submit",
        cancelButtonText: "Cancel",
        showLoaderOnConfirm: true,
        closeOnConfirm: false
    }, function(data) {
        if(data){
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/PendingRequest/CancelRequest/"+id,
                dataType : 'json'
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TablePendingRequest.api().ajax.reload();
                    swal(rec.title,"success");
                }else{
                    swal(rec.title,"error");
                }
            }).error(function(){
                swal("system.system_alert","system.system_error","error");
                btn.button("reset");
            });
        }

    });
});
$('body').on('click','.btn-history',function(data){
    $('#ModalHistory').modal('show');
});
$('body').on('click','.btn-history',function(){
    var id  = $(this).data('id');
    var btn = $(this);
    btn.button("loading");
    $.ajax({
        method      : "GET",
        url         : url_gb+"/admin/PendingRequest/"+id,
        dataType    : 'json'
    }).done(function(rec){
        var i = 1;
        $( ".Request_Data" ).empty();
        $.each(rec , function(rec, val){
            // var type_id = (rec.type_id ==1)?'Business':'Residentail';
            var type_id = (val.type_id ==1)?'Business':'Residentail';

            $( ".Request_Data" ).append(
                '<tr>'
                +'<td>'+i+'</td>'
                +'<td>'+type_id+'</td>'
                +'<td>'+val.premise_address+'</td>'
                +'</tr>');
                i++;
            });
            btn.button("reset");

        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
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
                // $('.company_name').text(rec.company_name);
            }

            $('.premise_address').text(rec.premise_address);
            $('.billing_address').text(rec.bill_address);
            $('.avg_consumption').text(rec.avr_consumtion);
            $('.ex_retailer').text(rec.ex_retailer);
            // $('.uen_number').text(rec.uen_no);
            $('.random_id').text(rec.random_request_id);
            // $('.company_name').text(rec.company_name);
            $('.ex_reatiler').text(rec.existing.name);
            $('.bills_images').empty();
            $.each(rec.request_photo, function(k,v){
                $('.bills_images').append('<a href="'+asset_gb+'uploads/requests/'+v.photo_name+'"><img id="img_preview" class="img_preview" src="'+asset_gb+'uploads/requests/'+v.photo_name+'" alt="your image" height="200px" width="200px"/></br></br></a>');
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
    $('body').on('click','.btn-edit', function(e){
        e.preventDefault();
        var id  = $(this).data('id');
        var btn = $(this);
        $.each($('input[type="checkbox"]'),function() {
            $(this).prop('checked',false);
        });
        btn.button("loading");
        $.ajax({
            method      : "GET",
            url         : url_gb+"/admin/PendingRequest/RequestDetail/"+id,
            dataType    : 'json'
        }).done(function(rec){
            $('.bills_images').empty();
            var type = (rec.type_id == 1)? "Business" : "Residentail";

            $('.company').empty();
            $('.uen').empty();
            if (rec.type_id ==1) {
                $('.company').append('<label>Company Name</label>'+
                '<input type="text" class="form-control company" name="company" value="'+rec.company_name+'">'+
                '</div>');
                $('.uen').append('<label>UEN Number</label>'+
                '<input type="text" class="form-control uen" name="uen" value="'+rec.uen_no+'">'+
                '</div>');
            }
            if (rec.type_id ==1) {
                $('.dewellings').addClass('hide');
            }else{
                $('.dewellings').removeClass('hide');
            }
            $('#type_id').val(rec.type_id);
            $('#request_id').val(rec.request_id);
            $('#customer_id').val(rec.customer_id);
            $('#random_request_id').val(rec.random_request_id);
            $('.type_business').text(type);
            $('#premise_address').val(rec.premise_address);
            $('#bill_address').val(rec.bill_address);
            $('#avg').val(rec.avr_consumtion);
            $('#ex_retailer').val(rec.ex_retailer);
            $('.random_id').val(rec.random_request_id);
            $('#ex_reatiler').val(rec.existing.name);
            $('#dwellings').val(rec.dwelling_type_id);
            $('#Existing').val(rec.ex_retailer);
            $('#price_model').remove();
            $.each(rec.request_estimate, function(k,v){
                $('#price_model'+v.estimate_commencement.id).prop('checked', true);
            });
            $('.bills_images').empty();
            // var i = 1;
            for(var i=1;i<=2;i++) {
                if (rec.request_photo[i-1]) {
                    $('.bills_images').append('<label>Bills Images</label>'+
                    '<input type="file" class="form-control photo_bill'+i+'" name="photo_bill'+i+'"><div class="images"></div>'+
                    '<img class="img_preview'+i+'" src="'+asset_gb+'uploads/requests/'+rec.request_photo[i-1].photo_name+'" alt="your image" width="200px" height="200px" style="width: 200px, height:200px;"/></br></br>');
                }else{
                    $('.bills_images').append('<label>Bills Images</label>'+
                    '<input type="file" class="form-control photo_bill'+i+'" name="photo_bill'+i+'"><div class="images"></div>'+
                    '<img class="img_preview'+i+'" src="" alt="your image" width="200px" height="200px" style="width: 200px;height:200px; display:none"/></br></br>');
                }
            }
            $('#ModalEditRequest').modal('show');
            btn.button("reset");
            // $('#ModalEditRequest').modal('show');

        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });
$('body').on('click','.btn-edit', function(e){
    e.preventDefault();
    $('#ModalEditRequest').modal('show');
});

    // function readURL1(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function (e) {
    //             $(input).next().children().attr('src', e.target.result).show();
    //         }
    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.img_preview1').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('body').on('change','.photo_bill1', function(){
        $(this).next().next().removeAttr('src');
        readURL1(this);
    });
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.img_preview2').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('body').on('change','.photo_bill2', function(){
        $(this).next().next().removeAttr('src');
        readURL2(this);
    });

    $('#EditRequest').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            date_signup: {
                required: true,
            },
            contact_period: {
                required: true,
            }
        },
        messages: {
            date_signup: {
                required: 'Please select date sign up',
            },
            contact_period: {
                required: 'Please select contract period',
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
            $('#SelectBusinessModal').modal('hide');
            var formData = new FormData(form);
            var id = $('#request_id').val();
            // btn.button("loading");
            swal({
                title: "Are you agree to update this request ?",
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
                        url: url_gb+"/admin/PendingRequest/Update/"+id,
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
                                    window.location = url_gb+"/admin/PendingRequest";
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
