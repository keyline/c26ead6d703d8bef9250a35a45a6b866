<section class="blogdetails_item">
   <div class="container">
      <div class="row">
         <div class="col-lg-3 col-md-12">
              <div id="sticky-sidebar-demo" class="sidebar fixed-sidebar">
               <h5 class="nav-title">Table of contents</h5>
                  <?php if($blogContents){ foreach($blogContents as $blogContent){?>
                  <a class="anchor_links_nav_health_guides" href="#<?=$blogContent->table_of_content_slug?>"><?=$blogContent->table_of_content?></a> 
                  <?php } }?>
            </div>
            
         </div>
         <div class="col-lg-7 col-md-12">
            <div class="blogdetials_innerpart">
               <h1><?=$firstBlog->title?></h3>
               <ul class="blogitem_cat">
                  <!-- <li>Brand</li> -->
                  <li><?=$firstBlog->name?></li>
               </ul>
               <ul class="blog_meta">
                  <li><i class="fa-solid fa-user"></i> <?=$firstBlog->post_by?></li>
                  <li><i class="fa-regular fa-calendar-days"></i> <?=date_format(date_create($firstBlog->content_date), "M d, Y")?></li>
                  <li><i class="fa-regular fa-clock"></i> <?=date_format(date_create($firstBlog->created_at), "h:i A")?></li>
               </ul>
               
               <div class="blogdetails_fullimage">
                  <img src="<?=env('UPLOADS_URL')?>blog/<?=$firstBlog->image?>" alt="<?=$firstBlog->title?>">
               </div>
               
               <div id="links-box" class="blogdetial_infomation">
                  <p><?=$firstBlog->description?></p>
                  <?php if($blogContents){ foreach($blogContents as $blogContent){?>
                     <h2 id="<?=$blogContent->table_of_content_slug?>"><strong><?=$blogContent->table_of_content?></strong></h2>

                     <?=$blogContent->content?>

                     <div class="medical-disclaimer disclaimer-copy">
                        <h4>Summary</h4>
                        <p><?=$blogContent->summary?></p>
                     </div>
                  <?php } }?>
               </div>
               
               <div class="blogdetails_share">
                  <ul>
                     <li><a href="javascript:void(0);" class="blogshare" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                     <li><a href="javascript:void(0);" class="blogshare" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                     <li><a href="javascript:void(0);" class="blogshare" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-lg-2 col-md-12">
            <div id="sticky-sidebar-cateogy" class="categroy_relate">
               <h5 class="nav-title">Recent Category</h5>
               <ul>
                  <?php if($recentBlogs){ foreach($recentBlogs as $recentBlog){?>
                  <li><a href="<?=url('/blog-details/'.$recentBlog->slug)?>"><?=$recentBlog->title?></a></li>
                  <?php } }?>
               </ul>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="blog_listing">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="blog_resent_title">Related articles</div>
         </div>
         <div class="col-md-12">
            <div id="blogdetails-recent" class="owl-carousel owl-theme">
               <?php if($relatedArticles){ foreach($relatedArticles as $recentBlog){?>
                  <div class="item">
                     <div class="blog_list_item">
                        <a href="<?=url('/blog-details/'.$recentBlog->slug)?>">
                           <div class="blogitem_img">
                              <img src="<?=env('UPLOADS_URL')?>blog/<?=$recentBlog->image?>" alt="<?=$recentBlog->title?>" style="height: 250px;">
                           </div>
                           <div class="blogitem_detials">
                              <p class="u-text-p8 u-mb-sm u-mt-md u-text-gray-700">
                                 <span class="pe-2"><?=$recentBlog->post_by?></span> | <span class="ps-2"><?=date_format(date_create($recentBlog->content_date), "M d, Y")?></span> | <span class="ps-2"><?=date_format(date_create($recentBlog->created_at), "h:i A")?></span>
                              </p>
                              <h3><?=$recentBlog->title?></h3>
                              <p class="shortdes"><?=$recentBlog->short_description?></p>
                           </div>
                        </a>
                     </div>
                  </div>
               <?php } }?>
            </div>
         </div>         
      </div>
   </div>
</section>