			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					@foreach($menus as $menu)
                    	@if(sizeof($menu->SubMenu)>0)
							<li class="{{($menu->link==$main_menu)? 'active':''}}">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-desktop"></i>
									<span class="menu-text">
										{{$menu->name}}
									</span>

									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									@foreach($menu->SubMenu as $sub)
									<li class="{{($sub->link==$sub_menu)? 'active':''}}">
										<a href="{{url('admin/'.$sub->link)}}">
											<i class="menu-icon fa fa-caret-right"></i>
											{{$sub->name}}
										</a>

										<b class="arrow"></b>
									</li>
									@endforeach
								</ul>
							</li>
						@else
						<li class="{{($menu->link==$main_menu)? 'active':''}}">
							<a href="{{url('admin/'.$menu->link)}}">
								<i class="menu-icon {{$menu->icon}}"></i>
								<span class="menu-text"> {{$menu->name}} </span>
							</a>
							<b class="arrow"></b>
						</li>
						@endif
                    @endforeach
				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
			</div>
