<?php if($page){?>
<!-- ********|| BANNER STARTS ||******** -->
<div class="inner_slider_section">
   <div class="container-fluid px-0">
      <div class="innerpage_banner">
         <div class="innerbanner_img">
            <?php if($page->page_banner_image != ''){?>
               <img src="<?=env('UPLOADS_URL')?>page/<?=$page->page_banner_image?>" alt="<?=$page->page_name?>">
            <?php }?>
         </div>
         <div class="innerbanner_bredcum">
            <h1><?=$page_header?></h1>
            <ul>
               <li><a href="<?=url('/')?>">Home</a></li>
               <li>/</li>
               <li><?=$page_header?></li>
            </ul>
         </div>
      </div>
   </div>
</div>
<!-- ********|| BANNER ENDS ||******** -->
<section class="about_section_two">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h3><?=$page_header?></h3>
         </div>
         <div class="col-md-6">
            <p><?=$page->page_content?></p>
         </div>
         <div class="col-md-6">
            <div class="rightvideop">
               <!-- <a href="https://player.vimeo.com/video/80629469" data-toggle="lightbox"> -->
               <?php if($page->page_image != ''){?>
                  <img src="<?=env('UPLOADS_URL')?>page/<?=$page->page_image?>" alt="<?=$page_header?>">
               <?php }?>
               <!-- <i class="fa-regular fa-circle-play"></i>
               </a> -->
            </div>
         </div>
      </div>
   </div>
</section>
<?php }?>