@extends('template.app')
@section('css_bottom')
<style>
.chat ul li.you .message:after {
    border-top: 17px solid #999;
}
.chat ul li.you .message {
    background-color: #999;
}

</style>
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
                      <i class="fa fa-table"></i> Chate Message
                    </h4>
                </div>
                <div class="content-body">
                  <div class="row">
                    <div class="col-md-12">
                      <section class="content-message">
                        <div class="chat">
                          <ul id="list-message">
                            @foreach($messages as $key=>$message)
                              @if($message->type_member_reply=='A')
                              <li class="you">
                                <a class="user" href="#">
                                  <img alt="" src="{{asset('images/admin.svg')}}" />
                                </a>
                                <div class="date">
                                  {{$message->created_at}}
                                </div>
                                <div class="message">
                                  <p>
                                    {{$message->detail}}
                                  </p>
                                </div>
                              </li>
                              @else
                              <li class="other" data-id="last">
                                <a class="user" href="#">
                                  @if($user->photo)
                                    @if(file_exists('uploads/profile/'.$user->photo))
                                      <img src="{{asset('uploads/profile/'.$user->photo)}}"/>
                                    @else
                                      <img  src="{{asset('images/avatar_user.png')}}"/>
                                    @endif
                                  @else
                                    <img  src="{{asset('images/avatar_user.png')}}"/>
                                  @endif
                                </a>
                                <div class="date">
                                  {{$message->created_at}}
                                </div>
                                <div class="message">
                                  <p>
                                    {{$message->detail}}
                                  </p>
                                </div>
                              </li>
                              @endif
                            @endforeach
                          </ul>
                          <div id="xxxx"></div>
                        </div>
                      </section>
                    </div>
                  </div>
                  <hr>
                  <form action="" id="FormSendMessage">
                    <div class="row">
                      <div class="col-xs-8 col-sm-10">
                        <input type="text" name="message" id="text_message" class="form-control">
                      </div>
                      <div class="col-xs-4 col-md-2">
                        <button type="submit" class="btn btn-success"> Send</button>
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

function animate_content_message(){
  console.log($(".chat > ul > li:last").data('id'));
  $('body').find('.content-message').animate({
      scrollTop: $("#xxxx").offset().top
  }, 0);
}
$('body').on('submit','#FormSendMessage',function(e){
  e.preventDefault();
  if($('#text_message').val()){
    var form = this
    var btn = $(form).find('[type="submit"]');

    btn.button("loading");
    $.ajax({
        method : "POST",
        url : url_gb+"/Retailer/Chat/Send",
        dataType : 'json',
        data : $(form).serialize()
    }).done(function(rec){
        btn.button("reset");
        $('#list-message').append('\
          <li class="other">\
            <a class="user" href="#">\
              @if($user->photo)\
                @if(file_exists('uploads/profile/'.$user->photo))\
                  <img src="{{asset('uploads/profile/'.$user->photo)}}"/>\
                @else\
                  <img  src="{{asset('images/avatar_user.png')}}"/>\
                @endif\
              @else\
                <img  src="{{asset('images/avatar_user.png')}}"/>\
              @endif\
            </a>\
            <div class="date">\
              {{$message->created_at}}\
            </div>\
            <div class="message">\
              <p>\
                '+$('#text_message').val()+'\
              </p>\
            </div>\
          </li>\
          ');
        $('#text_message').val('');
        animate_content_message();
    }).error(function(){
        swal("system.system_alert","system.system_error","error");
        btn.button("reset");
    });
  }
});
animate_content_message();
</script>
@endsection