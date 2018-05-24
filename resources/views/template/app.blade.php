<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{$title_page or ''}} | Electricity</title>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="description" content="Electricity Description"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="author" content=""/>
  <link type="text/css" rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}"/>
  <link type="text/css" rel="stylesheet" href="{{asset('assets/front/css/rating.css')}}"/>
  <link type="text/css" rel="stylesheet" href="{{asset('assets/front/css/landing-page.css')}}"/>
  <link type="text/css" rel="stylesheet" href="{{asset('assets/front/font-awesome/css/font-awesome.min.css')}}"/>
  <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:100,300,500|Lato:300,400,700,300italic,400italic,700italic|PT+Serif:400i"/>
  <link type="text/css" rel="stylesheet" href="{{asset('assets/front/css/global.css')}}"/>
  <link type="text/css" rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}"/>
  <link type="text/css" rel="stylesheet" href="{{asset('assets/front/css/bootstrap-datetimepicker.css')}}"/>
  <link type="text/css" rel="stylesheet" href="{{asset('assets/front/css/ace-fonts.css')}}"/>
  <!-- <link type="text/css" rel="stylesheet" href="{{asset('assets/front/css/register-login.css')}}"/> -->
<!--   <link type="text/css" rel="stylesheet" href="{{asset('assets/front/css/bootstrap-datetimepicker.css')}}"/> -->
<!--   <link type="text/css" rel="stylesheet" href="{{asset('assets/front/css/bootstrap-datetimepicker-standalone.css')}}"/> -->
  <link rel="stylesheet" href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/global/plugins/orakuploader/orakuploader.css')}}" />
  <link type="text/css" rel="stylesheet" href="{{asset('assets/global/css/modal.css')}}"/>
  @yield('css_bottom')
</head>
<body>

<div class="container-fluid z99 bgnav">
  <nav class="nav-main navbar navbar-default topnav">
    <div class="container-fluid topnav">
      <div class="row">
        <div class="navbar-header">
          <button class="navbar-toggle" type="buton" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <div class="row ptb10">
            <div class="col-xs-2 text-left">
              <a class="head-logo" href="{{url('/')}}">
                <img src="{{asset('images/logo.png')}}" class="logo-header" alt="">
              </a>
            </div>
            <div class="col-xs-10 text-right">
              <ul class="nav navbar-nav nav-mobile">
                <li class="nav-item {{$main_menu=='home'? 'active':'' }}"><a href="{{url('')}}">HOME</a></li>
                <li class="nav-item {{$main_menu=='about'? 'active':'' }}"><a href="{{url('about')}}">ABOUT US</a></li>
                <li class="nav-item hide {{$main_menu=='offer'? 'active':'' }}"><a href="{{url('offer')}}">OFFERS</a></li>
                <li class="nav-item hide {{$main_menu=='request_quotes'? 'active':'' }}"><a href="{{url('request_quotes')}}">REQUEST QUOTES</a></li>
                <li class="nav-item {{$main_menu=='knowledge_hub'? 'active':'' }}"><a href="{{url('knowledge_hub')}}">KNOWLEDGE HUB</a></li>
                <li class="nav-item {{$main_menu=='faq'? 'active':'' }}"><a href="{{url('faq')}}">FAQ</a></li>
                <li class="nav-item {{$main_menu=='contact'? 'active':'' }}"><a href="{{url('contact')}}">CONTACT US</a></li>
                @if(Auth::guard('customer')->check())
                  <li class="nav-item {{$main_menu=='customer'? 'active':'' }}">
                    <a href="{{url('Customer/Dashboard')}}">
                      <i class="icon-phone fa fa-user"> </i>
                      <span>Profile</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('Customer/Logout')}}">
                      <i class="icon-phone fa fa-sign-out"> </i>
                      <span>Logout</span></a>
                  </li>
                @elseif(Auth::guard('retailer')->check())
                  <li class="nav-item {{$main_menu=='retailer'? 'active':'' }}">
                    <a href="{{url('Retailer/Dashboard')}}">
                      <i class="icon-phone fa fa-user"> </i>
                      <span>Profile</span>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{url('Retailer/Logout')}}">
                      <i class="icon-phone fa fa-sign-out"> </i>
                      <span>Logout</span>
                    </a>
                  </li>
                @else
                  <li class="nav-item {{$main_menu=='customer_register'? 'active':'' }} hide">
                    <a href="{{url('Customer/Register')}}">
                      <i class="icon-phone fa fa-user"> </i>
                      <span>REGISTER</span>
                    </a>
                  </li>
                  <li class="nav-item {{$main_menu=='customer_login'? 'active':'' }}">
                    <a href="{{url('Customer/Login')}}">
                      <i class="icon-phone fa fa-lock"> </i>
                      <span>LOGIN</span>
                    </a>
                  </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</div>






