<?php
use App\Http\Controllers\Controller;
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
										<th>Booking No</th>
										<th>Mentor Details</th>
										<th>Txn No</th>
										<th>Transaction Date</th>
										<th>Payable/Payment Amount</th>
										<th>Payment Status</th>
										<th>Payment Method<br>Payment Mode</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if($transactions) { $sl=1; foreach($transactions as $row){
										$mentor = User::where('id', '=', $row->mentor_id)->first();
									?>
										<tr>
											<td><?=$sl++?></td>
											<td><?=$row->booking_no?></td>
											<td>
											  	<h6><i class="fa fa-user"></i> <?=(($mentor)?$mentor->name:'')?></h6>
											  	<h6><i class="fa fa-envelope"></i> <?=(($mentor)?$mentor->email:'')?></h6>
											  	<h6><i class="fa fa-mobile"></i> <?=(($mentor)?$mentor->phone:'')?></h6>
											</td>
											<td><?=$row->txn_id?></td>
											<td><?=(($row->payment_date_time != '')?date_format(date_create($row->payment_date_time), "M d, Y h:i A"):'')?></td>
											<td><?=number_format($row->payable_amt,2)?></td>
											<td>
												<?php if($row->payment_status){?>
													<span class="badge bg-success">SUCCESS</span>
												<?php } else {?>
													<span class="badge bg-danger">NOT PAID</span>
												<?php }?>
											</td>
											<td>
												<strong><?=$row->payment_method?></strong><br>
												<strong><?=$row->payment_mode?></strong>
											</td>
											<td>
												<?php if($row->payment_status){?>
													<a href="<?=url('user/print-student-invoice/'.Helper::encoded($row->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
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