<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://www.google.com/recaptcha/api.js?render=<?=env('recaptcha3.key')?>"></script>
<script type="text/javascript">
   function onSubmit(e) {
      e.preventDefault();
      grecaptcha.ready(function() {
            grecaptcha.execute("<?= getenv('recaptcha3.key') ?>", {action: 'submit'}).then(function(token) {
               document.getElementById("recaptcha_response").value = token;
               document.getElementById("admin_loginfrm").submit();
            });
      });
   }
</script>
<!-- ********|| BANNER STARTS ||******** -->
<div class="inner_slider_section">
   <div class="container-fluid px-0">
      <div class="innerpage_banner">
         <div class="innerbanner_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/contactbanner.jpg" alt="banner"></div>
         <div class="innerbanner_bredcum">
            <!-- <h1><?=$page_header?></h1>
            <ul>
               <li><a href="<?=url('/')?>">Home</a></li>
               <li>/</li>
               <li><?=$page_header?></li>
            </ul> -->
         </div>
      </div>
   </div>
</div>
<!-- ********|| BANNER ENDS ||******** -->
<section class="contact-section">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-12">
            <div class="wrapper">
               <div class="row no-gutters">
                  <div class="col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
                     <div class="contact-wrap w-100 p-md-5 p-4">
                        <h3 class="mb-4">Get in touch</h3>
                        <!-- <div id="form-message-warning" class="mb-4"></div> -->
                        <div class="row">
                           <div class="col-xl-12">
                              @if(session('success_message'))
                                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide" role="alert">
                                  {{ session('success_message') }}
                                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                              @endif
                              @if(session('error_message'))
                                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
                                  {{ session('error_message') }}
                                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                              @endif
                            </div>
                        </div>
                        <form method="POST" action="" id="admin_loginfrm" name="contactForm" class="contactForm" onSubmit="onSubmit(event)">
                           @csrf
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="label" for="name">Full Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="label" for="email">Email Address</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="label" for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="label" for="subject">Subject</label>
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="label" for="description">Message</label>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="4" placeholder="Message"></textarea>
                                 </div>
                              </div>
                              <input type="hidden" id="recaptcha_response" name="recaptcha_response" value="">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <!-- <input type="submit" value="Send Message" class="btn btn-themeprimary"> -->
                                    <button type="submit" class="btn btn-themeprimary" value="Send Message">Send Message</button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                     <div class="info-wrap bg-themeprimary w-100 p-md-5 p-4">
                        <h3 class="text-white">Let's get in touch</h3>
                        <p class="mb-4 text-white">We're open for any suggestion or just to have a chat</p>
                        <div class="dbox w-100 d-flex align-items-start">
                           <div class="icon d-flex align-items-center justify-content-center">
                              <span class="fa fa-map-marker"></span>
                           </div>
                           <div class="text ps-3">
                              <p><span>Address:</span> <?=$generalSetting->description?></p>
                           </div>
                        </div>
                        <div class="dbox w-100 d-flex align-items-center">
                           <div class="icon d-flex align-items-center justify-content-center">
                              <span class="fa fa-phone"></span>
                           </div>
                           <div class="text ps-3">
                              <p><span>Phone:</span> <a href="tel:<?=$generalSetting->site_phone?>"><?=$generalSetting->site_phone?></a></p>
                           </div>
                        </div>
                        <div class="dbox w-100 d-flex align-items-center">
                           <div class="icon d-flex align-items-center justify-content-center">
                              <span class="fa fa-paper-plane"></span>
                           </div>
                           <div class="text ps-3">
                              <p><span>Email:</span> <a href="mailto:<?=$generalSetting->site_mail?>"><?=$generalSetting->site_mail?></a></p>
                           </div>
                        </div>
                        <div class="dbox w-100 d-flex align-items-center">
                           <div class="icon d-flex align-items-center justify-content-center">
                              <span class="fa fa-globe"></span>
                           </div>
                           <div class="text ps-3">
                              <p><span>Website</span> <a href="<?=$generalSetting->site_url?>"><?=$generalSetting->site_url?></a></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- ********|| Home 3 button Start ||******** -->
<!-- ********|| Home 3 button End ||******** -->