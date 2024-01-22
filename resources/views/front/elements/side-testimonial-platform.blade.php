<?php
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\MentorProfile;
use App\Models\BookingRating;
use App\Models\PlatformRating;
use App\Helpers\Helper;

$platformReviews        = PlatformRating::where('status', '=', 1)->inRandomOrder()->get();
?>
<?php if($platformReviews){ foreach($platformReviews as $row){?>
   <?php
   $getUser = User::select('name')->where('id', '=', $row->user_id)->first();
   if($row->user_type == 'STUDENT'){
      $user = StudentProfile::select('profile_pic')->where('user_id', '=', $row->user_id)->first();
   } else {
      $user = MentorProfile::select('profile_pic')->where('user_id', '=', $row->user_id)->first();
   }
   ?>
   <div class="testmoric_item">
      <div class="testimor_quote" style="display: block;"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutationo.png" alt="icon"></div>
      <div class="testimori_content"><?=$row->review?></div>
      <div class="testomori_profile">
         <div class="testmori_prof_img">
            <?php if($user->profile_pic == ''){?>
               <img src="<?=env('NO_IMAGE')?>" alt="<?=$row->name?>">
            <?php } else {?>
               <img src="<?=env('UPLOADS_URL')?>user/<?=$user->profile_pic?>" alt="<?=$row->name?>">
            <?php }?>
         </div>
         <div class="testmori_name">
            <h3><?=(($getUser)?$getUser->name:'')?></h3>
            <!-- <h5><?=$row->designation?></h5> -->
            <div class="m-left d-table">
               <?php for($i=1;$i<=$row->rating;$i++){?>
                  <span class="fa fa-star checked"></span>
               <?php } ?>
               <?php for($i=1;$i<=(5 - $row->rating);$i++){?>
                  <span class="fa fa-star"></span>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
<?php } }?>