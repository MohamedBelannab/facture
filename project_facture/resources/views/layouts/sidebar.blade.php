<!-- Sidebar-right-->
		<div class="sidebar sidebar-left sidebar-animate">
			<div class="panel panel-primary card mb-0 box-shadow">
				<div class="tab-menu-heading border-0 p-3">
					<div class="card-title mb-0">الاشعارات</div>
					<div class="card-options mr-auto">
						<a href="#" class="sidebar-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
					<div class="tabs-menu ">
						<!-- Tabs -->
						<ul class="nav panel-tabs">
							<li><a href="#side3" data-toggle="tab"><i class="ion ion-md-contacts tx-18 ml-2"></i> الاعضاء المتصلين</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane  " id="side3">
							<div class="list-group list-group-flush ">
								@php
									$user = App\Models\User::get()
								@endphp
								@foreach ($user as $online)
								@if ($online->IsOnline())
									<div class="list-group-item d-flex  align-items-center">
										<div class="ml-2">
											<span class="avatar avatar-md brround cover-image" data-image-src="{{URL::asset($online->avatar)}}"><span class="avatar-status bg-success"></span></span>
										</div>
										<div class="">
											<div class="font-weight-semibold" data-toggle="modal" data-target="#chatmodel">{{ $online->name }}</div>
										</div>
									
									</div>
								@endif
									
								@endforeach
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!--/Sidebar-right-->
