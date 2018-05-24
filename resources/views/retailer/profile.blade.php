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
                  <h4><i class="fa fa-user"></i>  Edit Profile</h4>
                </div>
                <div class="container-fluid">
                  <form action="" id="FormSaveProfile">
                    <div class="row">
                      <div class="col-xs-12 form-horizontal">
                        <div class="form-group">
                          <label class="control-label col-md-4 text-right">Email</label>
                          <div class="col-md-5">
                            <p class="form-control-static">{{$user->email}}</p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 text-right">Name of Electricity Retailer</label>
                          <div class="col-md-5">
                            <input class="form-control" name="company" type="text" value="{{$user->company}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 text-right">Firstname</label>
                          <div class="col-md-5">
                            <input class="form-control" name="firstname" type="text" value="{{$user->firstname}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 text-right">Lastname</label>
                          <div class="col-md-5">
                            <input class="form-control" name="lastname" type="text" value="{{$user->lastname}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-4 text-right">Contact Number</label>
                          <div class="col-md-5">
                            <input class="form-control" name="mobile" type="text" value="{{$user->mobile}}">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-offset-4 col-md-8 text-left">
                            <input class="btn-primary btn" type="submit" value="Save changes">
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
@endsection
@section('js_bottom')
<script src="{{asset('assets/front/js/dashboard.js')}}"></script>
<script>
  $('#FormSaveProfile').validate({
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
            }
        },
        messages: {
            firstname: {
                required: 'This field is required',
            },
            lastname: {
                required: 'This field is required',
            },
            mobile: {
                required: 'This field is required',
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
                url : url_gb+"/Retailer/Profile",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    swal(rec.title,rec.content,"success");
                }else{
                    swal(rec.title_error,rec.content,"error");
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