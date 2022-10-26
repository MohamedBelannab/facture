
@extends('layouts.master')
@section('css')
@endsection

@section('content')
				<!-- row -->
				<div class="row row-sm py-5">
					<div class="col-lg-4">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="pl-0">
									<div class="main-profile-overview">
										<div class="main-img-user profile-user">
											<img alt="" src="{{URL::asset($user->avatar)}}">
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">{{ $user->name }}</h5>
												<p class="main-profile-name-text">
                                                    @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label> 
                                                    @endforeach
                                                    @endif
                                                </p>
											</div>
										</div>
										<h6>Bio</h6>
										<div class="main-profile-bio">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas, odio!

										</div><!-- main-profile-bio -->
										<div class="row">
											<div class="col-md-4 col mb20">
												<h5>0</h5>
												<h6 class="text-small text-muted mb-0">invoices</h6>
											</div>
											
										</div>
										<hr class="mg-y-30">
										<label class="main-content-label tx-13 mg-b-20">More</label>
										<div class="main-profile-social-list">
											<div class="media">
												<div class="media-icon bg-primary-transparent text-primary">
													<i class="fas fa-clock"></i>
												</div>
												<div class="media-body">
													<span>date</span> <a href="">{{ $user->created_at }}</a>
												</div>
											</div>
											<div class="media">
												<div class="media-icon bg-success-transparent text-success">
													<i class="fas fa-unlock-alt"></i>
												</div>
												<div class="media-body">
													<span>status</span> <a href="">{{ $user->status }}</a>
												</div>
											</div>
											
										</div>
										<hr class="mg-y-30">
										
									</div><!-- main-profile-overview -->
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8">

						<div class="card">
							<div class="card-body">
								<div class="tabs-menu ">
									<!-- Tabs -->
									<ul class="nav nav-tabs profile navtab-custom panel-tabs">
										<li class="active">
											<a href="#home" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">ABOUT ME</span> </a>
										</li>
									
									</ul>
								</div>
								<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
									<div class="tab-pane active" id="home">
										<form role="form">
											<div class="form-group">
												<label for="FullName">Full Name</label>
												<input type="text" value="{{ $user->name }}" readonly id="FullName" class="form-control">
											</div>
											<div class="form-group">
												<label for="Email">Email</label>
												<input type="email" value="{{ $user->email }}" readonly id="Email" class="form-control">
											</div>
											
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection