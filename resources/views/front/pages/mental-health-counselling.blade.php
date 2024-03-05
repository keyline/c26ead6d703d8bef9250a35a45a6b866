<!-- ********|| BANNER STARTS ||******** -->
<div class="inner_slider_section">
   <div class="container-fluid px-0">
      <div class="innerpage_banner">
         <div class="innerbanner_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/mental-health-counselling-banner.jpg" alt="banner"></div>
         <div class="innerbanner_bredcum">
            <!-- <h1>Mental Health Counselling</h1>
            <ul>
               <li><a href="<?=url('/')?>">Home</a></li>
               <li>/</li>
               <li>Mental Health Counselling</li>
            </ul> -->
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
               <h2>Mental Health Counselling</h2>
            </div>
         </div>
         <div class="col-lg-12">
            <p class="text-center">Book 1:1 Mental health counseling sessions with MentoVert’s experienced counselors from the comfort of your home maintaining complete privacy and peace of mind.</p>
         </div>
      </div>  
      <div class="row ">
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
                                       <!-- <div class="homecare_info">
                                          <a href="<?=url('mentor-details/'.$mentorDisplayName.'/'.Helper::encoded($mentorId))?>">View Profile</a>
                                       </div> -->
                                       <div class="book-btn-div">
                                          <a href="<?=url('mentor-details/'.$mentorDisplayName.'/'.Helper::encoded($mentorId))?>" class="book-btn"><i class="fas fa-plus"></i> Book Your Slots</a>
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
               <p class="pb-2">Mental health is the most ignored aspect of one’s health in India and when it is about students, it becomes all the more important!</p>
               <p class="pb-2">Students are under tremendous stress because of factors such as peer pressure, parental expectations and academic performance pressure etc. It becomes imperative for students to take care of their mental health and well being because it can lead to undesirable outcomes in a number of cases. The lack of support and guidance is one of the most common reasons that leads to students not performing well, losing track of their goals and in some cases even losing their lives.</p>
               <p class="pb-2">Mental health counseling for students is needed now more than ever in a world that constantly demands high standards and performance from students. Mental health counseling with an expert counselor not only can help students cope with exam stress but can also help with their personal issues and equip them to handle every type of issue better.</p>
               <p class="my-4 text-center"><a class="btn_orgfill" href="/mentors">Book Your Session</a></p>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- ********|| Home content ENDS ||******** -->

