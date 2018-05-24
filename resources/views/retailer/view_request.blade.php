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
            @include('retailer.nav_bar')
            <div class="col-lg-9">
              <div class="content-head">
                <h4><i class="fa fa-eye"></i> View Request Detail</h4>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row mt-xs">
                      <div class="col-md-6 text-form-tablet"><b>Status :</b></div>
                      <div class="col-md-6"><span class="label label-primary">{{$request->SubmitQuote[0]->status == 'w'? "Submitted" : "Open"}}</span></div>
                    </div>
                    <div class="row mt-xs">
                      <div class="col-md-6 text-form-tablet"><b>Premise Type :</b></div>
                      <div class="col-md-6">
                        {{ $request->type_id== 1 ? 'Business':'Residential'}}
                      </div>
                    </div>
                    <div class="row mt-xs">
                      <div class="col-md-6 text-form-tablet"><b>Premise Address :</b></div>
                      <div class="col-md-6">
                        {{ $request->premise_address}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row mt-xs">
                      <div class="col-md-6 text-form-tablet"><b>Average Consumption :</b></div>
                      <div class="col-md-6">
                        {{ $request->avr_consumtion}}
                      </div>
                    </div>
                    <div class="row mt-xs">
                      <div class="col-md-6 text-form-tablet"><b>Existing Retailer :</b></div>
                      <div class="col-md-6">
                        {{ $request->Existing->name}}
                      </div>
                    </div>
                    @if($request->type_id==2)
                    <div class="row mt-xs">
                      <div class="col-md-6 text-form-tablet"><b>Type of Dwelling :</b></div>
                      <div class="col-md-6">
                        {{ $request->Dwelling->dwe_name.' '.$request->Dwelling->dwe_detail}}
                      </div>
                    </div>
                    @endif
                  </div>
                </div>

                @if($request->type_id==1)
                <form action="" class="form-horizontal" id="FormBusiness" novalidate="novalidate">
                  <input type="hidden" name="customer_id_b" value="{{$request->customer_id}}">
                  <input type="hidden" name="request_id_b" value="{{$request->request_id}}">
                  <input type="hidden" name="customer_email" value="{{$request->user->email}}">
                  <input type="hidden" name="customer_name" value="{{$request->user->firstname}}">
                  @foreach($request->RequestEstimate as $RequestEstimate )
                  <input type="hidden" name="request_estimate_id_b[]" value="{{$RequestEstimate->id}}">
                  @endforeach
                  <div class="Business">
                    <div class="row mt-xs">
                      @foreach($request->RequestEstimate as $RequestEstimate)
                      <div class="col-md-6">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            {{$RequestEstimate->EstimateCommencement->name}}
                          </div>
                          <div class="panel-body">
                            <div class="form-group">
                              <label for="" class="col-sm-5 control-label">Peak</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control peak" id="" name="peak[]" placeholder="{{$RequestEstimate->EstimateCommencement->type=='F'? '$xxx/kWh':'xxx%'}}" value="{{$RequestEstimate->SubmitQuote->Quotation->peak}}" {{($RequestEstimate->SubmitQuote!='') ? 'readonly=""':''}}>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="" class="col-sm-5 control-label">Off Peak</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control off_peak" id="" name="off_peak[]" placeholder="{{$RequestEstimate->EstimateCommencement->type=='F'? '$xxx/kWh':'xxx%'}}" value="{{$RequestEstimate->SubmitQuote->Quotation->off_peak}}" {{($RequestEstimate->SubmitQuote!='') ? 'readonly=""':''}}>
                              </div>
                            </div>
                            <div class="form-group form-group-promotion">
                              <label for="" class="col-sm-5 control-label">Promotion</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control content_promotion" name="title" placeholder="Title " value="{{$RequestEstimate->SubmitQuote->Quotation->QuotePromotion->title}}" readonly="">
                              </div>
                            </div>
                            @if(!$check_submit)
                            <div class="form-group">
                              <label for="" class="col-sm-5 control-label">Select</label>
                              <div class="col-sm-7">
                                <select  name="promotion[]" class="form-control select_promotion">
                                  <option value="">Please Select</option>
                                  @foreach($promotions as $promotion)
                                  <option value="{{$promotion->id}}">{{$promotion->title}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            @endif
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                    <div class="row mt-xs">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">Payment Terms</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                              <input type="text" class="form-control payment_term_b" id="" name="payment_term_b" placeholder="Payment Terms" value="{{$RequestEstimate->SubmitQuote->Quotation->payment_term}}" {{($RequestEstimate->SubmitQuote!='') ? 'readonly=""':''}}>
                              <div class="input-group-addon">Days</div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">Security Deposit</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                              <input type="" class="form-control sec_dep_b" id="" name="sec_dep_b" placeholder="Security Deposit" value="{{$RequestEstimate->SubmitQuote->Quotation->sucurity_deposit}}" {{($RequestEstimate->SubmitQuote!='') ? 'readonly=""':''}}>
                              <div class="input-group-addon">$</div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">Retailer Charge</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                              <input type="" class="form-control retailer_charge_b" id="" name="retailer_charge_b" placeholder="Retailer Charge" value="{{$RequestEstimate->SubmitQuote->Quotation->retailer_charge}}" {{($RequestEstimate->SubmitQuote!='') ? 'readonly=""':''}}>
                              <div class="input-group-addon">$/Month</div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">AMI meter recurring charges</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                            <input type="text" class="form-control ami_b" id="" name="ami_b" placeholder="AMRC" value="{{$RequestEstimate->SubmitQuote->Quotation->ami}}" {{($RequestEstimate->SubmitQuote!='') ? 'readonly=""':''}}>
                            <div class="input-group-addon">$/Month</div>
                          </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">Billing Charges</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                              <input type="" class="form-control bill_charge_b" id="" name="bill_charge_b" placeholder="Billing Charges" value="{{$RequestEstimate->SubmitQuote->Quotation->billing_charge}}" {{($RequestEstimate->SubmitQuote!='') ? 'readonly=""':''}}>
                              <div class="input-group-addon">$/Month</div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">Collection Charges</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                              <input type="" class="form-control collect_charge_b" id="" name="collect_charge_b" placeholder="Collection Charges" value="{{$RequestEstimate->SubmitQuote->Quotation->collection_charge}}" {{($RequestEstimate->SubmitQuote!='') ? 'readonly=""':''}}>
                              <div class="input-group-addon">$/Month</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @if(!$check_submit)
                    <div class="row mt-xs">
                      <div class="col-md-8 col-md-offset-5">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Submit </button>
                      </div>
                    </div>
                    @endif
                  </div>
                </form>
                @else
                <form action="" class="form-horizontal" id="FormResidentail" novalidate="novalidate">
                  <input type="hidden" name="customer_id" value="{{$request->customer_id}}">
                  <input type="hidden" name="request_id" value="{{$request->request_id}}">
                  <input type="hidden" name="customer_email" value="{{$request->user->email}}">
                  <input type="hidden" name="customer_name" value="{{$request->user->firstname}}">
                  @foreach($request->RequestEstimate as $RequestEstimate )
                  <input type="hidden" name="request_estimate_id[]" value="{{$RequestEstimate->id}}">
                  @endforeach
                  <div class="Residentail">
                    <div class="row mt-xs">
                      @foreach($request->RequestEstimate as $RequestEstimate)
                      <div class="col-md-6">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            {{$RequestEstimate->EstimateCommencement->name}}
                          </div>
                          <div class="panel-body">
                            <div class="form-group">
                              <label for="" class="col-sm-5 control-label">{{$RequestEstimate->EstimateCommencement->name}}</label>
                              <div class="col-sm-7">  
                                <input type="number" class="form-control price" id="" name="price[]" placeholder="{{$RequestEstimate->EstimateCommencement->type=='F'? '$xxx/kWh':'xxx%'}}" value="{{$RequestEstimate->SubmitQuote->Quotation->price}}" {{($RequestEstimate->SubmitQuote!='') ? 'readonly=""':''}}>
                              </div>
                            </div>

                            <div class="form-group form-group-promotion">
                              <label for="" class="col-sm-5 control-label">Promotion</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control content_promotion" name="title"  placeholder="Title " value="{{$RequestEstimate->SubmitQuote->Quotation->QuotePromotion->title}}" readonly="">
                              </div>
                            </div>
                            @if(!$check_submit)
                            <div class="form-group">
                              <label for="" class="col-sm-5 control-label">Select</label>
                              <div class="col-sm-7">
                                <select  name="promotion[]" class="form-control select_promotion">
                                  <option value="">Please Select</option>
                                  @foreach($promotions as $promotion)
                                  <option value="{{$promotion->id}}">{{$promotion->title}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            @endif
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>

                    <div class="row mt-xs">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">Payment Terms</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                              <input type="text" class="form-control payment_term_f" id="" name="payment_term_f" placeholder="Payment Terms" value="{{$RequestEstimate->SubmitQuote->Quotation->payment_term}}" {{($check_submit)?"readonly":""}}>
                              <div class="input-group-addon">Days</div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">Security Deposit</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                              <input type="text" class="form-control sec_dep_f" id="" name="sec_dep_f" placeholder="Security Deposit" value="{{$RequestEstimate->SubmitQuote->Quotation->sucurity_deposit}}" {{($check_submit)?"readonly":""}}>
                              <div class="input-group-addon">$</div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">Retailer Charge</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                              <input type="text" class="form-control retailer_charge_f" id="" name="retailer_charge_f" placeholder="Retailer Charge" value="{{$RequestEstimate->SubmitQuote->Quotation->retailer_charge}}" {{($check_submit)?"readonly":""}}>
                              <div class="input-group-addon">$/Month</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">AMI meter recurring charges</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                            <input type="text" class="form-control ami_f" id="" name="ami_f"  placeholder="AMRC" value="{{$RequestEstimate->SubmitQuote->Quotation->ami}}" {{($check_submit)?"readonly":""}}>
                            <div class="input-group-addon">$/Month</div>
                          </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">Billing Charges</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                              <input type="" class="form-control bill_charge_f" id="" name="bill_charge_f" placeholder="Billing Charges" value="{{$RequestEstimate->SubmitQuote->Quotation->billing_charge}}" {{($check_submit)?"readonly":""}}>
                              <div class="input-group-addon">$/Month</div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-4 control-label">Collection Charges</label>
                          <div class="col-sm-8">
                            <div class="input-group">
                              <input type="" class="form-control collect_charge_f" id="" name="collect_charge_f" placeholder="Collection Charges" value="{{$RequestEstimate->SubmitQuote->Quotation->collection_charge}}" {{($check_submit)?"readonly":""}}>
                              <div class="input-group-addon">$/Month</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @if(!$check_submit)
                    <div class="row mt-xs">
                      <div class="col-md-8 col-md-offset-5">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Submit </button>
                      </div>
                    </div>
                    @endif
                  </div>
                </form>
              @endif
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
  
$('.peak,.off_peak,.payment_term_b,.sec_dep_b,.retailer_charge_b,.ami_b,.bill_charge_b,.collect_charge_b,.payment_term_f,.sec_dep_f,.retailer_charge_f,.ami_f,.bill_charge_f,.collect_charge_f,.price').keypress(function(event) {
    if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
            $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
}).on('paste', function(event) {
    event.preventDefault();
});

  $('body').on('change', 'select', function() {
    // alert(this.id);
    $('#title-'+this.id).val($(this).find('option[value="' + $(this).val() + '"]').data('title'));
    $('#detail-'+this.id).val($(this).find('option[value="' + $(this).val() + '"]').data('detail'));
  });

  $('#FormResidentail').validate({
    errorElement: 'span',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
      price: {
        required: true,
      },
      payment_term_f: {
        required: true,
      },
      sec_dep_f: {
        required: true,
      },
      retailer_charge_f: {
        required: true,
      },
      ami_f: {
        required: true,
      },
      bill_charge_f: {
        required: true,
      },
      collect_charge_f: {
        required: true,
      }
    },
    messages: {
      price: {
        required: 'This field is required',
      },
      payment_term_f: {
        required: 'This field is required',
      },
      sec_dep_f: {
        required: 'This field is required',
      },
      retailer_charge_f: {
        required: 'This field is required',
      },
      ami_f: {
        required: 'This field is required',
      },
      bill_charge_f: {
        required: 'This field is required',
      },
      collect_charge_f: {
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
    // btn.button("loading");
    swal({
      title: "Proceed to submit quotes?",
      text:  "1 Credit will be deducted after you’ve submitted.",
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
          url : url_gb+"/Retailer/ViewRequestResidentail",
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
              window.location = url_gb+"/Retailer/ViewRequest";
            });
          } else if(rec.status==2){
            swal({
              position          : "center",
              type              : "error",
              title             : rec.title_error,
              text              : rec.content,
              showConfirmButton : true
            },function(){
              window.location = url_gb+"/Retailer/Credit";
            });
          }else if(rec.status==3){
            swal({
              position          : "center",
              type              : "error",
              title             : rec.title_error,
              text              : rec.content,
              showConfirmButton : true
            },function(){
              window.location = url_gb+"/Retailer/Contract";
            });

          }else if(rec.status==4){
            swal({
              position          : "center",
              type              : "error",
              title             : rec.title_error,
              text              : rec.content,
              showConfirmButton : true
            },function(){
              window.location = url_gb+"/Retailer/ViewRequest";
            });

          }else{
            swal({
              position          : "center",
              type              : "error",
              title             : rec.title_error,
              text              : rec.content,
              showConfirmButton : true
            },function(){
              window.location = url_gb+"/Retailer/ViewRequest";
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

  $('#FormBusiness').validate({
    errorElement: 'span',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
      peak: {
        required: true,
      },
      off_peak: {
        required: true,
      },
      payment_term_b: {
        required: true,
      },
      sec_dep_b: {
        required: true,
      },
      retailer_charge_b: {
        required: true,
      },
      ami_b: {
        required: true,
      },
      bill_charge_b: {
        required: true,
      },
      collect_charge_b: {
        required: true,
      }
    },
    messages: {
      peak: {
        required: 'This field is required',
      },
      off_peak: {
        required: 'This field is required',
      },
      payment_term_b: {
        required: 'This field is required',
      },
      sec_dep_b: {
        required: 'This field is required',
      },
      retailer_charge_b: {
        required: 'This field is required',
      },
      ami_b: {
        required: 'This field is required',
      },
      bill_charge_b: {
        required: 'This field is required',
      },
      collect_charge_b: {
        required: 'Please select status first',
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
    // btn.button("loading");
    swal({
      title: "Submit your quote to this request?",
      text:  "A credit and Dwellings Credit Amount will be deduct after you're submitted",
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
          url : url_gb+"/Retailer/ViewRequestBusiness",
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
              window.location = url_gb+"/Retailer/ViewRequest";
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

  $('body').on('change','.select_promotion',function(){
    var id     = $(this).val();
    console.log(id);
    var name   = $(this).find('option:selected').text();
    $(this).closest('.panel-body').find('.content_promotion').val(name);
  });
</script>
@endsection
