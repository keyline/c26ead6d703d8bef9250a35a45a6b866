<section class="login-section singup-section">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-8 col-sm-8">
            <div class="login-box validate-otp-box">
               <div class="icon-box-1">
                  <img src="<?=env('FRONT_ASSETS_URL')?>assets/images/lamp.webp" alt="">
               </div>
               <h3>Your verification code</h3>
               <form id="otpForm" method="POST" action="">
                  <div class="form-group d-flex justify-content-center">
                     <input type="text" name="otp1"    class="otpInput" id="otp1" maxlength="1" required>
                     <input type="text" name="otp2" class="otpInput" id="otp2" maxlength="1" required>
                     <input type="text" name="otp3" class="otpInput" id="otp3" maxlength="1" required>
                     <input type="text" name="otp4"  class="otpInput" id="otp4" maxlength="1" required>
                     <input type="text" name="otp5"  class="otpInput" id="otp5" maxlength="1" required>
                     <input type="text" name="otp6"  class="otpInput" id="otp6" maxlength="1" required>
                  </div>
                  <div class="invalid-feedback">Please enter your otp.</div>
                  <div class="form-group">
                     <button class="login-btn">Submit</button>
                  </div>
                  <!-- <div class="icon-box-2">
                     <img src="<?=env('FRONT_ASSETS_URL')?>assets/images/verification-icon.webp" alt="">
                     </div> -->
               </form>
            </div>
         </div>
      </div>
   </div>
</section>