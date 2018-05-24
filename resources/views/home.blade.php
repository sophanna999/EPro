@extends('template.app')
@section('css_bottom')

@endsection
@section('body')

<div class="intro-header">
  <div class="container-fluid">
    <div class="row">
      <div class="mainslide">
        <div class="col-lg-12 bg-head">
          <div class="row">
            <div class="col-md-6 col-md-offset-6 col-xs-12">
              <div class="bluebox">
                <div class="h1 text-yellow">Find the best electricity rates for your business today!</div>
                <ul class="howto-list">
                  <li><span class="textstyle1">CHOOSE THE <span class="text-white">OFFER</span></span><span class="textstyle2">Description Lorem ipsum</span></li>
                  <li><span class="textstyle1">REQUEST FOR  <span class="text-white">QUOTES</span></span><span class="textstyle2">Description Lorem ipsum</span></li>
                  <li><span class="textstyle1">GET THE BEST <span class="text-white">PRICE</span></span><span class="textstyle2">Description Lorem ipsum</span></li>
                </ul><a class="btn btn-primary btn-getquote" href="{{url('Customer/Request')}}">GET QUOTES NOW</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid course-wrapper bg1 nomargin" style="min-height: 70%;">
  <div class="container concept-row">
    @if(count($advertisements)>0)
    <div class="row">
      <div class="col-xs-12 text-center intro">
        <h4>Advertisement</h4><span class="head-desc">Description Lorem ipsum dolor sit amet, consectetur</span>
      </div>
      <div class="row mt-sm">
        <div class="container">
          <div class="col-md-12">
            <div class="row">
              @foreach($advertisements as $advertisement)
              <div class="col-sm-6 course">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="course-img">
                        <a class="course-title" href="{{url('advertisements/'.$advertisement->id)}}">
                          <img src="{{asset('uploads/advertisements')}}/{{$advertisement->adv_image}}"></a>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="course-head">
                          <a class="course-title" href="{{url('advertisements/'.$advertisement->id)}}">
                            {{strip_tags($advertisement->adv_title)}}
                            <span class='date'>
                              <br>{{$advertisement->updated_at}}
                            </span>
                          </a>
                          <p class="course-desc">{{str_limit(strip_tags($advertisement->adv_detail),80)}}</p>
                          <a class="readmore" href="{{url('advertisements/'.$advertisement->id)}}">
                            <img src="{{asset('assets/front/img/icon-readmore.png')}}"> Readmore
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
      <div class="row">
        <div class="col-xs-12 text-center intro">
          <img src="{{asset('assets/front/img/head-knowledge.png')}}" alt="" title="">
          <span class="head-desc">Description Lorem ipsum dolor sit amet, consectetur</span>
        </div>
      </div>
      <div class="row mt-sm">
        <div class="container">
          <div class="col-md-12">
            <div class="row">
              @foreach($knowledges as $knowledge)
              <div class="col-sm-6 course">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="course-img">
                        <a class="readmore" href="{{url('knowledge_hub/'.$knowledge->id)}}">
                          <img src="{{asset('uploads/knowledges')}}/{{$knowledge->know_image}}"></a>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="course-head">
                          <a class="course-title" href="{{url('knowledge_hub/'.$knowledge->id)}}">
                            {{strip_tags($knowledge->know_title)}}
                            <span class='date'><br>{{$knowledge->updated_at}}</span>
                          </a>
                          <p class="course-desc">{{str_limit(strip_tags($knowledge->know_detail),80)}}</p>
                          <a class="readmore" href="{{url('knowledge_hub/'.$knowledge->id)}}">
                            <img src="{{asset('assets/front/img/icon-readmore.png')}}"> Readmore</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="row row-action">
            <div class="col-sm-4 text-center action-item hide"><a href="{{url('offer')}}"> <img src="{{asset('assets/front/img/btn-offer.jpg')}}"></a></div>
            <div class="col-sm-4 text-center action-item"><a href="{{url('Customer/Request')}}"> <img src="{{asset('assets/front/img/btn-requestquote.jpg')}}"></a></div>
            <div class="col-sm-4 col-sm-offset-4 col-xs-12 action-item subscribe-box">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 icon-sub text-center"><img src="{{asset('assets/front/img/icon-letter.png')}}"></div>
                  <div class="col-xs-12 icon-text"><strong>
                    <nobr>Subscribe to Us</nobr><span>lorem ipsum dolor sit...</span></strong></div>
                  </div>
                  <div class="row row-tb-subscribe">
                    <div class="col-xs-12 text-center">
                      <nobr>
                        <form id="subscribe">
                          <input class="tb-subscribe" name="sub_email" type="text" placeholder="your email">
                          <button type="submit" class="tb-btn">subscribe</button>
                        </form>
                      </nobr>
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
          $('#subscribe').validate({
            errorElement: 'span',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
              sub_email: {
                required: true,
                email: true,
              }
            },
            messages: {
              sub_email: {
                required: "This field is required",
                email: "Please enter the email first",
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
                url : url_gb+"/Subscribe",
                dataType : 'json',
                data : $(form).serialize()
              }).done(function(rec){
                if(rec.STATUS==1){
                  swal(rec.TITLE,rec.CONTENT,"success");
                  resetFormCustom(form);
                }else{
                  swal(rec.TITLE,rec.CONTENT,"error");
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