@yield('body')


 <footer class="pre-footer" >
  
                <div class="container">
                  <div class="row">
                    <p class="col-md-4 copyright text-muted small text-center">
                    Copyright &copy; electricity.com All Rights Reserved
                  </p>
                    <ul class="col-md-8 text-center list-inline nav-footer">
                      <li class="nav-item hide"><a href="#" onClick="logInWithFacebook()">Log In with the JavaScript SDK</a></li>
                      <li class="nav-item active"><a href="{{url('/')}}">HOME</a></li>
                      <li class="nav-item"><a href="{{url('about')}}">ABOUT US</a></li>
                      <li class="nav-item hide"><a href="{{url('offer')}}">OFFERS</a></li>
                      <li class="nav-item hide"><a href="{{url('request_quotes')}}">REQUEST QUOTES</a></li>
                      <li class="nav-item"><a href="{{url('knowledge_hub')}}">KNOWLEDGE HUB</a></li>
                      <li class="nav-item"><a href="{{url('faq')}}">FAQ</a></li>
                      <li class="nav-item"><a href="{{url('contact')}}">CONTACT US</a></li>
                      <li class="nav-item hide"><a href="{{url('Retailer/Register')}}"><i class="fa fa-user"></i> RETAILER REGISTER</a></li>
                      <li class="nav-item"><a href="{{url('Retailer/Login')}}"><i class="fa fa-lock"></i> RETAILERS LOGIN</a></li>
                    </ul>
                  </div>
                </div>



</footer>
  <script src="{{asset('assets/front/js/jquery.js')}}"></script>
  <script src="{{asset('assets/global/plugins/orakuploader/jquery-ui.min.js')}}"></script>
  <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url_gb = '{{url('')}}';
        var asset_gb = '{{asset('')}}';
        function makeid(){
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for( var i=0; i < 5; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            return text;
        }
         function addNumformat(nStr){
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    </script>
  <script src="{{asset('assets/front/js/rating.js')}}"></script>
  <script src="{{asset('assets/front/js/jquery.dotdotdot.min.js')}}"></script>
  <script src="{{asset('assets/front/js/lightGallery/js/lightgallery.min.js')}}"></script>
  <script src="{{asset('assets/front/js/lightGallery/js/lg-thumbnail.min.js')}}"></script>
  <script src="{{asset('assets/front/js/lightGallery/js/lg-fullscreen.min.js')}}"></script>
  <script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/front/js/global.js')}}"></script>
  <script src="{{asset('assets/global/js/modal.js')}}"></script>
  <script src="{{asset('assets/global/js/validate.js')}}"></script>
  <script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
  <script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.js')}}"></script>
  <script src="{{asset('assets/global/plugins/orakuploader/orakuploader.js')}}"></script>
  <script src="{{asset('assets/front/js/bootstrap-datetimepicker.js')}}"></script>




<script>
  logInWithFacebook = function() {
    FB.login(function(response) {
      console.log(response);
      if (response.authResponse) {
        $.ajax({
              method : "POST",
              url : url_gb+"/CallbackFacebook",
              dataType : 'json',
              data : {
                token : response.authResponse.accessToken,
                user_id : response.authResponse.userID,
              }
          }).done(function(rec){
              if(rec==1){
                window.location = url_gb+'/Customer/Dashboard';
              }
          }).error(function(){
              swal("system.system_alert","system.system_error","error");
              btn.button("reset");
          });
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    });
    return false;
  };
  logInWithFacebookRetailer = function() {
    FB.login(function(response) {
      console.log(response);
      if (response.authResponse) {
        $.ajax({
              method : "POST",
              url : url_gb+"/Retailer/CallbackFacebook",
              dataType : 'json',
              data : {
                token : response.authResponse.accessToken,
                user_id : response.authResponse.userID,
              }
          }).done(function(rec){
              if(rec==1){
                window.location = url_gb+'/Customer/Dashboard';
              }
          }).error(function(){
              swal("system.system_alert","system.system_error","error");
              btn.button("reset");
          });
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    });
    return false;
  };
  window.fbAsyncInit = function() {
    FB.init({
      appId: '381085508979093',
      cookie: true, // This is important, it's not enabled by default
      version: 'v2.11'
    });
  };

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
@yield('js_bottom')



</body>
</html>