@extends('template.app')
@section('css_bottom')

@endsection
@section('body')
<div class="container-fluid course-wrapper bg1 nomargin">
    <div class="row mt-sm">
      <div class="container">
        <div class="col-md-12">
          <div class="content-box-fullwidth">
            <div class="row">
              <div class="col-lg-3">
                <div class="content-head">
                  <h4>Retailer Register</h4>
                </div>
              </div>
            </div>
            <form action="" id="FormRegister">
            <div class="row">
              <div class="col-md-6 col-md-offset-3 form-horizontal mt-sm">
                <div class="form-group">
                  <label class="control-label col-md-4 text-right text-left-xs">Name Title</label>
                  <div class="col-md-8">
                    <select class="form-control" name="prefix_id" id="prefix_id">
                        <option value="">Select Name Title</option>
                        @foreach($name_title as $key => $value)
                        <option value="{{$value->prefix_id}}">{{$value->name}}</option>
                        @endforeach()
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 text-right text-left-xs">Firstname</label>
                  <div class="col-md-8">
                    <input class="form-control" name="firstname" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 text-right text-left-xs">Lastname</label>
                  <div class="col-md-8">
                    <input class="form-control" name="lastname" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 text-right text-left-xs">Name of Electricity Retailer</label>
                  <div class="col-md-8">
                    <input class="form-control" name="company" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 text-right text-left-xs">Mobile</label>
                  <div class="col-md-8">
                    <input class="form-control" name="mobile" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 text-right text-left-xs">Email</label>
                  <div class="col-md-8">
                    <input class="form-control" name="email" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 text-right text-left-xs">Password</label>
                  <div class="col-md-8">
                    <input class="form-control" name="password" id="password" type="password">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4 text-right text-left-xs">Confirm Password</label>
                  <div class="col-md-8">
                    <input class="form-control" name="re_password" type="password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12 col-md-8 col-md-offset-4">
                    <input class="btn-primary btn" type="submit" value="Submit">
                  </div>
                </div>
              </div>
            </div>
            </form>
            <div class="row mt-lg hide">
                  <div class="col-xs-12 text-center">
                    <a href="javascript:void(0)" onClick="logInWithFacebook()">
                      <img src="{{asset('assets/front/img/btn_facebook.gif')}}" width="200">
                    </a>
                  </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js_bottom')
<script>
  $('#FormRegister').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            firstname: {
                required: true,
            },
            lastname: {
                required: true,
            },
            mobile: {
                required: true,
            },
            email: {
                email: true,
                required: true,
            },
            password: {
                required: true,
                minlength: 4,
                maxlength: 16,
            },
            re_password: {
                required: true,
                equalTo: "#password",
            }
        },
        messages: {
            firstname: {
                required: 'Please fill',
            },
            lastname: {
                required: 'Please fill',
            },
            email: {
                required: 'Please fill',
                email: 'Please enter email',
            },
            password: {
                required: 'Please fill',
                minlength: 'Please enter password between 4 - 16',
                maxlength: 'Please enter password between 4 - 16',
            },
            re_password: {
                required: 'The password you entered did not match',
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
                url : url_gb+"/Retailer/Register",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
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