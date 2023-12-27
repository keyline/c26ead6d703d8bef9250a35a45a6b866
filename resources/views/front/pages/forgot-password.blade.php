<section class="login-section singup-section">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-8 col-sm-8">
            <div class="login-box forgot-pass-box">
               <div class="icon-box-1">
                  <img src="<?=env('FRONT_ASSETS_URL')?>assets/images/lamp.webp" alt="">
               </div>
               <h3>Find your account</h3>
               <p class="text-center">Please enter email address to find your account.</p>
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
                <form method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                     <input type="text" class="form-control" placeholder="Email address" name="email" id="email" required>
                  </div>
                  <div class="form-group">
                     <button type="submit" class="login-btn">Submit</button>
                  </div>
               </form>
               <div class="form-group">
                  <p>Already have an account? <a href="<?=url('signin')?>"> Sign In</a></p>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="rightside_testslider">
               <div class="login_sidebar_testimorial">
                  <?=$platformReviewData?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>