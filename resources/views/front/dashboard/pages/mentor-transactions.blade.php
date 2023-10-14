<?php
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
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
			<h4 class="pagestitle-item mb-0 badge bg-primary">Balance : <?=$mentor_balance?></h4>
		</header>
		<div class="body flex-grow-1 px-3">
			<div class="container-fluid-lg">
				<div class="row">
					<div class="col-sm-12 col-lg-12">
						<div class="table-responsive">
						  	<table id="example" class="table table-striped table-hover" style="width:100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Type</th>
										<th>Date</th>
										<th>Booking No</th>
										<th>Student Details</th>
										<th>Opening Balance</th>
										<th>Transaction Amount</th>
										<th>Closing Balance</th>
										<th>Withdrawl</th>
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
											<td><?=$sl++?></td>
											<td>
												<?php if($row->type == 'CREDIT'){?>
													<span class="badge bg-success">CREDIT</span>
												<?php } else {?>
													<span class="badge bg-danger">DEBIT</span>
												<?php }?>
											</td>
											<td><?=(($row->created_at != '')?date_format(date_create($row->created_at), "M d, Y h:i A"):'')?></td>
											<td><?=(($booking)?$booking->booking_no:'NA')?></td>
											<td>
											  	<h6><i class="fa fa-user"></i> <?=(($student)?$student->name:'')?></h6>
											  	<h6><i class="fa fa-envelope"></i> <?=(($student)?$student->email:'')?></h6>
											  	<h6><i class="fa fa-mobile"></i> <?=(($student)?$student->phone:'')?></h6>
											</td>
											<td><?=number_format($row->opening_amt,2)?></td>
											<td><?=number_format($row->transaction_amt,2)?></td>
											<td><?=number_format($row->closing_amt,2)?></td>
											<td>
												<?php if($row->status){?>
													<span class="badge bg-success">YES</span>
												<?php } else {?>
													<span class="badge bg-danger">NO</span>
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