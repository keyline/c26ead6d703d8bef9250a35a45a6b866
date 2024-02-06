<?php
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\MentorProfile;
use App\Models\GeneralSetting;
use App\Models\Survey;
use App\Helpers\Helper;

use Illuminate\Support\Facades\Route;;
$routeName = Route::current();
$pageName = $routeName->uri();
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
                     <!-- <li class="nav-item <?=(($pageName == '/')?'active':'')?>">
                        <a class="nav-link" href="<?=url('/')?>">Home</a>
                     </li> -->
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Mentorship For Exams</a>
                           <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="<?=url('mentors-for-10th-board')?>"> Mentors For 10th Board</a></li>
                              <li><a class="dropdown-item" href="<?=url('mentors-for-12th-board')?>"> Mentors For 12th Board </a></li>
                           </ul>
                     </li>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Counselling</a>
                           <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="<?=url('career-counseling-9-10th')?>"> Career Counselling 9-10th</a></li>
                              <li><a class="dropdown-item" href="<?=url('career-counseling-11-12th')?>"> Career Counselling 11-12th </a></li>
                              <!-- <li><a class="dropdown-item" href="#"> Career Counselling 12th and 11th </a></li> -->
                              <li><a class="dropdown-item" href="<?=url('mental-health-counselling')?>"> Mental Health Counselling </a></li>
                           </ul>
                     </li>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Free Resources</a>
                           <ul class="dropdown-menu">
                              <!-- <li><a class="dropdown-item" href="#"> For class 10th</a></li>
                              <li><a class="dropdown-item" href="#"> For class 12th </a></li> -->
                              <li><a class="dropdown-item" href="<?=url('blogs')?>"> Blogs </a></li>
                           </ul>
                     </li>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Free Career Tests</a>
                           <ul class="dropdown-menu">
                              <?php
                              $surveys = Survey::select('id', 'survey_sl_no', 'title')->where('status', '=', 1)->get();
                              ?>
                              <?php if($surveys){ foreach($surveys as $survey){?>
                                 <?php if(empty(session('is_user_login'))){?>
                                    <li><a class="dropdown-item" href="<?=url('signin/')?>"> <?=$survey->title?></a></li>
                                 <?php } else {?>
                                    <li><a class="dropdown-item" href="<?=url('user/survey-details/'.Helper::encoded($survey->id))?>"> <?=$survey->title?></a></li>
                                 <?php }?>
                              <?php } }?>
                           </ul>
                     </li>
                     <!-- <li class="nav-item <?=(($pageName == 'blogs')?'active':'')?>">
                        <a class="nav-link" href="<?=url('blogs')?>">Resources</a>
                     </li> -->
                     <!-- <li class="nav-item <?=(($pageName == 'how-it-works')?'active':'')?>">
                        <a class="nav-link" href="<?=url('how-it-works')?>">How it works</a>
                     </li> -->
                     <!-- <?php if(empty(session('is_user_login'))){?>
                        <li class="nav-item <?=(($pageName == 'survey-list')?'active':'')?>">
                           <a class="nav-link" href="<?=url('signin')?>">Take a free test</a>
                        </li>
                     <?php } else {?>
                        <li class="nav-item <?=(($pageName == 'survey-list')?'active':'')?>">
                           <a class="nav-link" href="<?=url('user/survey-list')?>">Take a free test</a>
                        </li>
                     <?php }?> -->
                  </ul>
               </div>
            </nav>
            <div class="header_loginbtn">
               <?php if(empty(session('is_user_login'))){?>
                  <ul>
                     <li>
                        <div class="wrapper-demo">
                           <div class="dropdown wrapper-dropdown-2">
                                 <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                 Sign in
                                 <span class="caret"></span>
                              </button>
                              <div class="dropdown-menu">
                                 <a class="dropdown-item" href="<?=url('signin')?>">Mentor Login</a>
                                 <a class="dropdown-item" href="<?=url('signin')?>">Student Login</a>
                              </div>
                           </div>
                           <!-- <div id="signdropdown" class="wrapper-dropdown-2" tabindex="1">Sign in
                              <ul class="dropdown">
                                 <li><a href="<?=url('signin')?>">Mentor Login</a></li>
                                 <li><a href="<?=url('signin')?>">Student Login</a></li>
                              </ul>
                           </div> -->
                        </div>
                        <!-- <a class="btn_border" href="<?=url('signin')?>">Sign In</a> -->
                     </li>
                     <li>
                        <div class="wrapper-demo">
                           <div class="dropdown wrapper-dropdown-2 wrapper-dropdown-2red">
                                 <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                 Sign up
                                 <span class="caret"></span>
                              </button>
                              <div class="dropdown-menu">
                                 <a class="dropdown-item" href="<?=url('mentor/signup')?>">Mentor Sign up</a>
                                 <a class="dropdown-item" href="<?=url('student-signup')?>">Student Sign up</a>
                              </div>
                           </div>
                           <!-- <div id="signdropdown1" class="wrapper-dropdown-2" tabindex="1">Sign up
                              <ul class="dropdown">
                                 <li><a href="<?=url('mentor/signup')?>">Mentor Sign up</a></li>
                                 <li><a href="<?=url('student-signup')?>">Student Sign up</a></li>
                              </ul>
                           </div> -->
                        </div>
                        <!-- <a class="btn_orgfill" href="<?=route('mentor.signup')?>">Sign up free</a> -->
                     </li>
                  </ul>
               <?php } else {?>
                  <div class="header_loginbtn">                     
                     <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                           <div class="avatar avatar-md">
                              <?php
                              $content        = session('name');
                              $user_id        = session('user_id');
                              $role           = session('role');
                              if ($role == 1) {
                                  $getUser = StudentProfile::where('user_id', '=', $user_id)->first();
                              } else {
                                  $getUser = MentorProfile::where('user_id', '=', $user_id)->first();
                              }
                              if ($getUser) {
                                  if ($getUser->profile_pic != '') {
                                      $imageLink = env('UPLOADS_URL') . 'user/' . $getUser->profile_pic;
                                      // $imageLink = '<img class="avatar-img" src="'.$image.'" alt="'.$content.'">';
                                  } else {
                                      $fullName = $content;
                                      $fullNameArr = explode(" ", $fullName);
                                      $firstWord = current($fullNameArr);
                                      $lastWord  = end($fullNameArr);
                                      $firstCharacter = substr($firstWord, 0, 1);
                                      $lastCharacter = substr($lastWord, 0, 1);
                                      $defaultProfile = strtoupper($firstCharacter);
                                      $imageLink = $defaultProfile;
                                  }
                              } else {
                                  $fullName = $content;
                                  $fullNameArr = explode(" ", $fullName);
                                  $firstWord = current($fullNameArr);
                                  $lastWord  = end($fullNameArr);
                                  $firstCharacter = substr($firstWord, 0, 1);
                                  $lastCharacter = substr($lastWord, 0, 1);
                                  $defaultProfile = strtoupper($firstCharacter);
                                  $imageLink = $shortName;
                              }
                              ?>
                              <?php if($getUser) {?>
                                  <?php if ($getUser->profile_pic != '') {?>
                                      <img class="avatar-img" src="<?= $imageLink ?>" alt="{{ session('name') }}">
                                  <?php } else {?>
                                      <span style="border: 1px solid #f9233f;height: 43px;width: 80px;padding: 9px 15px;border-radius: 50%;"><?= $imageLink ?></span>
                                  <?php }?>
                              <?php } else {?>
                                  <span style="border: 1px solid #f9233f;height: 43px;width: 80px;padding: 9px 15px;border-radius: 50%;"><?= $imageLink ?></span>
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