<meta property="og:title" content="<?=$firstBlog->title?>" />
<meta property="og:image" content="<?=env('UPLOADS_URL')?>blog/<?=$firstBlog->image?>" />
<meta property="og:description" content="<?=$firstBlog->title?>" />
<meta name="description" content="<?=$firstBlog->title?>">

<link rel="stylesheet" href="<?=env('FRONT_ASSETS_URL')?>assets/css/socialSharing.css">
<link rel="stylesheet" href="<?=env('FRONT_ASSETS_URL')?>assets/css/main.css">
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
                  <!-- <ul>
                     <li><a href="https://www.facebook.com/sharer.php?u=<?=env('APP_URL').$firstBlog->slug;?>" class="blogshare" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                     <li><a href="https://twitter.com/share?text=Visit the link &url=<?=env('APP_URL').$firstBlog->slug;?>" class="blogshare" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                     <li><a href="https://pinterest.com/pin/create/button/?url=<?=env('APP_URL').$firstBlog->slug;?>" class="blogshare" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a></li>
                  </ul> -->
               </div>
               <div id="Demo1" class="d-flex align-items-center justify-content-center mb-5"></div>
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
                              <p class="shortdes"><?= mb_strimwidth($recentBlog->short_description, 0, 180, "...."); ?></p>
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
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?=env('FRONT_ASSETS_URL')?>assets/js/socialSharing.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
      // alert();
        hljs.highlightAll();
    });
    $('#Demo1').socialSharingPlugin({
        url: window.location.href,
        title: $('meta[property="og:title"]').attr('content'),
        description: $('meta[property="og:description"]').attr('content'),
        img: $('meta[property="og:image"]').attr('content'),
        enable: ['copy', 'facebook', 'twitter', 'pinterest', 'linkedin']
    });
</script>