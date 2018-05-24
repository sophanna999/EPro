@extends('template.app')
@section('css_bottom')

@endsection
@section('body')
<div class="container-fluid course-wrapper bg1 nomargin">
    <div class="container concept-row">
        <div class="row">
            <div class="col-xs-12 text-center intro"><img src="http://placehold.it/728x90" alt="Advertising Space" title="Advertising Space"></div>
        </div>
        <div class="row">
            <div class="content-box-fullwidth nomargin nopadding">
                <div class="col-lg-4">
                    <div class="content-head">
                        <h4>Offers</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            
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
                                    <a href="{{url('offer/'.$list->post_offer_id)}}">
                                        <img src="{{asset('uploads/offers')}}/{{$list->photo}}">
                                    </a>
                                </div>
                                <a class="course-title" href="{{url('offer/'.$list->post_offer_id)}}">
                                    {{str_limit($list->title,34)}} 
                                    <span class='date'>{{date('d/m/Y',strtotime($list->updated_at))}}</span></a>
                                    <a class="btn btn-default btn-viewdetail" href="{{url('offer/'.$list->post_offer_id)}}">
                                        View Detail
                                    </a>
                                    @if(Auth::guard('customer')->check())
                                        <button class="btn btn-primary float-right pull-right btn btn-chooseplan" id="choose_plan" offer_id ="{{$list->post_offer_id}}">
                                            Choose This Plan
                                        </button>
                                    @endif
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
@endsection
@section('js_bottom')
<script>

    $('body').on('click', '#choose_plan', function(e){
        e.preventDefault();
        var btn = $(this).find('button');
        var offer_id = $(this).attr('offer_id');
        btn.button('loading');

        $.ajax({
            method : "POST",
            url    : url_gb+"/Customer/ChoosePlan",
            dataType: "json",
            data:{ offer_id : offer_id}
        }).done(function(res){
            if (res.status == 1) {
                swal(res.title, res.content, 'success');
               } else {
                swal(res.title,res.content, 'error');
               }
        });
    });

</script>
@endsection