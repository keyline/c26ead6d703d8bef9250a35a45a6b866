<style type="text/css">
   .load-more-content {
         display: none;
    }
    .noContent {
         /*color: #000 !important;
         background-color: transparent !important;
         pointer-events: none;*/
    }
</style>
<!-- ********|| BANNER STARTS ||******** -->
<div class="inner_slider_section">
   <div class="container-fluid px-0">
      <div class="innerpage_banner">
         <div class="innerbanner_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/blogbanner.jpg" alt="banner"></div>
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
<section class="blog_listing">
   <div class="container">
      
         <div class="row justify-content-center">
            <div class="col-md-6">
               <div class="blog_latestview">
                  <a href="<?=url('/blog-details/'.$firstBlog->slug)?>">
                     <div class="bloglate_img"><img src="<?=env('UPLOADS_URL')?>blog/<?=$firstBlog->image?>" alt="<?=$firstBlog->title?>"></div>
                     <div class="bloglate_info">
                        <h3><?=$firstBlog->title?></h3>
                        <ul>
                           <li><i class="fa-solid fa-user"></i> <?=$firstBlog->post_by?></li>
                           <li><i class="fa-regular fa-calendar-days"></i> <?=date_format(date_create($firstBlog->content_date), "M d, Y")?></li>
                           <li><i class="fa-regular fa-clock"></i> <?=date_format(date_create($firstBlog->created_at), "h:i A")?></li>
                        </ul>
                     </div>
                  </a>
               </div>
            </div>
         </div>

         <?php if($blogs){ $i=1;?>
         <div class="row">
            <div class="col-md-12">
               <div class="blog_resent_title">Recent articles</div>
            </div>
            <?php foreach($blogs as $blog){?>
               <?php if($i > 1){?>
                  <div class="col-md-4 load-more-content">
                     <div class="blog_list_item">
                        <a href="<?=url('/blog-details/'.$blog->slug)?>">
                           <div class="blogitem_img">
                              <img src="<?=env('UPLOADS_URL')?>blog/<?=$blog->image?>" alt="<?=$blog->title?>" style="height: 300px;">
                           </div>
                           <div class="blogitem_detials">
                              <ul class="blogitem_cat">
                                 <li><?=$blog->name?></li>
                              </ul>
                              <p class="u-text-p8 u-mb-sm u-mt-md u-text-gray-700">
                                 <span class="ps-2"><?=date_format(date_create($blog->content_date), "M d, Y")?></span> | <span class="ps-2"><?=$blog->post_by?></span> | <span class="pe-2"><?=date_format(date_create($blog->created_at), "h:i A")?></span>
                              </p>
                              <h3><?=$blog->title?></h3>
                              <p class="shortdes"><?=$blog->short_description?></p>
                           </div>
                        </a>
                     </div>
                  </div>
               <?php } ?>
            <?php $i++; }?>
            
         </div>
         <?php if(count($blogs) > 4){?>
            <div class="row">
               <div class="d-flex justify-content-center">
                  <div class="col-md-5">&nbsp;</div>
                  <div class="col-md-2"><button class="login-btn" id="load-more">Load More <img src="<?=env('FRONT_ASSETS_URL')?>assets/images/Pulse-1s-200px.gif" id="load-more-loader" style="width: 30px; display:none;"></button></div>
                  <div class="col-md-5">&nbsp;</div>
               </div>
            </div>
         <?php }?>
         <?php }?>
   </div>
</section>
<!-- ********|| Home 3 button Start ||******** -->
<!-- ********|| Home 3 button End ||******** -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready (function () {    
        $(".load-more-content").slice(0, 9).show();
        $("#load-more").on("click", function(e){
            e.preventDefault();
            $('#load-more-loader').show();
            $(".load-more-content:hidden").slice(0, 9).slideDown();
            $('#load-more-loader').hide();
            if ($(".load-more-content:hidden").length == 0) {
              // $("#load-more").text("No More Resources").addClass("noContent");
               $('#load-more').hide();
            }
        });
    })
</script>