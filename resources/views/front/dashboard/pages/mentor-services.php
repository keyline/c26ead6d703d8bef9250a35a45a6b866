<div class="account_wrapper">
	<?=$sidebar;?>
	<div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
		<header class="header header-sticky mb-4">
		<div class="container-fluid">
			<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
				<i class="fa-solid fa-bars"></i>
			</button>
			<h4 class="pagestitle-item mb-0">Service</h4>
			<ul class="header-nav ms-auto"></ul>
		</div>
		</header>
		<div class="body flex-grow-1 px-3">
			<div class="container-lg">
				<div class="row">
					<div class="col-sm-12 col-lg-6">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="aftertop_part mb-2">
											<h3>Select type</h3>
										</div>
										<div class="metor_seriveall">
											<div class="input-group mb-3">
												<div class="button-group button-group-2 check_halfbtn">
												<label class="button-group__btn"><input type="radio" name="check" /> <span class="button-group__label">
													<div class="ant-space css-15zlunz ant-space-vertical ant-space-align-start" style="gap: 8px;"><div class="ant-space-item" ><i class="fa-solid fa-calendar"></i></div><div class="ant-space-item" ><div class="ant-typography query-button-text css-15zlunz">1:1 Call</div></div><div class="ant-space-item"><div class="ant-typography query-button-subtext css-15zlunz">Share your time over a meeting</div></div></div>	
												</span></label>
												<label class="button-group__btn"><input type="radio" name="check" /> <span class="button-group__label">
													<div class="ant-space css-15zlunz ant-space-vertical ant-space-align-start" style="gap: 8px;"><div class="ant-space-item"><i class="fa-solid fa-envelope"></i></div><div class="ant-space-item"><div class="ant-typography query-button-subtext css-15zlunz">Share your time over a meeting</div></div></div>
												</span></label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body profile_cardbody">
								<div class="metor_service">
									<form>
										<div class="mb-3">
											<label for="exampleInputEmail1" class="form-label">Title</label>
											<input type="text" class="form-control" placeholder="Name of Service" id="exampleInputEmail1">
										</div>
										<div class="mb-3">
											<label for="exampleInputPassword1" class="form-label">Duration (mins)</label>
											<input type="text" class="form-control" id="exampleInputPassword1">
										</div>
										<div class="input-group mb-3">
											<label for="basic-url" class="form-label">Amount (₹)</label>
												<div class="input-group">
												<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-indian-rupee-sign"></i></span>
												<input type="number" value="0" class="form-control">
											</div>
										</div>
										<div class="d-grid gap-2">
											<button type="submit" class="btn btn-black">Next</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>