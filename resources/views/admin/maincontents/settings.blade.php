<?php
$user_type = session('type');
?>
<div class="pagetitle">
  <h1><?=$page_header?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Home</a></li>
      <li class="breadcrumb-item active"><?=$page_header?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section profile">
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
    <div class="col-xl-2">
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <?php if($admin->image != ''){?>
            <img src="<?=env('UPLOADS_URL').$admin->image?>" alt="<?=$admin->name?>" class="rounded-circle">
          <?php } else {?>
            <img src="<?=env('NO_IMAGE')?>" alt="<?=$admin->name?>" class="img-thumbnail" class="rounded-circle" style="width: 150px; height: 150px; margin-top: 10px;">
          <?php }?>
          <h2>{{ @session('name') }}</h2>
          <h3>{{ @session('type') }}</h3>
          <!-- <div class="social-links mt-2">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div> -->
        </div>
      </div>
    </div>
    <div class="col-xl-10">
      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1">Profile</button>
            </li>
            <?php if($user_type == 'ma'){?>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab2">General</button>
            </li>
            <?php }?>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab3">Change Password</button>
            </li>
            <?php if($user_type == 'ma'){?>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab4">Email</button>
            </li>
            <!-- <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab9">Email Templates</button>
            </li> -->
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab5">SMS</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab6">Footer</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab7">SEO</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab8">Payment</button>
            </li>
            <?php }?>
          </ul>
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="tab1">
              <!-- profile settings Form -->
              <form method="POST" action="{{ url('admin/profile-settings') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="name" class="form-control" id="name" value="<?=$admin->name?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="email" class="form-control" id="email" value="<?=$admin->email?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="mobile" class="col-md-4 col-lg-3 col-form-label">Mobile</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="mobile" class="form-control" id="mobile" value="<?=$admin->mobile?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="image" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="file" name="image" class="form-control" id="profile_image">
                    <small class="text-info">* Only JPG, JPEG, ICO, SVG, PNG files are allowed</small><br>
                    <?php if($admin->image != ''){?>
                      <img src="<?=env('UPLOADS_URL').$admin->image?>" alt="<?=$admin->name?>">
                    <?php } else {?>
                      <img src="<?=env('NO_IMAGE')?>" alt="<?=$admin->name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                    <?php }?>
                    
                    <div class="pt-2">
                      <!-- <a href="#profile_image" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a> -->
                      <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- End profile settings Form -->
            </div>
            <div class="tab-pane fade profile-edit pt-3" id="tab2">
              <!-- general settings Form -->
              <form method="POST" action="{{ url('admin/general-settings') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="site_name" class="col-md-4 col-lg-3 col-form-label">Site Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="site_name" type="text" class="form-control" id="site_name" value="<?=$setting->site_name?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="site_phone" class="col-md-4 col-lg-3 col-form-label">Site Phone</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="site_phone" type="text" class="form-control" id="site_phone" value="<?=$setting->site_phone?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="site_mail" class="col-md-4 col-lg-3 col-form-label">Site Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="site_mail" type="email" class="form-control" id="site_mail" value="<?=$setting->site_mail?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="system_email" class="col-md-4 col-lg-3 col-form-label">System Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="system_email" type="email" class="form-control" id="system_email" value="<?=$setting->system_email?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="site_url" class="col-md-4 col-lg-3 col-form-label">Site URL</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="site_url" type="url" class="form-control" id="site_url" value="<?=$setting->site_url?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="description" class="col-md-4 col-lg-3 col-form-label">Address</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="description" class="form-control" id="description" rows="5"><?=$setting->description?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="copyright_statement" class="col-md-4 col-lg-3 col-form-label">Copyright Statement</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="copyright_statement" class="form-control" id="copyright_statement" rows="5"><?=$setting->copyright_statement?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="google_map_api_code" class="col-md-4 col-lg-3 col-form-label">Google Map API Code</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="google_map_api_code" class="form-control" id="google_map_api_code" rows="5"><?=$setting->google_map_api_code?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="google_analytics_code" class="col-md-4 col-lg-3 col-form-label">Google Analytics Code</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="google_analytics_code" class="form-control" id="google_analytics_code" rows="5"><?=$setting->google_analytics_code?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="google_pixel_code" class="col-md-4 col-lg-3 col-form-label">Google Pixel Code</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="google_pixel_code" class="form-control" id="google_pixel_code" rows="5"><?=$setting->google_pixel_code?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="facebook_tracking_code" class="col-md-4 col-lg-3 col-form-label">Facebook Tracking Code</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="facebook_tracking_code" class="form-control" id="facebook_tracking_code" rows="5"><?=$setting->facebook_tracking_code?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="theme_color" class="col-md-4 col-lg-3 col-form-label">Theme Color</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="theme_color" type="color" class="form-control" id="theme_color" value="<?=$setting->theme_color?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="font_color" class="col-md-4 col-lg-3 col-form-label">Font Color</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="font_color" type="color" class="form-control" id="font_color" value="<?=$setting->font_color?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="home_page_youtube_link" class="col-md-4 col-lg-3 col-form-label">Home Page Youtube Video</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="home_page_youtube_link" type="text" class="form-control" id="home_page_youtube_link" value="<?=$setting->home_page_youtube_link?>">
                    <?php if($setting->home_page_youtube_link != ''){?>
                      <p class="mt-3">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$setting->home_page_youtube_code?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                      </p>
                    <?php }?>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="cgst_percent" class="col-md-4 col-lg-3 col-form-label">CGST Percentage</label>
                  <div class="col-md-8 col-lg-9">
                    <select class="form-control" name="cgst_percent" id="cgst_percent">
                      <option value="" selected>Select CGST Percentage</option>
                      <option value="0.00" <?=(($setting->cgst_percent == '0.00')?'selected':'')?>>0 %</option>
                      <option value="2.50" <?=(($setting->cgst_percent == '2.50')?'selected':'')?>>2.5 %</option>
                      <option value="6.00" <?=(($setting->cgst_percent == '6.00')?'selected':'')?>>6 %</option>
                      <option value="9.00" <?=(($setting->cgst_percent == '9.00')?'selected':'')?>>9 %</option>
                      <option value="14.00" <?=(($setting->cgst_percent == '14.00')?'selected':'')?>>14 %</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="sgst_percent" class="col-md-4 col-lg-3 col-form-label">SGST Percentage</label>
                  <div class="col-md-8 col-lg-9">
                    <select class="form-control" name="sgst_percent" id="sgst_percent">
                      <option value="" selected>Select CGST Percentage</option>
                      <option value="0.00" <?=(($setting->sgst_percent == '0.00')?'selected':'')?>>0 %</option>
                      <option value="2.50" <?=(($setting->sgst_percent == '2.50')?'selected':'')?>>2.5 %</option>
                      <option value="6.00" <?=(($setting->sgst_percent == '6.00')?'selected':'')?>>6 %</option>
                      <option value="9.00" <?=(($setting->sgst_percent == '9.00')?'selected':'')?>>9 %</option>
                      <option value="14.00" <?=(($setting->sgst_percent == '14.00')?'selected':'')?>>14 %</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="igst_percent" class="col-md-4 col-lg-3 col-form-label">IGST Percentage</label>
                  <div class="col-md-8 col-lg-9">
                    <select class="form-control" name="igst_percent" id="igst_percent">
                      <option value="" selected>Select CGST Percentage</option>
                      <option value="0.00" <?=(($setting->igst_percent == '0.00')?'selected':'')?>>0 %</option>
                      <option value="5.00" <?=(($setting->igst_percent == '5.00')?'selected':'')?>>5 %</option>
                      <option value="12.00" <?=(($setting->igst_percent == '12.00')?'selected':'')?>>12 %</option>
                      <option value="18.00" <?=(($setting->igst_percent == '18.00')?'selected':'')?>>18 %</option>
                      <option value="28.00" <?=(($setting->igst_percent == '28.00')?'selected':'')?>>28 %</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="stumento_commision_percent" class="col-md-4 col-lg-3 col-form-label">Stumento Commission Percentage</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="stumento_commision_percent" type="text" class="form-control" id="stumento_commision_percent" value="<?=$setting->stumento_commision_percent?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="date_available" class="col-md-4 col-lg-3 col-form-label">Advance Dates Available For Booking</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="date_available" type="text" class="form-control" id="date_available" value="<?=$setting->date_available?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="twitter_profile" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="twitter_profile" type="text" class="form-control" id="twitter_profile" value="<?=$setting->twitter_profile?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="facebook_profile" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="facebook_profile" type="text" class="form-control" id="facebook_profile" value="<?=$setting->facebook_profile?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="instagram_profile" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="instagram_profile" type="text" class="form-control" id="instagram_profile" value="<?=$setting->instagram_profile?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="linkedin_profile" class="col-md-4 col-lg-3 col-form-label">Pinterest Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="linkedin_profile" type="text" class="form-control" id="linkedin_profile" value="<?=$setting->linkedin_profile?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="youtube_profile" class="col-md-4 col-lg-3 col-form-label">Youtube Profile</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="youtube_profile" type="text" class="form-control" id="youtube_profile" value="<?=$setting->youtube_profile?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="site_logo" class="col-md-4 col-lg-3 col-form-label">Logo</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="file" name="site_logo" class="form-control" id="site_logo">
                    <small class="text-info">* Only jpg, jpeg, png, ico files are allowed</small><br>
                    <?php if($setting->site_logo != ''){?>
                      <img src="<?=env('UPLOADS_URL').$setting->site_logo?>" alt="<?=$setting->site_name?>">
                    <?php } else {?>
                      <img src="<?=env('NO_IMAGE')?>" alt="<?=$setting->site_name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                    <?php }?>
                    
                    <div class="pt-2">
                      <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove Image"><i class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="site_footer_logo" class="col-md-4 col-lg-3 col-form-label">Footer Logo</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="file" name="site_footer_logo" class="form-control" id="site_footer_logo">
                    <small class="text-info">* Only jpg, jpeg, png, ico files are allowed</small><br>
                    <?php if($setting->site_footer_logo != ''){?>
                      <img src="<?=env('UPLOADS_URL').$setting->site_footer_logo?>" alt="<?=$setting->site_name?>">
                    <?php } else {?>
                      <img src="<?=env('NO_IMAGE')?>" alt="<?=$setting->site_name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                    <?php }?>
                    
                    <div class="pt-2">
                      <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove Image"><i class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="site_favicon" class="col-md-4 col-lg-3 col-form-label">Favicon</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="file" name="site_favicon" class="form-control" id="site_favicon">
                    <small class="text-info">* Only jpg, jpeg, png, ico files are allowed</small><br>
                    <?php if($setting->site_favicon != ''){?>
                      <img src="<?=env('UPLOADS_URL').$setting->site_favicon?>" alt="<?=$setting->site_name?>">
                    <?php } else {?>
                      <img src="<?=env('NO_IMAGE')?>" alt="<?=$setting->site_name?>" class="img-thumbnail" style="width: 150px; height: 150px; margin-top: 10px;">
                    <?php }?>
                    
                    <div class="pt-2">
                      <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove Image"><i class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- End general settings Form -->
            </div>
            <div class="tab-pane fade pt-3" id="tab3">
              <!-- chnage password Form -->
              <form method="POST" action="{{ url('admin/change-password') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="old_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" name="old_password" class="form-control" id="old_password">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" name="new_password" class="form-control" id="new_password">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="confirm_password" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- End chnage password Form -->
            </div>
            <div class="tab-pane fade pt-3" id="tab4">
              <!-- email settings Form -->
              <form method="POST" action="{{ url('admin/email-settings') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="from_email" class="col-md-4 col-lg-3 col-form-label">From Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="from_email" class="form-control" id="from_email" value="<?=$setting->from_email?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="from_name" class="col-md-4 col-lg-3 col-form-label">From Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="from_name" class="form-control" id="from_name" value="<?=$setting->from_name?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="smtp_host" class="col-md-4 col-lg-3 col-form-label">SMTP Host</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="smtp_host" class="form-control" id="smtp_host" value="<?=$setting->smtp_host?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="smtp_username" class="col-md-4 col-lg-3 col-form-label">SMTP Username</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="smtp_username" class="form-control" id="smtp_username" value="<?=$setting->smtp_username?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="smtp_password" class="col-md-4 col-lg-3 col-form-label">SMTP Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="smtp_password" class="form-control" id="smtp_password" value="<?=$setting->smtp_password?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="smtp_port" class="col-md-4 col-lg-3 col-form-label">SMTP Port</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="smtp_port" class="form-control" id="smtp_port" value="<?=$setting->smtp_port?>">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- End email settings Form -->
            </div>
            <div class="tab-pane fade pt-3" id="tab9">
              <!-- seo settings Form -->
              <form method="POST" action="{{ url('admin/email-template') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="email_template_user_signup" class="col-md-4 col-lg-3 col-form-label">User Signup</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea type="text" name="email_template_user_signup" class="form-control ckeditor" id="email_template_user_signup" rows="5"><?=$setting->email_template_user_signup?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="email_template_forgot_password" class="col-md-4 col-lg-3 col-form-label">Forgot Password</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea type="text" name="email_template_forgot_password" class="form-control ckeditor" id="email_template_forgot_password" rows="5"><?=$setting->email_template_forgot_password?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="email_template_change_password" class="col-md-4 col-lg-3 col-form-label">Change Password</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea type="text" name="email_template_change_password" class="form-control ckeditor" id="email_template_change_password" rows="5"><?=$setting->email_template_change_password?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="email_template_failed_login" class="col-md-4 col-lg-3 col-form-label">Failed Login</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea type="text" name="email_template_failed_login" class="form-control ckeditor" id="email_template_failed_login" rows="5"><?=$setting->email_template_failed_login?></textarea>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- End seo settings Form -->
            </div>
            <div class="tab-pane fade pt-3" id="tab5">
              <!-- sms settings Form -->
              <form method="POST" action="{{ url('admin/sms-settings') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="sms_authentication_key" class="col-md-4 col-lg-3 col-form-label">Authentication Key</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="sms_authentication_key" class="form-control" id="sms_authentication_key" value="<?=$setting->sms_authentication_key?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="sms_sender_id" class="col-md-4 col-lg-3 col-form-label">Sender ID</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="sms_sender_id" class="form-control" id="sms_sender_id" value="<?=$setting->sms_sender_id?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="sms_base_url" class="col-md-4 col-lg-3 col-form-label">Base URL</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="text" name="sms_base_url" class="form-control" id="sms_base_url" value="<?=$setting->sms_base_url?>">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- End sms settings Form -->
            </div>
            <div class="tab-pane fade pt-3" id="tab6">
              <!-- footer settings Form -->
              <form method="POST" action="{{ url('admin/footer-settings') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="footer_text" class="col-md-4 col-lg-3 col-form-label">Footer Text</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea type="text" name="footer_text" class="form-control ckeditor" id="footer_text" rows="5"><?=$setting->footer_text?></textarea>
                  </div>
                </div>

                <label for="" class="col-md-4 col-lg-3 col-form-label">Column 1</label>
                <div class="field_wrapper1" style="border: 1px solid #8144f0;padding: 10px;margin-bottom: 10px;">
                  <?php
                  $footer_link_name = (($setting->footer_link_name != '')?json_decode($setting->footer_link_name):[]);
                  $footer_link = (($setting->footer_link != '')?json_decode($setting->footer_link):[]);
                  if(!empty($footer_link_name)){ for($i=0;$i<count($footer_link_name);$i++){
                  ?>
                      <div class="row">
                          <div class="col-md-5">
                              <label for="lefticon" class="control-label">Link Text<span class="red">*</span></label>
                              <span class="input-with-icon">
                                  <input type="text" class="form-control requiredCheck" data-check="Link Text" name="footer_link_name[]" value="<?=$footer_link_name[$i]?>" autocomplete="off">
                              </span>
                          </div>
                          <div class="col-md-5">
                              <label for="lefticon" class="control-label">Link<span class="red">*</span></label>
                              <span class="input-with-icon">
                                  <input type="text" class="form-control requiredCheck" data-check="Link" value="<?=$footer_link[$i]?>" name="footer_link[]" autocomplete="off">
                              </span>
                          </div>
                          <div class="col-md-2" style="margin-top: 26px;">
                              <a href="javascript:void(0);" class="remove_button1" title="Add field"><i class="fa fa-minus-circle fa-2x text-danger"></i></a>
                          </div>                                    
                      </div>
                  <?php } }?>
                  <div class="row">
                      <div class="col-md-5">
                          <label for="lefticon" class="control-label">Link Text<span class="red">*</span></label>
                          <span class="input-with-icon">
                              <input type="text" class="form-control requiredCheck" data-check="Link Text" name="first_col_link_text[]" autocomplete="off">
                          </span>
                      </div>
                      <div class="col-md-5">
                          <label for="lefticon" class="control-label">Link<span class="red">*</span></label>
                          <span class="input-with-icon">
                              <input type="text" class="form-control requiredCheck" data-check="Link" name="first_col_link[]" autocomplete="off">
                          </span>
                      </div>
                      <div class="col-md-2" style="margin-top: 26px;">
                          <a href="javascript:void(0);" class="add_button1" title="Add field"><i class="fa fa-plus-circle fa-2x text-success"></i></a>
                      </div>                                    
                  </div>
                </div>

                <label for="" class="col-md-4 col-lg-3 col-form-label">GET HELP</label>
                <div class="field_wrapper2" style="border: 1px solid #8144f0;padding: 10px;margin-bottom: 10px;">
                  <?php
                  $footer_link_name2 = (($setting->footer_link_name2 != '')?json_decode($setting->footer_link_name2):[]);
                  $footer_link2 = (($setting->footer_link2 != '')?json_decode($setting->footer_link2):[]);
                  if(!empty($footer_link_name2)){ for($i=0;$i<count($footer_link_name2);$i++){
                  ?>
                      <div class="row">
                          <div class="col-md-5">
                              <label for="lefticon" class="control-label">Link Text<span class="red">*</span></label>
                              <span class="input-with-icon">
                                  <input type="text" class="form-control requiredCheck" data-check="Link Text" name="second_col_link_text[]" value="<?=$footer_link_name2[$i]?>" autocomplete="off">
                              </span>
                          </div>
                          <div class="col-md-5">
                              <label for="lefticon" class="control-label">Link<span class="red">*</span></label>
                              <span class="input-with-icon">
                                  <input type="text" class="form-control requiredCheck" data-check="Link" value="<?=$footer_link2[$i]?>" name="second_col_link[]" autocomplete="off">
                              </span>
                          </div>
                          <div class="col-md-2" style="margin-top: 26px;">
                              <a href="javascript:void(0);" class="remove_button2" title="Add field"><i class="fa fa-minus-circle fa-2x text-danger"></i></a>
                          </div>                                    
                      </div>
                  <?php } }?>
                  <div class="row">
                      <div class="col-md-5">
                          <label for="lefticon" class="control-label">Link Text<span class="red">*</span></label>
                          <span class="input-with-icon">
                              <input type="text" class="form-control requiredCheck" data-check="Link Text" name="second_col_link_text[]" autocomplete="off">
                          </span>
                      </div>
                      <div class="col-md-5">
                          <label for="lefticon" class="control-label">Link<span class="red">*</span></label>
                          <span class="input-with-icon">
                              <input type="text" class="form-control requiredCheck" data-check="Link" name="second_col_link[]" autocomplete="off">
                          </span>
                      </div>
                      <div class="col-md-2" style="margin-top: 26px;">
                          <a href="javascript:void(0);" class="add_button2" title="Add field"><i class="fa fa-plus-circle fa-2x text-success"></i></a>
                      </div>                                    
                  </div>
                </div>

                <label for="" class="col-md-4 col-lg-3 col-form-label">SERVICES</label>
                <div class="field_wrapper3" style="border: 1px solid #8144f0;padding: 10px;margin-bottom: 10px;">
                  <?php
                  $footer_link_name3 = (($setting->footer_link_name3 != '')?json_decode($setting->footer_link_name3):[]);
                  $footer_link3 = (($setting->footer_link3 != '')?json_decode($setting->footer_link3):[]);
                  if(!empty($footer_link_name3)){ for($i=0;$i<count($footer_link_name3);$i++){
                  ?>
                      <div class="row">
                          <div class="col-md-5">
                              <label for="lefticon" class="control-label">Link Text<span class="red">*</span></label>
                              <span class="input-with-icon">
                                  <input type="text" class="form-control requiredCheck" data-check="Link Text" name="footer_link_name3[]" value="<?=$footer_link_name3[$i]?>" autocomplete="off">
                              </span>
                          </div>
                          <div class="col-md-5">
                              <label for="lefticon" class="control-label">Link<span class="red">*</span></label>
                              <span class="input-with-icon">
                                  <input type="text" class="form-control requiredCheck" data-check="Link" value="<?=$footer_link3[$i]?>" name="footer_link3[]" autocomplete="off">
                              </span>
                          </div>
                          <div class="col-md-2" style="margin-top: 26px;">
                              <a href="javascript:void(0);" class="remove_button3" title="Add field"><i class="fa fa-minus-circle fa-2x text-danger"></i></a>
                          </div>                                    
                      </div>
                  <?php } }?>
                  <div class="row">
                      <div class="col-md-5">
                          <label for="lefticon" class="control-label">Link Text<span class="red">*</span></label>
                          <span class="input-with-icon">
                              <input type="text" class="form-control requiredCheck" data-check="Link Text" name="footer_link_name3[]" autocomplete="off">
                          </span>
                      </div>
                      <div class="col-md-5">
                          <label for="lefticon" class="control-label">Link<span class="red">*</span></label>
                          <span class="input-with-icon">
                              <input type="text" class="form-control requiredCheck" data-check="Link" name="footer_link3[]" autocomplete="off">
                          </span>
                      </div>
                      <div class="col-md-2" style="margin-top: 26px;">
                          <a href="javascript:void(0);" class="add_button3" title="Add field"><i class="fa fa-plus-circle fa-2x text-success"></i></a>
                      </div>                                    
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- End footer settings Form -->
            </div>
            <div class="tab-pane fade pt-3" id="tab7">
              <!-- seo settings Form -->
              <form method="POST" action="{{ url('admin/seo-settings') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="meta_title" class="col-md-4 col-lg-3 col-form-label">Meta Title</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea type="text" name="meta_title" class="form-control" id="meta_title" rows="5"><?=$setting->meta_title?></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="meta_description" class="col-md-4 col-lg-3 col-form-label">Meta Description</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea type="text" name="meta_description" class="form-control" id="meta_description" rows="5"><?=$setting->meta_description?></textarea>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- End seo settings Form -->
            </div>
            <div class="tab-pane fade pt-3" id="tab8">
              <!-- payment settings Form -->
              <form method="POST" action="{{ url('admin/payment-settings') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="stripe_payment_type" class="col-md-4 col-lg-3 col-form-label">Stripe Sandbox Secret Key</label>
                  <div class="col-md-8 col-lg-9">
                    <select name="stripe_payment_type" class="form-control" id="stripe_payment_type" required>
                      <option value="" selected>Select Payment Environment</option>
                      <option value="1" <?=(($setting->stripe_payment_type == 1)?'selected':'')?>>SANDBOX</option>
                      <option value="2" <?=(($setting->stripe_payment_type == 2)?'selected':'')?>>LIVE</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="stripe_sandbox_sk" class="col-md-4 col-lg-3 col-form-label">Stripe Sandbox Secret Key</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="stripe_sandbox_sk" type="text" class="form-control" id="stripe_sandbox_sk" value="<?=$setting->stripe_sandbox_sk?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="stripe_sandbox_pk" class="col-md-4 col-lg-3 col-form-label">Stripe Sandbox Public Key</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="stripe_sandbox_pk" type="text" class="form-control" id="stripe_sandbox_pk" value="<?=$setting->stripe_sandbox_pk?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="stripe_live_sk" class="col-md-4 col-lg-3 col-form-label">Stripe Live Secret Key</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="stripe_live_sk" type="text" class="form-control" id="stripe_live_sk" value="<?=$setting->stripe_live_sk?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="stripe_live_pk" class="col-md-4 col-lg-3 col-form-label">Stripe Live Public Key</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="stripe_live_pk" type="text" class="form-control" id="stripe_live_pk" value="<?=$setting->stripe_live_pk?>" required>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- End payment settings Form -->
            </div>
          </div><!-- End Bordered Tabs -->
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){        
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button1'); //Add button selector
        var wrapper = $('.field_wrapper1'); //Input field wrapper
        var fieldHTML = '<div class="row">\
                            <div class="col-md-5">\
                                <label for="lefticon" class="control-label">Link Text<span class="red">*</span></label>\
                                <span class="input-with-icon">\
                                    <input type="text" class="form-control requiredCheck" data-check="Link Text" name="footer_link_name[]" autocomplete="off">\
                                </span>\
                            </div>\
                            <div class="col-md-5">\
                                <label for="lefticon" class="control-label">Link<span class="red">*</span></label>\
                                <span class="input-with-icon">\
                                    <input type="text" class="form-control requiredCheck" data-check="Link" name="footer_link[]" autocomplete="off">\
                                </span>\
                            </div>\
                            <div class="col-md-2" style="margin-top: 26px;">\
                                <a href="javascript:void(0);" class="remove_button1" title="Remove field"><i class="fa fa-minus-circle fa-2x text-danger"></i></a>\
                            </div>\
                        </div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button1', function(e){
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    $(document).ready(function(){        
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button2'); //Add button selector
        var wrapper = $('.field_wrapper2'); //Input field wrapper
        var fieldHTML = '<div class="row">\
                            <div class="col-md-5">\
                                <label for="lefticon" class="control-label">Link Text<span class="red">*</span></label>\
                                <span class="input-with-icon">\
                                    <input type="text" class="form-control requiredCheck" data-check="Second Column Link Text" name="second_col_link_text[]" autocomplete="off">\
                                </span>\
                            </div>\
                            <div class="col-md-5">\
                                <label for="lefticon" class="control-label">Link<span class="red">*</span></label>\
                                <span class="input-with-icon">\
                                    <input type="text" class="form-control requiredCheck" data-check="Second Column Link" name="second_col_link[]" autocomplete="off">\
                                </span>\
                            </div>\
                            <div class="col-md-2" style="margin-top: 33px;">\
                                <a href="javascript:void(0);" class="remove_button2" title="Remove field"><i class="fa fa-minus-circle fa-2x text-danger"></i></a>\
                            </div>\
                        </div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button2', function(e){
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    $(document).ready(function(){        
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button3'); //Add button selector
        var wrapper = $('.field_wrapper3'); //Input field wrapper
        var fieldHTML = '<div class="row">\
                            <div class="col-md-5">\
                                <label for="lefticon" class="control-label">Link Text<span class="red">*</span></label>\
                                <span class="input-with-icon">\
                                    <input type="text" class="form-control requiredCheck" data-check="Third Column Link Text" name="footer_link_name3[]" autocomplete="off">\
                                </span>\
                            </div>\
                            <div class="col-md-5">\
                                <label for="lefticon" class="control-label">Link<span class="red">*</span></label>\
                                <span class="input-with-icon">\
                                    <input type="text" class="form-control requiredCheck" data-check="Third Column Link" name="footer_link3[]" autocomplete="off">\
                                </span>\
                            </div>\
                            <div class="col-md-2" style="margin-top: 33px;">\
                                <a href="javascript:void(0);" class="remove_button3" title="Remove field"><i class="fa fa-minus-circle fa-2x text-danger"></i></a>\
                            </div>\
                        </div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button3', function(e){
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>