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
                      <h4><i class="fa fa-eye"></i> View Customer Detail</h4>
                  </div>
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-xs-12">
                              <h4>Customer id : {{$submit_quote_detail->random_request_id}}</h4>
                          </div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-sm-3 text-form-mobile">Customer Name :</div>
                          <div class="col-sm-8">{{$submit_quote_detail->firstname.' '.$submit_quote_detail->lastname}}</div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-sm-3 text-form-mobile">Customer Number :</div>
                          <div class="col-sm-8">{{$submit_quote_detail->mobile}}</div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-sm-3 text-form-mobile">Premise Address :</div>
                          <div class="col-sm-8">
                              {{$submit_quote_detail->premise_address}}
                          </div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-sm-3 text-form-mobile">Billing Address :</div>
                          <div class="col-sm-8">
                              {{$submit_quote_detail->bill_address}}
                          </div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-sm-3 text-form-mobile">Type :</div>
                          <div class="col-sm-8">
                            @if($submit_quote_detail->type_id == 1)
                            {{"Business"}}
                            @else 
                            {{"Residentail"}}
                            @endif
                        </div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-sm-3 text-form-mobile">Average Consumption :</div>
                          <div class="col-sm-8">{{$submit_quote_detail->avr_consumtion}} kWh</div>
                      </div>
                      <div class="row mt-xs">
                          @foreach($request_estimate as $k => $val)
                          @if($k==0)
                            <div class="col-md-offset-1 col-sm-3 text-form-mobile">Price Models:</div>
                          @else
                            <div class="col-md-offset-1 col-sm-3 text-form-mobile"></div>
                          @endif
                            <div class="col-sm-8">{{$no++ .' ) '}} {{ $val->name}} <br></div> 
                          @endforeach
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-sm-3 text-form-mobile">Existing Retailer :</div>
                          <div class="col-sm-8">{{$submit_quote_detail->name}}</div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-sm-3 text-form-mobile">Terms and Contract duration :</div>
                          <div class="col-sm-8"><a href="{{asset('uploads/contracts/'.$contracts[0]->file_name)}}" target="_blank">{{$contracts[0]->contract_name}}</a></div>
                      </div>
                     <!--  <div class="row mt-xs">
                          <div class="col-md-8 col-md-offset-4">
                            <a class="btn btn-primary" href="#">
                              View Contract
                            </a>
                          </div>
                      </div> -->
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