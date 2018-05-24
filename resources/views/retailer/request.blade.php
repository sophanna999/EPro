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
              @include('retailer.nav_bar')
              <div class="col-lg-9">
                <div class="content-head">
                    <h4><i class="fa fa-eye"></i> View Requests</h4>
                </div>
                <div class="container-fluid">
                    <div class="col-md-7">
                        <form class="form-inline" id="Search" action="{{url('Retailer/ViewRequest')}}" method="GET" style="margin-bottom: 15px;">
                          <div class="form-group">
                            <select class="form-control" name="type_id" id="type_id">
                              <option value="" {{$type_id==''? 'selected':''}}>Business Type</option>
                              <option value="1" {{$type_id=='1'? 'selected':''}}> Business </option>
                              <option value="2" {{$type_id=='2'? 'selected':''}}> Residential </option>
                          </select>
                      </div>
                      <div class="form-group">
                        <input class="form-control" type="text" id="keyword" name="keyword" value="{{($keyword!='' ? $keyword : '')}}" placeholder="Search Premise Address" style="min-width: 200px;">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-warning btn btn-search" name="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 text-form-tablet">
                <div class="form-group">

                            <button type="button" class="btn btn-warning"><i class="ace-icon fa fa-save bigger-120"></i></button>
                            <label for="" class="">Not submitted yet</label>
 
                            <button type="button" class="btn btn-info"><i class="ace-icon fa fa-eye bigger-120"></i></button>
                            <label for="" class="">Submitted</label> 



                </div>
             <!--    <div class="form-group">   
                </div> -->
            </div>
            <div class="row mt-xs">
                <div class="col-xs-12">
                    <div class="col-md-12 form-horizontal table-responsive">
                        <table class="table-bordered table table-striped basic-table">
                            <col width="">
                            <col width="120">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="text-center">Request ID</th>
                                    <th class="text-center">Business Type</th>
                                    <th class="text-center">Premise Address</th>
                                    <th class="text-center">Average Consumption</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date/Time</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($request_data as $key => $request)
                                {{-- */$i=0;/* --}}
                                <tr>
                                    <td> <span class="text-blue"></span>{{$id++}}</td>
                                    <td> <span class="text-blue"></span>{{$request->random_request_id}}</td>
                                    <td class="text-center">
                                        @if($request->type_id == 1)
                                        {{"Business"}}
                                        @elseif($request->type_id == 2)
                                        {{"Residential"}}
                                        @endif
                                    </td>
                                    <td class="">{{$request->premise_address}}</td>
                                    <td class="">{{$request->avr_consumtion}}</td>
                                    <td class="text-center">
                                        @if($request->status == O && (isset($request->SubmitQuote)&&($request->SubmitQuote[0]->status == 'w')))
                                        Submitted
                                        @elseif($request->status == O && (isset($request->SubmitQuote)&&($request->SubmitQuote[0]->status == 'r')))
                                        Closed
                                        @elseif($request->status == O)
                                        Open
                                        @elseif($request->status == S)
                                        Confirmed
                                        @else
                                        {{""}}
                                        @endif
                                        
                                    </td>
                                    <td class="text-center">{{date('d/m/Y',strtotime($request->created_at))}}</td>

                                    <td class="text-center">
                                        @if($request->status == 'O')
                                        @if(isset($request->SubmitQuote)&&(isset($request->SubmitQuote[0])))
                                        <a href="{{url('Retailer/ViewRequest'.'/'.$request->request_id)}}">
                                            <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-info btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$value->post_offer_id.'" title="Detail">
                                                <i class="ace-icon fa fa-eye bigger-120"></i>
                                            </button>
                                        </a>
                                        @else
                                        <a href="{{url('Retailer/ViewRequest'.'/'.$request->request_id)}}">
                                            <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$value->post_offer_id.'" title="Submit Quote">
                                                <i class="ace-icon fa fa-save bigger-120"></i>
                                            </button>
                                        </a>
                                        @endif
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    {{ $request_data->appends(['type_id' => $type_id, 'keyword'=>$keyword])->links() }}
                </div>
            </div>
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
    // $('body').on('change','#type_id',function(){
    //     window.location = "?type_id="+$(this).val();
    // });

    $('#FormSaveProfile').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            email: {
                required: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            email: {
                required: 'Please fill',
            },
            password: {
                required: 'Please fill',
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
                url : url_gb+"/Customer/Profile",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    swal(rec.title,rec.content,"success");
                }else{
                    swal(rec.title,rec.content,"error");
                }
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