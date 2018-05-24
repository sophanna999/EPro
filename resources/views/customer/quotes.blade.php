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
              @include('customer.nav_bar')
              <div class="col-lg-9">
                <div class="content-head">
                    <h4><i class="fa fa-table"></i> View Received Quotes</h4>
                </div>
                <div class="container-fluid">
                        <form class="form-inline" id="Search" action="{{url('Customer/ViewSubmittedQuotes')}}" method="GET">
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
                </form><br>
                    <div class="row">
                        <div class="col-xs-12 form-horizontal table-responsive">
                            <table class="table-bordered table table-striped basic-table">
                                <col width="">
                                <col width="120">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lists as $key => $value)
                                    <tr>
                                        <td>{{$id++}}</td>
                                        <td>{{$value->random_request_id}} ({{number_format($value->submit_quote_count)}})</td>
                                        <td>{{ ($value->type_id==1)? 'Business':'Residential'}}</td>
                                        <td>{{$value->premise_address}}</td>
                                        <td>{{$value->status == 'O'?'Open' : ''}}</td>
                                        <td>{{date('d/m/Y',strtotime($value->created_at))}}</td>
                                        <td>
                                            <a href="{{url('Customer/ViewSubmittedQuotes'.'/'.$value->request_id)}}"><button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="" title="Detail">
                                            <i class="ace-icon fa fa-edit bigger-120"></i>
                                        </button></a>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{ $lists->appends(['type_id' => $type_id, 'keyword'=>$keyword])->links() }}
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
  
</script>
@endsection