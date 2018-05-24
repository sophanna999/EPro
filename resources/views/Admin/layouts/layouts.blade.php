<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>{{$title_page or 'Home Page'}} | Electricity Flateform Sysytem</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/admin/css/font-awesome.css')}}" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="{{asset('assets/admin/css/ace-fonts.css')}}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{asset('assets/admin/css/ace.css')}}" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="{{asset('assets/admin/css/custom.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/global/plugins/orakuploader/orakuploader.css')}}" />
		<link type="text/css" rel="stylesheet" href="{{asset('assets/global/css/modal.css')}}"/>
		<!-- <link rel="stylesheet" href="{{asset('assets/admin/css/checkbox.css')}}" /> -->
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{asset('assets/admin/css/ace-part2.css')}}" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{{asset('assets/admin/css/ace-ie.css')}}" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{{asset('assets/admin/js/ace-extra.js')}}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="{{asset('assets/admin/js/html5shiv.js')}}"></script>
		<script src="{{asset('assets/admin/js/respond.js')}}"></script>
		<![endif]-->
		@yield('css_bottom')
	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Ace Admin
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="grey">
							<a class="dropdown-toggle" href="{{url('')}}">
								<i class="ace-icon fa fa-globe"></i>
							</a>
						</li>
						<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-tasks"></i>
								<span class="badge badge-grey">4</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									4 Tasks to complete
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Software Update</span>
													<span class="pull-right">65%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:65%" class="progress-bar"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Hardware Upgrade</span>
													<span class="pull-right">35%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:35%" class="progress-bar progress-bar-danger"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Unit Testing</span>
													<span class="pull-right">15%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:15%" class="progress-bar progress-bar-warning"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Bug Fixes</span>
													<span class="pull-right">90%</span>
												</div>

												<div class="progress progress-mini progress-striped active">
													<div style="width:90%" class="progress-bar progress-bar-success"></div>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See tasks with details
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">8</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									8 Notifications
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
														New Comments
													</span>
													<span class="pull-right badge badge-info">+12</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<i class="btn btn-xs btn-primary fa fa-user"></i>
												Bob just signed up as an editor ...
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
														New Orders
													</span>
													<span class="pull-right badge badge-success">+8</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
														Followers
													</span>
													<span class="pull-right badge badge-info">+11</span>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="green">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success">5</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									5 Messages
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#" class="clearfix">
												<img src="{{asset('assets/admin/avatars/avatar.png')}}" class="msg-photo" alt="Alex's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Alex:</span>
														Ciao sociis natoque penatibus et auctor ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>a moment ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="{{asset('assets/admin/avatars/avatar3.png')}}" class="msg-photo" alt="Susan's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Susan:</span>
														Vestibulum id ligula porta felis euismod ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>20 minutes ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="{{asset('assets/admin/avatars/avatar4.png')}}" class="msg-photo" alt="Bob's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Bob:</span>
														Nullam quis risus eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>3:15 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="{{asset('assets/admin/avatars/avatar2.png')}}" class="msg-photo" alt="Kate's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Kate:</span>
														Ciao sociis natoque eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>1:33 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="{{asset('assets/admin/avatars/avatar5.png')}}" class="msg-photo" alt="Fred's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Fred:</span>
														Vestibulum id penatibus et auctor  ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>10:09 am</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="inbox.html">
										See all messages
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								@if($admin->photo)
      							@if(file_exists('uploads/admin/'.$admin->photo))
								<img class="img-circle" src="{{asset('uploads/admin/'.$admin->photo)}}" width="50px" height="50px" />
								@else
								<img class="img-circle" src="{{asset('images/avatar_user.png')}}" width="50px" height="50px"/>
								@endif
							    @else
							      <img class="img-circle" src="{{asset('images/avatar_user.png')}}" width="50px" height="50px"/>
							    @endif
								<span class="user-info">
									<small>Hello,</small>
									{{Auth::guard('admin')->user()->nickname}}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<!-- <li>
									<a href="{{url('admin/change_password')}}">
										<i class="ace-icon fa fa-key"></i>
										Settings
									</a>
								</li> -->

								<li>
									<a href="{{url('admin/profile')}}">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="{{url('admin/logout')}}">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>

		<!-- /section:basics/navbar.layout -->
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
			@include('Admin.layouts.sidebar_menu',['main_menu'=>$main_menu,'sub_menu'=>$sub_menu])
			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					@yield('breadcrumbs')
					@yield('body')
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Ace</span>
							Application &copy; 2013-2014
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{{asset('assets/admin/js/jquery.js')}}"></script>
		<script src="{{asset('assets/global/plugins/orakuploader/jquery-ui.min.js')}}"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="{{asset('assets/admin/js/jquery1x.js')}}"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='{{asset('assets/admin/js/jquery.mobile.custom.js')}}'>"+"<"+"/script>");
		</script>
		<script src="{{asset('assets/admin/js/bootstrap.js')}}"></script>
		<script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.js')}}"></script>
		<!-- page specific plugin scripts -->
		<script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url_gb = '{{url('')}}';
            var asset_gb = '{{asset('')}}';
            function makeid(){
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

                for( var i=0; i < 5; i++ )
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                return text;
            }
             function addNumformat(nStr){
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
        </script>
		<!-- ace scripts -->
		<script src="{{asset('assets/admin/js/ace/elements.scroller.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/elements.colorpicker.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/elements.fileinput.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/elements.typeahead.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/elements.wysiwyg.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/elements.spinner.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/elements.treeview.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/elements.wizard.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/elements.aside.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.ajax-content.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.touch-drag.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.sidebar.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.sidebar-scroll-1.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.submenu-hover.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.widget-box.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.settings.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.settings-rtl.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.settings-skin.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.widget-on-reload.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.searchbox-autocomplete.js')}}"></script>
		

		<!-- inline scripts related to this page -->


		<script type="text/javascript"> ace.vars['base'] = '..'; </script>
		<script src="{{asset('assets/admin/js/ace/elements.onpage-help.js')}}"></script>
		<script src="{{asset('assets/admin/js/ace/ace.onpage-help.js')}}"></script>
		<script src="{{asset('assets/admin/js/dataTables/jquery.dataTables.js')}}"></script>
		<script src="{{asset('assets/admin/js/dataTables/jquery.dataTables.bootstrap.js')}}"></script>
		<script src="{{asset('assets/global/js/modal.js')}}"></script>
		<script src="{{asset('assets/global/js/validate.js')}}"></script>
		<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
		<script src="{{asset('assets/global/plugins/orakuploader/orakuploader.js')}}"></script>
		@yield('js_bottom')
	</body>
</html>