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
                  	<th>Request Date</th>
										<th>Booking Number</th>
										<th>Requested Amount</th>
										<th>Approve/Reject Date</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($withdrawls){ $sl=1; foreach($withdrawls as $row){
										$request_booking_ids = json_decode($row->request_booking_ids);
									?>
										<tr>
											<td><?=$sl++?></td>
                      <td><?=date_format(date_create($row->created_at), "M d, Y h:i A")?></td>
											<td>
												<?php
												$booking_no = [];
												if(!empty($request_booking_ids)){
													for($w=0;$w<count($request_booking_ids);$w++){
														$booking = Booking::where('id', '=', $request_booking_ids[$w])->first();
														if($booking){
															$booking_no[] = $booking->booking_no;
														}
													}
												}
												echo implode(", ", $booking_no);
												?>
											</td>
											<td><?=number_format($row->request_amount,2)?></td>
                      <td>
                        <?php if($row->status == 1){?>
                          <h6><?=date_format(date_create($row->accept_reject_date), "M d, Y h:i A")?></h6>
                          <h6><?=$row->txn_no?></h6>
                        <?php } elseif($row->status == 3){?>
                          <?=date_format(date_create($row->accept_reject_date), "M d, Y h:i A")?>
                        <?php }?>
                      </td>
											<td>
												<?php if($row->status == 0){?>
													<span class="badge bg-warning">Request Done</span>
												<?php } elseif($row->status == 1){?>
													<span class="badge bg-success">Withdrwal Done</span>
												<?php } elseif($row->status == 3){?>
													<span class="badge bg-danger">Request Rejected</span>
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