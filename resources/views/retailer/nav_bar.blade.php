<div class="col-lg-3">
  <div class="content-head">
    <h4>Retailer Dashboard</h4>
  </div>
  <div class="avatar mb-sm text-center">
     @if($user->photo)
      @if(file_exists('uploads/profile/'.$user->photo))
        <img class="avatar-img" src="{{asset('uploads/profile/'.$user->photo)}}"/>
      @else
        <img class="avatar-img" src="{{asset('images/avatar_user.png')}}"/>
      @endif
    @else
      <img class="avatar-img" src="{{asset('images/avatar_user.png')}}"/>
    @endif
    <span class="username">{{$user->firstname.' '.$user->lastname}}</span>
  </div>
  <ul class="user-nav">
    <li class="hide"><a href="{{url('Retailer/Quotation')}}"><i class="fa fa-asterisk" ></i> Quotations </a></li>
    <li><a href="{{url('Retailer/ViewRequest')}}"><i class="fa fa-eye"></i> View Requests</a></li>
    <li><a href="{{url('Retailer/ViewCustomer')}}"><i class="fa fa-eye"></i> View Customers</a></li>
    <li class="hide"><a href="{{url('Retailer/ViewCustomerChoosePlan')}}"><i class="fa fa-eye"></i> View Customers Choose Plan</a></li>
    <li class="hide"><a href="{{url('Retailer/Offer')}}"><i class="fa fa-asterisk"></i> Offers</a></li>
    <li class="hide"><a href="{{url('Retailer/WeeklyPrice')}}"><i class="fa fa-pencil"></i> Submit Weekly Price</a></li>
    <li><a href="{{url('Retailer/Credit')}}"><i class="fa fa-usd"></i> Buy Credits / View Credit Balance</a></li>
    <li><a href="{{url('Retailer/Promotion')}}"><i class="fa fa-user"></i> Promotions</a></li>
    <li><a href="{{url('Retailer/Dashboard')}}"><i class="fa fa-user"></i> Profile</a></li>
    <li><a href="{{url('Retailer/Chat')}}"><i class="fa fa-comments"></i> Messages <!-- <span class="norti norti-primary">3</span> --></a></li>
    <li><a href="{{url('Retailer/ChangePassword')}}"><i class="fa fa-key"></i> Change Password</a></li>
    <li><a href="{{url('Retailer/Contract')}}"><img src="{{asset('assets/front/img/contract_icon.png')}}" width="15" height="15" alt="" >Terms and Conditions</a></li>
    <li><a href="{{url('Retailer/Logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
  </ul>
</div>