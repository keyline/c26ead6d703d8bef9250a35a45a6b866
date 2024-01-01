<?php
use App\Helpers\Helper;
?>
<!-- mentor details start -->
<section class="mentor-details-section">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="mentor-dtl-left">
                  <div class="row">
                      <div class="col-12">
                          <div class="mentor-profile">
                              <div class="mentor-profile-left d-flex justify-content-center justify-content-md-start flex-wrap">
                                  <div class="profile-img">
                                      <?php if($profileDetail){?>
                                        <?php if($profileDetail->profile_pic != ''){?>
                                          <img src="<?=env('UPLOADS_URL').'user/'.$profileDetail->profile_pic?>" class="img-fluid img-thumbnail" alt="<?=(($profileDetail)?$profileDetail->full_name:'')?>" style="border-radius: 50%;">
                                        <?php } else {?>
                                          <img src="<?=env('NO_IMAGE')?>" alt="<?=(($profileDetail)?$profileDetail->full_name:'')?>" class="img-fluid img-thumbnail" style="border-radius: 50%;">
                                        <?php }?>
                                      <?php } else {?>
                                        <img src="<?=env('NO_IMAGE')?>" alt="<?=(($profileDetail)?$profileDetail->full_name:'')?>" class="img-fluid img-thumbnail" style="border-radius: 50%;">
                                      <?php }?>
                                  </div>
                                  <ul class="mentorprofile_info">
                                      <li><a href="javascript:void(0);"> <?=(($profileDetail)?$profileDetail->full_name:'')?> <i class="fas fa-check check-icon" data-toggle="tooltip" title="Verified user"></i></a></li>
                                      <?php if($rating_star != ''){?>
                                        <div class="rating">
                                          <?=(($rating_star != '')?$rating_star:'')?>
                                        </div>
                                      <?php }?>
                                      <?php if($profileDetail){?>
                                        <?php if($profileDetail->city != ''){?>
                                          <li><i class="fas fa-globe-asia"></i> <?=(($profileDetail)?$profileDetail->city:'')?></li>
                                        <?php }?>
                                        <?php if(!empty(json_decode($profileDetail->languages))){?>
                                          <li>
                                            <i class="fa-solid fa-font"></i> <?=(($profileDetail)?implode(", ", json_decode($profileDetail->languages)):'')?>
                                          </li>
                                        <?php }?>
                                        <?php if(!empty(json_decode($profileDetail->subjects))){?>
                                          <li>
                                            <i class="fa-regular fa-newspaper"></i> <?=(($profileDetail)?implode(", ", json_decode($profileDetail->subjects)):'')?>
                                          </li>
                                        <?php }?>
                                      <?php }?>
                                      <!-- <li>
                                        <i class="fas fa-calendar-day"></i> <?=((!empty($avl_days))?implode(", ", $avl_days):'')?>
                                      </li> -->
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="mentor-dtl-box">
                      <h4>About Me</h4>
                      <div class="overview-description">
                          <p><?=(($profileDetail)?$profileDetail->about_yourself:'')?></p>
                      </div>
                      <!-- <div class="divider"></div> -->
                      <br>
                      <!-- <h4>Education</h4>
                      <div class="education-details">
                        <?php
                          $edu_institute  = (($profileDetail)?(($profileDetail->edu_institute != '')?json_decode($profileDetail->edu_institute):[]):[]);
                          $edu_title      = (($profileDetail)?(($profileDetail->edu_title != '')?json_decode($profileDetail->edu_title):[]):[]);
                          $edu_year       = (($profileDetail)?(($profileDetail->edu_year != '')?json_decode($profileDetail->edu_year):[]):[]);
                        ?>
                          <?php if(!empty($edu_institute)){ for($s=0;$s<count($edu_institute);$s++) {?>
                            <div class="info-list mb-3">
                                <div class="info-content">
                                    <h6><?=$edu_institute[$s]?></h6> <?=$edu_title[$s]?>
                                </div>
                                <div class="info-years">
                                    <strong><?=$edu_year[$s]?></strong>
                                </div>
                            </div>
                          <?php } }?>
                      </div> -->
                      <!-- <div class="divider"></div> -->
                      <!-- <br>
                      <h4>Work Experience</h4>
                      <div class="education-details">
                          <?php
                            $work_institute  = (($profileDetail)?(($profileDetail->work_institute != '')?json_decode($profileDetail->work_institute):[]):[]);
                            $work_title      = (($profileDetail)?(($profileDetail->work_title != '')?json_decode($profileDetail->work_title):[]):[]);
                            $work_year       = (($profileDetail)?(($profileDetail->work_year != '')?json_decode($profileDetail->work_year):[]):[]);
                          ?>
                            <?php if(!empty($work_institute)){ for($s=0;$s<count($work_institute);$s++) {?>
                              <div class="info-list mb-3">
                                  <div class="info-content">
                                      <h6><?=$work_institute[$s]?></h6> <?=$work_title[$s]?>
                                  </div>
                                  <div class="info-years">
                                      <strong><?=$work_year[$s]?></strong>
                                  </div>
                              </div>
                            <?php } }?>
                      </div> -->
                      <!-- <div class="divider"></div> -->
                      <!-- <br>
                      <h4>Awards & Recognitions</h4>
                      <div class="education-details">
                        <?php
                            $award_title  = (($profileDetail)?(($profileDetail->award_title != '')?json_decode($profileDetail->award_title):[]):[]);
                            $award_year      = (($profileDetail)?(($profileDetail->award_year != '')?json_decode($profileDetail->award_year):[]):[]);
                          ?>
                            <?php if(!empty($award_title)){ for($s=0;$s<count($award_title);$s++) {?>
                              <div class="info-list mb-3">
                                  <div class="info-content">
                                      <h6><?=$award_title[$s]?></h6>
                                  </div>
                                  <div class="info-years">
                                      <strong><?=$award_year[$s]?></strong>
                                  </div>
                              </div>
                          <?php } }?>
                      </div> --> 
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
<!-- mentor details end -->