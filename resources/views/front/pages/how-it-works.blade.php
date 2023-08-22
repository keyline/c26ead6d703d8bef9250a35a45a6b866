<section class="login-section">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-12 col-md-12 col-sm-12 pb-5">
            <div class="howitswork_section">
               <div class="title text-center pb-5">
                  <h2><?=$page_header?></h2>
               </div>
               <?php if($howitworks){ $i=1;foreach($howitworks as $howitwork){?>
                  <div class="row align-items-center pb-5">
                     <div class="col-md-6 <?=(($i%2 == 0)?'mobile_order':'')?>"><img src="<?=env('UPLOADS_URL')?>how_it_work/<?=$howitwork->image?>" alt="<?=$howitwork->title?>"></div>
                     <div class="col-md-6">
                        <div class="howits_info">
                           <h3><?=$howitwork->title?></h3>
                           <p><?=$howitwork->description?></p>
                        </div>
                     </div>
                  </div>
               <?php $i++; } }?>
            </div>
            <div class="faq_section">
               <div class="title text-center pb-3">
                  <h2>FAQ</h2>
               </div>
               <div class="accordion" id="accordionExample">
                  <?php if($faqs){ $i=1;foreach($faqs as $faq){?>
                     <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?=$i?>">
                           <button class="accordion-button <?=(($i == 1)?'':'collapsed')?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapse<?=$i?>">
                           <?=$faq->question?>
                           </button>
                        </h2>
                        <div id="collapse<?=$i?>" class="accordion-collapse collapse <?=(($i == 1)?'show':'')?>" aria-labelledby="heading<?=$i?>" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                              <?=$faq->answer?>
                           </div>
                        </div>
                     </div>
                  <?php $i++; } }?>
               </div>
            </div>
         </div>
         <!-- <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="rightside_testslider">
               <div class="login_sidebar_testimorial">
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div> -->
      </div>
   </div>
</section>