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
                    <h4>About Us</h4>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <img class="about-img-1" src="{{asset('uploads/abouts/'.$abouts->image)}}">
                </div>
                <div class="col-lg-8">
                  {!!$abouts->detail!!}
                </div>
              </div>
              <div class="row mt-lg">
                <div class="col-lg-12">
                  <div class="content-head">
                    <h4>Services</h4>
                  </div>
                </div>
              </div>
              <div class="row">
                @foreach($services as $service)
                <div class="col-lg-4">
                  <div class="service-box">
                    <a href="{{url('service/'.$service->id)}}">
                    <img class="about-img-2" src="{{asset('uploads/services')}}/{{$service->image}}"></a>
                    <!-- <a href="{{url('knowledge_hub')}}/{{$service->id}}"><button class="col-md-12 service-title">{{$service->title}}</button></a> -->
                    <a href="{{url('service/'.$service->id)}}"><div class="service-title">{{$service->title}}</div></a>
                  </div>
                </div>
                @endforeach
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
</script>
@endsection