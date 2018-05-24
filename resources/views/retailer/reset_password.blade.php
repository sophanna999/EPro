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
              <div class="row">
                <div class="col-lg-12">
                  <div class="content-head">
                    <h4>Forgot Password</h4>
                  </div>
                </div>
              </div>
              <form action="" id="FormResetPassword">
            <div class="row">
              <div class="col-md-6 col-md-offset-3 form-horizontal mt-sm">
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
                    <input class="form-control" name="token" value="{{$token}}" type="hidden">
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
                    <button class="btn-primary btn" type="submit">Reset</button>
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
@endsection
@section('js_bottom')
<script>
  $('#FormResetPassword').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true
            },
            re_password: {
                equalTo: '#password'
            }
        },
        messages: {
            email: {
                required: 'Please fill.',
                email: 'Please enter email only.',
            },
            password: {
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
                url : url_gb+"/Retailer/ChangeResetPassword",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                if(rec.status==1){
                  // swal(
                  //   rec.title,rec.content,"success"
                  //   );
                  swal({
                      position          : "center",
                      type              : "success",
                      title             : rec.title,
                      text              : rec.content,
                      showConfirmButton : true
                    }, function(){
                      window.location = url_gb+"/Retailer/Login";
                    });

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
<script>
</script>
@endsection