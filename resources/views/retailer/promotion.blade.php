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
                      <h4>
                        <i class="fa fa-pencil"></i> 
                        Promotion
                        <div class="pull-right">
                          <a class="btn btn-success" href="{{url('Retailer/NewPromotion')}}">+ New Promotion</a>
                        </div>
                      </h4>
                  </div>
                  <div class="container-fluid">
                      <div class="row mt-xs">
                          <div class="col-xs-12 form-horizontal table-responsive">
                            <table class="table-bordered table table-striped basic-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th class="text-center">Promotion ID</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Created date</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($promotion_data as $key => $promotions)
                                    <tr>
                                        <td> <span class="text-blue">{{$id++}}</span></td>
                                        <td class="text-center">{{$promotions->random_id}}</td>
                                        <td class="text-center">{{$promotions->name}}</td>
                                        <td class="text-center">{{$promotions->title}}</td>
                                        <td class="text-center">
                                          @if($promotions->status=='A')
                                          Approved
                                          @elseif($promotions->status=='C')
                                          Cancel
                                          @elseif($promotions->status=='W')
                                          Waiting
                                          @else
                                          ""
                                          @endif
                                        </td>
                                        <td class="text-center">{{date('Y-m-d',strtotime($promotions->created_at))}}</td>
                                        <td class="text-center"> 
                                         @if($promotions->status=='A')
                                         <a href="{{url('Retailer/PromotionDetail').'/'.$promotions->id}}">
                                            <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-info btn-condensed btn-detail btn-tooltip" data-rel="tooltip" title="Detail">
                                            <i class="ace-icon fa fa-building-o bigger-120"></i>
                                        </button></a>
                                        @elseif($promotions->status=='C')
                                        <a href="{{url('Retailer/EditPromotion').'/'.$promotions->id}}">
                                            <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" title="Edit">
                                            <i class="ace-icon fa fa-edit bigger-120"></i>
                                        </button></a>
                                        @else
                                        
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 text-center">
                            {{ $promotion_data->links() }}
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
   
</script>
@endsection