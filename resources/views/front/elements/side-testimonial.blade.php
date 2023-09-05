<?php use App\Helpers\Helper;?>
<?php if($testimonials){ foreach($testimonials as $row){?>
   <div class="testmoric_item">
      <div class="testimor_quote"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/testi_qutationo.png" alt="icon"></div>
      <div class="testimori_content"><?=$row->review?></div>
      <div class="testomori_profile">
         <div class="testmori_prof_img"><img src="<?=env('UPLOADS_URL')?>testimonial/<?=$row->image?>" alt="<?=$row->name?>"></div>
         <div class="testmori_name">
            <h3><?=$row->name?></h3>
            <h5><?=$row->designation?></h5>
         </div>
      </div>
   </div>
<?php } }?>