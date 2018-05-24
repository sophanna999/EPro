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
                <h4><i class="fa fa-plus"></i> New Request</h4>
              </div>
              <div class="container-fluid">
                <div class="col-xs-12 form-horizontal">
                  <div class="form-group">
                    <label class="control-label col-xs-4 text-right"> <span class="text-red">*</span> Type</label>
                    <div class="col-xs-12 col-sm-5">
                      <select class="form-control " name="type_id" id="type_id">
                        <option value="2">Residential </option>
                        <option value="1">Business </option>
                      </select>
                    </div>
                  </div>
                  <div class="divide-line"></div>

                  <div class="residential" id="residential">
                    <form id="FormAddResidentail">
                      <div class="form-group">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Types of Dwellings </label>
                        <div class="col-xs-12 col-sm-5">
                          <select class="form-control" name="r_dwelling_type" id="r_dwelling_type">
                            <option value="">Select Dwelling</option>
                            @foreach($dwelling as $key => $value)
                            <option value="{{$value->id}}">{{$value->dwe_name.' :  '.$value->dwe_detail}}</option>
                            @endforeach
                            <!-- <option value="3">Landed Property </option>  -->
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Premise Address</label>
                        <div class="col-xs-12 col-sm-5">
                          <textarea class="form-control r_premise_address" row="5" name="r_premise_address" id="r_premise_address" required></textarea>
                        </div>
                      </div>
                      <div class="form-group">

                        <div class="control-label col-xs-4 text-right"></div>
                        <div class="col-xs-12 col-sm-5">
                          <input type="checkbox" class="form-check-input r_address-same" id="same_addr1"><span> Billing Same as premise address</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Billing Address</label>
                        <div class="col-xs-12 col-sm-5">
                          <textarea class="form-control mb-xs r_bill_address" row="5" name="r_bill_address" id="r_bill_address"></textarea>
                        </div>
                      </div>
                      <!-- <div class="form-group mt-xs">
                        <label class="control-label col-xs-4 text-right">MSSL Number</label>
                        <div class="col-xs-12 col-sm-5">
                          <input class="form-control mb-xs" type="text" name="r_mssl_no" id="r_mssl_no"><span>Found on Existing Electricity Bill</span>
                        </div>
                      </div> -->
                      <!-- <div class="form-group mt-xs">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Average Consumption kWh</label>
                        <div class="col-xs-12 col-sm-5">
                          <input class="form-control" type="text" name="r_avg_consumtion" id="r_avr_consumtion">
                        </div>
                      </div>
                      <div class="form-group mt-xs">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span>Upload Image </label>
                        <div class="col-xs-12 col-sm-5">
                          <div id="ResidentailPhoto" orakuploader="on" name="ResidentailPhoto"></div>
                        </div>
                      </div> -->
                      <div class="form-group mt-xs">
                        <label class="control-label col-xs-4 text-right"> Average Consumption kWh <img src="{{asset('assets/front/img/info.png')}}" data-toggle="tooltip" data-placement="top" title="You can enter average or images"  alt="" width="20px" height="20px"></label> 
                        <div class="col-xs-12 col-sm-5">
                          <input class="form-control checked_class" type="text" name="r_avg_consumtion" id="r_avg_consumtion" value="">
                        </div>
                      </div>
                      <div class="form-group mt-xs">
                        <label class="control-label col-xs-4 text-right">Upload Image <img src="{{asset('assets/front/img/info.png')}}" data-toggle="tooltip" data-placement="bottom" title="You can enter average or images" alt="" width="20px" height="20px"></label>
                        <div class="col-xs-12 col-sm-5">
                          <div class="checked_class" id="ResidentailPhoto" orakuploader="on" name="ResidentailPhoto[]"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Existing Retailer</label>
                        <div class="col-xs-12 col-sm-5">
                          <select class="form-control" name="r_ex_retailer" id="r_ex_retailer">
                            <option value="">Choose Existing Retailer</option>
                            @foreach($existing as $key => $value)
                            <option value="{{$value->existing_id}}">{{$value->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6 col-sm-offset-4">
                        <div class="form-group mt-xs">
                          <div class="col-xs-12 text-left">
                            <h4 class="label" style="color:#000;">Estimated Date of Commencement Preferred Electricity Price Model</h4>
                          </div>
                        </div>
                        @foreach($estimate as $key => $value)
                        <div class="checkbox col-xs-offset-1">
                          <label class="col-xs-12 mb-xs">
                            <input type="checkbox" name="estimate_residentail[]" id="estimate_residentail" value="{{$value->id}}">
                            {{$value->name}}
                          </label>
                        </div>
                        @endforeach
                        <div class="col-xs-12 mb-lg">
                          1) Fixed Rates - Secure a fixed flat rate for the entire contract period. This rate will not change for the entire contract period regardless of the market conditions. <br>
                          2) Discount Off SP Published Tariffs - Obtain a % discount off the prevailing Singapore Power (SP) tariff rates. This rate will move in tandem with the SP rates at a discount.
                        </div>
                        <div class="col-sm-4 col-sm-offset-7">
                          <div class="form-group">
                            <div class="col-xs-12 col-sm-5">
                              <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Submit </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form> 
                  </div>

                  <div class="business hide" id="business">
                   <form id="FormAddBusiness">
                    <div class="form-group">
                      <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Company Name</label>
                      <div class="col-xs-12 col-sm-5">
                        <input class="form-control" type="text" name="b_company_name" id="b_company_name" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> UEN Number</label>
                      <div class="col-xs-12 col-sm-5">
                        <input class="form-control" type="text" name="b_uen_no" id="b_uen_no" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Premise Address</label>
                      <div class="col-xs-12 col-sm-5">
                        <textarea class="form-control premise_address" row="5" name="b_premise_address" id="b_premise_address"></textarea>
                      </div>
                    </div>
                    <div class="form-group">

                      <div class="control-label col-xs-4 text-right"></div>
                      <div class="col-xs-12 col-sm-5">
                        <input type="checkbox" class="form-check-input address-same" id="same_addr"><span> Billing Same as premise address</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Billing Address</label>
                      <div class="col-xs-12 col-sm-5">
                        <textarea class="form-control mb-xs bill_address" row="5" name="b_bill_address" id="b_bill_address" ></textarea>
                      </div>
                    </div>
                    <div class="form-group mt-xs hide">
                      <label class="control-label col-xs-4 text-right">MSSL Number</label>
                      <div class="col-xs-12 col-sm-5">
                        <input class="form-control mb-xs checked_class" type="text" name="b_mssl_no" id="b_mssl_no"><span>Found on Existing Electricity Bill</span>
                      </div>
                    </div>
                    <div class="form-group mt-xs">
                      <label class="control-label col-xs-4 text-right"> Average Consumption kWh <img src="{{asset('assets/front/img/info.png')}}" data-toggle="tooltip" data-placement="top" title="You can enter average or images"  alt="" width="20px" height="20px"></label> 
                      <div class="col-xs-12 col-sm-5">
                        <input class="form-control checked_class" type="text" name="b_avg_consumtion" id="b_avg_consumtion" value="">
                      </div>
                    </div>
                    <div class="form-group mt-xs">
                      <label class="control-label col-xs-4 text-right">Upload Image <img src="{{asset('assets/front/img/info.png')}}" data-toggle="tooltip" data-placement="bottom" title="You can enter average or images" alt="" width="20px" height="20px"></label>
                      <div class="col-xs-12 col-sm-5">
                        <div class="checked_class" id="BusinessPhoto" orakuploader="on" name="BusinessPhoto[]"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Existing Retailer</label>
                      <div class="col-xs-12 col-sm-5">
                        <select class="form-control" name="b_existing_retailer" id="b_existing_retailer">
                          <option value="">Choose Existing Retailer</option>
                          @foreach($existing as $key => $value)
                          <option value="{{$value->existing_id}}">{{$value->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6 col-sm-offset-4">
                      <div class="form-group mt-xs">
                        <div class="col-xs-12 text-left">
                          <h4 class="label" style="color:#000;">Estimated Date of Commencement Preferred Electricity Price Model(Select more then 1 model)</h4>
                        </div>
                      </div>
                      @foreach($estimate as $key => $value)
                      <div class="checkbox col-xs-offset-1">
                        <label class="col-xs-12 mb-xs">
                          <input type="checkbox" name="estimate_business[]" id="estimate_business" value="{{$value->id}}">
                          {{$value->name}}
                        </label>
                      </div>
                      @endforeach
                      <div class="col-xs-12 mb-lg">
                        1) Fixed Rates - Secure a fixed flat rate for the entire contract period. This rate will not change for the entire contract period regardless of the market conditions. <br>
                        2) Discount Off SP Published Tariffs - Obtain a % discount off the prevailing Singapore Power (SP) tariff rates. This rate will move in tandem with the SP rates at a discount.
                      </div>

                      <div class="form-group">
                        <div class="col-sm-3 col-sm-offset-7 ">
                          <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Submit</button>
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
</div>
@endsection
@section('js_bottom')
<script src="{{asset('assets/front/js/dashboard.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });

  $('body').on('change','#type_id',function(e){
    if ($(this).val()==2) {
      $('#residential').removeClass('hide');
      $('#business').addClass('hide');
    } else if($(this).val()==1){
      $('#business').removeClass('hide');
      $('#residential').addClass('hide');
    }
  });
  $('body').on('input','.premise_address',function(){
    if($('.address-same').prop('checked')){
      $('.bill_address').val($(this).val());
    }

  });

  $('body').on('click','.address-same',function(){
    if($(this).prop('checked')){
      $('.bill_address').val($('.premise_address').val());
    }else{
      $('.bill_address').val('');
    }
  });
  $('body').on('input','.r_premise_address',function(){
    if($('.r_address-same').prop('checked')){
      $('.r_bill_address').val($(this).val());
    }

  });

  $('body').on('click','.r_address-same',function(){
    if($(this).prop('checked')){
      $('.r_bill_address').val($('.r_premise_address').val());
    }else{
      $('.r_bill_address').val('');
    }
  });

  $('#FormAddBusiness').validate({
    errorElement: 'span',
    errorClass: 'help-block',
    focusInvalid: false,
    rules: {
      b_company_name: {
        required: true,
      },
      b_uen_no: {
        required: true,
      },
      b_premise_address: {
        required: true,
      },
      b_bill_address: {
        required: true,
      },
      b_avg_consumtion: {
        required: function(){
          if(($('#b_avg_consumtion').val()=="")&&$('[name="BusinessPhoto[]"]').val()===undefined){
            $('#BusinessPhoto').closest('.form-group').addClass('has-error');
            return true;
          }else{
            $('#b_avg_consumtion').closest('.form-group').removeClass('has-error');
            $('#BusinessPhoto').closest('.form-group').removeClass('has-error');
            return false;
          }
        },
      },
      b_existing_retailer: {
        required: true,
      },
      BusinessPhoto: {
        required: function(){
          if(($('#b_avg_consumtion').val()=="")&&$('[name="BusinessPhoto[]"]').val()===undefined){
            $('#BusinessPhoto').closest('.form-group').addClass('has-error');
            return true;
          }else{
            $('#b_avg_consumtion').closest('.form-group').removeClass('has-error');
            $('#BusinessPhoto').closest('.form-group').removeClass('has-error');
            return false;
          }
        },
      },
    },
    messages: {
      b_company_name: {
        required: 'Enter your company name please',
      },
      b_uen_no: {
        required: 'Enter your uen number please',
      },
      b_premise_address: {
        required: 'Enter your premise addtress please',
      },
      b_bill_address: {
        required: 'Enter your bill address please',
      },
      b_existing_retailer: {
        required: 'Enter your existing retailer please',
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
              title: "Submit New Request?",
              text:  "Yes sure! I want to submit this request",
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
                  url : url_gb+"/Customer/CreateBusiness",
                  dataType : "json",
                  data : $(form).serialize()
                }).done(function(data){
                  console.log(data);
                  if(data.status == 1){
                    swal({
                      position          : "center",
                      type              : "success",
                      title             : data.title,
                      text              : data.content,
                      showConfirmButton : true
                    }, function(){
                      window.location = url_gb+"/Customer/Request";
                    });

                  }else{
                    swal(data.title,data.content,"error");
                  }
                }).error(function(data){
                  swal("System have problem","Contact to admin please","error");
                });
              }
            });

            // $.ajax({
            //     method : "POST",
            //     url : url_gb+"/Customer/CreateBusiness",
            //     dataType : 'json',
            //     data : $(form).serialize()
            // }).done(function(rec){
            //     btn.button("reset");
            //     if(rec.status==1){
            //         resetFormCustom(form);
            //         // swal(rec.title,rec.content,"success");
            //         swal({
            //           position          : "center",
            //           type              : "success",
            //           title             : rec.title,
            //           showConfirmButton : true
            //         }, function(){
            //           window.location = url_gb+"/Customer/Request";
            //         });
            //     }else{
            //         swal(rec.title,rec.content,"error");
            //     }
            // }).error(function(){
            //     swal("system.system_alert","system.system_error","error");
            //     btn.button("reset");
            // });
          },
          invalidHandler: function (form) {

          }
        });

