<div class="account_wrapper">
	<?=$sidebar;?>
	<div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
		<header class="header header-sticky mb-4">
			<div class="container-fluid">
				<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
				<i class="fa-solid fa-bars"></i>
				</button>
				<h4 class="pagestitle-item mb-0">Availability</h4>
				<ul class="header-nav ms-auto"></ul>
			</div>
		</header>
		<div class="body flex-grow-1 px-3">
			<div class="container-lg">
				<div class="row">
					<div class="col-md-12">
						<div class="topAvailability_btn">
							<ul>
								<li><a href="#" class="btn">Default</a></li>
								<li><a href="#" class="btn newscheuld">+ New Schedule</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-12 col-lg-8">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body profile_cardbody">
								<div class="col-md-12">
									<div class="aftertop_part">
										<h3>Default</h3>
										<a href="#" class="myprof_btn">Save</a>
									</div>
								</div>
								<div class="ant-col ant-col-24 add-slots">
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
														<label for="chkPassport">
														<input class="form-check-input" type="checkbox" id="chkPassport" />
														Saturday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div id="dvPassport" class="slots-section" style="display: none">
												<div class="slots-select-box">
													<div class="slot_starttime">
														<select id="selectbox">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<div style="display: inline; margin: 0px 1em;">-</div>
													<div class="slot_endtime">
														<select id="selectbox2">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<button class="add-slot-btn"><i class="fa-solid fa-plus"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
													<label for="chkPassport">
														<input class="form-check-input" type="checkbox" id="chkPassport1" />
														Sunday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div id="dvPassport1" class="slots-section" style="display: none">
												<div class="slots-select-box">
													<div class="slot_starttime">
														<select id="selectbox3">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<div style="display: inline; margin: 0px 1em;">-</div>
													<div class="slot_endtime">
														<select id="selectbox4">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<button class="add-slot-btn"><i class="fa-solid fa-plus"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
													<label for="chkPassport">
														<input class="form-check-input" type="checkbox" id="chkPassport1" />
														Monday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div id="dvPassport1" class="slots-section" style="display: none">
												<div class="slots-select-box">
													<div class="slot_starttime">
														<select id="selectbox5">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<div style="display: inline; margin: 0px 1em;">-</div>
													<div class="slot_endtime">
														<select id="selectbox6">
															<option value="1">12.00 AM</option>
															<option value="2">12.15 AM</option>
															<option value="3">12.30 AM</option>
															<option value="4">12.45 AM</option>
															<option value="5">1.00 AM</option>
															<option value="6">1.15 AM</option>
															<option value="7">1.30 AM</option>
															<option value="8">1.45 AM</option>
															<option value="9">2.00 AM</option>
														</select>
													</div>
													<button class="add-slot-btn"><i class="fa-solid fa-plus"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
													<label class="form-check-label" for="flexCheckChecked">
													Tuesday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="slots-section">
												<div class="ant-typography slots-unavailable">Unavailable</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
													<label class="form-check-label" for="flexCheckChecked">
													Wednesday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="slots-section">
												<div class="ant-typography slots-unavailable">Unavailable</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
										<div class="col-md-4">
											<div class="slot_weeksday">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
													<label class="form-check-label" for="flexCheckChecked">
													Thursday
													</label>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="slots-section">
												<div class="ant-typography slots-unavailable">Unavailable</div>
											</div>
										</div>
									</div>
									<div class="row slot-item">
											<div class="col-md-4">
												<div class="slot_weeksday">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
														<label class="form-check-label" for="flexCheckChecked">
														Friday
														</label>
													</div>
												</div>
											</div>
											<div class="col-md-8">
												<div class="slots-section">
													<div class="ant-typography slots-unavailable">Unavailable</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-4">
							<div class="card mb-4 text-white bg-whitebg">
								<div class="card-body ">
									<div class="col-md-12">
										<div class="aftertop_part mb-2">
											<h3>Block dates</h3>
										</div>
										<p>Add dates when you will be unavailable to take calls</p>
										<div class="afterblock_section">
											<div class="d-grid gap-2">
											<button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">Add unavailable dates</button>
											</div>
											<div class="metor_datenotwork">
												<ul>
													<li>
														<div class="date">13 December 2023</div>
														<div class="dateunavailable">unavailable</div>
														<div class="dateremove"><a href="#"><i class="fa-solid fa-trash"></i></a></div>
													</li>
													<li>
														<div class="date">20 December 2023</div>
														<div class="dateunavailable">unavailable</div>
														<div class="dateremove"><a href="#"><i class="fa-solid fa-trash"></i></a></div>
													</li>
													<li>
														<div class="date">31 December 2023</div>
														<div class="dateunavailable">unavailable</div>
														<div class="dateremove"><a href="#"><i class="fa-solid fa-trash"></i></a></div>
													</li>
													<li>
														<div class="date">13 December 2023</div>
														<div class="dateunavailable">unavailable</div>
														<div class="dateremove"><i class="fa-solid fa-trash"></i></div>
													</li>
												</ul>
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
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Select date(s) you are unavailable on</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="#" class="row">
					<div class="col-md-12">
					<div id="inline_cal"></div>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>
</div>