<?php
use App\Models\User;
use App\Models\MentorProfile;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\StudentProfile;
use App\Helpers\Helper;
?>
<div class="account_wrapper">
	<?=$sidebar;?>
	<div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
		<header class="header header-sticky mb-4">
			<div class="container-fluid">
				<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
					<i class="fa-solid fa-bars"></i>
				</button>
				<h4 class="pagestitle-item mb-0"><?=$page_header?></h4>
				<ul class="header-nav ms-auto"></ul>
			</div>
		</header>
		<div class="col-xl-12">
		@if(session('success_message'))
			<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide" role="alert">
			{{ session('success_message') }}
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		@if(session('error_message'))
			<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
			{{ session('error_message') }}
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
		</div>
		<div class="body flex-grow-1 px-3 py-3">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 px-0">
							<nav class="mb-4">
							  	<div class="nav nav-tabs" id="nav-tab" role="tablist">
									<button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All (<?=count($all_bookings)?>)</button>
									<button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Upcoming (<?=count($upcoming_bookings)?>)</button>
									<button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Completed (<?=count($past_bookings)?>)</button>
							  	</div>
							</nav>
							<div class="tab-content" id="nav-tabContent">
							  	<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
									<div class="table-responsive">
									  	<table id="example" class="stripe table cell-border hover" style="width:100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Booking Number<br>Booking Date</th>
													<th>Student Details</th>
													<th>Service Type<br> Service</th>
													<th>Duration</th>
													<th>Student Paid Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if($all_bookings){ $sl=1;foreach($all_bookings as $booking){
													$student = User::where('id', '=', $booking->student_id)->first();
												?>
													<tr>
														<td><?=$sl++?></td>
														<td><?=$booking->booking_no?><br><?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?></td>
														<td>
															<h6><i class="fa fa-user"></i> <?=(($student)?$student->name:'')?></h6>
														  	<h6><i class="fa fa-envelope"></i> <?=(($student)?$student->email:'')?></h6>
														  	<h6><i class="fa fa-mobile"></i> <?=(($student)?$student->phone:'')?></h6>
														  </td>
														<td>
															<?php
							                             	$service_type = ServiceType::select('name')->where('id', '=', $booking->service_type_id)->first();
							                             	echo (($service_type)?$service_type->name:'');
							                             	?>
															<br>
															<?php
							                             	$service = Service::select('name')->where('id', '=', $booking->service_id)->first();
							                             	echo (($service)?$service->name:'');
							                             	?>
														</td>
														<td><?=$booking->duration?> mins</td>
														<td><?=number_format($booking->payable_amt,2)?></td>
														<td>
															<?php if($booking->payment_status){?>
																<a href="<?=url('user/print-mentor-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
															<?php }?>
														</td>
													</tr>
												<?php } }?>
											</tbody>
										</table>
									</div>
								</div>
							  	<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
									<div class="table-responsive">
									  	<table id="example2" class="stripe table cell-border hover" style="width:100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Booking Number</th>
													<th>Booking Date</th>
													<th>Student Details</th>
													<th>Service Type<br> Service</th>
													<th>Duration</th>
													<th>Student Paid Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if($upcoming_bookings){ $sl=1;foreach($upcoming_bookings as $booking){
													$student = User::where('id', '=', $booking->student_id)->first();
												?>
													<tr>
														<td><?=$sl++?></td>
														<td><?=$booking->booking_no?></td>
														<td>
															<?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
														</td>
														<td>
															<h6><i class="fa fa-user"></i> <?=(($student)?$student->name:'')?></h6>
														  	<h6><i class="fa fa-envelope"></i> <?=(($student)?$student->email:'')?></h6>
														  	<h6><i class="fa fa-mobile"></i> <?=(($student)?$student->phone:'')?></h6>
														  </td>
														<td>
															<?php
							                             	$service_type = ServiceType::select('name')->where('id', '=', $booking->service_type_id)->first();
							                             	echo (($service_type)?$service_type->name:'');
							                             	?>
															<br>
															<?php
							                             	$service = Service::select('name')->where('id', '=', $booking->service_id)->first();
							                             	echo (($service)?$service->name:'');
							                             	?>
														</td>
														<td><?=$booking->duration?> mins</td>
														<td><?=number_format($booking->payable_amt,2)?></td>
														<td>
															<?php if($booking->payment_status){?>
																<a href="<?=url('user/print-mentor-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
															<?php }?>
														</td>
													</tr>
												<?php } }?>
											</tbody>
										</table>
									</div>
								</div>	
							  	<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
									<div class="table-responsive">
									  	<table id="example3" class="stripe table cell-border hover" style="width:100%">
											<thead>
												<tr>
													<th>#</th>
													<th>Booking Number</th>
													<th>Booking Date</th>
													<th>Student Details</th>
													<th>Service Type<br> Service</th>
													<th>Duration</th>
													<th>Student Paid Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if($past_bookings){ $sl=1;foreach($past_bookings as $booking){
													$student = User::where('id', '=', $booking->student_id)->first();
												?>
													<tr>
														<td><?=$sl++?></td>
														<td><?=$booking->booking_no?></td>
														<td>
															<?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
														</td>
														<td>
															<h6><i class="fa fa-user"></i> <?=(($student)?$student->name:'')?></h6>
														  	<h6><i class="fa fa-envelope"></i> <?=(($student)?$student->email:'')?></h6>
														  	<h6><i class="fa fa-mobile"></i> <?=(($student)?$student->phone:'')?></h6>
														  </td>
														<td>
															<?php
							                             	$service_type = ServiceType::select('name')->where('id', '=', $booking->service_type_id)->first();
							                             	echo (($service_type)?$service_type->name:'');
							                             	?>
															<br>
															<?php
							                             	$service = Service::select('name')->where('id', '=', $booking->service_id)->first();
							                             	echo (($service)?$service->name:'');
							                             	?>
														</td>
														<td><?=$booking->duration?> mins</td>
														<td><?=number_format($booking->payable_amt,2)?></td>
														<td>
															<?php if($booking->payment_status){?>
																<a href="<?=url('user/print-mentor-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
															<?php }?>
														</td>
													</tr>
												<?php } }?>
											</tbody>
										</table>
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