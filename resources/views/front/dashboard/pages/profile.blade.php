<?php
	use App\Models\User;
?>
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
			<div class="container-lg">
				<div class="row">
					<div class="col-sm-12 col-lg-6">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body profile_cardbody">
								<form method="POST" action="" enctype="multipart/form-data">
								@csrf
									<input type="hidden" name="mode10" value="updateData">.
									<input type="hidden" name="student_id" value="<?=$profileDetail->id?>">
									<div class="profile_myaccount">
										<div class="profile_changeavtar">
											<div class="profil_avimg">
												<div class="profl_img_show">
													<!-- <img src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>assets/img/avatars/1.jpg" alt="img"> -->
													<!-- <img src="<?=env('NO_IMAGE')?>" alt="<?=$profileDetail->profile_pic?>"  id="img_url" class="img-thumbnail" style="height: 110px; margin-top: 10px;"> -->
													<?php if($profileDetail->profile_pic != ''){?>
														<img src="<?=env('UPLOADS_URL').'student/'.$profileDetail->profile_pic?>"  id="img_url" class="img-thumbnail" alt="<?=$profileDetail->profile_pic?>" style="width: 150px; height: 150px; margin-top: 10px;">
													<?php } else {?>
														<img src="<?=env('NO_IMAGE')?>" alt="<?=$profileDetail->profile_pic?>"  id="img_url" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
													<?php }?>
												</div>
												<div class="profl_imgrequi">
													<strong>Profile photo</strong>
													<p>Required</p>
												</div>
											</div>
											<div class="prfile_chagebtn" style="margin-top:10px">
												<input type="file" class="form-control" name="image" id="img_file" onChange="img_pathUrl(this);" accept="image/png, image/gif, image/jpeg" >
											</div>
										</div>
										<div class="mb-3">
											<div class="col-md-12 profi_stumentlink">
												<div class="profi_copylink">
													<label for="basic-url" class="form-label">Your Stumento page link</label>
													<div class="input-group">
														<span class="input-group-text" id="basic-addon3">stumento.com/</span>
														<input type="text" class="form-control" name="page_link" value="<?=(($profileDetail->page_link)?$profileDetail->page_link:'')?>" id="myInput" aria-describedby="basic-addon3 basic-addon4">
													</div>
												</div>
												<div class="profi_copybtn">
													<a href="#" onclick="myFunction()"><i class="fa-regular fa-copy"></i></a>
												</div>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-md-6">
												<label for="formGroupExampleInput" class="form-label">First Name</label>
											<input type="text" class="form-control" placeholder="First name" name="fname" aria-label="First name" value="<?=(($profileDetail->first_name)?$profileDetail->first_name:'')?>" >
											</div>
											<div class="col-md-6">
												<label for="formGroupExampleInput" class="form-label">Last Name</label>
											<input type="text" class="form-control" placeholder="Last name" name="lname" aria-label="Last name" value="<?=(($profileDetail->last_name)?$profileDetail->last_name:'')?>">
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-md-12">
												<label for="formGroupExampleInput" class="form-label">Display Name</label>
											<input type="text" class="form-control" placeholder="First name" value="<?=(($profileDetail->full_name)?$profileDetail->full_name:'')?>" name="dname" aria-label="First name" value="<?=(($profileDetail->full_name)?$profileDetail->full_name:'')?>">
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-md-12">
												<label for="formGroupExampleInput" class="form-label">Your Stumento intro (Required)</label>
											<input type="text" class="form-control" placeholder="First name" name="intro" aria-label="Intro" value="<?=(($profileDetail->stumento_intro)?$profileDetail->stumento_intro:'')?>">
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-md-12">
												<label for="formGroupExampleInput" class="form-label">About yourself</label>
											<textarea class="form-control" id="exampleFormControlTextarea1" name="about_yourself" rows="3"> <?=(($profileDetail->about_yourself)?$profileDetail->about_yourself:'')?></textarea>
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
											<button type="submit" class="myprof_btn">Save Changes</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-6">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body ">
								<div class="title_myaccount">
									<h3>Your details</h3>
									<?php	$getUserID	=	User::where('id', '=', $profileDetail->user_id)->first();	?>
									<div class="prfile_editor">
										<div class="profle_topedit">
											<label class="form-label">Email address</label>
											<a href="#" class="edit-link">Edit Link</a>
											<a href="#" class="cancel">Cancel</a>
											<form method="POST" action="" enctype="multipart/form-data" class="editForm" style="display: none;">
											@csrf
												<input type="hidden" name="mode0" value="updateEmail">
												<input type="hidden" name="student_id" value="<?=$profileDetail->id?>">
												<input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="<?=(($getUserID->email)?$getUserID->email:'')?>">
												<input type="submit" value="Save"></input>
											</form>
										</div>
									</div>
									<div class="prfile_editor">
										<div class="profle_topedit">
											<label class="form-label">Mobile number</label>
											<a href="#" class="edit-link">Edit Link</a>
											<a href="#" class="cancel">Cancel</a>
											<form method="POST" action="" enctype="multipart/form-data" class="editForm" style="display: none;">
											@csrf
												<input type="hidden" name="mode1" value="updateMobile">
												<input type="hidden" name="student_id" value="<?=$profileDetail->id?>">
												<input type="tel" class="form-control" name="mobile" id="mobile" placeholder="+91 9876543210"  value="<?=(($getUserID->phone)?$getUserID->phone:'')?>">
												<input type="submit" value="Save"></input>
											</form>
										</div>
									</div>
									<div class="prfile_editor">
										<div class="profle_topedit">
											<label class="form-label">Password</label>
											<a href="#" class="edit-link">Edit Link</a>
											<a href="#" class="cancel">Cancel</a>
											<form method="POST" action="" enctype="multipart/form-data" class="editForm" style="display: none;">
											@csrf
												<input type="hidden" name="mode2" value="updatePassword">
												<input type="hidden" name="student_id" value="<?=$profileDetail->id?>">
												<input type="password" class="form-control" name="password" id="password"  value="<?=(($getUserID->password)?$getUserID->password:'')?>">
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
									<form method="POST" action="" enctype="multipart/form-data">
										@csrf
										<input type="hidden" name="mode" value="updateBankDetails">
										<input type="hidden" name="student_id" value="<?=$profileDetail->id?>">
										<div class="row mb-3">
											<div class="col-md-12">
												<label for="accountType" class="form-label">Account Type</label>
												<input type="radio" id="savings" name="account_type" value="SAVINGS" <?=(($profileDetail->account_type == 'SAVINGS')?'checked':'')?> >
												<label for="savings">Savings</label>
												<input type="radio" id="current" name="account_type" value="CURRENT" <?=(($profileDetail->account_type == 'CURRENT')?'checked':'')?>>
												<label for="current">Current</label>
											</div>
											<div class="col-md-12">
												<label for="bankName" class="form-label">Bank Name</label>
												<input type="text" class="form-control" name="bank_name" id="bank_name" value="<?=(($profileDetail->bank_name)?$profileDetail->bank_name:'')?>">
											</div>
											<div class="col-md-12">
												<label for="branchName" class="form-label">Branch Name</label>
												<input type="text" class="form-control" name="branch_name" id="branch_name" value="<?=(($profileDetail->branch_name)?$profileDetail->branch_name:'')?>">
											</div>
											<div class="col-md-12">
												<label for="accountNum" class="form-label">Account Number</label>
												<input type="text" class="form-control" name="acct_num" id="acct_num" value="<?=(($profileDetail->account_number)?$profileDetail->account_number:'')?>">
											</div>
											<div class="col-md-12">
												<label for="IfscCode" class="form-label">IFSC Code</label>
												<input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="<?=(($profileDetail->ifsc_code)?$profileDetail->ifsc_code:'')?>" >
											</div>
										</div>
										<div class="col-md-12 mb-3">
											<button type="submit" class="myprof_btn">Save Changes</button>
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
<script>
	function myFunction() {
		var copyText = document.getElementById("myInput");
		copyText.select();
		copyText.setSelectionRange(0, 99999);
		navigator.clipboard.writeText(copyText.value);
		alert("Copied the text: " + copyText.value);
	}
</script>
<script>
    function img_pathUrl(input){
        $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    }
</script>