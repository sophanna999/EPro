@extends('template.app')
@section('css_bottom')

@endsection
@section('body')

<div class="container-fluid course-wrapper bg1 nomargin">
  <div class="container mt-sm">
    <div class="row">
      <div class="col-lg-12">
        <div class="content-head">
   
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-sm mb-lg">


    <div class="container">
      <div class="col-md-12">
        <div class="container-fluid">
        <br><br><br>
          <div class="container">
            <div class="jumbotron">
             <div>  <i class="icon-phone fa fa-email"></i></div> <h1>Thank you for registering with Wattprice.com.sg</h1> 
              <p>Your account has been activated. You will be directed to the login page shortly or click <a href="{{url('Customer/Login')}}">here</a> to login directly.</p> 
              <a href="{{url('Customer/Login')}}"><img width="190px" src="http://workbythaidev.com/ect/electricity/public/images/logo.png" alt=""></a>
             </div>
          </div>
        </div>
      </div>
    </div>

    <style>
      .jumbotron .h1, .jumbotron h1 {
    font-size: xx-large;
    margin-bottom: 26px;
    font-weight: 900;
    color: #439e00;
}

.jumbotron p {
    margin-bottom: 15px;
    font-size: large;
    font-weight: 200;
}


.jumbotron {
    padding-top: 30px;
    padding-bottom: 30px;
    margin-bottom: 30px;
    color: inherit;
    background-color: #eeeeee47;
    border-style: solid;
    border-width: 1px;
    border-color: #d2d2d2;
}
    </style>


  </div>
  <div class="set-footer "></div>
</div>
@endsection
@section('js_bottom')
<script>
</script>
@endsection
