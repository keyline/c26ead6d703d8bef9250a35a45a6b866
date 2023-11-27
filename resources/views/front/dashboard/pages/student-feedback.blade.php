<?php
use App\Http\Controllers\Controller;
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
				<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"><i class="fa-solid fa-bars"></i></button>
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
		<div class="body flex-grow-1 px-3">
			<div class="container-fluid-lg">
				<div class="row">
					<div class="col-sm-12 col-lg-12">
						<div class="table-responsive">
							<table id="example3" class="stripe table cell-border hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Booking Number</th>
										<th>Mentor</th>
										<th>Service</th>
										<th>Rating</th>
										<th>Review</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($feedbacks){ $sl=1; foreach($feedbacks as $feedback){
										$booking = Booking::where('id', '=', $feedback->booking_id)->first();
										$mentor = User::where('id', '=', $booking->mentor_id)->first();
									?>
										<tr>
											<td><?=$sl++?></td>
											<td><?=(($booking)?$booking->booking_no:'')?></td>
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
											<td>
												<div class="m-left d-table">
													<?php for($i=1;$i<=$feedback->rating;$i++){?>
														<span class="fa fa-star checked"></span>
													<?php } ?>
													<?php for($i=1;$i<=(5 - $feedback->rating);$i++){?>
														<span class="fa fa-star"></span>
													<?php } ?>
												</div>
											</td>
											<td><?=$feedback->review?></td>
											<td>
												<?php if($feedback->status == 1){?>
													<span class="badge bg-success">Approved</span>
												<?php } elseif($feedback->status == 0) {?>
													<span class="badge bg-warning">Pending</span>
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
<style>
.checked {
  color: orange;
}
</style>