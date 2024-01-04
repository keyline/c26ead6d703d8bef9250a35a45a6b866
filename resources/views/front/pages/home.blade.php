<?php
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\MentorAvailability;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\MentorProfile;
use App\Helpers\Helper;
?>
<!-- ********|| BANNER STARTS ||******** -->
<div class="home_slider_section">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="homeslider_image">
               <div id="homefade-slider" class="owl-carousel owl-theme">
                  <?php if($banners){ foreach($banners as $row){?>
                     <div class="item">
                        <div class="homeslider_notes">
                           <div class="homeslid_info">
                              <div class="home_titlespeek"><?=$row->banner_text?></div>
                              <p class="homeban_sub"><?=$row->banner_text2?></p>
                              <ul class="banner_btn">
                                 <li><a class="btn_orgfill uppercase me-2" href="#">Book your session</a></li>
                                 <li><a class="btn_border uppercase btn_bordr_orgtext" href="<?=$row->banner_link?>" target="_blank">watch demo <i class="fa-solid fa-play"></i></a></li>
                              </ul>
                           </div>
                           <div class="homesli_img"><img src="<?=env('UPLOADS_URL')?>banner/<?=$row->banner_image?>" class="img-fluid" alt="<?=$row->banner_text?>"></div>
                        </div>
                     </div>
                  <?php } }?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- ********|| BANNER ENDS ||******** -->
<!-- ********|| Home About STARTS ||******** -->
<section class="homeabout_section">
   <div class="container">
      <div class="row">
         <div class="col-lg-12" data-aos="fade-up">
            <div class="homeabout_info wow fadeInLeft">
               <h2>Student Feedbacks</h2>
               <h4>What they’re talking about MentroVert</h4>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="homestudent_section">
   <div class="container">
      <div class="row">
         <div class="col-lg-2">
            <div class="studen_viewplay"><a href="#"><i class="zmdi zmdi-play"></i></a></div>
         </div>
         <div class="col-lg-10">
            <div id="home-feedbacks" class="owl-carousel owl-theme owl-loaded owl-drag">
               <?php if($testimonials){ foreach($testimonials as $row){?>
               <div class="item">
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content"><?=$row->review?></div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="<?=env('UPLOADS_URL')?>testimonial/<?=$row->image?>" alt="<?=$row->name?>"></div>
                        <div class="testmori_name">
                           <h3><?=$row->name?></h3>
                           <h5><?=$row->designation?></h5>
                        </div>
                     </div>
                  </div>
               </div>
               <?php } }?>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- ********|| Home About ENDS ||******** -->
<!-- ********|| Home career STARTS ||******** -->
<section class="home_career_section">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h2>Designed to help students with career choices</h2>
            <h5>Join amazing Counsellors willing to go the extra mile for you!</h5>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="homecare_tabpart">
               <div id="project-terms">
                  <a id="all" class="btn btn-default active" href="#">All</a>
                  <a id="mentalhealth" class="btn btn-metal" href="#">Mental Health</a>
                  <a id="careercounselling" class="btn btn-conselling" href="#">Career Counselling</a>
               </div>
               <!--main carousel element-->
               <div id="projects-carousel" class="owl-carousel career-carousel">
                  <?php
                  if($mentors) { foreacH($mentors as $mentor){
                     $mentorDisplayName   = $mentor['display_name'];
                     $mentorId            = $mentor['mentor_id'];
                  ?>
                     <div class="project <?=$mentor['service_class_name']?>">
                        <div class="projec_homecare">
                           <div class="homecare_img"><img src="<?=$mentor['profile_image']?>" alt="<?=$mentor['name']?>"></div>
                           <div class="homecare_info homecare_height">
                              <h3><?=$mentor['name']?></h3>
                              <h5><?=$mentor['service_name']?></h5>
                              <h3><?=$mentor['qualification']?></h3>
                              <h3><?=$mentor['experience']?> years experiences</h3>
                           </div>
                           <div class="homecare_info">
                              <a href="<?=url('mentor-details/'.$mentorDisplayName.'/'.Helper::encoded($mentorId))?>">View Profile</a>
                           </div>
                        </div>
                     </div>
                  <?php } }?>
               </div>
               <!--element to hold filtered out items-->
               <div id="projects-hidden" class="hide"></div>
            </div>
            <a class="viewallvendor_btn" href="<?=url('mentors/')?>">View All Vendors</a>
         </div>
      </div>
   </div>
