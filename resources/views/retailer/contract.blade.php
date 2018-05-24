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
                      <h4>
                        <i class="fa fa-pencil"></i> 
                        Terms and Conditions Document
                        <div class="pull-right">
                          <a class="btn btn-success" href="{{url('Retailer/NewContract')}}">+ Create Terms and Conditions</a>
                        </div>
                      </h4>
                  </div>
                  <div class="container-fluid">
                      <div class="row mt-xs">
                          <div class="col-md-12 form-horizontal table-responsive">
                            <table class="table-bordered table table-striped basic-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th class="text-center">Name of Document</th>
                                        <th class="text-center">Create date</th>
                                        <th class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($lists as $key => $value)
                                    <tr>
                                        <td> <span class="text-blue">{{$id++}}</span></td>
                                        <td class="text-center"><a href="{{asset('uploads/contracts/'.$value->file_name) }}" target="_blank">{{$value->contract_name}}</a></td>
                                        <td class="text-center">{{date('d-m-Y'),strtotime($value->created_at)}}</td>
                                        <td class="text-center"> 
                                            <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="{{$value->id}}" data-rel="tooltip" title="Delete">
                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                        </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 text-center">
                            {{ $lists->links() }}
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
<script src="{{asset('assets/front/js/retailer_dashboard.js')}}"></script>
<script>
  $("body").on("click",".btn-delete",function(){
        var id = $(this).data("id");
        swal({
            title: "Are you sure to delete this data?",
            text: "Yes, I am sure!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes I should be delete",
            cancelButtonText: "Cancel",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(data) {
            if(data){
                $.ajax({
                    method : "POST",
                    url : url_gb+"/Retailer/Contract/Delete/"+id,
                    data : {ID : id}
                }).done(function(data){
                    if(data){
                        var rec = $.parseJSON(data);
                        if(rec.status==1){
                            // swal(rec.title,rec.content,"success");
                          swal({
                            position: 'center',
                            type: 'success',
                            title: rec.title,
                            showConfirmButton: true
                          },function(){
                            window.location = 'Contract';
                          });
                        }else{
                            swal(rec.title,rec.content,"error");
                        }
                    }else{
                        swal("System have problem","Contact to admin please","error");
                    }
                }).error(function(data){
                    swal("System have problem","Contact to admin please","error");
                });
            }
        });
    });
  
</script>
@endsection