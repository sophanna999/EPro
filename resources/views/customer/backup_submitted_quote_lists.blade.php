@extends('template.app')
@section('css_bottom')

@endsection
@section('body')
<div class="container-fluid course-wrapper bg1 nomargin">
  <div class="row mt-sm">
    <div class="container">
      <div class="col-md-12">
        <div class="row">
          <div class="content-box-fullwidth">
            @include('customer.nav_bar')
            <div class="col-lg-9">
              <div class="content-head">
                <h4><i class="fa fa-table"></i> View Submitted Quotes</h4>
              </div>
              <div class="container-fluid">
                {{--*/ $type_id = "" /*--}}
                <div class="row">
                  @if($submited_quote)
                  <?php
                  $i = 1;
                  $j = 1;
                  ?>
                  @foreach($submited_quote as $k => $v)
                  @foreach($v as $key=>$value)
                  @if($j==1)
                  {{--*/ $type_id = $value->type_id /*--}}
                  <div class="col-xs-12 form-horizontal">
                    <div class="col-md-6">
                      <div class="row mt-xs">
                        <div class="col-md-6 text-right">Request ID : </div>
                        <div class="col-md-6">{{$value->request_id}}</div>
                      </div>
                      <div class="row mt-xs">
                        <div class="col-md-6 text-right">Estimate Consumption : </div>
                        <div class="col-md-6">{{$value->avr_consumtion}}</div>
                      </div>
                      <div class="row mt-xs">
                        <div class="col-md-6 text-right">SP Tariff :</div>
                        <div class="col-md-6">{{$sp_tariff->value}}</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row mt-xs">
                        <div class="col-md-6 text-right">Premise :</div>
                        <div class="col-md-6">{{$value->premise_address}}</div>
                      </div>
                      @if($type_id == 2)
                      <div class="row mt-xs">
                        <div class="col-md-6 text-right">Type of Dwellings :</div>
                        <div class="col-md-6">{{$value->dwe_name}} {{$value->dwe_detail}}</div>
                      </div>
                      @endif
                    </div>
                  </div><br>
                  <div class="col-xs-12 form-horizontal"><hr>
                    <table class="table-bordered table table-striped basic-table">
                      <col width="">
                      <col width="120">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Retailer</th>
                          <th>SP Tariff</th>
                          <th>Price Model</th>
                          <th>Contract Period</th>
                          <th>Amount Saved Per month</th>
                          <th>% Savings</th>
                          <th>Ranking</th>
                          <th>Promotions</th>
                          <th>Detail</th>
                        </tr>
                      </thead>
                      <tbody>
                        <input type="hidden" name="type_id" id="type_id" value="{{$value->type_id}}">
                        @endif
                        <tr>
                          <td>{{$id++}}</td>
                          <td>{{$value->firstname.' '.$value->lastname}}</td>
                          <td>{{$sp_tariff->value}}</td>
                          <td>
                            @if($type_id==1)
                              @if($value->type == "F")
                                {{$value->peak}}
                              @else
                                0
                              @endif  
                            @else
                              @if($value->type == "F")
                                {{$value->qprice}}
                              @else
                                0
                              @endif
                            @endif
                          </td>
                          <td> 
                            @if($type_id==1)
                              @if($value->type=="F")
                                {{$sp_tariff->value - $value->peak}}
                              @else
                                0
                              @endif  
                            @else
                              @if($value->type=="F")
                                  {{$sp_tariff->value - $value->qprice}}
                              @else
                                0
                              @endif
                            @endif
                          </td>
                          <td>
                            @if($type_id==1)
                              @if($value->type=="F")
                                {{number_format(((($sp_tariff->value - $value->peak)/$sp_tariff->value)*100),2)}} %
                              @else
                                {{$value->peak}} %
                              @endif
                            @else
                              @if($value->type=="F")
                                {{number_format(((($sp_tariff->value - $value->qprice)/$sp_tariff->value)*100),2)}} %
                              @else
                                {{$value->qprice}} %
                              @endif
                            
                            @endif
                          </td>
                          <td>{{$value->title}}</td>
                          <td>{{$i}}</td>
                          <td>{{$value->title}}</td>
                          <td>
                              <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="{{$value->submit_quotes_id}}" title="Detail">
                                <i class="ace-icon fa fa-edit bigger-120"></i>
                              </button>
                          </td>
                        </tr>
                        <?php
                        $j++;
                        ?>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                        @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
                @endif
                @if($type_id == 1)
                <div class="mt-xs container-fluid type" id="business">
                  <form id="FormBusiness" class="FormBusiness">
                    <input type="hidden" id="quotes_id" name="quotes_id" value="">
                    <input type="hidden" id="customer_id" name="customer_id" value="">
                    <input type="hidden" id="retailer_id" name="retailer_id" value="">
                    <input type="hidden" id="request_id" name="request_id" value="">
                    <input type="hidden" id="request_estimate_id" name="request_estimate_id" value="">
                    <div class="row">
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="date_signup" class="control-label">Date of Sign Up</label>
                          <!-- <input type="text" class="form-control" id="date_signup" placeholder="Date of Sign Up"> -->
                          <div class="" data-date="20-12-2017" data-date-format="dd-mm-yyyy">
                            <input class="form-control date_signup" type="text" name="date_signup" id="date_signup" placeholder="YYYY-MM-DD" value="">
                          </div>
                        </div><!-- ./form-group -->
                        <div class='form-group col-sm-6'>
                          <label for="Fixed" class="control-label">12 Months Fixed Peak</label>
                          <input type="text" class="form-control" id="peak" placeholder="12 Months Fixed" readonly>
                        </div><!-- ./form-group -->
                      </div><!-- ./row -->
                      <div class="row">
                        <div class='form-group col-sm-6'>

                        </div><!-- ./form-group -->
                        <div class='form-group col-sm-6'>
                          <label for="off" class="control-label">12 Months Fixed Off Peak</label>
                          <input type="text" class="form-control" id="off_peak" placeholder="12 Months Fixed Off Peak" readonly>
                        </div><!-- ./form-group -->
                      </div><!-- ./row -->
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="contact" class="control-label">Contract Period</label>
                          <input type="text" class="form-control contact" id="contact" name="contact_period" placeholder="Contract Period" value="" readonly>
                        </div>
                        <div class='form-group col-sm-6'>
                          <label for="estimated" class="control-label">Estimated amount saved per month</label>
                          <input type="text" class="form-control" id="estimated" placeholder="Estimated amount saved per month" readonly>
                        </div><!-- ./form-group -->
                      </div><!-- ./row -->
                    </div><hr>
                    <div class="row">
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="payment" class="control-label">Payment Terms</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="payment" placeholder="Payment Terms" readonly>
                            <span class="input-group-addon" id="basic-addon1">Days</span>
                          </div>
                        </div><!-- ./form-group -->
                        <div class='form-group col-sm-6'>
                          <label for="charge" class="control-label">AMI meter recurring charges</label>
                          <input type="text" class="form-control" id="ami" placeholder="Retailer Charge" readonly>
                        </div><!-- ./form-group -->
                      </div><!-- ./row -->
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="security" class="control-label">Security Deposit</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="security" placeholder="Security Deposit" readonly>
                            <span class="input-group-addon" id="basic-addon2">$/Month</span>
                          </div>
                        </div><!-- ./form-group -->
                        <div class='form-group col-sm-6'>
                          <label for="billing" class="control-label">Billing Charges</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="billing" placeholder="Billing Charges" readonly>
                            <span class="input-group-addon" id="basic-addon3">$/Month</span>
                          </div>
                        </div><!-- ./form-group -->
                      </div><!-- ./row -->
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="charge" class="control-label">Retailer Charge</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="retailer_charge" placeholder="Retailer Charge" readonly>
                            <span class="input-group-addon" id="basic-addon4">$/Month</span>
                          </div>
                        </div><!-- ./form-group -->
                        <div class='form-group col-sm-6'>
                          <label for="collection" class="control-label">Collection Charges</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="collection" placeholder="Collection Charges" readonly>
                            <span class="input-group-addon" id="basic-addon5">$/Month</span>
                          </div>
                        </div><!-- ./form-group -->
                      </div><!--./row mt-xs form-horizontal -->
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="collection" class="control-label">Promotions</label>
                          <div class="panel panel-default">
                            <div class="panel-heading" id="promotion_title">
                              
                            </div>
                            <div class="panel-body">
                              <div class="form-group">
                                <div class="col-sm-12" id="promotion_detail">
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                        </div><!-- ./form-group col-sm-6 -->
                      </div> <!-- ./row -->
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <div id="photo_bill" orakuploader="on" name="photo_bill[]"></div>
                        </div><!-- ./form-group -->
                        <div class='form-group col-sm-6'>
                          <div id="photo_id_card" orakuploader="on" name="photo_id_card[]"></div>
                        </div><!-- ./form-group -->
                      </div><!--./row mt-xs form-horizontal -->
                      <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                          <button type="button" class="col-sm-6 btn btn-danger btn-lg">Back</button>
                          <button type="button" class="col-sm-6 btn btn-warning btn-lg select-business">Select Price Plan</button>
                        </div> <!--./col-sm-6 col-sm-offset-3 -->
                      </div> <!--./row-->
                    </div>
                    <div class="modal fade" id="SelectBusinessModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Contraction</h4>
                          </div>
                          <div class="modal-body contract">
                            <a href=""><p id="contract"></p></a>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Yes, I agree</button>
                          </div>
                        </div>
                      </div>
                    </div>

                  </form>
                </div>
                @else
                <div class="mt-xs container-fluid type" id="residential">
                  <form id="FormResidetail" class="FormResidetail">
                    <input type="hidden" id="quotes_id" name="quotes_id" value="">
                    <input type="hidden" id="customer_id" name="customer_id" value="">
                    <input type="hidden" id="retailer_id" name="retailer_id" value="">
                    <input type="hidden" id="request_id" name="request_id" value="">
                    <input type="hidden" id="request_estimate_id" name="request_estimate_id" value="">
                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="date_signup" class="control-label">Date of Sign Up</label>
                        <div class="" data-date="20-12-2017" data-date-format="dd-mm-yyyy">
                            <input class="form-control date_signup" type="text" name="date_signup" id="date_signup" placeholder="YYYY-MM-DD">
                        </div>
                        <!-- <input type="text" class="form-control" id="date_signup" placeholder="Date of Sign Up"> -->
                      </div><!-- ./form-group -->
                      <div class='form-group col-sm-6'>
                        <label for="Fixed" class="control-label">12 Months Fixed</label>
                        <input type="text" class="form-control" id="Fixed" placeholder="12 Months Fixed" readonly>
                      </div><!-- ./form-group -->
                    </div><!-- ./row -->
                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="contact" class="control-label">Contract Period</label>
                        <input type="text" class="form-control contact" id="contact" name="contact_period" placeholder="Contract Period" readonly>
                      </div><!-- ./form-group -->
                      <div class='form-group col-sm-6'>
                        <label for="estimated" class="control-label">Estimated amount saved per month</label>
                        <input type="text" class="form-control" id="estimated" placeholder="Estimated amount saved per month" readonly>
                      </div><!-- ./form-group -->
                    </div><!-- ./row -->
                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="payment" class="control-label">Payment Terms</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="payment" placeholder="Payment Terms" readonly>
                          <span class="input-group-addon" id="basic-addon1">Days</span>
                        </div>
                      </div><!-- ./form-group -->
                      <div class='form-group col-sm-6'>
                        <label for="charge" class="control-label">AMI meter recurring charges</label>
                        <input type="text" class="form-control" id="ami" placeholder="Retailer Charge" readonly>
                      </div><!-- ./form-group -->
                    </div><!-- ./row -->
                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="security" class="control-label">Security Deposit</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="security" placeholder="Security Deposit" readonly>
                          <span class="input-group-addon" id="basic-addon2">$/Month</span>
                        </div>
                      </div><!-- ./form-group -->
                      <div class='form-group col-sm-6'>
                        <label for="billing" class="control-label">Billing Charges</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="billing" placeholder="Billing Charges" readonly>
                          <span class="input-group-addon" id="basic-addon3">$/Month</span>
                        </div>
                      </div><!-- ./form-group -->
                    </div><!-- ./row -->
                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="charge" class="control-label">Retailer Charge</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="retailer_charge" placeholder="Retailer Charge" readonly>
                          <span class="input-group-addon" id="basic-addon4">$/Month</span>
                        </div>
                      </div><!-- ./form-group -->
                      <div class='form-group col-sm-6'>
                        <label for="collection" class="control-label">Collection Charges</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="collection" placeholder="Collection Charges" readonly> 
                          <span class="input-group-addon" id="basic-addon5">$/Month</span>
                        </div>
                      </div><!-- ./form-group -->
                    </div><!--./row mt-xs form-horizontal -->

                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="collection" class="control-label">Promotions</label>
                        <div class="panel panel-default">
                          <div class="panel-heading" id="promotion_title">
                            
                          </div>
                          <div class="panel-body">
                            <div class="form-group">
                              <div class="col-sm-12" id="promotion_detail">
                              
                              </div>
                            </div>
                          </div>
                        </div>

                      </div><!-- ./form-group col-sm-6 -->
                    </div> <!-- ./row -->

                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <div id="photo_bill" orakuploader="on" name="photo_bill[]"></div>
                      </div><!-- ./form-group -->
                      <div class='form-group col-sm-6'>
                        <div id="photo_id_card" orakuploader="on" name="photo_id_card[]"></div>
                      </div><!-- ./form-group -->
                    </div><!--./row mt-xs form-horizontal -->
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                          <button type="button" class="col-sm-6 btn btn-danger btn-lg">Back</button>
                          <button type="button" class="col-sm-6 btn btn-warning btn-lg select-residentail">Select Price Plan</button>
                        </div> <!--./col-sm-6 col-sm-offset-3 -->
                    </div> <!--./row-->
                    <div class="modal fade" id="SelectResidentailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Contraction</h4>
                          </div>
                          <div class="modal-body contract">
                            <a href=""><p id="contract"></p></a>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Yes, I agree</button>
                          </div>
                        </div>
                      </div>
                    </div>

                  </form>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('js_bottom')
  <script src="{{asset('assets/front/js/dashboard.js')}}"></script>
  <script>
    $('#date_signup').datetimepicker({
        format: 'yyyy-mm-dd',
        minView : 2,
        autoclose : true
    });
  var type_id = $('#type_id').val();
  var this_id = "";
  $(function() {
    if(type_id==1) {
      this_id = "business";
      $('#'+this_id).hide();
      $('#residential').remove();
    } else if(type_id==2) {
      this_id = "residential";
      $('#'+this_id).hide();
      $('#business').remove();
    } else if(type_id == "") {
      $(".type").empty();
    }
  });

  // $('body').on('click','#date_signup',function(e){
  //     e.preventDefault();
  //     $('#contact').val(date ("d/M/Y", strtotime("+1 week", strtotime($('#date_signup').val()))));
  // });
  $('body').on('change', '.date_signup', function () {
        var start = $("#date_signup").val();
        // var plus = $("#a_type_month").val();
        var spl = start.split(" ");
        var firstDay = new Date(start);
        var months   = firstDay.getMonth()+1;
        var y = (firstDay.getFullYear()%4 == 0)?"366":"365";
        // alert(firstDay.getDate());
        // var nextWeek = new Date(firstDay.getTime() + 7);
        var nextWeek = new Date(firstDay.getFullYear()+'-'+(months + 1)+'-'+firstDay.getDate());
        var NextYear = new Date(nextWeek.getTime() + y * 24 * 60 * 60 * 1000);
        $(".contact").val(nextWeek.toISOString().split('T')[0] + ' To ' + NextYear.toISOString().split('T')[0] );
        // alert(nextWeek.getFullYear() + '-' + nextWeek.getDate() + '-' +(nextWeek.getMonth() + 1) );
    });

  var id = "";
  $('body').on('click','.btn-edit',function(data){
    // alert(asset_gb);
		var btn = $(this);
    data.preventDefault();
		btn.button('loading');
		id = $(this).data('id');
		$.ajax({
			method : "GET",
			url : url_gb+"/Customer/ViewSubmittedSelectPlan/"+id,
			dataType : 'json'
		}).success(function(rec){
      if(rec == null) {
        $('#'+this_id).hide();
        btn.button("reset");
      } else {
        $('#'+this_id).show();
        $('#quotes_id').val(rec.quotation.id);
        $('#retailer_id').val(rec.user.id);
        $('#customer_id').val(rec.customer.id);
        $('#request_id').val(rec.request_id);
        $('#request_estimate_id').val(rec.request_estimate_id);
        $('#peak').val(rec.quotation.peak);
        $('#off_peak').val(rec.quotation.off_peak);
        $('#payment').val(rec.quotation.payment_term);
        // $('#contact').val(date ("d/M/Y", strtotime("+1 week", strtotime($('#date_signup').val()))));
        $('#ami').val(rec.quotation.ami);
        $('#security').val(rec.quotation.sucurity_deposit);
        $('#billing').val(rec.quotation.billing_charge);
        $('#retailer_charge').val(rec.quotation.retailer_charge);
        $('#collection').val(rec.quotation.collection_charge);
        $('#Fixed').val(rec.quotation.price);
        $('#promotion_title').text(rec.title);
        $('#promotion_detail').text(rec.detail);
        $('#contract').text(rec.user.contract.contract_name);
        $('#contract').parent('a').prop('href',asset_gb+"uploads/contracts/"+rec.user.contract.file_name).prop('target','_blank');
        btn.button("reset");
      }
		}).error(function(){
      $('#'+this_id).hide();
			swal("system.system_alert","system.system_error","error");
			btn.button("reset");
		});
	});

$('body').on('click','.select-business',function(e){
  e.preventDefault();
  $('#SelectBusinessModal').modal('show');
});
$('body').on('click','.select-residentail',function(e){
  e.preventDefault();
  $('#SelectResidentailModal').modal('show');
});

  $('#FormBusiness').validate({
    errorElement: 'span',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
      date_signup: {
        required: true,
      }
    },
    messages: {
      date_signup: {
        required: 'Please select date sign up',
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
    // btn.button("loading");
    swal({
      title: "Select this Price plan?",
      text:  "A credit and Dwellings Credit Amount will be deduct after you're selected",
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
          method : "POST",
          url : url_gb+"/Customer/ViewSubmittedQuotes/SelectPlanBusiness/"+id,
          dataType : 'json',
          data : $(form).serialize()
        }).done(function(rec){
          btn.button("reset");
          if(rec.status==1){
            // swal(rec.title,rec.content,"success");
            swal({
              position          : "center",
              type              : "success",
              title             : rec.title,
              showConfirmButton : true
            }, function(){
              window.location = url_gb+"/Customer/ViewSubmittedQuotes";
            });
          }else{
            // swal(rec.title,rec.content,"error");
            swal({
              position          : "center",
              type              : "error",
              title             : rec.title,
              text              : rec.content,
              showConfirmButton : true
            },function(){
              window.location = url_gb+"/Retailer/Contract";
            });
          }
        }).error(function(){
          swal("system.system_alert","system.system_error","error");
          btn.button("reset");
        });
      }
    });
  },
  invalidHandler: function (form) {

  }
});

  $('#FormResidetail').validate({
    errorElement: 'span',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
      date_signup: {
        required: true,
      }
    },
    messages: {
      date_signup: {
        required: 'Please select date sign up',
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
      $('#SelectResidentailModal').modal('hide');
    // btn.button("loading");
    swal({
      title: "Select this Price plan?",
      text:  "A credit and Dwellings Credit Amount will be deduct after you're selected",
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
          method : "POST",
          url : url_gb+"/Customer/ViewSubmittedQuotes/SelectPlanResidetail/"+id,
          dataType : 'json',
          data : $(form).serialize()
        }).done(function(rec){
          btn.button("reset");
          if(rec.status==1){
            // swal(rec.title,rec.content,"success");
            swal({
              position          : "center",
              type              : "success",
              title             : rec.title,
              showConfirmButton : true
            }, function(){
              window.location = url_gb+"/Customer/ViewSubmittedQuotes";
            });
          }else{
            // swal(rec.title,rec.content,"error");
            swal({
              position          : "center",
              type              : "error",
              title             : rec.title,
              text              : rec.content,
              showConfirmButton : true
            },function(){
              window.location = url_gb+"/Retailer/Contract";
            });
          }
        }).error(function(){
          swal("system.system_alert","system.system_error","error");
          btn.button("reset");
        });
      }
    });
  },
  invalidHandler: function (form) {

  }
});

  $('#photo_bill').orakuploader({
      orakuploader_path         : url_gb+'/',
      orakuploader_ckeditor         : true,
      orakuploader_use_dragndrop       : true,
      orakuploader_main_path : 'uploads/bills/',
      orakuploader_thumbnail_path : 'uploads/bills/',
      orakuploader_thumbnail_real_path : asset_gb+'uploads/bills/',
      orakuploader_add_image       : asset_gb+'images/add.png',
      orakuploader_loader_image       : asset_gb+'images/loader.gif',
      orakuploader_no_image       : asset_gb+'images/no-image.jpg',
      orakuploader_add_label       : 'Select bill image',
      orakuploader_use_rotation: true,
      orakuploader_maximum_uploads : 1,
      orakuploader_hide_on_exceed : true,
  });

  $('#photo_id_card').orakuploader({
      orakuploader_path         : url_gb+'/',
      orakuploader_ckeditor         : true,
      orakuploader_use_dragndrop       : true,
      orakuploader_main_path : 'uploads/bills/',
      orakuploader_thumbnail_path : 'uploads/bills/',
      orakuploader_thumbnail_real_path : asset_gb+'uploads/bills/',
      orakuploader_add_image       : asset_gb+'images/add.png',
      orakuploader_loader_image       : asset_gb+'images/loader.gif',
      orakuploader_no_image       : asset_gb+'images/no-image.jpg',
      orakuploader_add_label       : 'Select ID Card Image',
      orakuploader_use_rotation: true,
      orakuploader_maximum_uploads : 1,
      orakuploader_hide_on_exceed : true,
  });
</script>
  @endsection
