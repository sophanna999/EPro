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
                  New Promotion
                </h4> 
              </div>
              <div class="container-fluid">
                <div class="row mt-xs">
                  <div class="container-fluid">
                    <form id="CreatePromotion" method="post" enctype="multipart/form-data">
                      <div class="col-xs-12 form-horizontal">
                        <div class="one-weekly-price">
                          <div class="form-group">
                            <h5 class="text-blue">Create Promotion Form</h5>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-4 text-right">Promotion Name</label>
                            <div class="col-md-4">
                              <input class="form-control" type="text" name="name" id="name">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-4 text-right">Title</label>
                            <div class="col-md-4">
                              <input class="form-control" type="text" name="title" id="title">
                            </div>
                            <p class="form-control-static col-md-2"></p>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-4 text-right">Upload Images</label>
                            <div class="col-md-4">
                              <input class="form-control" type="file" name="promotion_images" id="promotion_images">
                            </div>
                            <p class="form-control-static col-md-2"></p>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-4 text-right">Upload Files</label>
                            <div class="col-md-4">
                              <input class="form-control" type="file" name="promotion_files" id="promotion_files">
                            </div>
                            <p class="form-control-static col-md-2"></p>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-4 text-right">Detail</label>
                            <div class="col-md-4">
                              <!-- <input class="form-control" type="te" name="duration_from" id="duration_from"> -->
                              <textarea class="form-control" name="detail" id="detail" cols="30" rows="5"></textarea>
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
    $('#CreatePromotion').validate({
      errorElement: 'span',
      errorClass: 'help-block',
      focusInvalid: false,
      rules: {
        name: {
          required: true,
        },
        title: {
          required: true,
        }
      },
      messages: {
        name: {
          required: 'Please enter your promotion name',
        },
        title: {
          required: 'Please enter your title',
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
        var formData = new FormData(form);
        btn.button("loading");
        $.ajax({
          url: url_gb+"/Retailer/NewPromotion",
          data: formData,
          type: 'POST',
          contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
          processData: false, // NEEDED, DON'T OMIT THIS
          success : function(rec){
            var data = JSON.parse(rec);
            if (data.status == 1) {
              swal({
                position: 'center',
                type: 'success',
                title: data.title,
                text:  data.content,
                showConfirmButton: true
              },function(){
                window.location = url_gb+"/Retailer/Promotion";
              });
            }else{
              swal({
                position: 'center',
                type: 'error',
                title: data.title,
                text:  data.content,
                showConfirmButton: true
              });
            }
            btn.button('reset');
          }
        });
        // $.ajax({
        //   method : "POST",
        //   url : url_gb+"/Retailer/NewPromotion",
        //   dataType : 'json',
        //   data : $(form).serialize()
        // }).done(function(rec){
        //   btn.button("reset");
        //   if(rec.status==1){
        //     resetFormCustom(form);
        //     swal({
        //       position          : "center",
        //       type              : "success",
        //       text              : rec.content,
        //       title             : rec.title,
        //       showConfirmButton : true
        //     }, function(){
        //       window.location = url_gb+"/Retailer/Promotion";
        //     });
        //             // swal(rec.title,rec.content,"success");
        //           }else{
        //             swal(rec.title,rec.content,"error");
        //           }
        //         }).error(function(){
        //           swal("system.system_alert","system.system_error","error");
        //           btn.button("reset");
        //         });
              },
              invalidHandler: function (form) {

              }
            });
          </script>
          @endsection