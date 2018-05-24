@extends('template.app')
@section('css_bottom')

@endsection
@section('body')
<div class="container-fluid course-wrapper bg1 nomargin">
    <div class="container concept-row">
        <div class="row mt-sm">
            <div class="container">
                <div class="col-md-10 col-md-offset-1">
                    <h4 class="article-title">{{$services->title}} 
                        <span class="date">{{date('d/m/Y',strtotime($services->updated_at))}}</span>
                    </h4>
                    {!! $services->detail !!}
                    <p class="text-center mt-lg mb-lg">
                        <img src="{{asset('uploads/services')}}/{{$services->image}}">
                    </p>
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