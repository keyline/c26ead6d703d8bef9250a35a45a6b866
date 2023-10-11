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
										<th>Txn No</th>
										<th>Date</th>
										<th>Mentor Details</th>
										<th>Base Price</th>
										<th>GST</th>
										<th>Total Amount</th>
										<th>Payment Status</th>
										<th>Payment Method</th>
									</tr>
								</thead>
								<tbody>
									
									<tr>
										<td>1</td>
										<td>STUMENTO/2023-2024/000001</td>
										<td>h4684h8945b6758945674565467</td>
										<td>Sep 08, 2023 01:53 PM</td>
										<td>
										  <h6><i class="fa fa-user"></i> Makenna Robel</h6>
										  <h6><i class="fa fa-envelope"></i> fjohnson@example.org</h6>
										  <h6><i class="fa fa-mobile"></i> 2931574210</h6>
										</td>
										<td>1000.00</td>
										<td>118.00</td>
										<td>1180.00</td>
										<td><span class="badge bg-success">SUCCESS</span></td>
										<td><strong>Razor Pay</strong></td>
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