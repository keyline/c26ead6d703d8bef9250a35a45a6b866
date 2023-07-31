<h3><?=$page_header?></h3>
<form method="POST" action="" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
	  	<div class="row">
		    <div class="col-lg-6 mb-3">
		    	<label for="name">Name</label>
		      	<input type="text" class="form-control" placeholder="Enter your name" id="name" name="name" value="<?=$getUser->name?>">
		    </div>
		    <div class="col-lg-6 mb-3">
		    	<label for="email">Email</label>
		      	<input type="text" class="form-control" placeholder="Enter your email" id="email" name="email" value="<?=$getUser->email?>" readonly>
		    </div>
	     	<div class="col-lg-6 mb-3">
		    	<label for="country">Country</label>
		      	<input type="text" class="form-control" placeholder="Enter your country" id="country" name="country" value="<?=$getUser->country?> (+971)" readonly>
		    </div>
		    <div class="col-lg-6 mb-3">
		    	<label for="phone">Phone</label>
		      	<input type="text" class="form-control" placeholder="Enter your phone" id="phone" name="phone" value="<?=$getUser->phone?>">
		    </div>
		    <div class="col-lg-6 mb-3">
		    	<label for="image">Image</label>
		      	<input type="file" name="image" class="form-control" id="image">
                <small class="text-info">* Only JPG, JPEG, ICO, SVG, PNG files are allowed</small>
		    </div>
		    <div class="col-lg-6 mb-3">
		    	<?php if($getUser->image != ''){?>
                  <img src="<?=env('UPLOADS_URL').'user/'.$getUser->image?>" alt="<?=$getUser->name?>" style="width: 150px; height: 150px; margin-top: 10px;border-radius: 50%;">
                <?php } else {?>
                  <img src="<?=env('NO_IMAGE')?>" alt="<?=$getUser->name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                <?php }?>
		    </div>
	  	</div>
	</div>
	<div class="form-group">
	  	<button type="submit" class="theme-btn">Update Profile</button>
	</div>
</form>