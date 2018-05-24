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
                                      <option value="1" {{$request_data->type_id == 1? 'selected':''}}> Business </option>
                                      <option value="2" {{$request_data->type_id == 2? 'selected':''}}> Residential </option>
                                </select>
                            </div>
                        </div>
                        <div class="divide-line"></div>
                        <div class="business" id="business">
                         <form id="FormUpdateBusiness">
                          <div class="form-group">
                            <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Company Name</label>
                            <div class="col-xs-12 col-sm-5">
                              <input class="form-control" type="text" name="b_company_name" id="b_company_name" value="{{$request_data->company_name}}">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> UEN Number</label>
                            <div class="col-xs-12 col-sm-5">
                              <input class="form-control" type="text" name="b_uen_no" id="b_uen_no" value="{{$request_data->uen_no}}">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Premise Address</label>
                            <div class="col-xs-12 col-sm-5">
                              <textarea class="form-control premise_address" row="5" name="b_premise_address" id="b_premise_address">{{$request_data->premise_address}}</textarea>
                            </div>
                          </div>
                          <div class="form-group">

                            <div class="control-label col-xs-4 text-right"></div>
                            <div class="col-xs-12 col-sm-5">
                              <input type="checkbox" class="form-check-input address-same" id="same_addr" checked><span> Billing Same as premise address</span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Billing Address</label>
                            <div class="col-xs-12 col-sm-5">
                              <textarea class="form-control mb-xs bill_address" row="5" name="b_bill_address" id="b_bill_address" >{{$request_data->bill_address}}</textarea>
                            </div>
                          </div>
                          <div class="form-group mt-xs">
                            <label class="control-label col-xs-4 text-right">MSSL Number</label>
                            <div class="col-xs-12 col-sm-5">
                              <input class="form-control mb-xs" type="text" name="b_mssl_no" id="b_mssl_no" value="{{$request_data->mssl_no}}"><span>Found on Existing Electricity Bill</span>
                            </div>
                          </div>
                          <div class="form-group mt-xs">
                            <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Average Consumption kWh</label>
                            <div class="col-xs-12 col-sm-5">
                              <input class="form-control" type="text" name="b_avg_consumtion" id="b_avg_consumtion" value="{{$request_data->avr_consumtion}}">
                            </div>
                          </div>
                          <div class="form-group mt-xs">
                            <label class="control-label col-xs-4 text-right"><span class="text-red">*</span>Upload Image </label>
                            <div class="col-xs-12 col-sm-5">
                              <div id="BusinessPhoto" orakuploader="on" name="BusinessPhoto"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Existing Retailer</label>
                            <div class="col-xs-12 col-sm-5">
                              <select class="form-control" name="b_existing_retailer" id="b_existing_retailer">
                                <option value="">Choose Existing Retailer</option>
                                @foreach($existing as $key => $value)
                                @if($value->existing_id == $request_data->ex_retailer)
                                <option value="{{$value->existing_id}}" selected>{{$value->name}}</option>
                                @else 
                                <option value="{{$value->existing_id}}">{{$value->name}}</option>
                                @endif
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
                          @if($value->id == $request_data->estimate_id)
                          <div class="checkbox col-xs-offset-1">
                            <label class="col-xs-12 mb-xs">
                            <input type="radio" name="estimate_business" id="estimate_business" value="{{$value->id}}" checked>
                            {{$value->name}}
                          </label>
                          </div>
                          @else 
                          <div class="checkbox col-xs-offset-1">
                            <label class="col-xs-12 mb-xs">
                            <input type="radio" name="estimate_business" id="estimate_business" value="{{$value->id}}">
                            {{$value->name}}
                          </label>
                          </div>
                          @endif
                          @endforeach
                          <div class="col-xs-12 mb-lg">
                            1) Fixed Rates - Secure a fixed flat rate for the entire contract period. This rate will not change for the entire contract period regardless of the market conditions. <br>
                            2) Discount Off SP Published Tariffs - Obtain a % discount off the prevailing Singapore Power (SP) tariff rates. This rate will move in tandem with the SP rates at a discount.
                          </div>

                          <div class="form-group">
                            <div class="col-sm-3 col-sm-offset-7 ">
                              <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Save</button>
                            </div>
                          </div>
                        </div>
                      </form>  
                    </div>

                    <div class="residential hide" id="residential">
                    <form id="FormUpdateResidentail">
                      <input type="hidden" class="request_id" name="id" value="{{$request_data->request_id}}">
                      <div class="form-group">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Types of Dwellings </label>
                        <div class="col-xs-12 col-sm-5">
                          <select class="form-control" name="r_dwelling_type" id="r_dwelling_type">
                            <option value="">Select Dwelling</option>
                            @foreach($dwelling as $key => $value)
                            @if($value->id == $request_data->dwelling_type_id)
                            <option value="{{$value->id}}" selected>{{$value->dwe_name.' :  '.$value->dwe_detail}}</option>
                            @else 
                            <option value="{{$value->id}}">{{$value->dwe_name.' :  '.$value->dwe_detail}}</option>
                            @endif
                            @endforeach
                            <!-- <option value="3">Landed Property </option>  -->
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Premise Address</label>
                        <div class="col-xs-12 col-sm-5">
                          <textarea class="form-control r_premise_address" row="5" name="r_premise_address" id="r_premise_address" required>{{$request_data->premise_address}}</textarea>
                        </div>
                      </div>
                      <div class="form-group">

                        <div class="control-label col-xs-4 text-right"></div>
                        <div class="col-xs-12 col-sm-5">
                          <input type="checkbox" class="form-check-input r_address-same" id="same_addr1" checked><span> Billing Same as premise address</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Billing Address</label>
                        <div class="col-xs-12 col-sm-5">
                          <textarea class="form-control mb-xs r_bill_address" row="5" name="r_bill_address" id="r_bill_address">{{$request_data->bill_address}}</textarea>
                        </div>
                      </div>
                      <div class="form-group mt-xs">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Average Consumption kWh</label>
                        <div class="col-xs-12 col-sm-5">
                          <input class="form-control" type="text" name="r_avg_consumtion" id="r_avr_consumtion" value="{{$request_data->avr_consumtion}}">
                        </div>
                      </div>
                      <div class="form-group mt-xs">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span>Upload Image </label>
                        <div class="col-xs-12 col-sm-5">
                          <div id="ResidentailPhoto" orakuploader="on" name="ResidentailPhoto"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-xs-4 text-right"><span class="text-red">*</span> Existing Retailer</label>
                        <div class="col-xs-12 col-sm-5">
                          <select class="form-control" name="r_ex_retailer" id="r_ex_retailer">
                                <option value="">Choose Existing Retailer</option>
                                @foreach($existing as $key => $value)
                                @if($value->existing_id == $request_data->ex_retailer)
                                <option value="{{$value->existing_id}}" selected>{{$value->name}}</option>
                                @else 
                                <option value="{{$value->existing_id}}">{{$value->name}}</option>
                                @endif
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
                          @if($value->id == $request_data->estimate_id)
                          <div class="checkbox col-xs-offset-1">
                            <label class="col-xs-12 mb-xs">
                            <input type="radio" name="estimate_residentail" id="estimate_residentail" value="{{$value->id}}" checked>
                            {{$value->name}}
                          </label>
                          </div>
                          @else 
                          <div class="checkbox col-xs-offset-1">
                            <label class="col-xs-12 mb-xs">
                            <input type="radio" name="estimate_residentail" id="estimate_residentail" value="{{$value->id}}">
                            {{$value->name}}
                          </label>
                          </div>
                          @endif
                          @endforeach
                        <div class="col-xs-12 mb-lg">
                          1) Fixed Rates - Secure a fixed flat rate for the entire contract period. This rate will not change for the entire contract period regardless of the market conditions. <br>
                          2) Discount Off SP Published Tariffs - Obtain a % discount off the prevailing Singapore Power (SP) tariff rates. This rate will move in tandem with the SP rates at a discount.
                        </div>
                        <div class="col-sm-4 col-sm-offset-7">
                        <div class="form-group">
                          <div class="col-xs-12 col-sm-5">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Save </button>
                          </div>
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
<script>
   $('body').on('change','#type_id',function(e){
    if ($(this).val()==1) {
      $('#business').removeClass('hide');
      $('#residential').addClass('hide');
    } else if($(this).val()==2){
      $('#residential').removeClass('hide');
      $('#business').addClass('hide');
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

    $('#FormUpdateBusiness').validate({
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
            b_mssl_no: {
                required: true,
            },
            b_avg_consumtion: {
                required: true,
            },
            b_existing_retailer: {
                required: true,
            }
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
            b_mssl_no: {
                required: 'Enter your mssl number please',
            },
            b_avg_consumtion: {
                required: 'Enter your average consumption please',
            },
            b_existing_retailer: {
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
            var id  = $('.request_id').val();

            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/Customer/NewRequest/Business/"+id,
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    resetFormCustom(form);
                    // swal(rec.title,rec.content,"success");
                    swal({
                      position          : "center",
                      type              : "success",
                      title             : rec.title,
                      showConfirmButton : true
                    }, function(){
                      window.location = url_gb+"/Customer/Request";
                    });
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

    $('#FormUpdateResidentail').validate({
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
            r_mssl_no: {
                required: true,
            },
            r_avg_consumtion: {
                required: true,
            },
            r_existing_retailer: {
                required: true,
            }
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
            r_mssl_no: {
                required: 'Enter your mssl number please',
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
            var id  = $('.request_id').val();
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/Customer/NewRequest/Residentail/"+id,
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    resetFormCustom(form);
                    // swal(rec.title,rec.content,"success");
                    swal({
                      position          : "center",
                      type              : "success",
                      title             : rec.title,
                      showConfirmButton : true
                    }, function(){
                      window.location = url_gb+"/Customer/Request";
                    });
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


  $('#type_id').trigger('change');


   $('#BusinessPhoto').orakuploader({
    orakuploader_path         : url_gb+'/',
    orakuploader_ckeditor         : true,
    orakuploader_use_dragndrop       : true,
    orakuploader_main_path : 'uploads/requests',
    orakuploader_thumbnail_path : 'uploads/requests',                
    orakuploader_thumbnail_real_path : asset_gb+'uploads/requests',  
    orakuploader_add_image       : asset_gb+'images/add.png',
    orakuploader_loader_image       : asset_gb+'images/loader.gif',
    orakuploader_no_image       : asset_gb+'images/no-image.jpg',
    orakuploader_add_label       : 'Select attach bill',               
    orakuploader_use_rotation: true,
    orakuploader_hide_on_exceed : true,
    
    orakuploader_maximum_uploads : {{2-sizeof($photos)}},
    orakuploader_attach_images: {!! $photos==''? '[]':json_encode($photos) !!},
});
   $('#ResidentailPhoto').orakuploader({
    orakuploader_path         : url_gb+'/',
    orakuploader_ckeditor         : true,
    orakuploader_use_dragndrop       : true,
    orakuploader_main_path : 'uploads/requests',
    orakuploader_thumbnail_path : 'uploads/requests',                
    orakuploader_thumbnail_real_path : asset_gb+'uploads/requests',  
    orakuploader_add_image       : asset_gb+'images/add.png',
    orakuploader_loader_image       : asset_gb+'images/loader.gif',
    orakuploader_no_image       : asset_gb+'images/no-image.jpg',
    orakuploader_add_label       : 'Select attach bill',               
    orakuploader_use_rotation: true,
    orakuploader_hide_on_exceed : true,
    
    orakuploader_maximum_uploads : {{2-sizeof($photos)}},
    orakuploader_attach_images: {!! $photos==''? '[]':json_encode($photos) !!},
});

    // @if($request_data->bill_image)
    // $('div.picture_delete,div.rotate_picture,div.select_ck').remove();
    // @endif


</script>
@endsection