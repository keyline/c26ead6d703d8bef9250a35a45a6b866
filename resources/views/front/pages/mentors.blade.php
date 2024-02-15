<?php
use App\Helpers\Helper;
?>
<!-- mentor list start -->
<section class="mentor-section">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="mentor-heading text-center mb-md-5">
               <h2>Our Mentors</h2>
               
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-3">
            <div class="mentor-left-box my-4 my-md-0">
               <h5>Find Your Mentor</h5>
               <!-- <form action=""> -->
                  <label for="" class="form-label">Name</label>
                  <div class="input-group">
                     <input type="text" class="form-control" name="mentor_name" id="mentor_name">
                  </div>
                  <label for="" class="form-label">Services</label>
                  <div class="input-group">
                     <select name="service_id" id="service_id">
                        <option value="" selected>Select services</option>
                        <?php if($services){ foreach($services as $service){?>
                        <option value="<?=$service->id?>"><?=$service->name?></option>
                        <?php } }?>
                     </select>
                  </div>
                  <label for="" class="form-label">Day</label>
                  <div class="input-group">
                     <select name="day_no" id="day_no">
                        <option value="" selected>Select Day</option>
                        <option value="1">Sunday</option>
                        <option value="2">Monday</option>
                        <option value="3">Tuesday</option>
                        <option value="4">Wednesday</option>
                        <option value="5">Thursday</option>
                        <option value="6">Friday</option>
                        <option value="7">Saturday</option>
                     </select>
                  </div>
                  <!-- <div class="input-group">
                     <input type="checkbox"> &nbsp;Available today
                  </div> -->
                  <div class="input-group justify-content-center">
                     <button class="mx-2" type="button" onclick="getMentorFilter();">Search</button>
                     <button class="mx-2" type="button" id="reset-btn" onclick="getMentorFilterReset();" style="display: none;">Reset</button>
                  </div>
               <!-- </form> -->
            </div>
         </div>
         <div class="col-lg-9">
            <div class="mentor-right-box  my-4 my-lg-0">
               <div class="total-mentor-box">
                  <h5>Total <span id="mentor-count"><?=count($mentors)?></span> Mentors found</h5>
                  <!-- <a href="javascript:void(0);" class="help-me-btn">Help me to find a mentors</a> -->
               </div>
               <div class="row" id="mentor-list">
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
                     <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="mentor-main-box <?=$className1?>">
                           <a href="<?=url('mentor-details/'.$mentorDisplayName.'/'.Helper::encoded($mentorId))?>">
                              <div class="mentor-box <?=$className2?>">
                                 <div class="mentor-img-box">
                                    <img src="<?=$mentor['profile_image']?>" alt="<?=$mentor['name']?>">
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
                                                <i class="fas fa-comment"></i> <?=substr($mentor['last_review'], 0, 40).' ...'?>
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
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- mentor list end -->