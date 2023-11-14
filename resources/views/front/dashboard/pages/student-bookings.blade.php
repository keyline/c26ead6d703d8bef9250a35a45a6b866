<?php
use App\Models\User;
use App\Models\MentorProfile;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\StudentProfile;
use App\Models\Booking;
use App\Models\BookingRating;
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
			<div class="container-fluid" id="feedback-section">
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
													<th>Mentor Details</th>
													<th>Service Type<br> Service</th>
													<th>Duration</th>
													<th>Meeting Link</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if($all_bookings){ $sl=1;foreach($all_bookings as $booking){
													$mentor = User::where('id', '=', $booking->mentor_id)->first();
												?>
													<tr>
														<td><?=$sl++?></td>
														<td>
															<?=$booking->booking_no?><br>
															<?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
														</td>
														<td>
															<h6><i class="fa fa-user"></i> <?=(($mentor)?$mentor->name:'')?></h6>
														  	<h6><i class="fa fa-envelope"></i> <?=(($mentor)?$mentor->email:'')?></h6>
														  	<h6><i class="fa fa-mobile"></i> <?=(($mentor)?$mentor->phone:'')?></h6>
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
														<td>
															<!-- <?=number_format($booking->payable_amt,2)?> -->
															<a href="<?=$booking->meeting_link?>" target="_blank" class="btn btn-primary btn-sm">Meeting Link</a>
														</td>
														<td class="text-center">

															<?php if($booking->status <= 1){?>
																<?php
																$currentDate = date('Y-m-d');
																if($currentDate < $booking->booking_date){
																?>
																	<a href="<?=url('user/student-booking-cancel/'.Helper::encoded($booking->id))?>" class="btn btn-danger btn-sm text-light" onclick="return confirm('Do You Want To Cancel This Boooking ?');"><i class="fa fa-times"></i> Cancel Booking</a>
																<?php }?>
																<br>	
															<?php }?>
															<?php if($booking->status == 1){?>
																<h5 class="badge bg-info">Payment Done</h5>
															<?php }?>
															<?php if($booking->status == 2){?>
																<h5 class="badge bg-success">Meeting Done</h5>
															<?php }?>
															<?php if($booking->status == 3){?>
																<h5 class="badge bg-danger">Cancelled</h5>
															<?php }?><br>
															<?php if($booking->payment_status){?>
																<a href="<?=url('user/print-student-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
															<?php } else {?>
																<a href="<?=url('booking-success/'.Helper::encoded($booking->id))?>" class="btn btn-danger btn-sm text-light"><i class="fa fa-inr"></i> Retry Payment</a>
															<?php }?><br>

															<?php if($booking->status >= 2){?>
																<?php if($booking->status != 3){?>
																	<?php
																	$checkReviewSubmit = BookingRating::where('student_id', '=', $user_id)->where('booking_id', '=', $booking->id)->count();
																	if($checkReviewSubmit<=0){
																	?>
																		<button type="button" class="student_feedback btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackModal<?=$booking->id?>"><i class="fa-solid fa-star"></i> Feedback</button>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
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
													<th>Booking Number<br>Booking Date</th>
													<th>Mentor Details</th>
													<th>Service Type<br> Service</th>
													<th>Duration</th>
													<th>Meeting Link</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if($upcoming_bookings){ $sl=1;foreach($upcoming_bookings as $booking){
													$mentor = User::where('id', '=', $booking->mentor_id)->first();
												?>
													<tr>
														<td><?=$sl++?></td>
														<td>
															<?=$booking->booking_no?><br>
															<?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
														</td>
														<td>
															<h6><i class="fa fa-user"></i> <?=(($mentor)?$mentor->name:'')?></h6>
														  	<h6><i class="fa fa-envelope"></i> <?=(($mentor)?$mentor->email:'')?></h6>
														  	<h6><i class="fa fa-mobile"></i> <?=(($mentor)?$mentor->phone:'')?></h6>
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
														<td>
															<!-- <?=number_format($booking->payable_amt,2)?> -->
															<a href="<?=$booking->meeting_link?>" target="_blank" class="btn btn-primary btn-sm">Meeting Link</a>
														</td>
														<td class="text-center">

															<?php if($booking->status <= 1){?>
																<?php
																$currentDate = date('Y-m-d');
																if($currentDate < $booking->booking_date){
																?>
																	<a href="<?=url('user/student-booking-cancel/'.Helper::encoded($booking->id))?>" class="btn btn-danger btn-sm text-light" onclick="return confirm('Do You Want To Cancel This Boooking ?');"><i class="fa fa-times"></i> Cancel Booking</a>
																<?php }?>
																<br>	
															<?php }?>
															<?php if($booking->status == 1){?>
																<h5 class="badge bg-info">Payment Done</h5>
															<?php }?>
															<?php if($booking->status == 2){?>
																<h5 class="badge bg-success">Meeting Done</h5>
															<?php }?>
															<?php if($booking->status == 3){?>
																<h5 class="badge bg-danger">Cancelled</h5>
															<?php }?><br>
															<?php if($booking->payment_status){?>
																<a href="<?=url('user/print-student-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
															<?php } else {?>
																<a href="<?=url('booking-success/'.Helper::encoded($booking->id))?>" class="btn btn-danger btn-sm text-light"><i class="fa fa-inr"></i> Retry Payment</a>
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
													<th>Booking Number<br>Booking Date</th>
													<th>Mentor Details</th>
													<th>Service Type<br> Service</th>
													<th>Duration</th>
													<th>Meeting Link</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if($past_bookings){ $sl=1;foreach($past_bookings as $booking){
													$mentor = User::where('id', '=', $booking->mentor_id)->first();
												?>
													<tr>
														<td><?=$sl++?></td>
														<td>
															<?=$booking->booking_no?><br>
															<?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
														</td>
														<td>
															<h6><i class="fa fa-user"></i> <?=(($mentor)?$mentor->name:'')?></h6>
														  	<h6><i class="fa fa-envelope"></i> <?=(($mentor)?$mentor->email:'')?></h6>
														  	<h6><i class="fa fa-mobile"></i> <?=(($mentor)?$mentor->phone:'')?></h6>
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
														<td>
															<!-- <?=number_format($booking->payable_amt,2)?> -->
															<a href="<?=$booking->meeting_link?>" target="_blank" class="btn btn-primary btn-sm">Meeting Link</a>
														</td>
														<td class="text-center">
															<?php if($booking->status == 1){?>
																<h5 class="badge bg-info">Payment Done</h5>
															<?php }?>
															<?php if($booking->status == 2){?>
																<h5 class="badge bg-success">Meeting Done</h5>
															<?php }?>
															<?php if($booking->status == 3){?>
																<h5 class="badge bg-danger">Cancelled</h5>
															<?php }?><br>
															<?php if($booking->payment_status){?>
																<a href="<?=url('user/print-student-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
															<?php } else {?>
																<a href="<?=url('booking-success/'.Helper::encoded($booking->id))?>" class="btn btn-danger btn-sm text-light"><i class="fa fa-inr"></i> Retry Payment</a>
															<?php }?><br>
															
															<?php if($booking->status >= 2){?>
																<?php if($booking->status != 3){?>
																	<?php
																	$checkReviewSubmit = BookingRating::where('student_id', '=', $user_id)->where('booking_id', '=', $booking->id)->count();
																	if($checkReviewSubmit<=0){
																	?>
																		<button type="button" class="student_feedback btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackModal<?=$booking->id?>"><i class="fa-solid fa-star"></i> Feedback</button>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
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
<?php
if($past_bookings){ $sl=1;foreach($past_bookings as $booking){
	$getBooking             = Booking::where('id', '=', $booking->id)->first();
?>
	<?php if($booking->status >= 2){?>
		<?php if($booking->status != 3){?>
			<div class="modal fade" id="feedbackModal<?=$booking->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
			        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			        <div class="feedback_start">
			            <p>Please give mentor feedabck</p>
			            <form class="" method="POST" action="<?=url('user/student-feedback-list')?>">
				            <div class="feedstar rating">
	                    @csrf
	                    <input type="hidden" name="booking_id" value="<?=$booking->id?>">
	                    <input type="hidden" name="mentor_id" value="<?=$getBooking->mentor_id?>">
	                    <input type="hidden" name="student_id" value="<?=$getBooking->student_id?>">
	                    <input type="hidden" name="mentor_service_id" value="<?=$getBooking->mentor_service_id?>">
	                    <label>
	                        <input type="radio" name="stars" value="1" />
	                        <span class="icon">★</span>
	                    </label>
	                    <label>
	                        <input type="radio" name="stars" value="2" />
	                        <span class="icon">★</span>
	                        <span class="icon">★</span>
	                    </label>
	                    <label>
	                        <input type="radio" name="stars" value="3" />
	                        <span class="icon">★</span>
	                        <span class="icon">★</span>
	                        <span class="icon">★</span>   
	                    </label>
	                    <label>
	                        <input type="radio" name="stars" value="4" />
	                        <span class="icon">★</span>
	                        <span class="icon">★</span>
	                        <span class="icon">★</span>
	                        <span class="icon">★</span>
	                    </label>
	                    <label>
	                        <input type="radio" name="stars" value="5" />
	                        <span class="icon">★</span>
	                        <span class="icon">★</span>
	                        <span class="icon">★</span>
	                        <span class="icon">★</span>
	                        <span class="icon">★</span>
	                    </label>
				            </div>
				            <div class="mb-3 feedbcknote_label">
			                <label for="exampleFormControlTextarea1" class="form-label">Feedback Note:</label>
			                <textarea class="form-control" id="exampleFormControlTextarea1" name="review" rows="3" required></textarea>
			                <button type="submit" class="btn mt-3 m-auto d-table btn-primary">Submit</button>
				            </div>
			            </form>
			        </div>
			      </div>
			    </div>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
<?php } }?>
<style>
	.rating {
	  display: inline-block;
	  position: relative;
	  height: 50px;
	  line-height: 50px;
	  font-size: 50px;
	}

	.rating label {
	  position: absolute;
	  top: 0;
	  left: 0;
	  height: 100%;
	  cursor: pointer;
	}

	.rating label:last-child {
	  position: static;
	}

	.rating label:nth-child(1) {
	  z-index: 5;
	}

	.rating label:nth-child(2) {
	  z-index: 4;
	}

	.rating label:nth-child(3) {
	  z-index: 3;
	}

	.rating label:nth-child(4) {
	  z-index: 2;
	}

	.rating label:nth-child(5) {
	  z-index: 1;
	}

	.rating label input {
	  position: absolute;
	  top: 0;
	  left: 0;
	  opacity: 0;
	}

	.rating label .icon {
	  float: left;
	  color: transparent;
	  width: 3rem !important;
	    height: 1rem !important;
	    font-size: 3rem !important;
	}

	.rating label:last-child .icon {
	  color: #000;
	}

	.rating:not(:hover) label input:checked ~ .icon,
	.rating:hover label:hover input ~ .icon {
	  color: #f9233f;
	}

	.rating label input:focus:not(:checked) ~ .icon:last-child {
	  color: #000;
	  text-shadow: 0 0 5px #09f;
	}
</style>
<script>
	$(':radio').change(function() {
	  console.log('New star rating: ' + this.value);
	});
</script>