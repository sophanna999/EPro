@extends('Admin.layouts.layouts')
@section('breadcrumbs')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{url('dashboard')}}">หน้าแรก</a>
        </li>
        <li class="active">{{$title_page}}</li>
    </ul><!-- /.breadcrumb -->
</div>
@endsection
@section('body')
<div class="page-content">
    <!-- #section:settings.box -->
    <div class="ace-settings-container" id="ace-settings-container">
        <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
            <i class="ace-icon fa fa-cog bigger-130"></i>
        </div>

        <div class="ace-settings-box clearfix" id="ace-settings-box">
            <div class="pull-left width-50">
                <!-- #section:settings.skins -->
                <div class="ace-settings-item">
                    <div class="pull-left">
                        <select id="skin-colorpicker" class="hide">
                            <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                            <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                            <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                            <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                        </select>
                    </div>
                    <span>&nbsp; Choose Skin</span>
                </div>

                <!-- /section:settings.skins -->

                <!-- #section:settings.navbar -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
                    <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                </div>

                <!-- /section:settings.navbar -->

                <!-- #section:settings.sidebar -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
                    <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                </div>

                <!-- /section:settings.sidebar -->

                <!-- #section:settings.breadcrumbs -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
                    <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                </div>

                <!-- /section:settings.breadcrumbs -->

                <!-- #section:settings.rtl -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
                    <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                </div>

                <!-- /section:settings.rtl -->

                <!-- #section:settings.container -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
                    <label class="lbl" for="ace-settings-add-container">
                        Inside
                        <b>.container</b>
                    </label>
                </div>

                <!-- /section:settings.container -->
            </div><!-- /.pull-left -->

            <div class="pull-left width-50">
                <!-- #section:basics/sidebar.options -->
                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
                    <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                </div>

                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
                    <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                </div>

                <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
                    <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                </div>

                <!-- /section:basics/sidebar.options -->
            </div><!-- /.pull-left -->
        </div><!-- /.ace-settings-box -->
    </div><!-- /.ace-settings-container -->

    <!-- /section:settings.box -->
    <div class="page-header">
        <h1>
            User Profile Page
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                3 styles with inline editable feature
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-8">
            <!-- PAGE CONTENT BEGINS -->
            <form id="FormAdd">
                <div>
                    <div id="user-profile-1" class="user-profile row">
                        <div class="col-xs-12 col-sm-3 center">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div id="photo" orakuploader="on"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <div class="row">
                                <div class="space-12"></div>
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Username </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="username">
                                                <div class="form-group">
                                                    <input class="form-control" name="username" placeholder="Username" value="{{($admin->username) ? $admin->username : ''}}">
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Firstname </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="firstname">
                                                <div class="form-group">
                                                    <input class="form-control" name="firstname" placeholder="Firstname" value="{{($admin->firstname) ? $admin->firstname : ''}}">
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Lastname </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="lastname">
                                                <div class="form-group">
                                                    <input class="form-control" name="lastname" placeholder="Lastname" value="{{($admin->lastname) ? $admin->lastname : ''}}">
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Nickname </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="nickname">
                                                <div class="form-group">
                                                    <input class="form-control" name="nickname" placeholder="Nickname" value="{{($admin->nickname) ? $admin->nickname : ''}}">
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Address <!-- <i class="fa fa-map-marker light-orange bigger-110"></i> --></div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="address">
                                                <div class="form-group">
                                                    <textarea name="address" class="form-control full-width" placeholder="Address" rows="3">{{$admin->address}}</textarea>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Mobile </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="mobile">
                                                <div class="form-group">
                                                    <input class="form-control" name="mobile" placeholder="Molbile" value="{{($admin->mobile) ? $admin->mobile : ''}}">
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <input class="btn-primary btn" type="submit" value="Update Profile">
                            </div>
                            <div class="space-6"></div>
                        </div>
                    </div>
                </div>
            </form>
        <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->
@endsection
@section('js_bottom')
<script>
    $('#FormAdd').validate({
        errorElement: 'span',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            firstname: {
                required: true,
            },
            lastname: {
                required: true,
            },
            username: {
                required: true,
            },
        },
        messages: {
            firstname: {
                required: 'Please Enter Firstname',
            },
            lastname: {
                required: 'Please Enter Lastname',
            },
            username: {
                required: 'Please Enter Username',
            },
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
                url : url_gb+"/admin/update",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    swal(rec.title,rec.content,"success");
                }else{
                    swal(rec.title,rec.content,"error");
                }
                btn.button("reset");
            }).error(function(){
                swal("system.system_alert","system.system_error","error");
                btn.button("reset");
            });
        },
        invalidHandler: function (form) {

        }
    });

    $(function() {
        $('#photo').orakuploader({
            orakuploader_path         : url_gb+'/',
            orakuploader_ckeditor         : true,
            orakuploader_use_dragndrop            : true,
            orakuploader_use_sortable   : true,
            orakuploader_main_path : 'uploads/admin/',
            orakuploader_thumbnail_path : 'uploads/admin/',
            orakuploader_thumbnail_real_path : asset_gb+'uploads/admin/',
            orakuploader_loader_image       : asset_gb+'images/loader.gif',
            orakuploader_no_image       : asset_gb+'images/no-image.jpg',
            orakuploader_add_label       : 'Choose Image',
            orakuploader_use_rotation: true,
            orakuploader_maximum_uploads : 1,
            orakuploader_hide_on_exceed : true,
            
            @if( $admin->photo )
                orakuploader_attach_images: ['{{$admin->photo}}'],
                orakuploader_maximum_uploads : 0,
            @else
                orakuploader_maximum_uploads : 1
            @endif
        });
    });
</script>
@endsection