<div class="col-lg-3">
  <div class="content-head">
    <h4>Customer Dashboard</h4>
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
    <li><a href="{{url('Customer/Request')}}" ><i class="fa fa-plus"></i> Request</a></li>
    <li><a href="{{url('Customer/ViewSubmittedQuotes')}}"><i class="fa fa-table"></i> View Received Quotes</a></li>
    <li><a href="{{url('Customer/ViewConfirmRetailer')}}"><i class="fa fa-eye"></i> View Confirmed Retailers</a></li>
    <li><a href="{{url('Customer/SubmitReviewRetailer')}}"><i class="fa fa-pencil"></i> Submit Reviews of Retailers</a></li>
    <li class="hide"><a href="{{url('Customer/SearchPrice')}}"><i class="fa fa-search"></i> Search for Price</a></li>
    <li class="hide"><a href="{{url('offer')}}"><i class="fa fa-asterisk"></i> View Offer</a></li>
  </ul>
  <ul class="user-nav">
    <li><a href="{{url('Customer/Chat')}}"><i class="fa fa-comments"></i> Messages <!-- <span class="norti norti-primary">3</span> --></a></li>
    <li><a href="{{url('Customer/Dashboard')}}"><i class="fa fa-user"></i> Edit Profile</a></li>
    <li><a href="{{url('Customer/ChangePassword')}}"><i class="fa fa-key"></i> Change Password</a></li>
    <li><a href="{{url('Customer/Logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
  </ul>
</div>