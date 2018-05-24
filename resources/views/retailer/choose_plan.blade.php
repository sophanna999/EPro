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
                      <h4><i class="fa fa-eye"></i> View Customer Choose Plan</h4>
                  </div>
                  <div class="container-fluid">
                      <div class="row">
                          <div class="form-horizontal"></div>
                          <div class="form-group">
                              <div class="col-md-3 text-right pull-right">
                                  
                              </div>
                          </div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-xs-12">
                            <table class="table-bordered table table-striped basic-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th class="text-center">Customer Name</th>
                                        <th class="text-center">Offers Title</th>
                                        <th class="text-center"> Date</th>
                                        <th class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($choose_plan_data as $key => $value)
                                    <tr>
                                        <td> <span class="text-blue">{{$id++}}</span></td>
                                        <td class="text-center">{{$value->firstname.' '.$value->lastname}}</td>
                                        <td class="text-center">{{$value->title}}</td>
                                        <td class="text-center">{{date('d/m/Y'),strtotime($value->updated_at)}}</td>
                                        <td class="text-center"> 
                                          <!-- <a href="{{url('Retailer/ViewCustomer/1')}}">View Details</a> -->
                                          <a href="{{url('Retailer/ViewCustomerChoosePlan'.'/'.$value->choose_plan_id)}}"><button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-info btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="{{$value->choose_plan_id}}" title="Detail">
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
                            {{ $choose_plan_data->links() }}
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
  $('body').on('change','#status',function(){
    window.location = "?status="+$(this).val();
  });
</script>
@endsection