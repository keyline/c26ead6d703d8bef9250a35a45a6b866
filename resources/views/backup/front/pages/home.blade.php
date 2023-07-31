<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="inside_banner">
                  <h1>Get all your transition done using out platform</h1>
                  <p>
                    Find jobs on us, the job search app built to help you every step
                    of the way. Get free access to millions of job postings
                    personalize your search and submit job applications
                  </p>
                  <a href="#" class="theme-btn">Get started now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="help">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4">
          <div class="help-content">
            <h1>How We Can Help</h1>
            <p>
              We are the largest independent job board, register your CV to
              applying today. With simple search tool and instant job matches
              delivered to your inbox, it’s never been easear to land a new
              job with us.
            </p>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-4 child-class">
              <div class="help_card">
                <div class="counter"><div>01</div></div>
                <h4>Create Account</h4>
                <p>
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s content1
                </p>
              </div>
            </div>
            <div class="col-lg-4 child-class">
              <div class="help_card">
                <div class="counter"><div>02</div></div>
                <h4>Select Membership</h4>
                <p>
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s content2
                </p>
              </div>
            </div>
            <div class="col-lg-4 child-class">
              <div class="help_card">
                <div class="counter"><div>03</div></div>
                <h4>Get the transition done</h4>
                <p>
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s content3
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<section class="testimonial">
  <div class="container">
    <h1 class="sec_title">What People Say</h1>
    <div class="owl-carousel owl-theme" id="testimonial">
      <?php if($testimonials){ foreach($testimonials as $row){?>
        <div class="item">
          <div class="testimonial_iner">
            <div class="row align-items-center">
              <div class="col-lg-3">
               <div class="test_left">
                <img src="<?=env('UPLOADS_URL').'testimonial/'.$row->image?>" alt="<?=$row->name?>" class="img-fluid">
               </div>
              </div>
              <div class="col-lg-9">
               <div class="test-right">
                <p><?=$row->review?></p>
                <ul>
                   <li>
                    <h4><?=$row->name?></h4>
                    <h5><?=$row->designation?>, <?=$row->company_name?></h5>
                   </li>
                   <li><img src="<?=env('UPLOADS_URL').'testimonial/'.$row->company_logo?>" alt="<?=$row->company_name?>" class="img-fluid"></li>
                </ul>
               </div>
              </div>
            </div>
          </div>
        </div>
      <?php } }?>
    </div>     
  </div>
</section>