<footer class="footer">
   <div class="container">
      <div class="row">
         <div class="col-lg-4 col-md-6">
            <div class="footer_left">
               <div class="footer_logo">
                  <a href="<?=url('/')?>"><img class="img-fluid" src="<?=env('UPLOADS_URL').$generalSetting->site_footer_logo?>" alt="<?=$generalSetting->site_name?>"></a>
               </div>
               <div class="foot-righttop">
                  <ul>
                     <?php
                     $footer_link_name = (($generalSetting->footer_link_name != '')?json_decode($generalSetting->footer_link_name):[]);
                     $footer_link = (($generalSetting->footer_link != '')?json_decode($generalSetting->footer_link):[]);
                     if(!empty($footer_link_name)){ for($i=0;$i<count($footer_link_name);$i++){
                     ?>
                        <li><a href="<?=url('/')?>/<?=(($footer_link[$i] == 'home')?'':$footer_link[$i])?>"><?=$footer_link_name[$i]?></a></li>
                     <?php } }?>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-lg-5 col-md-6">
            <div class="foot_middlemenu">
               <div class="foot_midle_left">
                  <h5>Get Help</h5>
                  <ul>
                     <?php
                     $footer_link_name2 = (($generalSetting->footer_link_name2 != '')?json_decode($generalSetting->footer_link_name2):[]);
                     $footer_link2 = (($generalSetting->footer_link2 != '')?json_decode($generalSetting->footer_link2):[]);
                     if(!empty($footer_link_name2)){ for($i=0;$i<count($footer_link_name2);$i++){
                     ?>
                        <li><a href="<?=url('/')?>/<?=(($footer_link2[$i] == 'home')?'':$footer_link2[$i])?>"><?=$footer_link_name2[$i]?></a></li>
                     <?php } }?>
                  </ul>
               </div>
               <div class="foot_midle_left">
                  <h5>SERVICES</h5>
                  <ul>
                     <?php
                     $footer_link_name3 = (($generalSetting->footer_link_name3 != '')?json_decode($generalSetting->footer_link_name3):[]);
                     $footer_link3 = (($generalSetting->footer_link3 != '')?json_decode($generalSetting->footer_link2):[]);
                     if(!empty($footer_link_name3)){ for($i=0;$i<count($footer_link_name3);$i++){
                     ?>
                        <li><a href="<?=url('/')?>/<?=(($footer_link3[$i] == 'home')?'':$footer_link3[$i])?>"><?=$footer_link_name3[$i]?></a></li>
                     <?php } }?>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-12 paddingfoot-left">
            <div class="footer_rightadd">
               <div class="footer_icon">
                  <ul>
                     <!-- <li class="foot_location">
                        <div class="footer_fa"><i class="zmdi zmdi-phone"></i></div>
                        <p><?=$generalSetting->site_phone?></p>
                     </li> -->
                     <li>
                        <div class="footer_fa"><a href="tel:<?=$generalSetting->site_phone?>"><i class="zmdi zmdi-smartphone-android"></i></a></div>
                        <p><a href="tel:<?=$generalSetting->site_phone?>"><?=$generalSetting->site_phone?> </a></p>
                     </li>
                     <li>
                        <div class="footer_fa"><a href="mailto:<?=$generalSetting->site_mail?>"><i class="zmdi zmdi-email-open"></i></a></div>
                        <p><a href="mailto:<?=$generalSetting->site_mail?>"><?=$generalSetting->site_mail?></p>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-9 offset-lg-3">
            <div class="footer_freetrail_section">
               <div class="foot_trialtext">Start your free trial <a class="btn_orgfill" href="<?=route('mentor.signup')?>">Sign up free</a></div>
               <div class="footer_social">
                  <ul>
                     <li><a href="<?=$generalSetting->facebook_profile?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                     <li><a href="<?=$generalSetting->twitter_profile?>" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                     <li><a href="<?=$generalSetting->instagram_profile?>" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                     <li><a href="<?=$generalSetting->linkedin_profile?>" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a></li>
                     <li><a href="<?=$generalSetting->youtube_profile?>" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
<div class="footer_copyright">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <hr>
         </div>
         <div class="col-lg-6 col-md-6">
            <div class="footercopytext">All right reserved: © <?=date('Y')?> <?=$generalSetting->site_name?></div>
         </div>
         <div class="col-lg-6 col-md-6">
            <div class="footercopytext footdesign">Designed & Developed by <a href="https://keylines.net/" target="_blank" class="uppercase" style="color:#818181; text-decoration: none;">Keyline</a></div>
         </div>
      </div>
   </div>
</div>