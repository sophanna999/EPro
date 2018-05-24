@extends('template.app')
@section('css_bottom')

@endsection
@section('body')

<div class="container-fluid course-wrapper bg1 nomargin">
  <div class="container mt-sm">
    <div class="row">
      <div class="col-lg-12">
        <div class="content-head">
          <h4>Email Activated</h4>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-sm mb-lg">
    <div class="container">
      <div class="col-md-12">
        <div class="content-head">
            <h4><i class="fa fa-table"></i>Email Activated</h4>
        </div>
        <div class="container-fluid">
            <div class="panel panel-default">
              <div class="panel-heading"><b>Thank you for registering with Wattprice.com.sg</b></div>
              <div class="panel-body">
                Your account has been activated.
                You will be directed to the login page shortly or click <a href="{{url('Customer/Login')}}">here</a> to login directly. <br>
                <a href="{{url('Customer/Login')}}" class="thumbnail">
                  <img src="http://workbythaidev.com/ect/electricity/public/images/logo.png" alt="" width="300px" height="200px">
                </a>
                <!-- <img src="http://workbythaidev.com/ect/electricity/public/images/logo.png" alt="" width="300px" height="200px"> -->
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="set-footer "></div>
</div>
@endsection
@section('js_bottom')
<script>
</script>
@endsection
