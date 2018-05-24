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
                      <h4>
                        <i class="fa fa-pencil"></i> 
                        New Weekly Price
                      </h4>
                  </div>
                  <div class="container-fluid">
                      <div class="row mt-xs">
                        <div class="container-fluid">
                        <form id="InsertWeeklyPrice">
                          <div class="col-xs-12 form-horizontal">
                              <!-- start .one-weekly-price-->
                              <div class="one-weekly-price">
                                  <div class="form-group">
                                      <h5 class="text-blue">Create Price Form</h5>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label class="control-label col-md-4 text-right">Select type</label>
                                      <div class="col-md-5">
                                          <select class="form-control" name="type_id" id="type_id">
                                                  <option value="1">Business</option>
                                                  <option value="2">Residentail</option>
                                                </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-4 text-right">Input Consumption range</label>
                                      <div class="col-md-2">
                                          <input class="form-control" type="text" name="consumtion_start" id="consumtion_start">
                                      </div>
                                      <p class="form-control-static col-md-1 text-center">to </p>
                                      <div class="col-md-2">
                                          <input class="form-control" type="text" name="consumtion_end" id="consumtion_end">
                                      </div>
                                      <p class="form-control-static col-md-3">kWh / all prices </p>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-4 text-right">Electricity Unit Price</label>
                                      <div class="col-md-3">
                                          <input class="form-control" type="text" name="unit_price" id="unit_price">
                                      </div>
                                      <p class="form-control-static col-md-2">/ kWh</p>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-4 text-right">Price Duration from</label>
                                      <div class="col-md-2">
                                          <input class="form-control" type="text" name="duration_from" id="duration_from">
                                      </div>
                                      <p class="form-control-static col-md-1 text-center">to </p>
                                      <div class="col-md-2">
                                          <input class="form-control" type="text" name="duration_end" id="duration_end">
                                      </div>
                                  </div>
                              </div>
                              <!-- end one-weekly-price-->
                              <div class="form-group">
                                  <div class="divide-line"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-md-4 col-md-offset-4">
                                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
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
    $('#InsertWeeklyPrice').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            consumtion_start: {
                required: true,
            },
            consumtion_end: {
                required: true,
            },
            unit_price: {
                required: true,
            },
            duration_from: {
                required: true,
            },
            duration_end: {
                required: true,
            }
        },
        messages: {
            consumtion_start: {
                required: 'Please enter ',
            },
            consumtion_end: {
                required: 'Please enter',
            },
            unit_price: {
                required: 'Please enter',
            },
            duration_from: {
                required: 'Please enter',
            },
            duration_end: {
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
                url : url_gb+"/Retailer/NewWeeklyPrice",
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
                      window.location = url_gb+"/Retailer/WeeklyPrice";
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