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
                    <h4><i class="fa fa-table"></i> View Confirmed Retailer detail</h4>
                </div>
                <div class="container-fluid">
                  <!-- <div class="row">
                    <div class="col-xs-12"> 
                      <h5>Retailer id : R000001</h5>
                    </div>
                  </div> -->
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Retailer Name :</div>
                    <div class="col-md-8">{{$submit_quotes->user->firstname.' '.$submit_quotes->user->lastname}}</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Contact Number :</div>
                    <div class="col-md-8">{{$submit_quotes->user->mobile}}</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Email :</div>
                    <div class="col-md-8">{{$submit_quotes->user->email}}</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-xs-12">
                      <h5>Contract Details</h5>
                    </div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Premise Address :</div>
                    <div class="col-md-8">{{$submit_quotes->request->premise_address}}</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Billing Address :</div>
                    <div class="col-md-8">{{$submit_quotes->request->bill_address}}</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Type :</div>
                    <div class="col-md-8">
                        {{$submit_quotes->request->type_id ==1? "Business" : "Residentail"}}
                    </div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Payment Terms :</div>
                    <div class="col-md-8">{{$submit_quotes->quotation->payment_term}}</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Price Plan:</div>
                    <div class="col-md-8">
                      <input type="checkbox" checked> {{$submit_quotes->request->estimate->name}}
                    </div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Contraction doc:</div>
                    <div class="col-md-8"><a href="{{ asset('uploads/contracts/'.$submit_quotes->quotation->contract->file_name) }}">{{$submit_quotes->quotation->contract->contract_name}}</a> </div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Electricity Rate :</div>
                    <div class="col-md-8">{{$submit_quotes->RequestEstimate->EstimateCommencement->name}}</div>
                  </div>
                  <!-- <div class="row mt-xs">
                    <div class="col-md-8 col-md-offset-4"><a class="btn btn-primary" href="#" data-toggle="modal">View Contact</a></div>
                  </div> -->
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