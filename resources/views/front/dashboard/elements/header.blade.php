<?php
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\MentorProfile;
use App\Models\GeneralSetting;

$generalSetting             = GeneralSetting::find('1');
use Illuminate\Support\Facades\Route;
$routeName = Route::current();
$pageName = $routeName->uri();

// function ProfilePicFromName($fullName) {
//     $fullNameArr = explode(" ", $fullName);
//     $firstWord = current($fullNameArr);
//     $lastWord  = end($fullNameArr);
//     $firstCharacter = substr($firstWord, 0, 1);
//     $lastCharacter = substr($lastWord, 0, 1);
//     $defaultProfile = strtoupper($firstCharacter.$lastCharacter);
//     return $defaultProfile;
// }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12 col-6">
            <div class="headlogo">
                <a class="navbar-brand" href="<?= url('/') ?>">
                    <img class="img-fluid" src="<?=env('UPLOADS_URL').$generalSetting->site_logo?>" alt="<?=$generalSetting->site_name?>">
                </a>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="head_menusection">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" id="myNavbarToggler4" aria-label="Toggle navigation">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                    <div class="offcanvas-collapse navbar-collapse" id="myNavbarToggler4">
                        <button class="navbar-toggler  mobileclose" type="button" data-toggle="collapse"
                            data-target="#myNavbarToggler4" aria-controls="myNavbarToggler4" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <i class="zmdi zmdi-close"></i>
                        </button>
                        <ul class="navbar-nav">
                            <!-- <li class="nav-item <?= $pageName == '/' ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= url('/') ?>">Home</a>
                            </li>
                            <li class="nav-item <?= $pageName == 'mentors' ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= url('mentors') ?>">Mentors</a>
                            </li>
                            <li class="nav-item <?= $pageName == 'blogs' ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= url('blogs') ?>">Resources</a>
                            </li>
                            <li class="nav-item <?= $pageName == 'how-it-works' ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= url('how-it-works') ?>">How it works</a>
                            </li>
                            <?php
                            $role       = session('role');
                            if($role == 1){
                            ?>
                            <li class="nav-item <?= $pageName == 'user/survey-list' ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= url('user/survey-list') ?>">Take a free test</a>
                            </li>
                            <?php }?> -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Mentorship for Exams</a>
                                   <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="<?=url('mentors-for-10th-board')?>"> Mentors for 10th board</a></li>
                                      <li><a class="dropdown-item" href="<?=url('mentors-for-12th-board')?>"> Mentors for 12th board </a></li>
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
                                    <?php if($surveys){ foreach($surveys as $survey){?>
                                    <li><a class="dropdown-item" href="<?=url('user/survey-details/'.Helper::encoded($survey->id))?>"> <?=$survey->title?></a></li>
                                    <?php } }?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="header_loginbtn">
                    <ul class="header-nav ms-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link py-0" data-coreui-toggle="dropdown" href="javascript:void(0);"
                                role="button" aria-haspopup="true" aria-expanded="false">
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
                            <div class="dropdown-menu dropdown-menu-end pt-0">
                                <div class="dropdown-header bg-light py-2">
                                    <div class="fw-semibold">Welcome <strong>{{ session('name') }}</strong></div>
                                </div>
                                <a class="dropdown-item" href="<?= url('user/profile') ?>"><i class="fa fa-user"></i>
                                    Profile</a>
                                <?php if($role == 1){?>
                                <a class="dropdown-item" href="<?= url('user/survey-list') ?>"><i
                                        class="fa fa-poll"></i> Survey List</a>
                                <?php }?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= url('user/logout') ?>"><i class="fa fa-sign-out"></i>
                                    Sign Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>

</div>

<?php
$user = User::where('id', '=', $user_id)->first();
if ($user->email_verified_at == ''){
?>
<div class="style_marquee">
    <marquee behavior="alternate" direction="left" onmouseover="this.stop();" onmouseout="this.start();">

        Your account has not been verified yet, please verify your account first from the verification mail, which is
        sent to your registered mail.
    </marquee>
</div>
<?php }?>
