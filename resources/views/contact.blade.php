@extends('template.app')
@section('css_bottom')

@endsection
@section('body')
<div class="container-fluid course-wrapper bg1 nomargin">
    
</style>
    <div class="row mt-sm">
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="content-box-fullwidth">
                        <div class="col-lg-4">
                            <div class="content-head">
                                <h4>Electricity</h4>
                            </div>
                            <p> <img src="{{asset('uploads')}}/{{$contact->image}}"></p>
                            <p>
                                {{$contact->address}}<br> Phone. {{$contact->phone}} <br> FAX {{$contact->fax}} <br> Email Address : {{$contact->email}}
                            </p>
                            <p>
                                <button class="btn btn-default" data-toggle="modal" data-target="#imageMap"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;Look Map</button>
                                <button class="btn btn-default" data-toggle="modal" data-target="#googleMap" onclick="myMap()" ><i class="glyphicon glyphicon-globe"></i>&nbsp;Look Google Map</button>
                            </p>
                        </div>
                        <div class="col-lg-8">
                            <div class="content-head">
                                <h4>Ask the questions / Suggestions</h4>
                            </div>
                            <div class="col-xs-12 form-horizontal mt-sm">
                                <form id="FormAdd">
                                    <div class="form-group">
                                        <label class="control-label col-xs-3 text-right">Firstname-Lastname:</label>
                                        <div class="col-xs-12 col-sm-6">
                                            <input class="form-control" type="text" name="name" id="name" placeholder="Enter your firstname and lastname">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3 text-right">Email:</label>
                                        <div class="col-xs-12 col-sm-6">
                                            <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3 text-right">Phone: </label>
                                        <div class="col-xs-12 col-sm-6">
                                            <input class="form-control" type="text" name="phone" id="phone" placeholder="Enter your phone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-3 text-right">Detail: </label>
                                        <div class="col-xs-12 col-sm-6">
                                            <textarea class="form-control" cols="30" rows="5" name="detail" id="detail"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                                            <button class="btn-primary btn" type="submit"> Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="set-footer "></div>
    </div>
</div>
<!-- Google map box Modal -->
<div class="modal fade" id="googleMap" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">Google Map</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <p>3/2 ซ.ลาดพร้าว 69 ถ.ลาดพร้าว แขวงสะพานสอง เขตวังทองหลาง กรุงเทพฯ 10310 <br> โทร. 02-276-5260, มือถือ 08-9665-3599 โทรสาร 02-933-0969 <br> Email Address : email@email.com <br> เวลาทำการ 9.00 - 17.00 น. หยุดทุกวันอังคาร</p>
                        <div id="googleMapBox"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="imageMap" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">แผนที่</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 img-fill-width">
                        <p>3/2 ซ.ลาดพร้าว 69 ถ.ลาดพร้าว แขวงสะพานสอง เขตวังทองหลาง กรุงเทพฯ 10310 <br> โทร. 02-276-5260, มือถือ 08-9665-3599 โทรสาร 02-933-0969 <br> Email Address : email@email.com <br> เวลาทำการ 9.00 - 17.00 น. หยุดทุกวันอังคาร</p>
                        <p class="text-center"><img src="http://placehold.it/500x500" alt=""></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_bottom')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCU_lbxk8OcaNV24QpnjHzMQB3QwPnn_o&callback=myMap"></script>
<script>
    function myMap() {
        setTimeout(function(){
            var latitude = parseFloat(document.getElementById("latitude").value);
            var longitude = parseFloat(document.getElementById("longitude").value);
            var myCenter = new google.maps.LatLng(latitude,longitude);
            var mapCanvas = document.getElementById("googleMapBox");
            var mapOptions = {center: myCenter, zoom: 20};
            var map = new google.maps.Map(mapCanvas, mapOptions);
            var marker = new google.maps.Marker({position:myCenter});
            marker.setMap(map);
        },1000);
    }
    $('#FormAdd').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
            },
            phone: {
                required: true,
            },
            detail: {
                required: true,
            }
        },
        messages: {
            name: {
                required: 'Enter your name please',
            },
            email: {
                required: 'Enter your email please',
            },
            phone: {
                required: 'Enter your phone please',
            },
            detail: {
                required: 'Enter your detail please',
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
            var btn = $(form).find('[type="submit"]');

            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/contact",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
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