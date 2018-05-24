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
                    <h4><i class="fa fa-table"></i>View Received Quotes</h4>
                </div>
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-xs-12">
                      <h4>{{$submit_quote_detail->premise_address}} :  {{$submit_quote_detail->updated_at}}</h4>
                      <h5>Retailer A Price details</h5>
                    </div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Price Model :</div>
                    <div class="col-md-8">Discount of SP published tariffs (12 Months)</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">A : Electricity unit Price :</div>
                    <div class="col-md-8"> <span class="text-blue">  </span>{{$submit_quote_detail->energy_rate}} / kWh</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">B : MDSC :</div>
                    <div class="col-md-8"> <span class="text-blue">{{$submit_quote_detail->mdsc_value}}</span> / kWh</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">C : UOS :</div>
                    <div class="col-md-8"> <span class="text-blue">{{$submit_quote_detail->uos_value}} </span>/ kWh</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">A + B + C : Total Price :</div>
                    <div class="col-md-8"> <span class="text-blue">$ {{$submit_quote_detail->energy_rate + $submit_quote_detail->mdsc_value + $submit_quote_detail->uos_value}}  </span>/ kWh</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Payment Terms :</div>
                    <div class="col-md-8">{{$submit_quote_detail->payment_term}}</div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Promotions :</div>
                    <div class="col-md-8">{{$submit_quote_detail->detail}}</div>
                  </div>
                  <div class="col-md-8 request_id hide">{{$submit_quote_detail->request_id}}</div>
                  <div class="col-md-8 retailer_id hide">{{$submit_quote_detail->id}}</div>
                  <div class="col-md-8 submit_quotes_id hide">{{$submit_quote_detail->submit_quotes_id}}</div>

                  <!-- <div class="row mt-xs">
                    <div class="col-md-offset-1 col-md-3 text-right">Terms and Conditions :</div>
                    <div class="col-md-8"> <a href="#">Click here <i class="fa fa-download"></i></a></div>
                  </div> -->
                  <div class="row mt-xs">
                    <div class="col-md-8 col-md-offset-4">
                      <input type="checkbox"> I agree and accept the terms and conditions
                    </div>
                  </div>
                  <div class="row mt-xs">
                    <div class="col-md-8 col-md-offset-4">
                      <button class="btn btn-primary btn-select" type="">Select This Plan</button>
                      <!-- <a class="btn btn-primary" href="" data-toggle="modal">Select this Plan
                      </a> -->
                      
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
  $('body').on('click','.btn-select', function(e){
    e.preventDefault();
    var id = $('.submit_quotes_id').text();
    var request_id  = $('.request_id').text();
    var retailer_id = $('.retailer_id').text();
    console.log(id);
    swal({
        title: "Select this plan?",
        text:  "Yes, I'm sure!!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel",
        showLoaderOnConfirm: true,
        closeOnConfirm: false
      }, function(data) {
        if(data){
            $.ajax({
                method : "POST",
                url : url_gb+"/Customer/ViewSubmittedQuotes/"+id,
                dataType : 'json',
                data : {request_id :request_id, retailer_id : retailer_id}
             }).done(function(rec){
            if(rec.status==1){
                // swal(rec.title,rec.content,"success");
                swal({
                  position          : "center",
                  type              : "success",
                  title             : rec.title,
                  showConfirmButton : true
                }, function(){
                  window.location = url_gb+"/Customer/ViewSubmittedQuotes";
                });
            }else{
                // swal(rec.title,rec.content,"error");
                swal({
                  position          : "center",
                  type              : "error",
                  title             : rec.title,
                  text              : rec.content,
                  showConfirmButton : true
                });
            }
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
        });
        }
    });
  });
  
</script>
@endsection