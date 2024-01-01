<!-- ********|| Home content STARTS ||******** -->
<section class="static_section">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="innerpage_title">
               <h2>Career Counseling 11-12th</h2>
            </div>
         </div>
         <div class="col-lg-12">
            <p>Choose from a number of experienced mentors below and book counseling sessions in 2 clicks to start making the right decisions right after 11-12th.</p>
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
            <p class="pb-2">Career Counseling is the need of the hour in India today. For ages students have been made to follow the same template of completing education and degrees where the student does not really know anything about the career he or she is choosing until it is too late to change the path they are on. It is not only the education system but our societal set up that also contributes to misfit students in career paths they don't really belong to. No wonder India is producing students who are not industry ready after completing graduation and post graduation degrees.</p>
            <p class="pb-2">The solution? Career guidance and counseling that is readily available. Online career counseling for 11-12th is one such option that students can explore from the comfort of their homes. WIth quality career counseling students can understand their strengths and weaknesses, personality types, career-personality fit and opt for careers right at the outset of their journey.</p>
            <p class="pb-2">This is why career counseling for 11-12th becomes so critical for students. It is during this time that the career decisions about graduate programs and competitive exams are taken albeit without proper knowledge and guidance such as college selection, course choices and competitive exams to aim for. </p>
            <p class="pb-2">We at MentroVert aim to educate students and parents alike about the choices and options available to the students to help them opt for the right path and chalk out long term career goals based on their personalities and career fit. Our expert mentors provide in depth career guidance starting from 11th to help students begin on the front foot.</p>
            <p class="my-4 text-center"><a class="btn_orgfill" href="/mentors">Book Your Session</a></p>
         </div>
      </div>
   </div>
</section>

<!-- ********|| Home content ENDS ||******** -->

