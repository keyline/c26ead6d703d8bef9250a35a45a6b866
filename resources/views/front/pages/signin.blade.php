<section class="login-section">
   <div class="container">
      <div class="row justify-content-around">
         <div class="col-lg-5 col-md-6 col-sm-6">
            <div class="login-box rounded-top">
               <div class="icon-box-1">
                  <img src="<?=env('FRONT_ASSETS_URL')?>assets/images/lamp.webp" alt="">
               </div>
               <h3>Hi, you can signin from here</h3>
               @if(session('success_message'))
                  <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide" role="alert">
                    {{ session('success_message') }}
                  </div>
               @endif
               @if(session('error_message'))
                  <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
                    {{ session('error_message') }}
                  </div>
               @endif
               <form method="POST" id="signin_form" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <div class="form-group">
                     <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required>
                  </div>
                  <div class="form-group form_password">
                     <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                     <i class="fa-regular fa-eye" id="togglePassword" onclick="getEyeOpen();"></i>
                     <i class="fa-regular fa-eye-slash" id="togglePassword2" onclick="getEyeClose();" style="display:none;"></i>
                  </div>
                  <div class="form-group d-flex align-items-center">
                     <input type="checkbox" name="" id="remember_me" class="me-2"> <span class="text-muted"><label for="remember_me">Remember me</label></span>
                     <a href="<?=url('forgot-password')?>" class="ms-auto">Forgot Password?</a>
                  </div>
                  <div class="form-group">
                     <button class="login-btn" type="submit">Sign In</button>
                  </div>
               </form>
               <div class="form-group">
                  <p>
                     <span>Don't have an account? <a href="<?=url('mentor-signup')?>"> Mentor Sign Up</a></span>
                     <span style="float: right;"><a href="<?=url('student-signup')?>"> Student Sign Up</a></span>
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