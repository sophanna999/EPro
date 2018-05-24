@extends('template.app')
@section('css_bottom')

@endsection
@section('body')
<div class="container-fluid course-wrapper bg1 nomargin">
    <div class="container concept-row">
        <div class="row mt-sm">
            <div class="container">
                <div class="col-md-10 col-md-offset-1">
                    <h4 class="article-title">{{$advertisements->adv_title}} 
                        <span class="date">{{date('d/m/Y',strtotime($advertisements->updated_at))}}</span>
                    </h4>
                    {!!$advertisements->adv_detail!!}
                    <p class="text-center mt-lg mb-lg">
                        <img src="{{asset('uploads/advertisements')}}/{{$advertisements->adv_image}}">
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