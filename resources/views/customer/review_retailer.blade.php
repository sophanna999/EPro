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
                      <h4><i class="fa fa-table"></i> Review Retailer</h4>
                  </div>
                  <div class="container-fluid">
                    <div class="col-xs-12 form-horizontal">
                      <form id="FormReviewRetailer">
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Choose Retailer</label>

                        <div class="col-md-6">
                          <select class="form-control required" name="retailer" id="retailer">
                            <option value="">Select Ratailer</option>
                              }
                              @foreach($retailer_name as $key => $value)
                              <option value="{{$value->id}}">{{$value->firstname.' '.$value->lastname}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Pre Sales Service</label>
                        <div class="col-md-6">
                          <div class="rating-group form-group">
                            <input class="rating pre_sale required" name="pre_sale" type="radio" value="1">
                            <input class="rating pre_sale required" name="pre_sale" type="radio" value="2">
                            <input class="rating pre_sale required" name="pre_sale" type="radio" value="3">
                            <input class="rating pre_sale required" name="pre_sale" type="radio" value="4">
                            <input class="rating pre_sale required" name="pre_sale" type="radio" value="5">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">After Sales Service</label>
                        <div class="col-md-6">
                          <div class="rating-group form-group">
                            <input class="rating after_sale" name="after_sale" type="radio" value="1">
                            <input class="rating after_sale" name="after_sale" type="radio" value="2">
                            <input class="rating after_sale" name="after_sale" type="radio" value="3">
                            <input class="rating after_sale" name="after_sale" type="radio" value="4">
                            <input class="rating after_sale" name="after_sale" type="radio" value="5">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Price</label>
                        <div class="col-md-6">
                          <div class="rating-group form-group">
                            <input class="rating price" name="price" type="radio" value="1">
                            <input class="rating price" name="price" type="radio" value="2">
                            <input class="rating price" name="price" type="radio" value="3">
                            <input class="rating price" name="price" type="radio" value="4">
                            <input class="rating price" name="price" type="radio" value="5">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 text-right">Comment</label>
                        <div class="col-md-6">
                          <textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-offset-4 col-md-6">
                          <!-- <input class="btn-primary btn" type="submit" value="Submit"> -->
                          <button type="submit" class="btn btn-primary"><i class="fa fa-save" ></i> Submit</button>
                        </div>
                      </div>
                      </form>                  
                  </div>
                </div>
              </div>
              <div class="col-lg-9">
                <div class="content-head">
                  <h4><i class="fa fa-table"></i> History Reviews</h4>
                </div>
                <div class="col-xs-12 form-horizontal table-responsive">
                <table class="table-bordered table table-striped basic-table">
                      <thead>
                          <tr>
                              <th>No.</th>
                              <th>Retailer Name</th>
                              <th>Point Pre Sale</th>
                              <th>Point After Sale</th>
                              <th>Point Price</th>
                              <th>Comment</th>
                          </tr>
                      </thead>
                      <tbody id="data_search">
                        @foreach($review as $key => $value)
                          <tr>
                            <td>{{$id++}}</td>
                            <td>{{$value->retailer->firstname." ".$value->retailer->lastname}}</td>
                            <td>
                              <div class="rating-group form-group disable-star">
                                @for($i=1;$i<=5;$i++)
                                  <input class="rating price hide" type="radio" value="{{$i}}" {{($value->point_pre_sale == $i) ? 'checked' : ''}} >
                                @endfor
                              </div>
                            </td>
                            <td>
                              <div class="rating-group form-group disable-star">
                                @for($i=1;$i<=5;$i++)
                                <input class="rating price hide" type="radio" value="{{$i}}" {{($value->point_after_sale == $i) ? 'checked' : ''}} >
                                @endfor
                              </div>
                            </td>
                            <td>
                              <div class="rating-group form-group disable-star">
                                @for($i=1;$i<=5;$i++)
                                <input class="rating price hide" type="radio" value="{{$i}}" {{($value->point_price == $i) ? 'checked' : ''}} >
                                @endfor
                              </div>
                            </td>
                            <td>{{$value->comment}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
                  <div class="row">
                    <div class="col-lg-12 text-center">
                        {{$review->links()}}
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
        $('#FormReviewRetailer').validate({
          errorElement: 'span',
          errorClass: 'help-block',
          focusInvalid: false,
          rules: {
              pre_sale   : "required",
              after_sale : "required",
              price      : "required",
              comment    : "required"
          },
          messages: {
              pre_sale    : "Please enter pre sale service",
              after_sale  : "Please enter after sale",
              price       : "Please enter price",
              comment     : "Please enter your comment"

          },
          highlight: function (e) {
              validate_highlight(e);
          },
          success: function (e) {
              validate_success(e);
          },

          errorPlacement: function (error, element) {
              validate_errorplacement(error, element);
          },
          submitHandler: function (form) {
              var btn = $(form).find('[type="submit"]');

              btn.button("loading");
              $.ajax({
                  method : "POST",
                  url : url_gb+"/Customer/SubmitReviewRetailer",
                  dataType : 'json',
                  data : $(form).serialize()
              }).done(function(rec){
                  btn.button("reset");
                  if(rec.status==1){
                      resetFormCustom(form);
                      // swal(rec.title,rec.content,"success");
                      swal({
                        position          : "center",
                        type              : "success",
                        title             : rec.title,
                        showConfirmButton : true
                      }, function(){
                        window.location = url_gb+"/Customer/SubmitReviewRetailer";
                      });
                  }else{
                      swal(rec.title,rec.content,"error");
                  }
              }).error(function(){
                  swal("system.system_alert","system.system_error","error");
                  btn.button("reset");
              });
          },
          invalidHandler: function (form) {

          }
      });
 
  </script>
  @endsection