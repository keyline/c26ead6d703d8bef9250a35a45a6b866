<section class="login-section singup-section">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-8 col-sm-8">
            <div class="login-box validate-otp-box">
               <div class="icon-box-1">
                  <img src="<?=env('FRONT_ASSETS_URL')?>assets/images/lamp.webp" alt="">
               </div>
               <h3>Enter Your Verification Code</h3>
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
                  <input type="hidden" class="form-control" name="id" id="id" value="<?=$id?>">
                  <div class="form-group d-flex justify-content-center">
                     <input type="password" name="otp1" class="otpInput" id="otp1" maxlength="1" required>
                     <input type="password" name="otp2" class="otpInput" id="otp2" maxlength="1" required>
                     <input type="password" name="otp3" class="otpInput" id="otp3" maxlength="1" required>
                     <input type="password" name="otp4" class="otpInput" id="otp4" maxlength="1" required>
                     <input type="password" name="otp5" class="otpInput" id="otp5" maxlength="1" required>
                     <input type="password" name="otp6" class="otpInput" id="otp6" maxlength="1" required>
                  </div>
                  <!-- <div class="invalid-feedback">Please enter your otp.</div> -->
                  <div class="form-group">
                     <button type="submit" class="login-btn">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>