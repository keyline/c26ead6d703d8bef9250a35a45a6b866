<!-- ********|| BANNER STARTS ||******** -->
<div class="inner_slider_section">
   <div class="container-fluid px-0">
      <div class="innerpage_banner">
         <div class="innerbanner_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/mentors-for-10th-board-banner.jpg" alt="banner"></div>
         <div class="innerbanner_bredcum">
            <h1>Mentors for 10th Board</h1>
            <ul>
               <li><a href="<?=url('/')?>">Home</a></li>
               <li>/</li>
               <li>Mentors for 10th Board</li>
            </ul>
         </div>
      </div>
   </div>
</div>
<!-- ********|| BANNER ENDS ||******** -->
<!-- ********|| Home content STARTS ||******** -->
<section class="static_section">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="innerpage_title">
               <h2>Mentors for 10th Board</h2>
            </div>
         </div>
         <div class="col-lg-12">
            <p class="text-center">Why wait and stress over 10th boards, ace your exams by booking board counseling sessions from the list of expert mentors below!</p>
         </div>
      </div>  
      <div class="row">
         <div class="col-md-12">
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
                        <a class="viewallvendor_btn" href="<?=url('mentors/')?>">View All Mentors</a>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div> 
      <div class="row mb-5">
         <div class="col-lg-12">
            <div class="static_boxarea">
               <p class="pb-2">Preparing for Board exams is one of the most stressful things students encounter during their career journey and everyone knows the importance of the first encounter with the boards. </p>
               <p class="pb-2">Tenth class board exams set the tone for the next step which is stream selection in 11th standard and competitive exam preparation, hence 10th boards carry that much more significance for a high school student.</p>
               <p class="pb-2">If a student is well prepared with good preparation and proper guidance on what path to take after 10th, the board exams become easier to tackle and instead of becoming a hurdle become a milestone in the career journey of the student.</p>
               <p class="pb-2">With MentorVert’s highly skilled and experienced mentors offering board counseling, mental health counseling, step by step guidance, study plans, data driven insights into the board exam patterns and crash courses for 10th boards, preparing for boards becomes an easy task for students.</p>
               <p class="my-4 text-center"><a class="btn_orgfill" href="/mentors">Book Your Session</a></p>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- ********|| Home content ENDS ||******** -->

