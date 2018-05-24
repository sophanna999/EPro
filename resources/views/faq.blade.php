@extends('template.app')
@section('css_bottom')

@endsection
@section('body')

<div class="container-fluid course-wrapper bg1 nomargin">
  <div class="container mt-sm">
    <div class="row">
      <div class="col-lg-12">
        <div class="content-head">
          <h4>FAQ</h4>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-sm mb-lg">
    <div class="container">
      <div class="col-md-12">
        @foreach($lists as $list)
        <a class="ask" href="#">
          <i class="fa fa-question-circle"></i>
          {{$list->question}}
        </a>
        <div class="answer">
          <div class="answer-body">
            {{$list->answer}}
          </div>
        </div>
        @endforeach
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