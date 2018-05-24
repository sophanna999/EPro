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
                      <h4><i class="fa fa-eye"></i> View Customers</h4>
                  </div>
                  <div class="container-fluid">
                    <form class="form-inline" id="Search" action="{{url('Retailer/ViewCustomer')}}" method="GET">
                      <div class="form-group">
                        <select class="form-control" name="status_type" id="status">
                          <option value="" {{$status==''? 'selected':''}}> Choose Status </option>
                          <option value="w" {{$status=='w'? 'selected':''}}> Waiting </option>
                          <option value="p" {{$status=='p'? 'selected':''}}> Pending </option>
                          <option value="r" {{$status=='r'? 'selected':''}}> Reject </option>
                          <option value="a" {{$status=='a'? 'selected':''}}> Approve </option>
                          <option value="s" {{$status=='s'? 'selected':''}}> Success </option>
                        </select>
                      </div>
                      <div class="form-group">
                        <input class="form-control" type="text" id="keyword" name="keyword" value="{{($keyword!='' ? $keyword : '')}}" placeholder="Search ID, Quote Name and Customer's Name here">
                     </div>
                     <div class="form-group">
                        <button type="submit" class="btn-warning btn btn-search" name="submit">Search</button>
                     </div>
                    </form>
                      <div class="row mt-xs">
                          <div class="col-xs-12 form-horizontal table-responsive">
                            <table class="table-bordered table table-striped basic-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th class="text-center">Request ID</th>
                                        <th class="text-center">Customer Name</th>
                                        <th class="text-center">Premise Address</th>
                                        <th class="text-center"> Status </th>
                                        <th class="text-center"> Date</th>
                                        <th class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($customer_data as $key => $value)
                                    <tr>
                                        <td> <span class="text-blue">{{$id++}}</span></td>
                                        <td> <span class="text-center">{{$value->random_request_id}}</span></td>
                                        <td class="text-center">{{$value->firstname.' '.$value->lastname}}</td>
                                        <td class="text-center">{{$value->premise_address}}</td>
                                        <td class="text-center">@if($value->substatus == "w")
                                          {{"Waiting"}}
                                          @elseif ($value->substatus == "a")
                                          {{"Aproved"}} 
                                          @elseif($value->substatus == "s")
                                          {{"Success"}}
                                          @elseif($value->substatus == "r")
                                          {{"Reject"}}
                                          @elseif($value->substatus == "p")
                                          {{"Pending"}}
                                          @endif
                                        </td>
                                        <td class="text-center">{{date('d/M/Y',strtotime($value->created_at))}}</td>
                                        <td class="text-center"> 
                                          <!-- <a href="{{url('Retailer/ViewCustomer/1')}}">View Details</a> -->
                                          <a href="{{url('Retailer/ViewCustomer'.'/'.$value->submit_quotes_id)}}"><button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-info btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$value->post_offer_id.'" title="Edit">
                                            <i class="ace-icon fa fa-eye bigger-120"></i>
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
                            {{ $customer_data->appends(['status_type' => $status, 'keyword'=>$keyword])->links() }}
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
<script src="{{asset('assets/front/js/retailer_dashboard.js')}}"></script>
<script>
  // $('body').on('change','#status',function(){
  //   window.location = "?status="+$(this).val();
  // });
</script>
@endsection