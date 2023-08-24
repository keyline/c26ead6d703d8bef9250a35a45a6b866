<section class="login-section singup-section">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-8 col-sm-8">
            <div class="login-box signup-box">
               <div class="icon-box-1">
                  <img src="<?=env('FRONT_ASSETS_URL')?>assets/images/lamp.webp" alt="">
               </div>
               <h3>Welcome!</h3>
               <form action="" id="signup_form" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" class="form-control" name="key" id="key" value="facb6e0a6fcbe200dca2fb60dec75be7">
                  <input type="hidden" class="form-control" name="source" id="source" value="WEB">
                  <div class="form-group">
                     <input type="text" class="form-control requiredCheck" name="fname" id="fname" placeholder="First name" data-check="First name">
                  </div>
                  <div class="form-group">
                     <input type="text" class="form-control requiredCheck" name="lname" id="lname" placeholder="Last name" data-check="Last name">
                  </div>
                  <div class="form-group">
                     <input type="email" class="form-control requiredCheck" name="email" id="email" placeholder="Email address" data-check="Email address">
                  </div>
                  <div class="form-group">
                     <input type="tel" class="form-control requiredCheck" name="phone" id="phone" placeholder="Phone number" data-check="Phone number">
                  </div>
                  <div class="form-group">
                     <input type="password" class="form-control requiredCheck" name="password" id="password" placeholder="Set password" data-check="Set password">
                  </div>
                  <div class="form-group">
                     <input type="password" class="form-control requiredCheck" name="confirm_password" id="confirm_password" placeholder="Confirm password" data-check="Confirm password">
                  </div>
                  <div class="form-group">
                     <button type="submit" class="login-btn">Sign Up</button>
                  </div>
               </form>
               <div class="form-group">
                  <p>
                     <span>Already have an account? <a href="<?=url('signin')?>"> Sign In</a></span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="rightside_testslider">
               <div class="login_sidebar_testimorial">
                  <?=$testimonialsData?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>