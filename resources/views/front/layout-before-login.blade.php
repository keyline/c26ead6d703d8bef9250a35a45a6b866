<?php
use Illuminate\Support\Facades\Route;;
$routeName = Route::current();
$pageName = $routeName->uri();
?>
<!doctype html>
<html lang="en">
   <head>
      <?=$head?>
   </head>
   <body>
      <!-- ********|| HEADER START ||******** -->
      <header class="header">
         <?=$header?>
      </header>
      <!-- ********|| HEADER ENDS ||******** -->
      <?=$maincontent?>
      <!--    FOOTER STARTS-->
      <?=$footer?>
      <!--    FOOTER ENDS-->
      <!--    Sticky Start-->
      <div class="stictyleft_soaial">
         <ul>
            <li><a href="<?=$generalSetting->facebook_profile?>" class="stiky_face" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li><a href="<?=$generalSetting->twitter_profile?>" class="stiky_twi" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="<?=$generalSetting->linkedin_profile?>" class="stiky_pint" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a></li>
            <li><a href="<?=$generalSetting->instagram_profile?>" class="stiky_insta" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="<?=$generalSetting->youtube_profile?>" class="stiky_youtub" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
         </ul>
      </div>
      <!--    Sticky ENDS-->
      <!--      BACK TO TOP ENDS-->
      <!-- <a href="#top" class="top scrolltop"><i class="zmdi zmdi-chevron-up"></i></a>  -->
      <!-- Modal -->
      <!-- Optional JavaScript; choose one of the two! -->
      <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/bootstrap/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
      <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/jquery.serialtabs.js"></script>
      <?php if(($pageName == 'blogs') || ($pageName == 'blog-details/{id}') || ($pageName == 'team-member-profile/{id}')){?>
      <script src="https://www.jquery-az.com/jquery/js/sticky-sidebar/sticky-sidebar.js"></script>
      <?php }?>
      <?php if(($pageName == 'how-it-works') || ($pageName == 'signin') || ($pageName == 'forgot-password') || ($pageName == 'validate-otp') || ($pageName == 'reset-password') || ($pageName == 'student-signup') || ($pageName == 'mentor-signup') || ($pageName == 'mentor-signup-2') || ($pageName == 'mentor-signup-3') || ($pageName == 'mentor-signup-4') || ($pageName == 'team-member-profile/{id}')){?>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
      <?php }?>
      <script defer type="text/javascript" src="<?=env('FRONT_ASSETS_URL')?>assets/js/script.js"></script>
      <script src="<?=env('FRONT_ASSETS_URL')?>assets/owl/owl-min.js"></script>
      
      <?php if(($pageName == 'mentor-signup-4') || ($pageName == 'team-member-profile/{id}')){?>
      <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/bvselect.js"></script>
      <?php }?>

      <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/easyResponsiveTabs.js"></script>
      <script type="text/javascript">
         (function() {
         'use strict'
         document.querySelector('#myNavbarToggler4').addEventListener('click', function() {
         document.querySelector('.offcanvas-collapse').classList.toggle('open')
         })
         document.querySelector('.mobileclose').addEventListener('click', function() {
         document.querySelector('.offcanvas-collapse').classList.toggle('close');
         document.querySelector('.offcanvas-collapse').classList.remove('open')
         })
         })()
      </script>
      <script type="text/javascript">
         var a = new StickySidebar('#sticky-sidebar-demo', {
            topSpacing: 25,
            containerSelector: '.blogdetails_item',
            innerWrapperSelector: '.sidebar__inner'
         });
         
         var a = new StickySidebar('#sticky-sidebar-cateogy', {
            topSpacing: 25,
            containerSelector: '.blogdetails_item',
            innerWrapperSelector: '.sidebar__inner'
         });
      </script>
      <script>
         $(document).ready(function() {
           var x = $('#links-box a.anchor_links_nav_health_guides[href^="#"]')
           var count = 0
           for (let index = 0; index < x.length; index++) {
               count++
               $('<a>', {
                   class: 'item link',
                   href: '#'+x[index].href.split('#')[1],
                   text: x[index].text
               }).appendTo('.fixed-sidebar');
               $('<a>', {
                   class: 'item link',
                   href: '#'+x[index].href.split('#')[1],
                   text: x[index].text
               }).appendTo('.dropdown-health-guids-anchor');
               
           }
           if(count = 0) {
               $('.fixed-sidebar').hide();
           }
           $(".anchor_links_nav_health_guides").click(function() {
               // remove classes from all
               $(".anchor_links_nav_health_guides").removeClass("active");
               // add class to the one we clicked
               $(this).addClass("active");
           });
           $(window).scroll(function() {
               var scrollDistance = $(window).scrollTop();
           
               // Assign active class to nav links while scolling
               $('#links-box').children('h2').each(function(i) {
                   if ($(this).position().top <= scrollDistance) {
                       $('.sidebar a.active').removeClass('active');
                       $('.sidebar a').eq(i).addClass('active');
                   }
               });
           }).scroll();              
         });
      </script>
      <script>
         const otpInputs = document.querySelectorAll(".otpInput");
         otpInputs.forEach((input, index) => {
             input.addEventListener("input", function() {
                 if (this.value.length >= 1) {
                     if (index < otpInputs.length - 1) {
                         otpInputs[index + 1].focus();
                     }
                 }
             });
             input.addEventListener("keydown", function(event) {
                 if (event.key === "Backspace" && this.value.length === 0) {
                     if (index > 0) {
                         otpInputs[index - 1].focus();
                     }
                 }
             });
         });
      </script>
      <script>
         document.addEventListener("DOMContentLoaded", function() {
               var demo1 = new BVSelect({
                 selector: "#selectbox",
                 searchbox: false,
                 offset: false
               });
          var demo2 = new BVSelect({
                 selector: "#selectbox2",
                 searchbox: false,
                 offset: false
               });
             var demo3 = new BVSelect({
                 selector: "#selectbox3",
                 searchbox: false,
                 offset: false
               });
          var demo4 = new BVSelect({
                 selector: "#selectbox4",
                 searchbox: false,
                 offset: false
               });
          var demo5 = new BVSelect({
                 selector: "#selectbox5",
                 searchbox: false,
                 offset: false
               });
          var demo6 = new BVSelect({
                 selector: "#selectbox6",
                 searchbox: false,
                 offset: false
               });
                
         });
      </script>
   </body>
</html>