$('#FormAddResidentail').validate({
  errorElement: 'span',
  errorClass: 'help-block',
  focusInvalid: false,
  rules: {
    r_dwelling_type: {
      required: true,
    },
    r_premise_address: {
      required: true,
    },
    r_bill_address: {
      required: true,
    },
    r_avg_consumtion: {
      required: function(){
        if(($('#r_avg_consumtion').val()=="") && $('[name="ResidentailPhoto[]"]').val()===undefined){
          $('#ResidentailPhoto').closest('.form-group').addClass('has-error');
          return true;
        }else{
          $('#r_avg_consumtion').closest('.form-group').removeClass('has-error');
          $('#ResidentailPhoto').closest('.form-group').removeClass('has-error');
          return false;
        }
      },
    },
    r_existing_retailer: {
      required: true,
    },
    ResidentailPhoto: {
      required: function(){
        if(($('#r_avg_consumtion').val()=="")&& $('[name="ResidentailPhoto[]"]').val()===undefined){
          $('#ResidentailPhoto').closest('.form-group').addClass('has-error');
          return true;
        }else{
          $('#r_avg_consumtion').closest('.form-group').removeClass('has-error');
          $('#ResidentailPhoto').closest('.form-group').removeClass('has-error');
          return false;
        }
      },
    },
  },
  messages: {
    r_dwelling_type: {
      required: 'Enter your uen number please',
    },
    r_premise_address: {
      required: 'Enter your premise addtress please',
    },
    r_bill_address: {
      required: 'Enter your bill address please',
    },
    r_avg_consumtion: {
      required: 'Enter your average consumption please',
    },
    r_existing_retailer: {
      required: 'Enter your existing retailer please',
    },
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
              title: "Submit New Request?",
              text:  "Yes sure! I want to submit this request",
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
                  url : url_gb+"/Customer/CreateResidentail",
                  dataType : "json",
                  data : $(form).serialize()
                }).done(function(data){
                  console.log(data);
                  if(data.status == 1){
                    swal({
                      position          : "center",
                      type              : "success",
                      title             : data.title,
                      text              : data.content,
                      showConfirmButton : true
                    }, function(){
                      window.location = url_gb+"/Customer/Request";
                    });

                  }else{
                    swal(data.title,data.content,"error");
                  }
                }).error(function(data){
                  swal("System have problem","Contact to admin please","error");
                });
              }
            });
            // $.ajax({
            //     method : "POST",
            //     url : url_gb+"/Customer/NewRequest",
            //     dataType : 'json',
            //     data : $(form).serialize()
            // }).done(function(rec){
            //     btn.button("reset");
            //     if(rec.status==1){
            //         resetFormCustom(form);
            //         // swal(rec.title,rec.content,"success");
            //         swal({
            //           position          : "center",
            //           type              : "success",
            //           title             : rec.title,
            //           showConfirmButton : true
            //         }, function(){
            //           window.location = url_gb+"/Customer/Request";
            //         });
            //     }else{
            //         swal(rec.title,rec.content,"error");
            //     }
            // }).error(function(){
            //     swal("system.system_alert","system.system_error","error");
            //     btn.button("reset");
            // });
          },
          invalidHandler: function (form) {

          }
        });

