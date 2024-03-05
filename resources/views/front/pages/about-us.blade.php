<?php
use App\Helpers\Helper;
?>
<!-- ********|| BANNER STARTS ||******** -->
<div class="inner_slider_section">
   <div class="container-fluid px-0">
      <div class="innerpage_banner">
         <div class="innerbanner_img"><img src="<?=env('UPLOADS_URL')?>page/<?=$page->page_banner_image?>" alt="<?=$page->page_name?>"></div>
         <div class="innerbanner_bredcum">
            <!-- <h1><?=$page_header?></h1>
            <ul>
               <li><a href="<?=url('/')?>">Home</a></li>
               <li>/</li>
               <li><?=$page_header?></li>
            </ul>
         </div> -->
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
                  <h3>Education is everything!</h3>
                  <p>Education is what helps humans to enquire into deeper truths and helps human conscience grow to higher levels. We believe in education through self-enquiry and independence, and that a good mentor/counselor in life is instrumental to independent pursuits and is as important as a great teacher in class</p>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="about_details about_details_two">
               <div class="aboutdetails_info">
                  <h3>Committed to Students!</h3>
                  <p>We are a bunch of people who have worked closely with students and we want to contribute our part by helping as many students as we can by empowering them to make well researched and informed decisions!</p>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="about_details about_details_three">
               <div class="aboutdetails_info">
                  <h3>Community Building</h3>
                  <p>We at StuMento envisage a future where student communities drive the change from within to create an ecosystem of trust, growth and self sustainability. The target is to automate the evolution of the education system in India through student communities.</p>
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
            <div class="about_title">About Us</div>
         </div>
         <div class="col-md-12">
            <p>StuMento is the first of its kind platform in India devoted to student career and mental health. The platform connects students directly to career and mental health counselors and seeks to provide first hand personalized counseling  and support to students in need. </p>
            <p>We are aware that Indian students, particularly those in grades 9 through 12, face various difficulties as they traverse pivotal points in their academic and career journeys. This is a crucial time in the student’s life and almost everyone needs a mentor, a guide or a friend who can understand what they are going through.At StuMento, our mission is to provide students in grades 9 through 12 with thorough and individualized online career counseling, career assistance, and online mental health counseling.</p>
            <p>Our goal is to empower students by providing them with the information, resources, assistance and support  they require in order to make wise decisions regarding their well-being and careers. We genuinely think that having a strong foundation throughout these early years is essential to opening up a world of possibilities and obtaining happy</p>
            <h5>What Sets Us Apart:</h5>
            <ul class="listbullet">
               <li class="font16">Experienced Counselors: Our team of expert counselors comprises experienced professionals with a deep understanding of the Indian education system and industry trends. They are here to guide you through every step of your journey.</li>
               <li class="font16">Tailored Personalized Guidance: We recognize that each student is unique, and so are their dreams and aspirations. Our 1:1 counseling sessions are highly personalized, ensuring that the students receive guidance that is just right for them.</li>
               <li class="font16">Online Accessibility: We provide online career counseling and online mental health counseling, ensuring that you can access our services from the comfort of your home, making our platform convenient and accessible for students across India.</li>
               <li class="font16">Special Focus on 10th and 12th: We specialize in offering specialized counseling services for 10th and 12th-grade students. We understand the significance of these milestones in your academic journey and offer targeted support to help you make the best choices.</li>
               <li class="font16">Free Counseling sessions: We provide free counseling sessions for students willing to try our services or for those unable to finance themselves. An initiative to put students and their needs first before profits.</li>
               <li class="font16">On-demand Parental guidance: We guide and help parents to understand the issues, pressure and mental state of their children preparing for board exams or other competitive exams such as IIT and NEET.</li>
            </ul>
            <p>At StuMento, we are dedicated to providing students in India with the much needed support system to succeed academically and achieve overall mental well-being. We want to be every student’s partner in this exciting and challenging journey, and we look forward to helping you make informed decisions and embrace a brighter future..</p>
         </div>
      </div>   
   </div>
</section>
<!-- <section class="about_section_two">
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
               <img src="<?=env('FRONT_ASSETS_URL')?>assets/images/serv-img4.png" alt="banner">
               <img src="<?=env('UPLOADS_URL')?>page/<?=$page->page_image?>" alt="<?=$page_header?>">
               <i class="fa-regular fa-circle-play"></i>
               </a>
            </div>
         </div>
      </div>
   </div>
</section> -->

<section class="about_section_vission py-5">
   <div class="container">
      <div class="row">
         
         <div class="col-md-6">
            <div class="about_title">Our Vision</div>
            <p class="font18">Our goal is to create a future wherein no student underperforms or takes radical steps for the lack of help, counseling or guidance. A future in which students have an easily accessible strong support system and a community of peers and counselors that stands by them in every situation.</p>
         </div>
         <div class="col-md-6">
            <div class="about_title">Our Mission</div>
               <p class="font18">Our Mission is to provide every student in India, access to mentorship, counseling and guidance so that they can make informed decisions and excel in career and life. We understand that most of the students preparing for competitive exams are unable to express what they are experiencing and need help with tackling day to day challenges they face.  We aim to provide a clear direction in their career pursuits and at the same time ensure the mental well being of every student irrespective of  their location, background, financial status or other limitations. We believe that the role of a mentor/counselor is of the utmost importance at every stage in a student’s life, be it career counseling, interview prep or general issues.</p>
            </div>
      </div>   
   </div>
</section>

<?php if($owner){?>
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
<?php }?>
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
            <div id="ourteam-carousel" class="owl-carousel" style="display: flex;justify-content: center;">
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