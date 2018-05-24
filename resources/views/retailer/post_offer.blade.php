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
                        <i class="fa fa-asterisk"></i> 
                        Post Offers
                    </h4>
                  </div>
                  <div class="container-fluid">
                      <div class="col-xs-12 form-horizontal">
                          <div class="lowtension">
                            <form class="FormInsertOffer" id="FormInsertOffer">
                              <div class="form-group">
                                  <div id="photo" orakuploader="on"></div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-4 text-right">Retailer Name</label>
                                  <div class="col-md-5">
                                      <input class="form-control" type="text" name="retailer_name" id="retailer_name">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-4 text-right">Offer Title</label>
                                  <div class="col-md-5">
                                      <input class="form-control" type="text" name="title" id="title">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-4 text-right">Offer Description</label>
                                  <div class="col-md-5">
                                      <textarea class="form-control" rows="5" name="detail" id="detail"></textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-4 text-right">Promotion Duration from</label>
                                  <div class="col-md-2"  data-date="20-12-2017" data-date-format="dd-mm-yyyy">
                                      <input class="form-control" type="text" name="promotion_start" id="promotion_start">
                                  </div>
                                  <p class="form-control-static text-center col-md-1">to </p>
                                  <div class="col-md-2">
                                      <input class="form-control" type="text" name="promotion_end" id="promotion_end">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-4 text-right">Contact Person</label>
                                  <div class="col-md-5">
                                      <input class="form-control" type="text" name="contact_person" id="contact_person">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-4 text-right">Contact Number</label>
                                  <div class="col-md-5">
                                      <input class="form-control" type="text" name="contact_number" id="contact_number">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-4 text-right">Contact Email</label>
                                  <div class="col-md-5">
                                      <input class="form-control" type="text" name="contact_email" id="contact_email">
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-md-4 col-md-offset-4">
                                  <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Submit </button>
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
  $('#promotion_start').datetimepicker({
    format: 'yyyy-mm-dd',
    minView : 2,
    autoclose : true
  }).on('change',function(){
    var start_date = $(this).val();
    $('#promotion_end').datetimepicker('setStartDate',start_date);
  });
  $('#promotion_end').datetimepicker({
      format: 'yyyy-mm-dd',
      minView : 2,
      autoclose : true
    });

  $('#FormInsertOffer').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            retailer_name: {
                required: true,
            },
            title: {
                required: true,
            },
            detail: {
                required: true,
            },
            promotion_start: {
                required: true,
            },
            promotion_end: {
                required: true,
            },
            contact_person: {
                required: true,
            },
            contact_number: {
                required: true,
            },
            contact_email: {
                required: true,
            }
        },
        messages: {
            retailer_name: {
                required: 'Enter your retailer name please',
            },
            title: {
                required: 'Enter your title please',
            },
            detail: {
                required: 'Enter your detail please',
            },
            promotion_start: {
                required: 'Enter your promotion start please',
            },
            promotion_end: {
                required: 'Enter your promotion end please',
            },
            contact_person: {
                required: 'Enter your contact person please',
            },
            contact_number: {
                required: 'Enter your contact number please',
            },
            contact_email: {
                required: 'Enter your contact email please',
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

            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/Retailer/PostOffer",
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
                      window.location = url_gb+"/Retailer/Offer";
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


    //  $(function () {
    //     $('#datetimepicker6').datetimepicker();
    //     $('#datetimepicker7').datetimepicker({
    //         useCurrent: false //Important! See issue #1075
    //     });
    //     $("#datetimepicker6").on("dp.change", function (e) {
    //         $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    //     });
    //     $("#datetimepicker7").on("dp.change", function (e) {
    //         $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    //     });
    // });


  $('#photo').orakuploader({
    orakuploader_path         : url_gb+'/',
    orakuploader_ckeditor         : true,
    orakuploader_use_dragndrop       : true,
    orakuploader_main_path : 'uploads/offers/',
    orakuploader_thumbnail_path : 'uploads/offers/',                
    orakuploader_thumbnail_real_path : asset_gb+'uploads/offers/',  
    orakuploader_add_image       : asset_gb+'images/add.png',
    orakuploader_loader_image       : asset_gb+'images/loader.gif',
    orakuploader_no_image       : asset_gb+'images/no-image.jpg',
    orakuploader_add_label       : 'Select Images',               
    orakuploader_use_rotation: true,
    orakuploader_maximum_uploads : 1,
    orakuploader_hide_on_exceed : true,
    
    orakuploader_finished : function(){
        $(".file").addClass("multi_file");
    }
});
</script>
@endsection