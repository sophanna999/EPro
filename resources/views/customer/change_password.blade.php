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
                <div class="col-lg-9">
                <div class="content-head">
                  <h4><i class="fa fa-user"></i>  Change Password</h4>
                </div>
                <div class="container-fluid">
                  <form action="" id="ChangePassword">
                    <div class="row">
                      <!-- <input type="hidden" name="id" id="id" value="{{$user->id}}"> -->
                      <div class="col-xs-12 form-horizontal">
                        <div class="form-group">
                          <label class="control-label col-md-4 text-right">Email : </label>
                          <div class="col-md-5">
                            <p class="form-control-static">{{$user->email}}</p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 text-right">Current Password : </label>
                          <div class="col-md-5">
                            <input class="form-control" name="current_password" type="password" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 text-right">New Password : </label>
                          <div class="col-md-5">
                            <input class="form-control" name="new_password" id="new_password" type="password" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 text-right"> Confirm New Password : </label>
                          <div class="col-md-5">
                            <input class="form-control" name="conf_new_password" type="password" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-offset-4 col-md-8 text-left">
                           <button class="btn-primary btn" type="submit">Change Password</button>
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
@endsection
@section('js_bottom')
<script src="{{asset('assets/front/js/dashboard.js')}}"></script>
<script>
  
  $('#ChangePassword').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            current_password: {
                required: true,
            },
            new_password: {
                required: true,
                minlength: 4,
                maxlength: 16,
            },
            conf_new_password: {
                required: true,
                equalTo: "#new_password",
            }
            
        },
        messages: {
            current_password: {
                required: 'Please fill your current password',
            },
            new_password: {
                required: 'Please fill your new password',
                minlength: 'Please enter password between 4 - 16',
                maxlength: 'Please enter password between 4 - 16',
            },
            conf_new_password: {
                required: 'Please confirm your password',
                equalTo : 'The passwords you entered did not match',
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
                url : url_gb+"/Customer/ChangePassword",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                if(rec.status==1){
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
                }else{
                    swal(rec.title,rec.content,"error");
                }
                btn.button("reset");
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