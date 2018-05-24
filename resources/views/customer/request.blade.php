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
                    <h4>
                      <i class="fa fa-plus"></i> Request
                      <a href="{{url('Customer/NewRequest')}}" class="btn btn-success pull-right">
                        + New Request
                      </a>
                    </h4>
                </div>
                <div class="container-fluid">
                <form class="form-inline" id="Search" action="{{url('Customer/Request')}}" method="GET">
                    <div class="form-group">
                      <select class="form-control" name="type_id" id="type_id">
                          <option value="" {{$type_id==''? 'selected':''}}>Choose Type Of Business </option>
                          <option value="1" {{$type_id==1? 'selected':''}}>Business </option>
                          <option value="2" {{$type_id==2? 'selected':''}}>Residential </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input class="form-control" type="text" id="keyword" name="keyword" value="{{($keyword!='' ? $keyword : '')}}" placeholder="Search ID and Premise address" style="min-width: 300px;">
                   </div>
                   <div class="form-group">
                      <button type="submit" class="btn-warning btn btn-search" name="submit">Search</button>
                   </div>
                  </form> <br>

                  <div class="row">
                    <div class="col-md-12 form-horizontal table-responsive">
                      <table class="table-bordered table table-striped basic-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Request ID</th>
                                    <th>Type</th>
                                    <th>Premise Address</th>
                                    <th>Status</th>
                                    <!-- <th></th> -->
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($lists as $key => $value)
                                <tr>
                                  <td>{{$id++}}</td>
                                  <td>{{$value->random_request_id}}</td>
                                  <td>@if($value->type_id == 1)
                                      {{"Business"}}
                                      @else 
                                      {{"Residential"}}
                                      @endif
                                  </td>
                                  <td>{{$value->premise_address}}</td>
                                  <td>@if($value->status == "W")
                                      {{"Waiting"}}
                                      @else 
                                      {{"Approved"}}
                                      @endif
                                  </td>
                                  <!-- <td>
                                      <a href="{{url('Customer/Request'.'/'.$value->request_id)}}"><button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$value->request_id.'" title="Edit">
                                      <i class="ace-icon fa fa-edit bigger-120"></i>
                                  </button></a>
                                </td> -->
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        {{ $lists->appends(['type_id' => $type_id, 'keyword'=>$keyword])->links() }}
                    </div>
                </div> <br>
                  <div class="col-sm-6 col-sm-offset-5">
                    <a href="{{url('Customer/NewRequest')}}" class="btn btn-success btn-lg">+ New Request</a>
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