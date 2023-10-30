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
                     <span class="text-danger">* Required</span>
                     <input type="text" class="form-control requiredCheck" name="fname" id="fname" placeholder="First name" data-check="First name">
                  </div>
                  <div class="form-group">
                     <span class="text-danger">* Required</span>
                     <input type="text" class="form-control requiredCheck" name="lname" id="lname" placeholder="Last name" data-check="Last name">
                  </div>
                  <div class="form-group">
                     <span class="text-danger">* Required</span>
                     <input type="email" class="form-control requiredCheck" name="email" id="email" placeholder="Email address" data-check="Email address">
                  </div>
                  <div class="form-group">
                     <span class="text-danger">* Required</span>
                     <input type="tel" class="form-control requiredCheck" name="phone" id="phone" placeholder="Phone number" data-check="Phone number">
                  </div>
                  <div class="form-group">
                     <span class="text-danger">* Required</span>
                     <input type="password" class="form-control requiredCheck" name="password" id="password" placeholder="Set password" data-check="Set password">
                     <i class="fa-regular fa-eye" id="togglePassword" onclick="getEyeOpen2();"></i>
                     <i class="fa-regular fa-eye-slash" id="togglePassword2" onclick="getEyeClose2();" style="display:none;"></i>
                  </div>
                  <div class="form-group">
                     <span class="text-danger">* Required</span>
                     <input type="password" class="form-control requiredCheck" name="confirm_password" id="confirm_password" placeholder="Confirm password" data-check="Confirm password">
                     <i class="fa-regular fa-eye" id="togglePassword11" onclick="getEyeOpen2();"></i>
                     <i class="fa-regular fa-eye-slash" id="togglePassword22" onclick="getEyeClose2();" style="display:none;"></i>
                  </div>

                  <div class="form-group">
                     <select class="form-control" name="doc_type" id="doc_type">
                        <option value="" selected>Select Document</option>
                        <?php if($documents){ foreach($documents as $document){?>
                        <option value="<?=$document->id?>"><?=$document->document?></option>
                        <?php } }?>
                     </select>
                  </div>
                  <div class="form-group">
                     <input type="file" class="form-control" name="user_doc" id="fileName" placeholder="Confirm password" data-check="Upload Document" accept="image/png, image/gif, image/jpeg, application/pdf" onchange="validateFileType(this)">
                     <span class="text-primary">Only jpg, jpeg, png & pdf files & less than 2 MB files are allowed</span>
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