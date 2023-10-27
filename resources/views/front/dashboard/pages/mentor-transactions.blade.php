<?php
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Withdrawl;
use App\Helpers\Helper;
?>
<div class="account_wrapper">
	<?=$sidebar;?>
	<div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
		<header class="header header-sticky mentor_transtion_top mb-4">
			<div class="container-fluid">
				<div class="row w-100">
					<div class="col-md-6">
						<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"><i class="fa-solid fa-bars"></i></button>
						<h4 class="pagestitle-item mb-0"><?=$page_header?></h4>
						<ul class="header-nav ms-auto"></ul>
					</div>
					<div class="col-md-6">
						<h4 class="pagestitle-item mentor_amout_balance mb-0 badge bg-primary">Balance : <?=$mentor_balance?></h4>
					</div>
				</div>
				
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
					<div class="col-sm-12 col-lg-12 mb-5">
						<form name="withdrawlForm" method="POST" action="<?=url('user/mentor-transactions')?>">
							@csrf
		                    <input type="hidden" name="mentor_id" class="requiredCheck" value="<?=$user_id?>">
							<button type="submit" class="btn btn-success" id="withdrawl-form-submit"><i class="fa fa-inr"></i> Withdrawl</button>
							<div class="table-responsive">
							  	<table id="example" class="table table-striped table-hover" style="width:100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Type</th>
											<th>Booking No<br>Date</th>
											<th>Student Details</th>
											<th>Opening Balance</th>
											<th>Transaction Amount</th>
											<th>Closing Balance</th>
											<th>Withdrawl<br>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if($transactions) { $sl=1; foreach($transactions as $row){
											$booking = Booking::where('id', '=', $row->booking_id)->first();
											if($booking){
												$student = User::where('id', '=', $booking->student_id)->first();
											} else {
												$student = [];
											}
										?>
											<tr>
												<td>
													<div class="form-check">
														<?php if($booking->status >= 2){?>
															<?php if($booking->status != 3){?>
																<?php
																$checkWithdrawl = Withdrawl::where('mentor_id', '=', $user_id)->where('request_booking_ids', 'LIKE', '%'.$row->booking_id.'%')->count();
																if($checkWithdrawl<=0){
																?>
																	<input class="form-check-input" type="checkbox" name="booking_ids[]" value="<?=$row->booking_id?>">
																<?php } ?>
															<?php } ?>
														<?php } ?>
														<?=$sl++?>
													</div>
													
												</td>
												<td>
													<?php if($row->type == 'CREDIT'){?>
														<span class="badge bg-success">CREDIT</span>
													<?php } else {?>
														<span class="badge bg-danger">DEBIT</span>
													<?php }?>
												</td>
												<td><?=(($booking)?$booking->booking_no:'-')?><br><?=(($row->created_at != '')?date_format(date_create($row->created_at), "M d, Y h:i A"):'')?></td>
												<td>
												  	<h6><i class="fa fa-user"></i> <?=(($student)?$student->name:'')?></h6>
												  	<h6><i class="fa fa-envelope"></i> <?=(($student)?$student->email:'')?></h6>
												  	<h6><i class="fa fa-mobile"></i> <?=(($student)?$student->phone:'')?></h6>
												</td>
												<td><?=number_format($row->opening_amt,2)?></td>
												<td><?=number_format($row->transaction_amt,2)?></td>
												<td><?=number_format($row->closing_amt,2)?></td>
												<td>
													<?php if($row->type == 'CREDIT'){?>
								                      <?php if($row->status == 1){?>
								                        <span class="badge bg-warning">Request Done</span>
								                      <?php } elseif($row->status == 2){?>
								                        <span class="badge bg-danger">Withdrwal Done</span>
								                      <?php } elseif($row->status == 0){?>
								                        <span class="badge bg-danger">Not Requested</span>
								                      <?php }?>
								                      <br>

								                      <?php if($booking->status == 1){?>
								                        <h5 class="badge bg-info">Student Paid</h5>
								                      <?php }?>
								                      <?php if($booking->status == 2){?>
								                        <h5 class="badge bg-info">Meeting Done</h5>
								                      <?php }?>
								                      <?php if($booking->status == 3){?>
								                        <h5 class="badge bg-info">Cancelled</h5>
								                      <?php }?>
								                      <?php if($booking->status == 4){?>
								                        <h5 class="badge bg-info">Withdrawl Requested</h5>
								                      <?php }?>
								                      <?php if($booking->status == 5){?>
								                        <h5 class="badge bg-info">Withdrawl Done</h5>
								                      <?php }?>
								                    <?php }?>
												</td>
											</tr>
										<?php } }?>
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('#withdrawl-form-submit').on('submit', function(){
			alert($('#withdrawlForm input:checked').length);
			if($('#withdrawlForm input:checked').length > 0){
				alert('Please Select Atleast One Booking For Withdrawl !!!');
			}
		});
	})
</script>
<style>
button#withdrawl-form-submit {
    clear: both;
    margin: 0px 0 30px;
    color: #fff;
}
</style>