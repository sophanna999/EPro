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
                      <h4><i class="fa fa-eye"></i> View Choose Plan Detail</h4>
                  </div>
                  <div class="container-fluid">
                     
                     <div class="row mt-xs">
                        <div class="col-md-offset-1 col-md-3 text-right">Status :</div>
                        <div class="col-md-8"><span class="label label-primary">Open</span></div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-md-3 text-right">Date of Request :</div>
                        <div class="col-md-8">1 Sep 2017</div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-md-3 text-right">Closing date of request :</div>
                        <div class="col-md-8">8 Sep 2017</div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-md-3 text-right">Estimated date of commencement :</div>
                        <div class="col-md-8">7 Oct 2017</div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-md-3 text-right">Premise Type :</div>
                        <div class="col-md-8">Residential</div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-md-3 text-right">Type :</div>
                        <div class="col-md-8">HBD</div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-md-3 text-right">MSSL Number :</div>
                        <div class="col-md-8">xxxxxxxx</div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-md-3 text-right">Average consumption per month :</div>
                        <div class="col-md-8">xxx kWh</div>
                    </div>

                    <form id="SubmitQuote">
                        <input type="hidden" name="customer_id" id="customer_id" value="{{$choose_plan_detail->customer_id}}">
                        <input type="hidden" name="request_id" id="request_id" value="{{$choose_plan_detail->request_id}}">
                        <input type="hidden" name="choose_plan_id" id="choose_plan_id" value="{{$choose_plan_detail->choose_plan_id}}">

                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-md-3 text-right">View Bill :</div>
                        <!-- <div class="col-md-8"><a href="#">Click here <i class="fa fa-download"></i></a></div> -->
                         <div class="col-md-4">
                            <div id="photo" orakuploader="on"></div>
                        </div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-md-3 text-right">Choose Quotation :</div>
                        <div class="col-md-4">
                            <select class="form-control" name="quote_id" id="quote_id">
                                <option value="">Select Quotation</option>
                                @foreach($quotation_name as $key => $value)
                                <option value="{{$value->quotes_id}}">{{$value->quotes_name}}</option>
                                @endforeach()
                            </select>
                        </div>
                        
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-md-3 text-right">Status :</div>
                        <div class="col-md-4">
                            <select class="form-control" name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="w">Waiting</option>
                                <option value="p">Pending</option>
                                <option value="r">Reject</option>
                                <option value="a">Aprove</option>
                                <option value="s">Success</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-xs">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Submit </button>
                        </div>
                        <div ></div>
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
@endsection
@section('js_bottom')
<script src="{{asset('assets/front/js/retailer_dashboard.js')}}"></script>
<script>
    $('#SubmitQuote').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            quote_id: {
                required: true,
            },
            status: {
                required: true,
            }
        },
        messages: {
            quote_id: {
                required: 'Please fill',
            },
            status: {
                required: 'Please fill',
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
                url : url_gb+"/Retailer/SubmitCustomerChoosePlan",
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
                      window.location = url_gb+"/Retailer/ViewCustomerChoosePlan";
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
  


  $('#photo').orakuploader({
    orakuploader_path         : url_gb+'/',
    orakuploader_ckeditor         : true,
    orakuploader_use_dragndrop       : true,
    orakuploader_main_path : 'uploads/bills/',
    orakuploader_thumbnail_path : 'uploads/bills/',                
    orakuploader_thumbnail_real_path : asset_gb+'uploads/bills/',  
    orakuploader_add_image       : asset_gb+'images/add.png',
    orakuploader_loader_image       : asset_gb+'images/loader.gif',
    orakuploader_no_image       : asset_gb+'images/no-image.jpg',
    orakuploader_add_label       : 'Select attach bill',               
    orakuploader_use_rotation: true,
    orakuploader_maximum_uploads : 1,
    orakuploader_hide_on_exceed : true,
    
    orakuploader_finished : function(){
        $(".file").addClass("multi_file");
    }
});
</script>
@endsection