</section>
<!-- ********|| Home Success Stories END ||******** -->
<section class="preparation_section">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="top_title text-center py-4">You will never be alone during <br>your preparation with MentroVert</div>
         </div>
      </div>
   </div>
   <?php if($serviceTypes){ $i=1; foreach($serviceTypes as $row){?>
      <?php if($i%2){?>
         <div class="perpation_part1">
            <div class="container-fluid ">
               <div class="row paera_sameline">
                  <div class="col-md-6">
                     <img src="<?=env('UPLOADS_URL')?>service_type/<?=$row->image?>" alt="<?=$row->homepage_service_title?>">
                  </div>
                  <div class="col-md-6">
                     <div class="perpation_info">
                        <h3><?=$row->homepage_service_title?></h3>
                        <p><?=$row->description?></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <?php } else {?>
         <div class="perpation_part2">
            <div class="container-fluid">
               <div class="row paera_sameline">
                  <div class="col-md-6">
                     <div class="perpation_info">
                        <h3><?=$row->homepage_service_title?></h3>
                        <p><?=$row->description?></p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <img src="<?=env('UPLOADS_URL')?>service_type/<?=$row->image?>" alt="<?=$row->homepage_service_title?>">
                  </div>
               </div>
            </div>
         </div>
      <?php }?>
   <?php $i++; } }?>
   <?php if($services){ $i=1; foreach($services as $row){?>
      <?php if($i%2){?>
         <div class="perpation_part1">
            <div class="container-fluid ">
               <div class="row paera_sameline">
                  <div class="col-md-6">
                     <img src="<?=env('UPLOADS_URL')?>service/<?=$row->image?>" alt="<?=$row->homepage_service_title?>">
                  </div>
                  <div class="col-md-6">
                     <div class="perpation_info">
                        <h3><?=$row->homepage_service_title?></h3>
                        <p><?=$row->description?></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <?php } else {?>
         <div class="perpation_part2">
            <div class="container-fluid">
               <div class="row paera_sameline">
                  <div class="col-md-6">
                     <div class="perpation_info">
                        <h3><?=$row->homepage_service_title?></h3>
                        <p><?=$row->description?></p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <img src="<?=env('UPLOADS_URL')?>service/<?=$row->image?>" alt="<?=$row->homepage_service_title?>">
                  </div>
               </div>
            </div>
         </div>
      <?php }?>
   <?php $i++; } }?>
</section>
<section class="home_counter">
   <div class="container">
      <div class="row" id="counter">
         <div class="col-md-4">
            <h2 data-max="78">%</h2>
            <div class="counter_info">of menteers reported confidence boost after a session</div>
         </div>
         <div class="col-md-4">
            <h2 data-max="25071">+</h2>
            <div class="counter_info">session booked</div>
         </div>
         <div class="col-md-4">
            <h2 data-max="84">%</h2>
            <div class="counter_info">of menteers reported saving time or more after a session</div>
         </div>
      </div>
   </div>
