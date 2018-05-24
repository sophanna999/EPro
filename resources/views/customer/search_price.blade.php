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
                    <h4>
                      <i class="fa fa-plus"></i> Search Price
                    </h4>
                </div>
                <div class="container-fluid"></div>
                <div class="row form-inline">
                <form id="Search" action="{{url('Customer/SearchPrice')}}" method="GET">
                  <div class="col-sm-12">
                    <div class="form-group">
                        <label class="sr-only"> <span class="text-red">*</span> Type</label>
                        <select class="form-control" name="type_id" id="type_id">
                          <option value="" {{$type_id==''? 'selected':''}}>Choose Type Of Business </option>
                          <option value="1" {{$type_id==1? 'selected':''}}>Business </option>
                          <option value="2" {{$type_id==2? 'selected':''}}>Residential </option>
                        </select>
                      </div>
                  <div class="form-group">
                    <label class="sr-only">Input Average Consumption kWh</label>
                    <input class="form-control" type="text" id="keyword" name="keyword" value="{{($keyword!='' ? $keyword : '')}}" placeholder="Input Average Consumption kWh" style="min-width: 200px;">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn-warning btn btn-search" name="submit">Search</button>
                      </div>
                  </div>
                  </form>
                </div>
                <br>
                  <div class="row">

                    <div class="col-md-12">
                      <table class="table-bordered table table-striped basic-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Retailer Name</th>
                                    <th>Consumption From Price</th>
                                    <th>Consumption To Price</th>
                                    <th>Unit Price</th>
                                    <th>Duration From</th>
                                    <th>Duration To</th>
                                </tr>
                            </thead>
                            <tbody id="data_search">
                              @foreach($lists as $key => $value)
                                <tr>
                                  <td>{{$id++}}</td>
                                  <td>@if($value->type_id == 1)
                                      {{"Business"}}
                                      @else 
                                      {{"Residentail"}}
                                      @endif
                                  </td>
                                  <td>{{$value->consumtion_start}}</td>
                                  <td>{{$value->consumtion_end}}</td>
                                  <td>{{$value->unit_price}}</td>
                                  <td>{{$value->duration_from}}</td>
                                  <td>{{$value->duration_end}}</td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                          <div class="col-md-12 text-center">
                              {{ $lists->appends(['type_id'=>$type_id, 'keyword'=>$keyword])->links() }}
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
    </div>
  </div>
@endsection
@section('js_bottom')
<script src="{{asset('assets/front/js/dashboard.js')}}"></script>
<script>
    // $('body').on('change','#type_id',function(){
    //   window.location = "?type_id="+$(this).val();
    // });

   // $('body').on('submit','#Search', function(e){
   //    e.preventDefault();
   //    var btn = $(this).find('button');
   //    btn.button('loading');

   //    $.ajax({
   //      method : "POST",
   //      url : url_gb+"/Customer/SearchPrice",
   //      dataType: "json",
   //      data : $(this).serialize()
   //    }).done(function(rec){
   //      $('#data_search').empty();
   //      var newTable = '<tr>';
   //      var i = 0;
   //      $.each(rec.data, function(key, value) {
   //        i++;
   //        newTable +='<td>'+i+'</td>'
   //        newTable += (value.type_id == 1) ? "<td>Business</td>" : "<td>Residentail</td>";
   //        newTable += "<td>"+value.consumtion_start+"</td>";
   //        newTable += "<td>"+value.consumtion_end+"</td>";
   //        newTable += "<td>"+value.unit_price+"</td>";
   //        newTable += "<td>"+value.duration_from+"</td>";
   //        newTable += "<td>"+value.duration_end+"</td></tr>";
   //      });
   //      $("#data_search").append(newTable);
   //    });
   //    btn.button('reset');
   // });   
</script>
@endsection