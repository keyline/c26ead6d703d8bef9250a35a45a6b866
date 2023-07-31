<div class="main-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 col-4">
                <div class="logo">
                    <a href="<?=url('/')?>">
                        <img src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>">
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-8">
                <div class="nav-header">
                    <div class="stellarnav">
                        <ul>
                            <li><a href="<?=url('/')?>">Home</a></li>
                            <li><a href="<?=url('page/about-us')?>">About Us</a></li>
                            <li><a href="<?=url('contact-us')?>">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-8">
                <?php if(empty(session('name'))){?>
                    <ul class="header-right">
                        <li>
                            <a href="<?=url('signin')?>">Sign In</a>
                        </li>
                        <li>
                            <a href="<?=url('signup')?>">Sign Up</a>
                        </li>
                    </ul>
                <?php } else {?>
                    <div class="login-profile">
                        <a href="<?=url('dashboard')?>">
                            <div class="login-profile-avatar">
                                <?php if($user->image != ''){?>
                                  <img src="<?=env('UPLOADS_URL').'user/'.$user->image?>" alt="<?=$user->name?>">
                                <?php } else {?>
                                  <img src="<?=env('NO_IMAGE')?>" alt="<?=$user->name?>" class="img-thumbnail">
                                <?php }?>
                                <!-- <img src="<?=env('FRONT_ASSETS_URL')?>assets/img/profile-img.png"> -->
                            </div>
                            <div>
                                <h3>Welcome</h3>
                                <h4><?=(($user)?$user->name:'')?></h4>
                            </div>
                        </a>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>