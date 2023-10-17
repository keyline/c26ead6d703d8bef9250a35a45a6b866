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
			<div class="container-lg">
				<div class="row">
					<div class="col-sm-12 col-lg-12">
						<div class="table-responsive">
							<table id="example3" class="stripe table cell-border hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Booking Number</th>
										<th>Rating</th>
										<th>Total Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>STUMENTO/000004</td>
										<td>
											<div class="m-left d-table">
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
											</div>
										</td>
										<td>1800.00</td>
										<td><button type="button" class="btn btn-success btn-sm">Approve</button></td>
									</tr>
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