</section>
<?php if($featured_mentor){?>
   <!-- ********|| Home Success Stories STARTS ||******** -->
   <section class="home_mentoer_section">
      <div class="container">
         <div class="row">
            <div class="homemento_middle">
               <div class="top_title text-center pt-2 pb-5">Featured Mentor</div>
               <div class="row">
                  <div class="col-md-6">
                     <?php
                     if($featured_mentor->profile_pic != ''){
                        $imageLink = env('UPLOADS_URL') . 'user/' . $featured_mentor->profile_pic;
                     } else {
                        $imageLink = env('NO_IMAGE_AVATAR');
                     }
                     ?>
                     <img src="<?=$imageLink?>" alt="<?=$featured_mentor->full_name?>">
                  </div>
                  <div class="col-md-6">
                     <div class="metor_info">
                        <h3 class="sitecolor"><?=$featured_mentor->full_name?></h3>
                        <?php
                        /* service details */
                            $service_attribute_ids = [];
                            $getServiceDetails = ServiceDetail::select('service_attribute_id')->where('mentor_user_id', '=', $featured_mentor->user_id)->where('status', '=', 1)->get();
                            if ($getServiceDetails) {
                                foreach ($getServiceDetails as $getServiceDetail) {
                                    $service_attribute_ids[] = $getServiceDetail->service_attribute_id;
                                }
                            }
                            $service_ids = [];
                            if (!empty($service_attribute_ids)) {
                                for ($s = 0; $s < count($service_attribute_ids); $s++) {
                                    $getServiceDetails2 = ServiceTypeAttribute::select('service_id')->where('service_attribute_id', '=', $service_attribute_ids[$s])->where('is_active', '=', 1)->first();
                                    if ($getServiceDetails2) {
                                        if (!in_array($getServiceDetails2->service_id, $service_ids)) {
                                            $service_ids[] = $getServiceDetails2->service_id;
                                        }
                                    }
                                }
                            }
                            $serviceNames       = [];
                            $serviceClassNames  = [];
                            if (!empty($service_ids)) {
                                for ($s = 0; $s < count($service_ids); $s++) {
                                    $service = Service::select('name', 'class_name')->where('id', '=', $service_ids[$s])->where('status', '=', 1)->first();
                                    if ($service) {
                                        $serviceNames[]         = (($service) ? $service->name : '');
                                        $serviceClassNames[]    = (($service) ? $service->class_name : '');
                                    }
                                }
                            }
                        /* service details */
                        ?>
                        <h5><?=implode(", ", $serviceNames)?></h5>
                        <h6><?=implode(", ", json_decode($featured_mentor->edu_title))?></h6>
                        <h6><?=$mentor['experience']?> years experiences</h6>
                        <a class="btn_orgfill mt-5" href="<?=url('/mentor-details/'.$featured_mentor->display_name.'/'.Helper::encoded($featured_mentor->user_id))?>">View Profile</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- ********|| Home Success Stories End ||******** -->
<?php }?>
<!-- ********|| Home 3 button Start ||******** -->
<section class="home_faq_section">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="top_title text-center py-4">Frequently asked questions</div>
         </div>
         <?php if($faqs){?>
            <?php //if($i <= 2){?>
               <div class="col-md-4">
                  <div class="homefaq_box mb-3">
                     <h4><?=$faqs[0]->question?></h4>
                     <p><?=$faqs[0]->answer?></p>
                  </div>
                  <div class="homefaq_box mb-3">
                     <h4><?=$faqs[1]->question?></h4>
                     <p><?=$faqs[1]->answer?></p>
                  </div>
               </div>
            <?php //}?>
            <?php //if($i == 3){?>
               <div class="col-md-4">
                  <div class="homefaq_box mb-3">
                     <div class="bigquestion">?</div>
                     <h4><?=$faqs[2]->question?></h4>
                     <p><?=$faqs[2]->answer?></p>
                  </div>
               </div>
            <?php //}?>
            <?php //if($i >= 4 && $i <= 5){?>
               <div class="col-md-4">
                  <div class="homefaq_box mb-3">
                     <h4><?=$faqs[3]->question?></h4>
                     <p><?=$faqs[3]->answer?></p>
                  </div>
                  <div class="homefaq_box mb-3">
                     <h4><?=$faqs[4]->question?></h4>
                     <p><?=$faqs[4]->answer?></p>
                  </div>
               </div>
            <?php //}?>
         <?php }?>
      </div>
   </div>
</section>
<!-- ********|| Home 3 button End ||******** -->