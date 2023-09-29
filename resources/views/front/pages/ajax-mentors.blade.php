<?php
use App\Helpers\Helper;
?>
<!-- mentor list start -->
<?php
if($mentors) { foreacH($mentors as $mentor){
   if($mentor['service_count'] > 1){
      $className1 = '';
      $className2 = '';
   } else {
      $className1 = 'mentor-main-box-2';
      $className2 = 'mentor-box-2';
   }
   $mentorDisplayName   = $mentor['display_name'];
   $mentorId            = $mentor['mentor_id'];
?>
   <div class="col-sm-6 col-md-6 col-lg-4 mentor-count">
      <div class="mentor-main-box <?=$className1?>">
         <a href="<?=url('mentor-details/'.$mentorDisplayName.'/'.Helper::encoded($mentorId))?>">
            <div class="mentor-box <?=$className2?>">
               <div class="mentor-img-box">
                  <img src="<?=$mentor['profile_image']?>" alt="<?=$mentor['name']?>" style="width: 150px;border-radius: 50%;">
               </div>
               <div class="mentor-content">
                  <h4><?=$mentor['name']?> <i class="fas fa-check check-icon" data-toggle="tooltip"
                     title="Verified user"></i></h4>
                  <h5><?=$mentor['service_name']?></h5>
                  <h6><?=$mentor['qualification']?></h6>
                  <h6><?=(($mentor['experience'] > 0)?$mentor['experience'].' Year Experience':'<br>')?></h6>
                  <div class="rating">
                     <?=$mentor['avg_rating']?>
                  </div>
                  <div class="mentor-list">
                     <ul class="d-flex justify-content-center flex-column flex-wrap">
                        <?php if($mentor['last_review'] != ''){?>
                           <li>
                              <i class="fas fa-comment"></i> <?=$mentor['last_review']?>
                           </li>
                        <?php } ?>
                        <li class="<?=(($mentor['avl_today'])?'available':'not-available')?>">
                           <i class="fas fa-clipboard"></i> <?=(($mentor['avl_today'])?'Available Today':'Not Available Today')?>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </a>
         <div class="book-btn-div"><a href="<?=url('mentor-details/'.$mentorDisplayName.'/'.Helper::encoded($mentorId))?>" class="book-btn"><i class="fas fa-plus"></i> Book Your Slots</a></div>
      </div>
   </div>
<?php } }?>
<!-- mentor list end -->