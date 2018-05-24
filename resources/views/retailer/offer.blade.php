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
                        <i class="fa fa-asterisk"></i> 
                        Offers
                        <div class="pull-right">
                          <a class="btn btn-success" href="{{url('Retailer/PostOffer')}}">+ New Offer</a>
                        </div>
                    </h4>
                  </div>
                  <div class="container-fluid">
                    <div class="row mt-xs">
                          <div class="col-xs-12">
                            <table class="table-bordered table table-striped basic-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th class="text-center">Retailer Name</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($offer_data as $key => $value)
                                  @if($user->id == $value->user_id)
                                    <tr>
                                        <td> <span class="text-blue">{{$id++}}</span></td>
                                        <td class="text-center">{{$value->retailer_name}}</td>
                                        <td class="text-center">{{$value->title}}</td>
                                        <td class="text-center"> 
                                          <a href="{{url('Retailer/PostOffer'.'/'.$value->post_offer_id)}}"><button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-info btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$value->post_offer_id.'" title="Edit">
                                            <i class="ace-icon fa fa-eye bigger-120"></i>
                                        </button></a>

                                          <a href="{{url('Retailer/PostOffer'.'/'.$value->post_offer_id)}}"><button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$value->post_offer_id.'" title="Edit">
                                            <i class="ace-icon fa fa-edit bigger-120"></i>
                                        </button></a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 text-center">
                            {{ $offer_data->links() }}
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