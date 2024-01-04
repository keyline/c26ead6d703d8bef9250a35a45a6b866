<!-- ********|| BANNER STARTS ||******** -->
<div class="inner_slider_section">
   <div class="container-fluid px-0">
      <div class="innerpage_banner">
         <div class="innerbanner_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/career-counseling-9-10th-banner.jpg" alt="banner"></div>
         <div class="innerbanner_bredcum">
            <h1>Career Counseling 9-10th</h1>
            <ul>
               <li><a href="<?=url('/')?>">Home</a></li>
               <li>/</li>
               <li>Career Counseling 9-10th</li>
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
               <h2>Career Counseling 9-10th</h2>
            </div>
         </div>
         <div class="col-lg-12">
            <p>Start making the right decisions right from the career onset journey from high school by booking counseling sessions with experienced mentors listed below in a couple of clicks.</p>
         </div>
      </div>  
      <div class="row my-5">
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
                        <a href="<?=url('mentors/')?>">View All Vendors</a>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div> 
      <div class="row mb-5">
         <div class="col-lg-12">
            <p class="pb-2">Career Counseling is the need of the hour in India today. For ages students have been made to follow the same template of completing education and degrees where the student does not really know anything about the career path he or she is choosing until it is too late to change the path they are on. It is not only the education system but our societal set up that also contributes to misfit students in career paths they don't really belong to.</p>
            <p class="pb-2">One of the best solutions that is now readily available from the comfort of one’s home nowadays is career counseling. WIth quality career counseling students can understand their strengths and weaknesses and opt for careers right at the outset of their journey.</p>
            <p class="pb-2">This is why career counseling for 9-10th becomes so critical for students. It is during high school that most of the career decisions are taken without proper knowledge and guidance such as stream selection, subject choices and competitive exams to aim for.</p>
            <p class="pb-2">We at MentroVert aim to educate students and parents alike about the choices and options available to the students so that they can opt for the right path and chalk out long term career goals based on their personalities and fit. Our expert mentors provide in depth career guidance starting from 10th to help students begin on the front foot.</p>
            <p class="my-4 text-center"><a class="btn_orgfill" href="/mentors">Book Your Session</a></p>
         </div>
      </div>
   </div>
</section>

<!-- ********|| Home content ENDS ||******** -->

