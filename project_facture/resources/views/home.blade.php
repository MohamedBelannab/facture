@extends('layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
						  <p class="mg-b-0">اوكسيجين لادارة الفواتير</p>
						</div>
					</div>
					@php
						$online = 0
					@endphp
					@foreach ( $user as $row)
					@php
						if( $row->IsOnline() ){
							$online = $online + 1;
						};

					@endphp
						
					@endforeach
					<div class="main-dashboard-header-right">
						<div>
							<label class="tx-13">المتصلين</label>
							<h5>{{ $online  }}</h5>
						</div>
						<div>
							<label class="tx-13">عدد مستخدمين</label>
							<h5>{{ count($user) }}</h5>
						</div>
					</div>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">اجمالي الفواتير</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white"> {{ number_format(App\Models\invoices::sum('Total'),2) }}  </h4>
											<p class="mb-0 tx-12 text-white op-7">عدد الفواتير : {{ App\Models\invoices::count() }}</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7"> 100%</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">الفواتير غير المدفوعة</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\invoices::where('Value_Status' , '2')->sum('Total') }}</h4>
											<p class="mb-0 tx-12 text-white op-7">عدد الفواتير غير المدفوعة : {{ App\Models\invoices::where('Value_Status' ,'2')->count() }}</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7"> 
												@if (App\Models\invoices::count())
												{{ round( App\Models\invoices::where('Value_Status' ,'2')->count() / App\Models\invoices::count() * 100) }}%-	
												@else
													0
												@endif
											</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\invoices::where('Value_Status' ,'1')->sum('Total') }}</h4>
											<p class="mb-0 tx-12 text-white op-7">عدد الفواتير المدفوعة : {{ App\Models\invoices::where('Value_Status' ,'1')->count() }}</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-up text-white"></i>
											<span class="text-white op-7">
												@if (App\Models\invoices::count())
												{{ round( App\Models\invoices::where('Value_Status' ,'1')->count() / App\Models\invoices::count() * 100) }}%-	
												@else
													0
												@endif
											</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة جزئيا</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\invoices::where('Value_Status' ,'3')->sum('Total') }}</h4>
											<p class="mb-0 tx-12 text-white op-7">عدد الفواتير المدفوعة جزئيا :{{ App\Models\invoices::where('Value_Status' ,'3')->count() }}</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-down text-white"></i>
											<span class="text-white op-7">
												 @if (App\Models\invoices::count())
												{{ round( App\Models\invoices::where('Value_Status' ,'3')->count() / App\Models\invoices::count() * 100) }}%-	
												@else
													0
												@endif</span>
											</span>
									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
				</div>
				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-md-12 col-lg-12 col-xl-7">
						<div class="card">
							<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mb-0">نسبة احصائيات الفواتير</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 text-muted mb-0">احصائيات اوكسيجين لادارة الفواتير</p>
							</div>
							<div class="card-body" style="width:79%;" >
								<div>
									{!! $chartjs->render() !!}
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-xl-5">
						<div class="card card-dashboard-map-one">
							<label class="main-content-label">نسبة احصائيات الفواتير</label>
							<span class="d-block mg-b-20 text-muted tx-12">احصائيات اوكسيجين لادارة  الفواتير</span>
							<div class="">
								
									{!! $chartjsBar->render() !!}
								
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->

				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-4 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header pb-1">
								<h3 class="card-title mb-2">اخر المستخدمين</h3>
								
							</div>
							<div class="card-body p-0 customers mt-1">
								<div class="list-group list-lg-group list-group-flush">
									@if (!empty($lastUser))
									@foreach ($lastUser as $user)
									<div class="list-group-item list-group-item-action" href="#">
										<div class="media mt-0">
											<img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset($user->avatar)}}" >
											<div class="media-body">
												
												<div class="d-flex align-items-center">
													<div class="mt-0">
														<h5 class="mb-1 tx-15">{{ $user->name }}</h5>
														<p class="mb-0 tx-13 text-muted">
															@if(!empty($user->getRoleNames()))
															@foreach($user->getRoleNames() as $v)
															<label class="badge badge-success">{{ $v }}</label> 
															@endforeach
															@endif
													
															<span class="  ml-2">{{ $user->status }}</span></p>	
															
														
													</div>	
												</div>
											
											</div>
										</div>
									</div>
									@endforeach	
									@else
									<div class="list-group-item list-group-item-action" href="#">
										<div class="media mt-0">
											
											<div class="media-body">
												
												<div class="d-flex align-items-center">
													<div class="mt-0">
														<h5 class="mb-1 tx-15">لا يوجد مستخدمين</h5>
														
													</div>	
												</div>
											
											</div>
										</div>
									</div>
										
									@endif
									
									
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-12 col-lg-6">
						<div class="card">
							<div class="card-header pb-1">
								<h3 class="card-title mb-2">اخر الفواتير</h3>
								
							</div>
							<div class="product-timeline card-body pt-2 mt-1">
								<ul class="timeline-1 mb-0">
									@if (!empty($lastInvoice))
									@foreach ($lastInvoice as $invoice)
									<li class="mt-0"> <i class="ti-pie-chart bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">{{ $invoice->invoice_number }}</span> <a href="" class="float-left tx-11 text-muted">{{ $invoice->created_at->diffForHumans() }}</a>
										<p class="mb-0 text-muted tx-12">{{ $invoice->Status }}</p>
									</li>	
									@endforeach	
									@else
									<li class="mt-0"> <i class="ti-pie-chart bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">لا توجد فواتير</span> <a href="#" class="float-left tx-11 text-muted">0</a>
										<p class="mb-0 text-muted tx-12"></p>
									</li>
									@endif
									
									
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-12 col-lg-6">
						<div class="card card-dashboard-eight pb-2">
							<h6 class="card-title">حالة الفواتير</h6>
							<div class="list-group">
								<div class="list-group-item border-top-0">
									<i style="font-size: 19px" class="fas fa-cart-arrow-down text-success"></i>
									<p>الفواتير المدفوعة</p><span>${{ App\Models\invoices::where('Value_Status' , '1')->sum('Total') }}</span>
								</div>
								<div class="list-group-item">
									<i style="font-size: 19px" class="fas fa-cart-arrow-down text-danger"></i>
									<p>الفواتير الغير المدفوعة</p><span>${{ App\Models\invoices::where('Value_Status' , '2')->sum('Total') }}</span>
								</div>
								<div class="list-group-item">
									<i style="font-size: 19px" class="fas fa-cart-arrow-down text-warning"></i>
									<p>الفواتير المدفوعة جزئيا</p><span>${{ App\Models\invoices::where('Value_Status' , '3')->sum('Total') }}</span>
								</div>

							</div>
						</div>
					</div>
				</div>
				<!-- row close -->

				<!-- row opened -->
				<div class="row row-sm row-deck">
					
					<div class="col-md-12 col-lg-12 col-xl-12">
						<div class="card card-table-two">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mb-1">Owner Oxygen</h4>
								<i class="mdi mdi-dots-horizontal text-gray"></i>
							</div>
							
							<div class="table-responsive country-table">
								<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
									<thead>
										<tr>
											<th class="wd-lg-25p">الاسم</th>
											<th class="wd-lg-25p tx-right">الايمايل</th>
											<th class="wd-lg-25p tx-right">الصلاحيات</th>
											<th class="wd-lg-25p tx-right">المدة</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($userOwner as $owner)
										<tr>
											<td>{{ $owner->name }}</td>
											<td class="tx-right tx-medium tx-inverse">{{ $owner->email }}</td>
											<td class="tx-right tx-medium tx-inverse">
													@if(!empty($owner->getRoleNames()))
                                                    @foreach($owner->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label> 
                                                    @endforeach
                                                    @endif
											</td>
											<td class="tx-right tx-medium tx-danger">{{ $owner->created_at->diffForHumans() }}</td>
										</tr>	
										@endforeach
										
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>	
@endsection