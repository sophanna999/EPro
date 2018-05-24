@extends('template.app')
@section('css_bottom')

@endsection
@section('body')
<div class="container-fluid course-wrapper bg1 nomargin">
    <div class="container concept-row">
        <div class="row">
            <div class="col-xs-12 text-center intro">
            	<img src="{{asset('assets/front/img/head-knowledge.png')}}" alt="ศาสตร์ตัวเลข" title="ศาสตร์ตัวเลข">
            	<span class="head-desc">
                    Description Lorem ipsum dolor sit amet, consectetur
                </span>
            </div>
        </div>
        <div class="row mt-sm">
            <div class="container">
                <div class="col-md-12">
                    @if($lists)
                    @foreach($lists as $key=>$list)
                    @if($key%4==0)
                    @if($key>0)
                </div>
                @endif
                <div class="row">
                    @endif
                    <div class="col-sm-3 course">
                        <div class="course-img">
                            <a href="{{url('knowledge_hub/'.$list->id)}}">
                                <img src="{{asset('uploads/knowledges')}}/{{$list->know_image}}">
                            </a>
                        </div>
                        <a class="course-title" href="{{url('knowledge_hub/'.$list->id)}}">
                            {{str_limit($list->know_title,34)}}
                            <span class='date'>{{date('d/m/Y',strtotime($list->updated_at))}}</span>
                        </a>
                        <p class="course-desc">
                            {{str_limit($list->know_detail,150)}}
                            <a class="readmore" href="{{url('knowledge_hub/'.$list->id)}}">
                                <img src="{{asset('assets/front/img/icon-readmore.png')}}"> 
                                Readmore
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{ $lists->links() }}
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