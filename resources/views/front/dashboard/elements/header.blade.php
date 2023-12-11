<?php
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\MentorProfile;
use App\Models\GeneralSetting;

$generalSetting             = GeneralSetting::find('1');
use Illuminate\Support\Facades\Route;
$routeName = Route::current();
$pageName = $routeName->uri();
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
                            <li class="nav-item <?= $pageName == '/' ? 'active' : '' ?>">
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
                            <?php }?>
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
                                    $user_id = session('user_id');
                                    $role = session('role');
                                    if ($role == 1) {
                                        $getUser = StudentProfile::where('user_id', '=', $user_id)->first();
                                    } else {
                                        $getUser = MentorProfile::where('user_id', '=', $user_id)->first();
                                    }
                                    if ($getUser) {
                                        if ($getUser->profile_pic != '') {
                                            $imageLink = env('UPLOADS_URL') . 'user/' . $getUser->profile_pic;
                                        } else {
                                            $imageLink = env('NO_IMAGE_AVATAR');
                                        }
                                    } else {
                                        $imageLink = env('NO_IMAGE_AVATAR');
                                    }
                                    ?>
                                    <img class="avatar-img" src="<?= $imageLink ?>" alt="{{ session('name') }}">
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
