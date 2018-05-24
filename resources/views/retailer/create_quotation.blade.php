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
                  <h4><i class="fa fa-eye"></i>  View Request Detail</h4>
                </div>
                <div class="container-fluid">
                  <div class="col-xs-12 form-horizontal">
                    <div class="form-group">
                      <label class="control-label col-md-4 text-right"> Type</label>
                      <div class="col-xs-3">
                        <select class="form-control select-type" name="type_tension">
                          <option name="lowtension" id="lowtension" value=".lowtension">Low Tension </option>
                          <option name="hightension" id="hightension" value=".hightension">High Tension </option>
                        </select>
                      </div>
                    </div>
                    <div class="divide-line"></div>
                    <div class="lowtension" id="lowtension">

                      <form id="InsertLowForm">
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Quote Name</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="quotes_name" id="quotes_name" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Energy Rate</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="energy_rate" id="energy_rate" value="">
                        </div>
                        <p class="form-control-static">/ kWh</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Market Development Service Charge (MDSC) included?</label>
                        <div class="col-md-3">
                          <label class="checkbox-inline">
                             <input type="radio" name="mdsc" id="mdsc_yes" value="1"> yes
                          </label>
                            <label class="checkbox-inline">
                            <input type="radio" name="mdsc" id="mdsc_no" value="2"> no
                        </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-3 col-md-offset-4">
                          <input class="form-control" type="text" name="mdsc_value" id="mdsc_value" value="">
                        </div>
                        <p class="form-control-static" id="mdsc_label">/ kWh</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Use of System (UOS) Charge Included?</label>
                        <div class="col-md-3"><label class="checkbox-inline">
                         <input type="radio" name="uos" id="uos_yes" value="1"> yes
                          </label>
                          <label class="checkbox-inline">
                            <input type="radio" name="uos" id="uos_no" value="2"> no
                           </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-3 col-md-offset-4">
                          <input class="form-control" type="text" name="uos_value" id="uos_value" value="">
                        </div>
                        <p class="form-control-static" id="uos_label">/ kWh</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Total Rate</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="total_rate" id="total_rate" value="">
                        </div>
                        <p class="form-control-static">/ kWh = B</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">AMI meter charge</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="meter_charge" id="meter_charge" value="">
                        </div>
                        <p class="form-control-static">/ month</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Billing charge</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="billing_charge" id="billing_charge" value="">
                        </div>
                        <p class="form-control-static">/ month</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Collection charge</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="collection_charge" id="collection_charge">
                        </div>
                        <p class="form-control-static">/ month</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Payment terms</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="payment_term" id="payment_term" value="">
                        </div>
                        <p class="form-control-static">days</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Any promotion</label>
                        <div class="col-md-5">
                          <textarea class="form-control" rows="5" name="detail" id="detail"></textarea>
                        </div>
                      </div>
                      <!-- <div class="form-group">
                          <button type="submit" class="btn btn-success"> Submit </button>
                      </div> -->
                      <div class="form-group">
                      <div class="col-md-4 col-md-offset-4">
                        <button type="submit" class="btn btn-success btn-lg"> Submit </button>
                      </div>
                    </div>
                  </form>

                    </div>
                    <!-- hightesion        -->
                  <form id="InsertFormHight">
                    <div class="hightension hidden">
                       <div class="form-group">
                        <label class="control-label col-md-4 text-right">Quote Name</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="h_quotes_name" id="h_quotes_name" value="" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Energy Rate</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="h_energy_rate" id="h_energy_rate" value="">
                        </div>
                        <p class="form-control-static">/ kWh</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Market Development Service Charge (MDSC) included?</label>
                        <div class="col-md-3"><label class="checkbox-inline">
                          <input type="radio" name="h_mdsc" id="h_mdsc_yes" value="1"> yes
                          </label>
                          <label class="checkbox-inline">
                          <input type="radio" name="h_mdsc" id="h_mdsc_no" value="2"> no
                        </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-3 col-md-offset-4">
                          <input class="form-control" type="text" name="h_mdsc_value" id="h_mdsc_value" value="">
                        </div>
                        <p class="form-control-static" id="h_mdsc_label">/ kWh</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Use of System (UOS) Charge Included?</label>
                        <div class="col-md-3"><label class="checkbox-inline">
                          <input type="radio" name="h_uos" id="h_uos_yes" value="1"> yes
                          </label>
                          <label class="checkbox-inline">
                          <input type="radio" name="h_uos" id="h_uos_no" value="0"> no
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-3 col-md-offset-4">
                          <input class="form-control" type="text" name="h_uos_value" id="h_uos_value" value="">
                        </div>
                        <p class="form-control-static" id="h_uos_label">/ kWh</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Power System Operator (PSO) Fees included?</label>
                        <div class="col-md-3"><label class="checkbox-inline">
                          <input type="radio" name="pso" id="pso_yes" value="1"> yes
                          </label>
                          <label class="checkbox-inline">
                          <input type="radio" name="pso" id="pso_no" value="2"> no
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-3 col-md-offset-4">
                          <input class="form-control" type="text" name="pso_value" id="pso_value" value="">
                        </div>
                        <p class="form-control-static" id="pso_label">/ kWh</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Energy Market Charges (EMC) Fees included?</label>
                        <div class="col-md-3"><label class="checkbox-inline">
                          <input type="radio" name="emc" id="emc_yes" value="1"> yes
                          </label>
                          <label class="checkbox-inline">
                          <input type="radio" name="emc" id="emc_no" value="2"> no
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-3 col-md-offset-4">
                          <input class="form-control" type="text" name="emc_value" id="emc_value" value="">
                        </div>
                        <p class="form-control-static" id="emc_label">/ kWh</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Monthly Energy Uplift Charges (MEUC) Fees included?</label>
                        <div class="col-md-3"><label class="checkbox-inline">
                          <input type="radio" name="meuc" id="meuc_yes" value="1"> yes
                          </label>
                          <label class="checkbox-inline">
                          <input type="radio" name="meuc_value" id="meuc_no" value="2"> no
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-3 col-md-offset-4">
                          <input class="form-control" type="text" name="meuc_value" id="meuc_value" value="">
                        </div>
                        <p class="form-control-static" id="meuc_label">/ kWh</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Allocated Regulation Price (AFP) Fees included?</label>
                        <div class="col-md-3"><label class="checkbox-inline">
                          <input type="radio" name="afp" id="afp_yes" value="1"> yes
                          </label>
                          <label class="checkbox-inline">
                          <input type="radio" name="afp" id="afp_no" value="2"> no
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-3 col-md-offset-4">
                          <input class="form-control" type="text" name="afp_value" id="afp_value" value="">
                        </div>
                        <p class="form-control-static" id="afp_label">/ kWh</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Total Rate</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="h_total_rate" id="h_total_rate"  value="">
                        </div>
                        <p class="form-control-static">/ kWh = B</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">AMI meter charge</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="h_meter_charge" id="h_meter_charge" value="">
                        </div>
                        <p class="form-control-static">/ month</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Billing charges</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="h_billing_charge" id="h_billing_charge" value="">
                        </div>
                        <p class="form-control-static">/ month</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Collection charges</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="h_collection_charge" id="h_collection_charge" value="">
                        </div>
                        <p class="form-control-static">/ month</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Payment terms</label>
                        <div class="col-md-3">
                          <input class="form-control" type="text" name="h_payment_term" id="h_payment_term" value="">
                        </div>
                        <p class="form-control-static">days</p>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Any promotion</label>
                        <div class="col-md-5">
                          <textarea class="form-control" rows="5" name="h_detail" id="h_detail"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                      <div class="col-md-4 col-md-offset-4">
                        <button type="submit" class="btn btn-success btn-lg"> Submit </button>
                      </div>
                    </div>
                   </div>
                  </form>

                  </div>
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
<script src="{{asset('assets/front/js/retailer_dashboard.js')}}"></script>
<script>
  $("#mdsc_yes").click(function () {

      $('#mdsc_value').addClass("hide");
      $('#mdsc_label').addClass("hide");

    });

    $("#mdsc_no").click(function () {

      $('#mdsc_value').removeClass("hide");
      $('#mdsc_label').removeClass("hide");

    });
    $("#uos_yes").click(function(){
      $('#uos_value').addClass("hide");
      $('#uos_label').addClass("hide");
    });
    $("#uos_no").click(function(){
      $('#uos_value').removeClass("hide");
      $('#uos_label').removeClass("hide");
    });
    $("#h_mdsc_yes").click(function () {
      $('#h_mdsc_value').addClass("hide");
      $('#h_mdsc_label').addClass("hide");
    });
    $("#h_mdsc_no").click(function () {
      $('#h_mdsc_value').removeClass("hide");
      $('#h_mdsc_label').removeClass("hide");

    });
    $("#h_uos_yes").click(function(){
      $('#h_uos_value').addClass("hide");
      $('#h_uos_label').addClass("hide");
    });
    $("#h_uos_no").click(function(){
      $('#h_uos_value').removeClass("hide");
      $('#h_uos_label').removeClass("hide");
    });
     $("#pso_yes").click(function(){
      $('#pso_value').addClass("hide");
      $('#pso_label').addClass("hide");
    });
    $("#pso_no").click(function(){
      $('#pso_value').removeClass("hide");
      $('#pso_label').removeClass("hide");
    });
    $("#emc_yes").click(function(){
      $('#emc_value').addClass("hide");
      $('#emc_label').addClass("hide");
    });
    $("#emc_no").click(function(){
      $('#emc_value').removeClass("hide");
      $('#emc_label').removeClass("hide");
    });
    $("#afp_yes").click(function(){
      $('#afp_value').addClass("hide");
      $('#afp_label').addClass("hide");
    });
    $("#afp_no").click(function(){
      $('#afp_value').removeClass("hide");
      $('#afp_label').removeClass("hide");
    });
    $("#meuc_yes").click(function(){
      $('#meuc_value').addClass("hide");
      $('#meuc_label').addClass("hide");
    });
    $("#meuc_no").click(function(){
      $('#meuc_value').removeClass("hide");
      $('#meuc_label').removeClass("hide");
    });

   $('#InsertLowForm').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            quotes_name: {
                required: true,
            },
            energy_rate: {
                required: true,
            },
            total_rate: {
                required: true,
            },
            meter_charge: {
                required: true,
            },
            billing_charge: {
                required: true,
            },
            collection_charge: {
                required: true,
            },
            payment_term: {
                required: true,
            },
            detail: {
                required: true,
            }

        },
        messages: {
            quotes_name: {
                required: 'Please enter ',
            },
            energy_rate: {
                required: 'Please enter',
            },
            total_rate: {
                required: 'Please enter',
            },
            meter_charge: {
                required: 'Please enter',
            },
            billing_charge: {
                required: 'Please enter',
            },
            collection_charge: {
                required: 'Please enter',
            },
            payment_term: {
                required: 'Please enter',
            },
            detail: {
                required: 'Please enter',
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
            var btn = $(form).find('button');
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/Retailer/NewQuotationLow",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    resetFormCustom(form);
                    swal({
                      position          : "center",
                      type              : "success",
                      title             : rec.title,
                      showConfirmButton : true
                    }, function(){
                      window.location = url_gb+"/Retailer/Quotation";
                    });
                    // swal(rec.title,rec.content,"success");
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
      // $('body').on('click', '#InsertFormHight', function(e){
      //   alert('Test');
      // });

   $('#InsertFormHight').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            h_quotes_name: {
                required: true,
            },
            h_energy_rate: {
                required: true,
            },
            h_total_rate: {
                required: true,
            },
            h_meter_charge: {
                required: true,
            },
            h_billing_charge: {
                required: true,
            },
            h_collection_charge: {
                required: true,
            },
            h_payment_term: {
                required: true,
            },
            h_detail: {
                required: true,
            }
        },
        messages: {
            h_quotes_name: {
                required: 'Please enter ',
            },
            h_energy_rate: {
                required: 'Please enter',
            },
            h_total_rate: {
                required: 'Please enter',
            },
            h_meter_charge: {
                required: 'Please enter',
            },
            h_billing_charge: {
                required: 'Please enter',
            },
            h_collection_charge: {
                required: 'Please enter',
            },
            h_payment_term: {
                required: 'Please enter',
            },
            h_detail: {
                required: 'Please enter',
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
            var btn = $(form).find('button');
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/Retailer/NewQuotationHight",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    resetFormCustom(form);
                    swal({
                      position          : "center",
                      type              : "success",
                      title             : rec.title,
                      showConfirmButton : true
                    }, function(){
                      window.location = url_gb+"/Retailer/Quotation";
                    });
                    // swal(rec.title,rec.content,"success");
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


</script>
@endsection