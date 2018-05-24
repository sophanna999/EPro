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
                  <h4><i class="fa fa-user"></i> Contract </h4>
                </div>
                <div class="container-fluid">
                  <form action="" method="post" id="ContractForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-xs-12 form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-xs-4 text-right">Contract Name: </label>
                            <div class="col-xs-12 col-sm-5">
                              <input class="form-control" type="text" name="contract_name" id="contract_name">
                            </div>
                          </div>
                        <div class="form-group">
                          <label class="control-label col-xs-4 text-right">Upload Contract file: </label>
                            <div class="col-xs-12 col-sm-5">
                              <input class="form-control" type="file" name="contract_file" id="contract_file">
                            </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-offset-4 col-md-8 text-left">
                            <input class="btn-primary btn" type="submit" value="Submit">
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
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
  $('body').on('submit','#ContractForm', function(e){
    e.preventDefault();

    var btn = $(this).find('[type="submit"]');
    btn.button('loading');
    var form = $(this)[0]; // You need to use standard javascript object here
    var formData = new FormData(form);
    $.ajax({
      url: url_gb+"/Retailer/Upload",
      data: formData,
      type: 'POST',
      contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
      processData: false, // NEEDED, DON'T OMIT THIS
      success : function(rec){
        console.log(rec);
        var data = JSON.parse(rec);
        if (data.status == 1) {
          swal({
            position: 'center',
            type: 'success',
            title: data.title,
            showConfirmButton: true
          })
        }else{
          swal({
            position: 'center',
            type: 'error',
            title: data.title_error,
            showConfirmButton: true
          });
        }
        // btn.button('reset');
      }
  });

</script>
@endsection