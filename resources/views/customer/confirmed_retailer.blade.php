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
                    <h4><i class="fa fa-table"></i> View Confirmed Retailer</h4>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 form-horizontal table-responsive">
                            <table class="table-bordered table table-striped basic-table">
                                <col width="">
                                <col width="120">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Request ID</th>
                                        <th>Your Premise Address</th>
                                        <th>Reatiler Name</th>
                                        <th>Contact Retailer</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($request_data as $key => $value)
                                    <tr>
                                        <td>{{$id++}}</td>
                                        <td>{{$value->request->random_request_id}}</td>
                                        <td>{{$value->request->premise_address}}</td>
                                        <td>{{$value->user->firstname.'  '.$value->user->lastname}}</td>
                                        <td>{{$value->user->mobile}}</td>
                                        <td>
                                        <a href="{{url('Customer/ViewConfirmRetailer'.'/'.$value->submit_quotes_id)}}"><button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="{{$value->submit_quotes_id}}" title="Detail">
                                            <i class="ace-icon fa fa-edit bigger-120"></i>
                                        </button> </a>
                                    </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{ $request_data->links() }}
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