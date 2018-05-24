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
                      <h4><i class="fa fa-usd"></i> Buy Credits / View Credit Balance</h4>
                  </div>
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-xs-12">
                              <h5 class="text-blue">View Credits</h5>
                          </div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-md-3 text-form-mobile">Total Credits :</div>
                          <div class="col-md-8"> <span class="text-blue">{{number_format($pending_credit + $credits)}}</span></div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-md-3 text-form-mobile">Pending Credits :</div>
                          <div class="col-md-8"><span class="text-blue">{{number_format($pending_credit)}}</span></div>
                      </div>
                      <div class="row mt-xs">
                          <div class="col-md-offset-1 col-md-3 text-form-mobile">Credits Balance :</div>
                          <div class="col-md-8"><span class="text-blue">{{number_format(Auth::guard('retailer')->user()->credit)}}</span></div>
                      </div>
                      <div class="divide-line mt-sm"></div>
                      <div class="row mt-sm">
                          <div class="col-xs-12">
                              <h5 class="text-blue">Purchase Credits</h5>
                          </div>
                      </div>
                      <div class="col-md-12 form-horizontal table-responsive buycredit">
                           <table class="table-bordered table table-striped basic-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th class="text-center">Credit Name</th>
                                        <th class="text-center">Number of Credits</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Purchase</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach($credit_data as $key => $value)
                                    <tr>
                                        <td> <span class="text-blue">{{$id++}}</span></td>
                                        <td class="text-center">{{$value->name}}</td>
                                        <td class="text-center">{{$value->credit}}</td>
                                        <td class="text-center">{{$value->price}} $</td>
                                        <td class="text-center"> 
                                          <a href="{{url('Retailer/Credit'.'/'.$value->credit_id)}}"><button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$value->credit_id.'" title="Edit">
                                            <i class="ace-icon fa fa-shopping-cart bigger-120"></i>
                                        </button>
                                        </a>
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                              <div class="col-md-12 text-center">
                                  {{ $credit_data->links() }}
                              </div>
                          </div>
                      </div>
                      <div class="row mt-sm">
                          <div class="col-xs-12">
                              <h5 class="text-blue">History</h5>
                          </div>
                      </div>
                      <div class="form-horizontal buycredit">
                           <table class="table-bordered  table table-striped basic-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Credit</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($histories as $key => $history)
                                    <tr>
                                        <td class="text-center"> <span class="text-blue">{{$key+1}}</span></td>
                                        <td class="text-center">{{number_format($history->credit)}}</td>
                                        <td class="text-center">{{number_format($history->price,2)}} $</td>
                                        <td class="text-center">
                                          @if($history->status=='WA')
                                            <span class="text-warning">Wait Approve</span>
                                          @elseif($history->status=='A')
                                            <span class="text-success">Approved</span>
                                          @elseif($history->status=='C')
                                            <span class="text-danger">Unapprove</span>
                                          @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                              <div class="col-md-12 text-center">
                                  {{ $credit_data->links() }}
                              </div>
                          </div>
                          <form action="https://staging-secure.smoovpay.com/redirecturl" method="post" >
                          <!-- For actual LIVE account, use https://secure.smoovpay.com/redirecturl -->
                              <input type="hidden" name="version" value="2.0" />
                              <input type="hidden" name="action" value="pay" />
                              <input type="hidden" name="merchant" value="sophanna.tep@gmail.com" />
                              <input type="hidden" name="ref_id" value="001" />
                              <input type="hidden" name="item_name_1" value="item 1" />
                              <input type="hidden" name="item_description_1" value="Description for item 1" />
                              <input type="hidden" name="item_quantity_1" value="1" />
                              <input type="hidden" name="item_amount_1" value="1.00" />
                              <input type="hidden" name="item_name_2" value="item 2" />
                              <input type="hidden" name="item_description_2" value="Description for item 2" />
                              <input type="hidden" name="item_quantity_2" value="1" />
                              <input type="hidden" name="item_amount_2" value="1.00" />
                              <!--(Optional) input type="hidden" name="delivery_charge" value="0.00" />-->
                              <!--(Optional) input type="hidden" name="tax_amount" value="0.00" />-->
                              <!--(Optional) input type="hidden" name="tax_percentage " value="8.00" />-->
                              <!--(Optional) input type="hidden" name="fulfilled_date_time " value="2016-05-05 22:22" />-->
                              <input type="hidden" name="currency" value="SGD" />
                              <input type="hidden" name="total_amount" value="2.00" />
                              <input type="hidden" name="success_url" value="https://staging-secure.smoovpay.com/TokenAccess/7df11faa336841d5b2d8d7b6a2ea58ce" />
                              <input type="hidden" name="cancel_url" value="http://www.yourweb.com" />
                              <!--(Optional)<input type="hidden" name="str_url" value="http://www.yourweb.com/StrHandler" />-->
                              <!-- <button type="submit" class="form-control" name="submit" >Purchase Credit</button> -->
                              <!-- <input type="image" src="https://www.smoovpay.com/img/btn_smoovpay_v1.png" name="submit" alt="SmoovPay!" /> -->
                          </form>
                          <?php 
                            $dataToBeHashed = '3c13001e69e9437f9e89a4464e313dbf'
                                . 'sophanna.tep@gmail.com'
                                . 'pay'
                                . '001'
                                . '2.00'
                                . 'SGD';
                            $utfString = mb_convert_encoding($dataToBeHashed, "UTF-8");
                            $signature = sha1($utfString, false);

                           ?>

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