$('#BusinessPhoto').orakuploader({
  orakuploader_path         : url_gb+'/',
  orakuploader_ckeditor         : true,
  orakuploader_use_dragndrop       : true,
  orakuploader_main_path : 'uploads/requests/',
  orakuploader_thumbnail_path : 'uploads/requests/',
  orakuploader_thumbnail_real_path : asset_gb+'uploads/requests/',
  orakuploader_add_image       : asset_gb+'images/add.png',
  orakuploader_loader_image       : asset_gb+'images/loader.gif',
  orakuploader_no_image       : asset_gb+'images/no-image.jpg',
  orakuploader_add_label       : 'Select Request Images',
  orakuploader_use_rotation: true,
  orakuploader_maximum_uploads : 2,
  orakuploader_hide_on_exceed : true,
      // @if($user->photo)
      //   orakuploader_attach_images: [{!!json_encode($user->photo)!!}],
      // @endif
      // orakuploader_finished : function(){

      // }
    });
$('#ResidentailPhoto').orakuploader({
  orakuploader_path         : url_gb+'/',
  orakuploader_ckeditor         : true,
  orakuploader_use_dragndrop       : true,
  orakuploader_main_path : 'uploads/requests/',
  orakuploader_thumbnail_path : 'uploads/requests/',
  orakuploader_thumbnail_real_path : asset_gb+'uploads/requests/',
  orakuploader_add_image       : asset_gb+'images/add.png',
  orakuploader_loader_image       : asset_gb+'images/loader.gif',
  orakuploader_no_image       : asset_gb+'images/no-image.jpg',
  orakuploader_add_label       : 'Select Request Images',
  orakuploader_use_rotation: true,
  orakuploader_maximum_uploads : 2,
  orakuploader_hide_on_exceed : true,
      // @if($user->photo)
      //   orakuploader_attach_images: [{!!json_encode($user->photo)!!}],
      // @endif
      // orakuploader_finished : function(){

      // }
    });
  </script>
  @endsection