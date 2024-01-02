<!-- ********|| BANNER STARTS ||******** -->
<div class="inner_slider_section">
   <div class="container-fluid px-0">
      <div class="innerpage_banner">
         <div class="innerbanner_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/mentors-for-12th-board-banner.jpg" alt="banner"></div>
         <div class="innerbanner_bredcum">
            <h1>Mentors for 12th Board</h1>
            <ul>
               <li><a href="<?=url('/')?>">Home</a></li>
               <li>/</li>
               <li>Mentors for 12th Board</li>
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
               <h2>Mentors for 12th Board</h2>
            </div>
         </div>
         <div class="col-lg-12">
            <p>Don't wait and stress over 12th boards preparation, ace your exams by booking board counseling sessions from the list of expert mentors below!</p>
         </div>
      </div>  
      <div class="row my-5">
         <div class="col-md-12">
            <section class="home_career_section">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <h2>Designed to help students with career choice</h2>
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
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div> 
      <div class="row mb-5">
         <div class="col-lg-12">
            <p class="pb-2">Preparing for Board exams is one of the most stressful things students encounter during their career journey and everyone knows the importance of 12th boards </p>
            <p class="pb-2">Twelfth class board exams set the tone for the whole career, the graduate program, the college a student will opt for and essentially for the future career path the student will take. Not only 12th boards are a vital cog in the career wheel but they also play a major role in competitive exam preparation whether it is IIT-JEE or NEET or CUET. Every competitive exam draws from the syllabus of 12th boards and delves deeper into it. Hence 12th boards become a major milestone in a students career journey to say the least.</p>
            <p class="pb-2">If a student is well prepared with proper guidance on what path to take after 12th, board exams become easier to tackle and instead of becoming a hurdle become a milestone in the career journey. </p>
            <p class="pb-2">Since students prepare simultaneously for competitive exams and 12th boards, factors such as time management, stress management, topic wise insights, data driven insights, roadmap, fast track preparation etc. become major contributors for future goals.</p>
            <p class="pb-2">With MentorVert’s highly skilled and experienced mentors offering board counseling, mental health counseling, study plans, scientific time management techniques, stress management, step by step syllabus management guidance, data driven insights into the board exam patterns and crash courses for 12th boards, preparing for boards becomes an easy task for students.</p>
            <p class="my-4 text-center"><a class="btn_orgfill" href="/mentors">Book Your Session</a></p>
         </div>
      </div>
   </div>
</section>

<!-- ********|| Home content ENDS ||******** -->

