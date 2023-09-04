<div class="account_wrapper">
	<?=$sidebar;?>
	<div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
		<header class="header header-sticky mb-4">
			<div class="container-fluid">
				<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
					<i class="fa-solid fa-bars"></i>
				</button>
				<h4 class="pagestitle-item mb-0">Profile</h4>
				<ul class="header-nav ms-auto"></ul>
			</div>
		</header>
		<div class="body flex-grow-1 px-3">
			<div class="container-lg">
				<div class="row">
					<div class="col-sm-12 col-lg-6">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body profile_cardbody">
								<div class="profile_myaccount">
									<div class="profile_changeavtar">
										<div class="profil_avimg">
											<div class="profl_img_show"><img src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>assets/img/avatars/1.jpg" alt="img"></div>
											<div class="profl_imgrequi">
												<strong>Profile photo</strong>
												<p>Required</p>
											</div>
										</div>
										<div class="prfile_chagebtn">
											<a href="#">Change Photo</a>
										</div>
									</div>
									<div class="mb-3">
										<div class="col-md-12 profi_stumentlink">
											<div class="profi_copylink">
												<label for="basic-url" class="form-label">Your Stumento page link</label>
												<div class="input-group">
													<span class="input-group-text" id="basic-addon3">stumento.com/</span>
													<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
												</div>
											</div>
											<div class="profi_copybtn">
												<a href="#"><i class="fa-regular fa-copy"></i></a>
											</div>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-6">
											<label for="formGroupExampleInput" class="form-label">First Name</label>
										<input type="text" class="form-control" placeholder="First name" aria-label="First name">
										</div>
										<div class="col-md-6">
											<label for="formGroupExampleInput" class="form-label">Last Name</label>
										<input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-12">
											<label for="formGroupExampleInput" class="form-label">Display Name</label>
										<input type="text" class="form-control" placeholder="First name" aria-label="First name">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-12">
											<label for="formGroupExampleInput" class="form-label">Your Stumento intro (Required)</label>
										<input type="text" class="form-control" placeholder="First name" aria-label="First name">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-md-12">
											<label for="formGroupExampleInput" class="form-label">About yourself</label>
										<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-lg-12">
											<h3 style="font-size: 16px;">Social Links</h3>
											<div class="add-function">
												<div class="function-table-2">
													<div class="form-group function-tr-2">
														<div class="input-group">
															<div class="input-group-addon">
																<select class="form-control">
																<option selected>linkedin</option>
																<option>instagram</option>
																<option>youtube</option>
																<option>twitter</option>
																<option>youtube</option>
																</select>
															</div>
																<input id="wrapped" class="form-control" type="input" placeholder="Add social url" name="wrapped" />
															<div class="form-group col-md-1 pl-1 pr-2">
																<div class="remove-action">
																	<a href="javascript:void(0)" class="js-del2-row"><i class="fa-solid fa-xmark"></i></a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="add-button-function">
													<div class="add-action">
														<a href="javascript:void(0)" class="js-add2-row">+ Add social link</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12 mb-3">
										<a href="#" class="myprof_btn">Save Changes</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body ">
								<div class="title_myaccount">
									<h3>Your details</h3>
									<div class="prfile_editor">
										<div class="profle_topedit">
											<label class="form-label">Email address</label>
											<a href="#" class="edit-link">Edit Link</a>
											<a href="#" class="cancel">Cancel</a>
											<form class="editForm" style="display: none;">
											<input type="email" class="form-control" id="editMessage" placeholder="name@example.com">
											<input type="submit" value="Save"></input>
											</form>
										</div>
									</div>
									<div class="prfile_editor">
										<div class="profle_topedit">
											<label class="form-label">Mobile number</label>
											<a href="#" class="edit-link">Edit Link</a>
											<a href="#" class="cancel">Cancel</a>
											<form class="editForm" style="display: none;">
											<input type="email" class="form-control" id="editMessage" placeholder="name@example.com">
											<input type="submit" value="Save"></input>
											</form>
										</div>
									</div>
									<div class="prfile_editor">
										<div class="profle_topedit">
											<label class="form-label">Password</label>
											<a href="#" class="edit-link">Edit Link</a>
											<a href="#" class="cancel">Cancel</a>
											<form class="editForm" style="display: none;">
											<input type="email" class="form-control" id="editMessage" placeholder="name@example.com">
											<input type="submit" value="Save"></input>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body ">
								<div class="title_myaccount">
									<h3>Your Payouts</h3>
									<div class="row mb-3">
										<div class="col-md-12">
											<label for="formGroupExampleInput" class="form-label">Bank Details</label>
											<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
										</div>
									</div>
									<div class="col-md-12 mb-3"><a href="#" class="myprof_btn">Save Changes</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
