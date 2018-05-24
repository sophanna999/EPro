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
                      <h4><i class="fa fa-usd"></i> Buy Credits / View Credit Balance</h4>
                  </div>

                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-xs-12">
                              <h5 class="text-blue">Purchase Credits</h5>
                          </div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-sm-3 text-form-mobile">Credit Name :</div>
                          <div class="col-sm-8"> <span class="text-blue"></span>{{$credit_data->name}}</div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-sm-3 text-form-mobile">Credit Amount :</div>
                          <div class="col-sm-8">{{$credit_data->credit}}</div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-sm-3 text-form-mobile">Price :</div>
                          <div class="col-sm-8">{{$credit_data->price}} $</div>
                      </div>

                      <div class="form-group" style="margin-top: 25px;">
                          <div class="col-md-12 col-md-offset-4">
                              <button type="submit" class="btn btn-info btn-lg buy-credit"><i class="fa fa-save"></i> Payment </button>
                              <button type="button" class="btn btn-danger btn-lg btn-back"><i class="fa fa-times"></i> Cancel </button>
                          </div>
                      </div>

                      <form id="PurchaseForm" class="hide">
                        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                        <input type="hidden" name="credit_id" id="credit_id" value="{{$credit_data->credit_id}}">
                        <input type="hidden" name="credit" id="credit" value="{{$credit_data->credit}}">
                        <input type="hidden" name="price" id="price" value="{{$credit_data->price}}"> <br>

                       <!--  <div class="form-group">
                            <div id="photo" orakuploader="on" name="photo"></div>
                        </div>
                        <div class="form-group">
                              <div class="col-md-12 col-md-offset-4">
                                  <button type="submit" class="btn btn-info btn-lg"><i class="fa fa-save"></i> Purchase </button>
                                  <button type="button" class="btn btn-danger btn-lg btn-back"><i class="fa fa-times"></i> Cancel </button>
                              </div>
                          </div> -->

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
  $('body').on('click','.btn-back', function(e){
    e.preventDefault();
    window.location = url_gb+"/Retailer/Credit";
  });

//    $('#photo').orakuploader({
//     orakuploader_path         : url_gb+'/',
//     orakuploader_ckeditor         : true,
//     orakuploader_use_dragndrop       : true,
//     orakuploader_main_path : 'uploads/bills/',
//     orakuploader_thumbnail_path : 'uploads/bills/',
//     orakuploader_thumbnail_real_path : asset_gb+'uploads/bills/',
//     orakuploader_add_image       : asset_gb+'images/add.png',
//     orakuploader_loader_image       : asset_gb+'images/loader.gif',
//     orakuploader_no_image       : asset_gb+'images/no-image.jpg',
//     orakuploader_add_label       : 'Select attach bill',
//     orakuploader_use_rotation: true,
//     orakuploader_maximum_uploads : 1,
//     orakuploader_hide_on_exceed : true,

//     orakuploader_finished : function(){

//     }
// });
   $('#PurchaseForm').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            photo: {
                required: true,
            }
        },
        messages: {
            photo: {
                required: 'Enter your photo please',
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

            swal({
            title: "Purchase Credit?",
            text:  "Yes sure! I want to purchase this credit",
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
                    url : url_gb+"/Retailer/Credit",
                    dataType : "json",
                    data : $(form).serialize()
                }).done(function(data){
                  // console.log(data);
                    if(data.status == 1){
                      // resetFormCustom(form);
                      swal({
                        position          : "center",
                        type              : "success",
                        title             : data.title,
                        showConfirmButton : true
                      }, function(){
                        window.location = url_gb+"/Retailer/Credit";
                    });
                    // swal(data.title,data.content,"success");

                }else{
                    swal('Select attach bill file first',data.content,"error");
                }
                }).error(function(data){
                    swal("System have problem","Contact to admin please","error");
                });
            }
        });

            // btn.button("loading");
            // $.ajax({
            //     method : "POST",
            //     url : url_gb+"/Retailer/Credit",
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
            //           window.location = url_gb+"/Retailer/Credit";
            //         });
            //     }else{
            //         swal('Select attach bill file first',rec.content,"error");
            //     }
            // }).error(function(){
            //     swal("system.system_alert","system.system_error","error");
            //     btn.button("reset");
            // });
        },
        invalidHandler: function (form) {

        }
    });

   $('body').on('click','.buy-credit',function(){
    $(this).button('loading');
    $.ajax({
        method : "POST",
        url : url_gb+"/Retailer/BuyCreditWithSmoovPay",
        dataType : "json",
        data : {id : {{$credit_data->credit_id}} }
    }).done(function(data){
      window.location = data.redirect_url;
    }).error(function(data){
        swal("System have problem","Contact to admin please","error");
    });
   });
</script>
@endsection