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
                    <h4><i class="fa fa-table"></i> View Confirmed Retailer detail</h4>
                </div>
                <div class="container-fluid">
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-sm-3 text-form-mobile"><strong>Type :</strong></div>
                    <div class="col-sm-8"><strong>{{$submit_quotes->request->type_id ==1? "Business" : "Residentail"}}</strong></div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-sm-3 text-form-mobile">Retailer Name :</div>
                    <div class="col-sm-8">{{$submit_quotes->user->firstname.' '.$submit_quotes->user->lastname}}</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-sm-3 text-form-mobile">Contact Number :</div>
                    <div class="col-sm-8">{{$submit_quotes->user->mobile}}</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-sm-3 text-form-mobile">Email :</div>
                    <div class="col-sm-8">{{$submit_quotes->user->email}}</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-xs-12">
                      <strong>Confirmed Retailer Details</strong>
                      <input type="hidden" name="type_id" id="type_id" value="{{$submit_quotes->request->type_id}}">
                    </div>
                  </div>

                  <div class="mt-xs container-fluid type" id="business">
                  <form action="" class="confirmed_retailer_business">
                    <div class="row">
                        <div class='form-group col-sm-3'>
                        <h3><p class="bg-primary retailer_name"></p></h3>
                        </div><!-- ./form-group -->
                        <div class='form-group col-sm-9'>
                        </div><!-- ./form-group -->
                      </div><!-- ./row -->
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="date_signup" class="control-label">Date of Sign Up</label>
                          <!-- <input type="text" class="form-control" id="date_signup" placeholder="Date of Sign Up"> -->
                          <div class="" data-date="20-12-2017" data-date-format="dd-mm-yyyy">
                            <input class="form-control date_signup" type="text" name="date_signup" id="date_signup" placeholder="YYYY-MM-DD" value="{{date('d-m-Y',strtotime($submit_quotes->date_signup))}}" readonly>
                          </div>
                        </div>
                        <div class='form-group col-sm-6'>
                          <label for="Fixed" class="control-label peak">{{$submit_quotes->requestestimate->estimatecommencement->name}} Peak</label>
                            <input type="text" class="form-control" id="peak" value="{{$submit_quotes->quotation->peak}} %" placeholder="12 Months Fixed" readonly>
                        </div><!-- ./form-group -->
                      </div>
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="contact" class="control-label">Contract Period</label>
                          <input type="text" class="form-control contract_period" id="contract_period" name="contact_period" placeholder="Contract Period" value="{{$submit_quotes->contract_period}}" readonly>
                        </div>
                        <div class='form-group col-sm-6'>
                          <label for="off" class="control-label off-peak">{{$submit_quotes->requestestimate->estimatecommencement->name}} Off Peak</label>
                            <input type="text" class="form-control" id="off_peak" value="{{$submit_quotes->quotation->off_peak}} %" placeholder="12 Months Fixed Off Peak" readonly>
                        </div>
                      </div><!-- ./row -->
                      <!-- <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="contact" class="control-label">Contract Period</label>
                          <input type="text" class="form-control contract_period" id="contract_period" name="contact_period" placeholder="Contract Period" value="{{$submit_quotes->contract_period}}" readonly>
                        </div>
                        <div class='form-group col-sm-6'>
                          <label for="estimated_save" class="control-label col-sm-12">Estimated amount saved per month</label>
                          <div class="col-sm-12">
                            <div type="text" class="form-control estimated_save" id="estimated_save" placeholder="Estimated amount saved per month" value="" readonly></div>
                          </div>
                        </div>
                      </div> -->
                    <!-- </div> -->
                    <hr>
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="payment" class="control-label col-sm-12">Payment Terms</label>
                          <div class="col-sm-12">
                          <div class="input-group">
                            <input type="text" class="form-control" id="payment" value="{{$submit_quotes->quotation->payment_term}}" placeholder="Payment Terms" readonly>
                            <span class="input-group-addon" id="basic-addon1">Days</span>
                          </div>
                          </div>
                        </div><!-- ./form-group -->
                        <div class='form-group col-sm-6'>
                          <label for="billing" class="control-label col-sm-12">AMI meter recurring charges</label>
                          <div class="col-sm-12">
                          <div class="input-group">
                            <input type="text" class="form-control" id="ami" value="{{$submit_quotes->quotation->ami}}" placeholder="Retailer Charge" readonly>
                            <span class="input-group-addon" id="basic-addon3">$/Month</span>
                          </div>
                          </div>
                        </div> <!-- ./form-group -->
                      </div><!-- ./row -->
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="security" class="control-label col-sm-12">Security Deposit</label>
                          <div class="col-sm-12">
                          <div class="input-group">
                            <input type="text" class="form-control" id="security" value="{{$submit_quotes->quotation->sucurity_deposit}}" placeholder="Security Deposit" readonly>
                            <span class="input-group-addon" id="basic-addon2">$</span>
                          </div>
                          </div>
                        </div><!-- ./form-group -->
                        <div class='form-group col-sm-6'>
                          <label for="billing" class="control-label col-sm-12">Billing Charges</label>
                          <div class="col-sm-12">
                          <div class="input-group">
                            <input type="text" class="form-control" id="billing" value="{{$submit_quotes->quotation->billing_charge}}" placeholder="Billing Charges" readonly>
                            <span class="input-group-addon" id="basic-addon3">$/Month</span>
                          </div>
                          </div>
                        </div><!-- ./form-group -->
                      </div><!-- ./row -->
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="charge" class="control-label col-sm-12">Retailer Charge</label>
                          <div class="col-sm-12">
                          <div class="input-group">
                            <input type="text" class="form-control" id="retailer_charge" value="{{$submit_quotes->quotation->retailer_charge}}" placeholder="Retailer Charge" readonly>
                            <span class="input-group-addon" id="basic-addon4">$/Month</span>
                          </div>
                          </div>
                        </div><!-- ./form-group -->
                        <div class='form-group col-sm-6'>
                          <label for="collection" class="control-label col-sm-12">Collection Charges</label>
                          <div class="col-sm-12">
                          <div class="input-group">
                            <input type="text" class="form-control" id="collection" value="{{$submit_quotes->quotation->collection_charge}}" placeholder="Collection Charges" readonly>
                            <span class="input-group-addon" id="basic-addon5">$/Month</span>
                          </div>
                          </div>
                        </div><!-- ./form-group -->
                      </div><!--./row mt-xs form-horizontal -->
                      @if($submit_quotes->quotepromotion->title != null || $submit_quotes->quotepromotion->detail != null)
                      <div class="row">
                        <div class='form-group col-sm-6'>
                          <label for="collection" class="control-label"></label>
                          <div class="panel panel-default">
                            <div class="panel-heading" id="promotion_title"><a href="{{asset('uploads/promotions/'.$submit_quotes->quotepromotion->files)}}" target="_blank" ><strong>{{$submit_quotes->quotepromotion->title}}</strong></a></div>
                            <div class="panel-body">
                              <div class="form-group">
                                <div class="col-sm-12" id="promotion_detail">{{$submit_quotes->quotepromotion->detail}}</div><br><br>
                                <div class="promotion_image_business" id="promotion_image_business"><img src="{{asset('uploads/promotions/'.$submit_quotes->quotepromotion->images)}}" alt="" style="width: 250px, height:250px;"></div>
                              </div>
                            </div>
                          </div>
                        </div><!-- ./form-group col-sm-6 -->
                      </div> <!-- ./row -->
                      @endif
                      <div class="row">
                        <div class='form-group col-sm-6 BillImage'>
                          <label for="charge" class="control-label">Upload Lastest Bill</label>
                          @foreach($submit_quotes->request->requestphoto as $k => $v)
                            <img class="img_preview" src="{{asset('uploads/requests/'.$v->photo_name)}}" alt="your image" style="width: 250px, height:250px;"/> <br><br>
                          @endforeach
                        </div>
                        <div class='form-group col-sm-6'>
                          <label for="collection" class="control-label">Upload Premise Owner</label>
                          <!-- <input type="file" class="form-control" name="photo_id_card" id="photo_id_card"> -->
                          <img class="premise_owner_image" src="{{asset('uploads/requests/'.$submit_quotes->id_card_image)}}" alt="your image" width="250px" height="250px" />
                        </div>
                      </div>
                  </form>  
                </div>

                <div class="mt-xs container-fluid type hide" id="residential">
                  <form action="" class="confirmed_retailer_residentail">
                    <div class="row">
                        <div class='form-group col-sm-3'>
                        <h3><p class="bg-primary retailer_name"></p></h3>
                        </div><!-- ./form-group -->
                        <div class='form-group col-sm-9'>
                        </div><!-- ./form-gro
                        up -->
                      </div><!-- ./row -->
                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="date_signup" class="control-label">Date of Sign Up</label>
                        <div class="" data-date="20-12-2017" data-date-format="dd-mm-yyyy">
                            <input class="form-control date_signup" type="text" name="date_signup" id="date_signup" value="{{date('d-m-Y',strtotime($submit_quotes->date_signup))}}" placeholder="YYYY-MM-DD" readonly>
                        </div>
                        <!-- <input type="text" class="form-control" id="date_signup" placeholder="Date of Sign Up"> -->
                      </div><!-- ./form-group -->
                      <div class='form-group col-sm-6'>
                        <label for="Fixed" class="control-label res-price">{{$submit_quotes->requestestimate->estimatecommencement->name}}</label>
                            <input type="text" class="form-control" id="Fixed" value="{{$submit_quotes->quotation->price}} %" placeholder="12 Months Fixed" readonly>
                      </div>
                    </div><!-- ./row -->
                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="contact" class="control-label">Contract Period</label>
                        <input type="text" class="form-control contract_period" id="contract_period" name="contact_period" value="{{$submit_quotes->contract_period}}" placeholder="Contract Period" readonly>
                      </div><!-- ./form-group -->
                      <div class='form-group col-sm-6'>
                        <!-- <label for="estimated" class="control-label col-sm-12">Estimated amount saved per month</label>
                        <div class="col-sm-12">
                        <div type="text" class="form-control estimated_save_res" id="estimated_save_res" placeholder="Estimated amount saved per month" value="" readonly></div>
                      </div> -->
                      </div> 
                    </div><!-- ./row -->
                    <hr>
                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="payment" class="control-label col-sm-12">Payment Terms</label>
                        <div class="col-sm-12">
                        <div class="input-group">
                          <input type="text" class="form-control" id="payment" value="{{$submit_quotes->quotation->payment_term}}" placeholder="Payment Terms" readonly>
                          <span class="input-group-addon" id="basic-addon1">Days</span>
                        </div>
                        </div>
                      </div><!-- ./form-group -->
                      <div class='form-group col-sm-6'>
                        <label for="charge" class="control-label col-sm-12">AMI meter recurring charges</label>
                        <input type="text" class="form-control" id="ami" value="{{$submit_quotes->quotation->ami}}" placeholder="Retailer Charge" readonly>
                      </div><!-- ./form-group -->
                    </div><!-- ./row -->
                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="security" class="control-label col-sm-12">Security Deposit</label>
                        <div class="col-sm-12">
                        <div class="input-group">
                          <input type="text" class="form-control" id="security" value="{{$submit_quotes->quotation->sucurity_deposit}}" placeholder="Security Deposit" readonly>
                          <span class="input-group-addon" id="basic-addon2">$/Month</span>
                        </div>
                      </div><!-- ./form-group -->
                      </div>
                      <div class='form-group col-sm-6'>
                        <label for="billing" class="control-label col-sm-12">Billing Charges</label>
                        <div class="col-sm-12">
                        <div class="input-group">
                          <input type="text" class="form-control" id="billing" value="{{$submit_quotes->quotation->billing_charge}}" placeholder="Billing Charges" readonly>
                          <span class="input-group-addon" id="basic-addon3">$/Month</span>
                        </div>
                        </div>
                      </div><!-- ./form-group -->
                    </div><!-- ./row -->
                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="charge" class="control-label col-sm-12">Retailer Charge</label>
                        <div class="col-sm-12">
                        <div class="input-group">
                          <input type="text" class="form-control" id="retailer_charge" value="{{$submit_quotes->quotation->retailer_charge}}" placeholder="Retailer Charge" readonly>
                          <span class="input-group-addon" id="basic-addon4">$/Month</span>
                        </div>
                      </div>
                      </div><!-- ./form-group -->
                      <div class='form-group col-sm-6'>
                        <label for="collection" class="control-label col-sm-12">Collection Charges</label>
                        <div class="col-sm-12">
                        <div class="input-group">
                          <input type="text" class="form-control" id="collection" value="{{$submit_quotes->quotation->collection_charge}}" placeholder="Collection Charges" readonly> 
                          <span class="input-group-addon" id="basic-addon5">$/Month</span>
                        </div>
                        </div>
                      </div><!-- ./form-group -->
                    </div><!--./row mt-xs form-horizontal -->
                    @if($submit_quotes->quotepromotion->title != null || $submit_quotes->quotepromotion->detail != null)
                    <div class="row">
                      <div class='form-group col-sm-6'>
                        <label for="collection" class="control-label"></label>
                        <div class="panel panel-default">
                          <div class="panel-heading" id="promotion_title"><a href="{{asset('uploads/promotions/'.$submit_quotes->quotepromotion->files)}}" target="_blank" ><strong>{{$submit_quotes->quotepromotion->title}}</strong></a></div>
                          <div class="panel-body">
                            <div class="form-group">
                              <div class="col-sm-12" id="promotion_detail">{{$submit_quotes->quotepromotion->detail}} </div><br> <br>
                              <div class="promotion_image_res" id="promotion_image_res"><img src="{{asset('uploads/promotions/'.$submit_quotes->quotepromotion->images)}}" alt="" style="width: 250px, height:250px;"></div>
                            </div>
                          </div>
                        </div>
                      </div><!-- ./form-group col-sm-6 -->
                    </div> <!-- ./row -->
                    @endif
                    
                    <div class="row">
                        <div class='form-group col-sm-6 BillImage'>
                          <label for="charge" class="control-label">Upload Lastest Bill</label>
                          @foreach($submit_quotes->request->requestphoto as $k => $v)
                            <img class="img_preview" src="{{asset('uploads/requests/'.$v->photo_name)}}" alt="your image" style="width: 250px, height:250px;"/> <br><br>
                          @endforeach
                        </div>  <!-- ./form-group -->
                        <div class='form-group col-sm-6'>
                          <label for="collection" class="control-label">Upload Premise Owner</label>
                          <img class="premise_owner_image" src="{{asset('uploads/requests/'.$submit_quotes->id_card_image)}}" alt="your image" width="250px" height="250px" />
                        </div>  <!-- ./form-group -->
                      </div><!--./row mt-xs form-horizontal -->
                  </form>   
                </div>               
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
  var type_id = $('#type_id').val();
  // console.log(type_id);
  $(function(){
    if (type_id==1) {
        $('#business').removeClass('hide');
        $('#residential').addClass('hide');
    }else if (type_id==2){
        $('#residential').removeClass('hide');
        $('#business').addClass('hide');
    }else if(type_id==""){
      $('.type').empty();
    }
  });

  // var id = "";
  // $('body').on('click','.btn-edit',function(data){
  //   var btn = $(this);
  //   console.log($(this).data('id'));
  //   data.preventDefault();
  //   btn.button('loading');
  //   id = $(this).data('id');
  //   $.ajax({
  //     method : "GET",
  //     url : url_gb+"/Customer/ViewConfirmRetailer/"+id,
  //     dataType : 'json'
  //   }).success(function(rec){
  //     console.log(rec);
  //     if(rec == null) {
  //       $('#'+this_id).hide();
  //       btn.button("reset");
  //     } else {
  //       var count_month = rec.count_month;
  //       var start = '{{date("Y-m-d")}}';
  //       var nextMonth = '{{date("Y-m-d",strtotime('+1 month'))}}';
  //       var percent = rec.request_estimate.estimate_commencement.type;
  //       if (percent == "D") {
  //         $('#percent_peak').removeClass('hide');
  //         $('#percent_peak_off').removeClass('hide');
  //         $('#percent_fixed_res').removeClass('hide');
  //       }else{
  //         $('#percent_peak').addClass('hide');
  //         $('#percent_peak_off').addClass('hide');
  //         $('#percent_fixed_res').addClass('hide');
  //       }
  //       $('#'+this_id).show();
  //       $('#date_signup').val('{{date("Y-m-d")}}');
  //       $('#quotes_id').val(rec.quotation.id);
  //       $('.contract_period').val(nextMonth+' to '+rec.count_month);
  //       $('#retailer_id').val(rec.user.id);
  //       $('#customer_id').val(rec.customer.id);
  //       $('#request_id').val(rec.request_id);
  //       $('#request_estimate_id').val(rec.request_estimate_id);
  //       $('#peak').val(rec.quotation.peak +' %');
  //       $('#off_peak').val(rec.quotation.off_peak +' %');
  //       $('#payment').val(rec.quotation.payment_term);
  //       $('.retailer_name').text(rec.user.firstname+' '+rec.user.lastname);
  //       $('#ami').val(rec.quotation.ami);
  //       $('#security').val(rec.quotation.sucurity_deposit);
  //       $('#billing').val(rec.quotation.billing_charge);
  //       $('#retailer_charge').val(rec.quotation.retailer_charge);
  //       $('#collection').val(rec.quotation.collection_charge);
  //       $('#Fixed').val(rec.quotation.price+ ' %');
  //       // $('#promotion_title').text(rec.quote_promotion.title);
  //       $('#promotion_title').html('<a href="'+asset_gb+'uploads/promotions/'+rec.quote_promotion.files+' " target = "_blank">'+rec.quote_promotion.title+'</a>');
  //       $('#promotion_detail').text(rec.quote_promotion.detail);
  //       $('#promotion_image_res').html('<img class="" src="'+asset_gb+'uploads/promotions/'+rec.quote_promotion.images+'" alt="your image" style="width: 250px, height:250px;"/></br></br>');
  //       $('#promotion_image_business').html('<img class="" src="'+asset_gb+'uploads/promotions/'+rec.quote_promotion.images+'" alt="your image" style="width: 250px, height:250px;"/></br></br>');
  //       // $('#contract').text(rec.user.contract.contract_name);
  //       // $('#contract').parent('a').prop('href',asset_gb+"uploads/contracts/"+rec.user.contract.file_name).prop('target','_blank');
  //       $('.contract_title').text(rec.user.contract.contract_name);
  //       $('.contract_title').parent('a').prop('href',asset_gb+"uploads/contracts/"+rec.user.contract.file_name).prop('target','_blank');

  //       $('.BillImage').children().remove();
  //       for(var i=1;i<=2;i++) {
  //         if (rec.request.request_photo[i-1]) {
  //               $('.BillImage').append('<label for="charge" class="control-label">Upload Lastest Bill</label>'+
  //               '<input type="file" class="form-control photo_bill'+i+'" name="photo_bill'+i+'"><div class="images"></div>'+
  //               '<img class="img_preview'+i+'" src="'+asset_gb+'uploads/requests/'+rec.request.request_photo[i-1].photo_name+'" alt="your image" style="width: 250px, height:250px;"/></br></br>');
  //           }else{
  //               $('.BillImage').append('<label for="charge" class="control-label">Upload Lastest Bill</label>'+
  //               '<input type="file" class="form-control photo_bill'+i+'" name="photo_bill'+i+'"><div class="images"></div>'+
  //               '<img class="img_preview'+i+'" src="" alt="your image" width="200px" height="200px" style="width: 250px;height:250px; display:none"/></br></br>');
  //         }
  //       }
  //     btn.button("reset");
  //   }
  //   }).error(function(){
  //     $('#'+this_id).hide();
  //     swal("system.system_alert","system.system_error","error");
  //     btn.button("reset");
  //   });
  // });
</script>
@endsection