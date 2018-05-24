@extends('Admin.layouts.layouts')
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
@section('breadcrumbs')
<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="#">Home</a>
        </li>

        <li>
            <a href="#">Other Pages</a>
        </li>
        <li class="active">Blank Page</li>
    </ul><!-- /.breadcrumb -->

    <!-- #section:basics/content.searchbox -->
    <div class="nav-search" id="nav-search">
        <button class="btn btn-xs btn-success btn-add">
            + Add {{$title or 'New Data'}}
        </button>
    </div><!-- /.nav-search -->

    <!-- /section:basics/content.searchbox -->
</div>
@endsection
@section('body')
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <section class="content-message">
                        <div class="chat">
                          <ul id="list-message">

                            @foreach($messages as $key=>$message)
                              @if($message->type_member_reply=='A')
                              <li class="other" data-id="last">
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
                              <li class="you">
                                <a class="user" href="#">
                                  @if($message->User->photo)
                                    @if(file_exists('uploads/profile/'.$message->User->photo))
                                      <img src="{{asset('uploads/profile/'.$message->User->photo)}}"/>
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
                      <hr>
                      <form action="" id="FormSendMessage">
                        <input type="hidden" name="user_id" class="form-control" value="{{$message->User->id}}">
                        <div class="row">
                          <div class="col-xs-8 col-sm-10">
                            <input type="text" name="message" id="text_message" class="form-control">
                          </div>
                          <div class="col-xs-4 col-sm-2">
                            <button type="submit" class="btn btn-success"> Send</button>
                          </div>
                        </div>
                      </form>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->
@endsection
@section('js_bottom')
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
        url : url_gb+"/admin/Message/Send",
        dataType : 'json',
        data : $(form).serialize()
    }).done(function(rec){
        btn.button("reset");
        $('#list-message').append('\
          <li class="other" data-id="last">\
            <a class="user" href="#">\
                <img alt="" src="{{asset('images/admin.svg')}}" />\
            </a>\
            <div class="date">\
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
