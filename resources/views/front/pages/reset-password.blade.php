<section class="login-section">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-8 col-sm-8">
            <div class="login-box reset-pass-box">
               <div class="icon-box-1">
                  <img src="<?=env('FRONT_ASSETS_URL')?>assets/images/lamp.webp" alt="">
               </div>
               <h3>Reset your password</h3>
               <p class="text-center">Now you can create new password</p>
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
                  <div class="form-group">
                     <input type="password" class="form-control" placeholder="Enter new password" id="password" name="password" required>
                  </div>
                  <div class="form-group">
                     <input type="password" class="form-control" placeholder="Confirm new password" id="confirm_password" name="confirm_password" required>
                  </div>
                  <div class="form-group">
                     <button type="submit" class="login-btn">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>