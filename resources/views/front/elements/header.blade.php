<?php
use Illuminate\Support\Facades\Route;;
$routeName = Route::current();
$pageName = $routeName->uri();
// dd($routeName);
?>
<div class="container">
   <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-12 col-6">
         <div class="headlogo"><a class="navbar-brand" href="<?=url('/')?>"><img class="img-fluid" src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>"></a></div>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-12">
         <div class="head_menusection">
            <nav class="navbar navbar-expand-lg navbar-light">
               <button class="navbar-toggler" type="button" id="myNavbarToggler4" aria-label="Toggle navigation">
               <i class="fa fa-bars" aria-hidden="true"></i>
               </button>
               <div class="offcanvas-collapse navbar-collapse" id="myNavbarToggler4">
                  <button class="navbar-toggler  mobileclose" type="button" data-toggle="collapse" data-target="#myNavbarToggler4" aria-controls="myNavbarToggler4" aria-expanded="false" aria-label="Toggle navigation">
                  <i class="zmdi zmdi-close"></i>
                  </button>
                  <ul class="navbar-nav">
                     <li class="nav-item <?=(($pageName == '/')?'active':'')?>">
                        <a class="nav-link" href="<?=url('/')?>">Home</a>
                     </li>
                     <li class="nav-item <?=(($pageName == 'mentors')?'active':'')?>">
                        <a class="nav-link" href="<?=url('mentors')?>">Mentors</a>
                     </li>
                     <li class="nav-item <?=(($pageName == 'blogs')?'active':'')?>">
                        <a class="nav-link" href="<?=url('blogs')?>">Resources</a>
                     </li>
                     <li class="nav-item <?=(($pageName == 'how-it-works')?'active':'')?>">
                        <a class="nav-link" href="<?=url('how-it-works')?>">How it works</a>
                     </li>
                     <?php if(empty(session('is_user_login'))){?>
                        <li class="nav-item <?=(($pageName == 'survey-list')?'active':'')?>">
                           <a class="nav-link" href="<?=url('signin')?>">Take a free test</a>
                        </li>
                     <?php } else {?>
                        <li class="nav-item <?=(($pageName == 'survey-list')?'active':'')?>">
                           <a class="nav-link" href="<?=url('user/survey-list')?>">Take a free test</a>
                        </li>
                     <?php }?>
                  </ul>
               </div>
            </nav>
            <div class="header_loginbtn">
               <?php if(empty(session('is_user_login'))){?>
                  <ul>
                     <li>
                        <div class="wrapper-demo">
                           <div id="signdropdown" class="wrapper-dropdown-2" tabindex="1">Sign in with
                              <ul class="dropdown">
                                 <li><a href="#">Mentor Login</a></li>
                                 <li><a href="#">Student Login</a></li>
                              </ul>
                           </div>
                        </div>
                        <!-- <a class="btn_border" href="<?=url('signin')?>">Sign In</a> -->
                     </li>
                     <li>
                        <div class="wrapper-demo">
                           <div id="signdropdown1" class="wrapper-dropdown-2" tabindex="1">Sign up with
                              <ul class="dropdown">
                                 <li><a href="#">Mentor Sign up</a></li>
                                 <li><a href="#">Student Sign up</a></li>
                              </ul>
                           </div>
                        </div>
                        <!-- <a class="btn_orgfill" href="<?=route('mentor.signup')?>">Sign up free</a> -->
                     </li>
                  </ul>
               <?php } else {?>
                  <div class="header_loginbtn">

                     <!-- <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                     <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                           <div class="avatar avatar-md">
                                 <?php if($user->image != ''){?>
                                 <img src="<?=env('UPLOADS_URL').'user/'.$user->image?>" alt="<?=$user->name?>" class="avatar-img">
                              <?php } else {?>
                                 <img src="<?=env('NO_IMAGE')?>" alt="<?=$user->name?>" class="avatar-img">
                              <?php }?>
                           </div>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                           <li>Welcome</li>
                           <li><h4><?=(($user)?$user->name:'')?></h4></li>
                           <li><hr class="dropdown-divider"></li>
                           <li><a class="dropdown-item" href="<?=url('logout')?>"><i class="fa-regular fa-sign-out"></i> Sign Out</a></li>
                        </ul>
                            

                     </div>
                  </div>
                  <div class="login-profile dropdown">
                     <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">

                         <div class="login-profile-avatar">
                             <?php if($user->image != ''){?>
                               <img src="<?=env('UPLOADS_URL').'user/'.$user->image?>" alt="<?=$user->name?>" style="width: 100px; height:100px; border-radius: 50%;">
                             <?php } else {?>
                               <img src="<?=env('NO_IMAGE')?>" alt="<?=$user->name?>" class="img-thumbnail" style="width: 100px; height:100px; border-radius: 50%;">
                             <?php }?>
                         </div>
                         <div>
                             <h3>Welcome</h3>
                             <h4><?=(($user)?$user->name:'')?></h4>
                         </div>
                     </button>
                     <div>
                         <ul class="dropdown-menu">
                              <li class="dropdown-item"><a href="<?=url('user/profile')?>"><i class="fa fa-user"></i> Profile</a></li>
                              <li class="dropdown-item"><a href="<?=url('user/survey-list')?>"><i class="fa fa-poll"></i> Survey List</a></li>
                              <li class="dropdown-item"><a href="<?=url('user/logout')?>"><i class="fa fa-sign-out"></i> Sign Out</a></li>
                         </ul>
                     </div> -->
                     <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                           <div class="avatar avatar-md">
                                 <?php if($user->profile_pic != ''){?>
                                 <img src="<?=env('UPLOADS_URL').'user/'.$user->profile_pic?>" alt="<?=$user->full_name?>" class="avatar-img">
                              <?php } else {?>
                                 <img src="<?=env('NO_IMAGE')?>" alt="<?=$user->full_name?>" class="avatar-img">
                              <?php }?>
                           </div>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                           <li>Welcome</li>
                           <li><h4><?=(($user)?$user->full_name:'')?></h4></li>
                           <li><hr class="dropdown-divider"></li>
                           <li class="dropsub_link"><a href="<?=url('user/profile')?>"><i class="fa fa-user"></i> Profile</a></li>
                           <li class="dropsub_link"><a href="<?=url('user/survey-list')?>"><i class="fa fa-poll"></i> Survey List</a></li>
                           <li class="dropsub_link"><a href="<?=url('user/logout')?>"><i class="fa fa-sign-out"></i> Sign Out</a></li>
                        </ul>
                     </div>
                 </div>
               <?php }?>
            </div>
         </div>
      </div>
   </div>
</div>