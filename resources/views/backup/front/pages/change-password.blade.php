<h3><?=$page_header?></h3>
<form method="POST" action="" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
	  	<div class="row">
		    <div class="col-lg-4">
		    	<label for="old_password">Old Password</label>
		      	<input type="password" class="form-control" placeholder="Enter your old password" id="old_password" name="old_password">
		    </div>
		    <div class="col-lg-4">
		    	<label for="new_password">New Password</label>
		      	<input type="password" class="form-control" placeholder="Enter your new password" id="new_password" name="new_password">
		    </div>
		    <div class="col-lg-4">
		    	<label for="confirm_password">Confirm Password</label>
		      	<input type="password" class="form-control" placeholder="Enter your confirm password" id="confirm_password" name="confirm_password">
		    </div>
	  	</div>
	</div>
	<div class="form-group">
	  	<button type="submit" class="theme-btn">Change Password</button>
	</div>
</form>