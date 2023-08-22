<?php
use App\Helpers\Helper;
?>
<!-- ********|| BANNER STARTS ||******** -->
<div class="inner_slider_section">
   <div class="container-fluid px-0">
      <div class="innerpage_banner">
         <div class="innerbanner_img"><img src="<?=env('UPLOADS_URL')?>page/<?=$page->page_banner_image?>" alt="<?=$page->page_name?>"></div>
         <div class="innerbanner_bredcum">
            <h1><?=$page_header?></h1>
            <ul>
               <li><a href="<?=url('/')?>">Home</a></li>
               <li>/</li>
               <li><?=$page_header?></li>
            </ul>
         </div>
      </div>
   </div>
</div>
<!-- ********|| BANNER ENDS ||******** -->
<section class="about_section_one">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="innerpage_title">
               <h2><?=$page_header?></h2>
            </div>
         </div>
         <div class="col-md-4">
            <div class="about_details about_details_one">
               <div class="aboutdetails_info">
                  <h3>Committed to Students!</h3>
                  <p>We are a bunch of people who have worked closely with students and given the state of our education sector, we want to contribute our part by helping as many students as we can!</p>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="about_details about_details_two">
               <div class="aboutdetails_info">
                  <h3>Community Building</h3>
                  <p>We at StuMento envisage a future where student communities drive the change from within to create an ecosystem of trust, growth and self sustainability. The target is to automate the evolution of education system in India through student communities.</p>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="about_details about_details_three">
               <div class="aboutdetails_info">
                  <h3>Education is everything!</h3>
                  <p>Education is what helps humans to enquire into deeper truths and helps human conscious grow to higher levels. We believe in education through self-enquiry and independence, and that a good mentor in life is more important than a great teacher in class.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="about_section_two">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h3>Our Mission. Our Goal.</h3>
         </div>
         <div class="col-md-6">
            <p><?=$page->page_content?></p>
         </div>
         <div class="col-md-6">
            <div class="rightvideop">
               <?php
               if($page->page_video != ''){
                  $page_video = explode("vimeo.com/", $page->page_video);
                  $video_code = $page_video[1];
               } else {
                  $video_code = '';
               }
               ?>
               <a href="https://player.vimeo.com/video/<?=$video_code?>" data-toggle="lightbox">
               <!-- <img src="<?=env('FRONT_ASSETS_URL')?>assets/images/serv-img4.png" alt="banner"> -->
               <img src="<?=env('UPLOADS_URL')?>page/<?=$page->page_image?>" alt="<?=$page_header?>">
               <i class="fa-regular fa-circle-play"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- ********|| Home About STARTS ||******** -->
<section class="about_cleintinfo">
   <div class="container">
      <div class="row">
         <div class="col-md-2">
            <div class="cleintinfo_img"><img src="<?=env('UPLOADS_URL')?>team/<?=$owner->image?>" alt="<?=$owner->name?>"></div>
         </div>
         <div class="col-md-10">
            <div class="cleintinfo_info">
               <h3><?=$owner->name?></h3>
               <h5><?=$owner->designation?></h5>
               <h3><?=$owner->qualification?></h3>
               <p><?=$owner->experience?></p>
               <p class="mt-4"><?=$owner->thought?></p>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- ********|| Home About ENDS ||******** -->
<!-- ********|| Home career STARTS ||******** -->
<section class="about_ourteam">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h3 class="section_title">Our Team</h3>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div id="ourteam-carousel" class="owl-carousel">
               <?php if($teamMembers){ foreach($teamMembers as $teamMember){?>
                  <div class="item">
                     <div class="project mentalhealth">
                        <div class="projec_homecare">
                           <div class="homecare_img"><img src="<?=env('UPLOADS_URL')?>team/<?=$teamMember->image?>" alt="<?=$teamMember->name?>"></div>
                           <div class="homecare_info">
                              <h3><?=$teamMember->name?></h3>
                              <h5><?=$teamMember->designation?></h5>
                              <h3><?=$teamMember->qualification?></h3>
                              <h4>(<?=$teamMember->experience?>)</h4>
                              <a href="<?=url('team-member-profile/'.Helper::encoded($teamMember->id))?>">View Profile</a>
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
<!-- ********|| Home Success Stories END ||******** -->
<!-- ********|| Home Success Stories STARTS ||******** -->
<!-- ********|| Home Success Stories End ||******** -->
<!-- ********|| Home 3 button Start ||******** -->
<!-- ********|| Home 3 button End ||******** -->