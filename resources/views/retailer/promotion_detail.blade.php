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
                    <h4><i class="fa fa-eye"></i> View Promotion Detail</h4>
                </div>
                @if($promotion_data->status == 'A')
                <div class="container-fluid">
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-sm-3 text-form-mobile">Promotion Name: </div>
                        <div class="col-sm-8">{{$promotion_data->name}}</div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-sm-3 text-form-mobile">Promotion Title:</div>
                        <div class="col-sm-8">{{$promotion_data->title}}</div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-sm-3 text-form-mobile">Promotion Detail:</div>
                        <div class="col-sm-8">{{$promotion_data->detail}}</div>
                    </div>
                </div>
                @else
                <form id="EditPromotion">
                <div class="container-fluid">
                    <input type="hidden" class="form-control promotion_id" name="id" value="{{$promotion_data->id}}">
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-sm-3 text-form-mobile">Promotion Name: </div>
                        <div class="col-sm-4"><input type="text" class="form-control" name="name" value="{{$promotion_data->name}}"></div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-sm-3 text-form-mobile">Promotion Title:</div>
                        <div class="col-sm-4"><input type="text" class="form-control" name="title" value="{{$promotion_data->title}}"></div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-offset-1 col-sm-3 text-form-mobile">Promotion Detail:</div>
                        <div class="col-sm-4"><input type="text" class="form-control" name="detail" value="{{$promotion_data->detail}}"></div>
                    </div>
                    <div class="row mt-xs">
                        <div class="col-md-12 col-md-offset-4">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </div>
                </div>
                </form>
                @endif
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
$('#EditPromotion').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            name: {
                required: true,
            },
            title: {
                required: true,
            },
            detail: {
                required: true,
            }
        },
        messages: {
            name: {
                required: 'Please enter promotion name ',
            },
            title: {
                required: 'Please enter promotion title',
            },
            detail: {
                required: 'Please enter promotion detail',
            }
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
            var btn = $(form).find('button');
            var id  = $('.promotion_id').val();
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/Retailer/EditPromotion/"+id,
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    resetFormCustom(form);
                    swal({
                      position          : "center",
                      type              : "success",
                      title             : rec.title,
                      showConfirmButton : true
                    }, function(){
                      window.location = url_gb+"/Retailer/Promotion";
                    });
                    // swal(rec.title,rec.content,"success");
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