<?php
use App\Models\User;
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<style type="text/css">
    .choices__list--multiple .choices__item {
        background-color: #f9233f;
        border: 1px solid #f9233f;
    }
</style>
<div class="account_wrapper">
	<?=$sidebar;?>
	<div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
		<header class="header header-sticky mb-4">
			<div class="container-fluid">
				<button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
					<i class="fa-solid fa-bars"></i>
				</button>
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
					<div class="col-sm-12 col-lg-6">
						<div class="card mb-4 text-white bg-whitebg">
							<div class="card-body profile_cardbody">
								<small class="text-danger">Star (*) marks fields are mandatory</small>
								<form method="POST" action="" enctype="multipart/form-data">
									@csrf
									<input type="hidden" name="mode10" value="updateData">
									<input type="hidden" name="user_id" value="<?=$profileDetail->id?>">
									<div class="profile_myaccount">
										<div class="profile_changeavtar">
											<div class="profil_avimg">
												<div class="profl_img_show">
													<!-- <img src="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>assets/img/avatars/1.jpg" alt="img"> -->
													<!-- <img src="<?=env('NO_IMAGE')?>" alt="<?=$profileDetail->profile_pic?>"  id="img_url" class="img-thumbnail" style="height: 110px; margin-top: 10px;"> -->
													<?php if($profileDetail->profile_pic != ''){?>
														<img src="<?=env('UPLOADS_URL').'user/'.$profileDetail->profile_pic?>"  id="img_url" class="img-thumbnail" alt="<?=$profileDetail->profile_pic?>" style="width: 150px; height: 150px; margin-top: 10px;">
													<?php } else {?>
														<img src="<?=env('NO_IMAGE')?>" alt="<?=$profileDetail->profile_pic?>"  id="img_url" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
													<?php }?>
												</div>
												<div class="profl_imgrequi">
													<strong>Profile Image</strong>
												</div>
											</div>
											<div class="prfile_chagebtn" style="margin-top:10px">
												<input type="file" class="form-control" name="image" id="img_file" onChange="img_pathUrl(this);" accept="image/png, image/gif, image/jpeg" >
											</div>
										</div>
										<div class="mb-3">
											<div class="col-md-12 profi_stumentlink">
												<div class="profi_copylink">
													<label for="basic-url" class="form-label">Your Stumento page link <span class="text-danger">*</span></label>
													<div class="input-group">
														<span class="input-group-text" id="basic-addon3">mentrovert.com/mentor-profile/</span>
														<input type="text" class="form-control" name="display_name" value="<?=(($profileDetail->display_name)?$profileDetail->display_name:'')?>" id="myInput" aria-describedby="basic-addon3 basic-addon4">
													</div>
												</div>
												<div class="profi_copybtn">
													<a href="#" onclick="myFunction()"><i class="fa-regular fa-copy"></i></a>
												</div>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-md-6">
												<label for="formGroupExampleInput" class="form-label">First Name <span class="text-danger">*</span></label>
											<input type="text" class="form-control" placeholder="First name" name="fname" aria-label="First name" value="<?=(($profileDetail->first_name)?$profileDetail->first_name:'')?>" required>
											</div>
											<div class="col-md-6">
												<label for="formGroupExampleInput" class="form-label">Last Name <span class="text-danger">*</span></label>
											<input type="text" class="form-control" placeholder="Last name" name="lname" aria-label="Last name" value="<?=(($profileDetail->last_name)?$profileDetail->last_name:'')?>" required>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-md-12">
												<label for="formGroupExampleInput" class="form-label">About yourself <span class="text-danger">*</span></label>
											<textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="8" required><?=(($profileDetail->description)?$profileDetail->description:'')?></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-lg-12">
												<h3 style="font-size: 16px;">Social Links</h3>
												<div class="field_wrapper">
													<?php
													$social_platform 	= json_decode($profileDetail->social_platform);
													$social_url 		= json_decode($profileDetail->social_url);
													?>
													<?php if(!empty($social_platform)){ for($s=0;$s<count($social_platform);$s++) {?>
													<div class="row" style="margin-top: 10px;">
														<div class="col-md-4">
															<select class="form-control" name="social_platform[]">
																<option value="" selected>Social Platforms</option>
																<?php if($socialPlatforms){ foreach($socialPlatforms as $socialPlatform){?>
																<option value="<?=$socialPlatform->name?>" <?=(($social_platform[$s] == $socialPlatform->name)?'selected':'')?>><?=$socialPlatform->name?></option>
																<?php } }?>
															</select>
														</div>
														<div class="col-md-6">
															<input type="text" class="form-control" name="social_url[]" value="<?=$social_url[$s]?>" placeholder="Social Link">
														</div>
														<div class="col-md-2">
															<a href="javascript:void(0);" class="remove_button" title="Add field">
																<i class="fa fa-minus-circle fa-2x text-danger"></i>
															</a>
														</div>
													</div>
													<?php } }?>
													<div class="row" style="margin-top: 10px;">
														<div class="col-md-4">
															<select class="form-control" name="social_platform[]">
																<option value="" selected>Social Platforms</option>
																<?php if($socialPlatforms){ foreach($socialPlatforms as $socialPlatform){?>
																<option value="<?=$socialPlatform->name?>"><?=$socialPlatform->name?></option>
																<?php } }?>
															</select>
														</div>
														<div class="col-md-6">
															<input type="text" class="form-control" name="social_url[]" placeholder="Social Link">
														</div>
														<div class="col-md-2">
															<a href="javascript:void(0);" class="add_button" title="Add field">
															<i class="fa fa-plus-circle fa-2x text-success"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-md-12">
												<label for="city" class="form-label">City</label>
												<input type="text" class="form-control" placeholder="City" name="city" aria-label="City" value="<?=(($profileDetail->city)?$profileDetail->city:'')?>" required>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-md-12">
												<label for="team_meeting_link" class="form-label">Team Meeting Link</label>
												<input type="text" class="form-control" placeholder="Team Meeting Link" name="team_meeting_link" aria-label="City" value="<?=(($profileDetail->team_meeting_link)?$profileDetail->team_meeting_link:'')?>" required>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-md-12">
												<?php
												$languagesData 	= json_decode($profileDetail->languages);
												?>
												<label for="languages" class="form-label">Languages</label>
												<select class="form-control" name="languages[]" id="choices-multiple-remove-button" multiple>
													<?php if($languages){ foreach($languages as $language){?>
													<option value="<?=$language->name?>" <?=((in_array($language->name, $languagesData))?'selected':'')?>><?=$language->name?></option>
													<?php } }?>
												</select>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-md-12">
												<?php
												$subjectsData 	= json_decode($profileDetail->subjects);
												?>
												<label for="subjects" class="form-label">Subjects</label>
												<select class="form-control" name="subjects[]" id="choices-multiple-remove-button" multiple>
													<?php if($subjects){ foreach($subjects as $subject){?>
													<option value="<?=$subject->name?>" <?=((in_array($subject->name, $subjectsData))?'selected':'')?>><?=$subject->name?></option>
													<?php } }?>
												</select>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-lg-12">
												<h3 style="font-size: 16px;">Education</h3>
												<div class="field_wrapper2">
													<?php
													$edu_institute 	= (($profileDetail->edu_institute != '')?json_decode($profileDetail->edu_institute):[]);
													$edu_title 		= (($profileDetail->edu_title != '')?json_decode($profileDetail->edu_title):[]);
													$edu_year 		= (($profileDetail->edu_year != '')?json_decode($profileDetail->edu_year):[]);
													?>
													<?php if(!empty($edu_institute)){ for($s=0;$s<count($edu_institute);$s++) {?>
													<div class="row" style="margin-top: 10px;">
														<div class="col-md-4">
															<input type="text" class="form-control" name="edu_institute[]" value="<?=$edu_institute[$s]?>" placeholder="University">
														</div>
														<div class="col-md-4">
															<input type="text" class="form-control" name="edu_title[]" value="<?=$edu_title[$s]?>" placeholder="Title">
														</div>
														<div class="col-md-3">
															<input type="text" class="form-control" name="edu_year[]" value="<?=$edu_year[$s]?>" placeholder="Year">
														</div>
														<div class="col-md-1">
															<a href="javascript:void(0);" class="remove_button2" title="Remove field">
																<i class="fa fa-minus-circle fa-2x text-danger"></i>
															</a>
														</div>
													</div>
													<?php } }?>
													<div class="row" style="margin-top: 10px;">
														<div class="col-md-4">
															<input type="text" class="form-control" name="edu_institute[]" placeholder="University">
														</div>
														<div class="col-md-4">
															<input type="text" class="form-control" name="edu_title[]" placeholder="Title">
														</div>
														<div class="col-md-3">
															<input type="text" class="form-control" name="edu_year[]" placeholder="Year">
														</div>
														<div class="col-md-1">
															<a href="javascript:void(0);" class="add_button2" title="Add field">
															<i class="fa fa-plus-circle fa-2x text-success"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-lg-12">
												<h3 style="font-size: 16px;">Work Experience</h3>
												<div class="field_wrapper3">
													<?php
													$work_institute 	= (($profileDetail->work_institute != '')?json_decode($profileDetail->work_institute):[]);
													$work_title 		= (($profileDetail->work_title != '')?json_decode($profileDetail->work_title):[]);
													$work_year 			= (($profileDetail->work_year != '')?json_decode($profileDetail->work_year):[]);
													?>
													<?php if(!empty($work_institute)){ for($s=0;$s<count($work_institute);$s++) {?>
													<div class="row" style="margin-top: 10px;">
														<div class="col-md-4">
															<input type="text" class="form-control" name="work_institute[]" value="<?=$work_institute[$s]?>" placeholder="Organization">
														</div>
														<div class="col-md-4">
															<input type="text" class="form-control" name="work_title[]" value="<?=$work_title[$s]?>" placeholder="Title">
														</div>
														<div class="col-md-3">
															<input type="text" class="form-control" name="work_year[]" value="<?=$work_year[$s]?>" placeholder="Year">
														</div>
														<div class="col-md-1">
															<a href="javascript:void(0);" class="remove_button3" title="Remove field">
																<i class="fa fa-minus-circle fa-2x text-danger"></i>
															</a>
														</div>
													</div>
													<?php } }?>
													<div class="row" style="margin-top: 10px;">
														<div class="col-md-4">
															<input type="text" class="form-control" name="work_institute[]" placeholder="Organization">
														</div>
														<div class="col-md-4">
															<input type="text" class="form-control" name="work_title[]" placeholder="Title">
														</div>
														<div class="col-md-3">
															<input type="text" class="form-control" name="work_year[]" placeholder="Year">
														</div>
														<div class="col-md-1">
															<a href="javascript:void(0);" class="add_button3" title="Add field">
															<i class="fa fa-plus-circle fa-2x text-success"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-lg-12">
												<h3 style="font-size: 16px;">Awards & Recognitions</h3>
												<div class="field_wrapper4">
													<?php
													$award_title 		= (($profileDetail->award_title != '')?json_decode($profileDetail->award_title):[]);
													$award_year 		= (($profileDetail->award_year != '')?json_decode($profileDetail->award_year):[]);
													?>
													<?php if(!empty($award_title)){ for($s=0;$s<count($award_title);$s++) {?>
													<div class="row" style="margin-top: 10px;">
														<div class="col-md-5">
															<input type="text" class="form-control" name="award_title[]" value="<?=$award_title[$s]?>" placeholder="Title">
														</div>
														<div class="col-md-5">
															<input type="text" class="form-control" name="award_year[]" value="<?=$award_year[$s]?>" placeholder="Year">
														</div>
														<div class="col-md-2">
															<a href="javascript:void(0);" class="remove_button4" title="Remove field">
																<i class="fa fa-minus-circle fa-2x text-danger"></i>
															</a>
														</div>
													</div>
													<?php } }?>
													<div class="row" style="margin-top: 10px;">
														<div class="col-md-5">
															<input type="text" class="form-control" name="award_title[]" placeholder="Title">
														</div>
														<div class="col-md-5">
															<input type="text" class="form-control" name="award_year[]" placeholder="Year">
														</div>
														<div class="col-md-2">
															<a href="javascript:void(0);" class="add_button4" title="Add field">
															<i class="fa fa-plus-circle fa-2x text-success"></i>
															</a>
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
											<label class="form-label"><i class="fa fa-envelope"></i></label>
											<label class="form-label"><?=(($getUserID->email)?$getUserID->email:'')?></label>
											<a href="#" class="edit-link">Edit</a>
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
											<label class="form-label"><i class="fa fa-mobile"></i></label>
											<label class="form-label"><?=(($getUserID->phone)?$getUserID->phone:'')?></label>
											<a href="#" class="edit-link">Edit</a>
											<a href="#" class="cancel">Cancel</a>
											<form method="POST" action="" enctype="multipart/form-data" class="editForm" style="display: none;">
											@csrf
												<input type="hidden" name="mode1" value="updateMobile">
												<input type="hidden" name="student_id" value="<?=$profileDetail->id?>">
												<input type="text" class="form-control" name="mobile" id="mobile" placeholder="+91 9876543210" maxlength="10" minlength="10" onkeypress="return isNumber(event)" value="<?=(($getUserID->phone)?$getUserID->phone:'')?>">
												<input type="submit" value="Save"></input>
											</form>
										</div>
									</div>
									<div class="prfile_editor">
										<div class="profle_topedit">
											<label class="form-label"><i class="fa fa-key"></i></label>
											<label class="form-label">********</label>
											<a href="#" class="edit-link">Edit</a>
											<a href="#" class="cancel">Cancel</a>
											<form method="POST" action="" enctype="multipart/form-data" class="editForm" style="display: none;">
											@csrf
												<input type="hidden" name="mode2" value="updatePassword">
												<input type="hidden" name="student_id" value="<?=$profileDetail->id?>">
												<input type="password" class="form-control" name="password" id="password" value="">
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
									<small class="text-danger">Star (*) marks fields are mandatory</small>
									<form method="POST" action="" enctype="multipart/form-data">
										@csrf
										<input type="hidden" name="mode" value="updateBankDetails">
										<input type="hidden" name="student_id" value="<?=$profileDetail->id?>">
										<div class="row mb-3">
											<div class="col-md-12">
												<label for="accountType" class="form-label">Account Type <span class="text-danger">*</span></label>
												<input type="radio" id="savings" name="account_type" value="SAVINGS" <?=(($profileDetail->account_type == 'SAVINGS')?'checked':'')?> required>
												<label for="savings">Savings</label>
												<input type="radio" id="current" name="account_type" value="CURRENT" <?=(($profileDetail->account_type == 'CURRENT')?'checked':'')?> required>
												<label for="current">Current</label>
											</div>
											<div class="col-md-12">
												<label for="bankName" class="form-label">Bank Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="bank_name" id="bank_name" value="<?=(($profileDetail->bank_name)?$profileDetail->bank_name:'')?>" required>
											</div>
											<div class="col-md-12">
												<label for="branchName" class="form-label">Branch Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="branch_name" id="branch_name" value="<?=(($profileDetail->branch_name)?$profileDetail->branch_name:'')?>" required>
											</div>
											<div class="col-md-12">
												<label for="accountNum" class="form-label">Account Number <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="acct_num" id="acct_num" value="<?=(($profileDetail->account_number)?$profileDetail->account_number:'')?>" onkeypress="return isNumber(event)" required>
											</div>
											<div class="col-md-12">
												<label for="IfscCode" class="form-label">IFSC Code <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="<?=(($profileDetail->ifsc_code)?$profileDetail->ifsc_code:'')?>" required>
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
<script type="text/javascript">
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
<script>
	function myFunction() {
		var copyText = document.getElementById("myInput");
		copyText.select();
		let baseUrl = '<?=url('mentor-profile/')?>';
		copyText.setSelectionRange(0, 99999);
		let finalCopyValue = baseUrl + '/' + copyText.value;
		navigator.clipboard.writeText(finalCopyValue);
		alert("Copied the text: " + finalCopyValue);
	}
    function img_pathUrl(input){
        $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var fieldHTML ='<div class="row" style="margin-top: 10px;">\
							<div class="col-md-4">\
								<select class="form-control" name="social_platform[]">\
									<option value="" selected>Social Platforms</option>\
									<?php if($socialPlatforms){ foreach($socialPlatforms as $socialPlatform){?>
									<option value="<?=$socialPlatform->name?>"><?=$socialPlatform->name?></option>\
									<?php } }?>
								</select>\
							</div>\
							<div class="col-md-6">\
								<input type="text" class="form-control" name="social_url[]" placeholder="Social Link">\
							</div>\
                          <div class="col-md-2">\
                                <a href="javascript:void(0);" class="remove_button" title="Add field">\
                                <i class="fa fa-minus-circle fa-2x text-danger"></i>\
                                </a>\
                          </div>\
                        </div>';
        var x = 1;
        $(addButton).click(function(){
            if(x < maxField){
                x++;
                $(wrapper).append(fieldHTML);
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        });
    });
    $(document).ready(function(){
        var maxField = 10;
        var addButton = $('.add_button2');
        var wrapper = $('.field_wrapper2');
        var fieldHTML ='<div class="row" style="margin-top: 10px;">\
							<div class="col-md-4">\
								<input type="text" class="form-control" name="edu_institute[]" placeholder="University">\
							</div>\
							<div class="col-md-4">\
								<input type="text" class="form-control" name="edu_title[]" placeholder="Title">\
							</div>\
							<div class="col-md-3">\
								<input type="text" class="form-control" name="edu_year[]" placeholder="Year">\
							</div>\
							<div class="col-md-1">\
                                <a href="javascript:void(0);" class="remove_button2" title="Remove field">\
                                <i class="fa fa-minus-circle fa-2x text-danger"></i>\
                                </a>\
                          	</div>\
                        </div>';
        var x = 1;
        $(addButton).click(function(){
            if(x < maxField){
                x++;
                $(wrapper).append(fieldHTML);
            }
        });
        $(wrapper).on('click', '.remove_button2', function(e){
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        });
    });
    $(document).ready(function(){
        var maxField = 10;
        var addButton = $('.add_button3');
        var wrapper = $('.field_wrapper3');
        var fieldHTML ='<div class="row" style="margin-top: 10px;">\
							<div class="col-md-4">\
								<input type="text" class="form-control" name="work_institute[]" placeholder="Organization">\
							</div>\
							<div class="col-md-4">\
								<input type="text" class="form-control" name="work_title[]" placeholder="Title">\
							</div>\
							<div class="col-md-3">\
								<input type="text" class="form-control" name="work_year[]" placeholder="Year">\
							</div>\
							<div class="col-md-1">\
                                <a href="javascript:void(0);" class="remove_button3" title="Remove field">\
                                <i class="fa fa-minus-circle fa-2x text-danger"></i>\
                                </a>\
                          	</div>\
                        </div>';
        var x = 1;
        $(addButton).click(function(){
            if(x < maxField){
                x++;
                $(wrapper).append(fieldHTML);
            }
        });
        $(wrapper).on('click', '.remove_button3', function(e){
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        });
    });
    $(document).ready(function(){
        var maxField = 10;
        var addButton = $('.add_button4');
        var wrapper = $('.field_wrapper4');
        var fieldHTML ='<div class="row" style="margin-top: 10px;">\
							<div class="col-md-5">\
								<input type="text" class="form-control" name="award_title[]" placeholder="Title">\
							</div>\
							<div class="col-md-5">\
								<input type="text" class="form-control" name="award_year[]" placeholder="Year">\
							</div>\
							<div class="col-md-2">\
                                <a href="javascript:void(0);" class="remove_button4" title="Remove field">\
                                <i class="fa fa-minus-circle fa-2x text-danger"></i>\
                                </a>\
                          	</div>\
                        </div>';
        var x = 1;
        $(addButton).click(function(){
            if(x < maxField){
                x++;
                $(wrapper).append(fieldHTML);
            }
        });
        $(wrapper).on('click', '.remove_button4', function(e){
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){    
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount:30,
            searchResultLimit:30,
            renderChoiceLimit:30
        });     
    });
</script>