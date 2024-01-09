<?php
use Illuminate\Support\Facades\Route;
use App\Models\GeneralSetting;
use App\Models\MetaInformation;
use App\Helpers\Helper;

$routeName = Route::current();
$pageName = ($pageName) ?? $routeName->uri();

$page_link  = url()->current();
$url        = url('/');
if($page_link == $url){
    $slugSearch = '/';
} else {
    $page_slug  = explode($url.'/', $page_link);
    $slugSearch = $page_slug[1];
}
$getPage    = MetaInformation::select('id', 'page_link', 'page_slug', 'page_title', 'meta_keyword', 'meta_description')
    ->where('page_slug', '=', $slugSearch)
    ->first();
if ($getPage) {
    $meta_description   = $getPage->meta_description;
    $meta_keyword       = $getPage->meta_keyword;
} else {
    $meta_description   = $generalSetting->meta_description;
    $meta_keyword      = $generalSetting->meta_title;
}
?>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="<?=$meta_description?>">
<meta name="keywords" content="<?=$meta_keyword?>">
<meta name="author" content="<?php echo $generalSetting->site_name;?>">

<!-- Google Analytic Code -->
<?php echo $generalSetting->google_analytics_code;?>
<!-- Google Analytic Code -->

<!-- Google Pixel Code -->
<?php echo $generalSetting->google_pixel_code;?>
<!-- Google Pixel Code -->

<!-- Favicons -->
<link href="<?=env('UPLOADS_URL').$generalSetting->site_favicon?>" rel="icon">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?=env('FRONT_ASSETS_URL')?>assets/css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?=env('FRONT_ASSETS_URL')?>assets/css/menumaker.css">
<!-- <link rel="stylesheet" href="<?=env('FRONT_ASSETS_URL')?>assets/css/jquery.serialtabs.css" />-->
<title><?=$title?></title>
<!------------GOOGLE FONT------------>
<!------------ZMDI ICON------------>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<link rel="stylesheet" 
   href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
   crossorigin="anonymous" referrerpolicy="no-referrer" />
<!------------OWL------------>
<link rel="stylesheet" href="<?=env('FRONT_ASSETS_URL')?>assets/owl/owl3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php if(($pageName == 'mentor-signup-4')) {?>
<link rel="stylesheet" type="text/css" href="<?=env('FRONT_ASSETS_URL')?>assets/css/bvselect.css">
<?php }?>

<!--    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">-->
<!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="<?=env('FRONT_ASSETS_URL')?>assets/css/easy-responsive-tabs.css " />
<link rel="stylesheet" type="text/css" href="<?=env('FRONT_ASSETS_URL')?>assets/css/style.css">

<?php if(($pageName == 'how-it-works') || ($pageName == 'signin') || ($pageName == 'forgot-password') || ($pageName == 'validate-otp') || ($pageName == 'reset-password') || ($pageName == 'student-signup') || ($pageName == 'mentor-signup') || ($pageName == 'mentor-signup-2') || ($pageName == 'mentor-signup-3') || ($pageName == 'mentor-signup-4')) {?>
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
<?php }?>

<?php //if(($pageName == 'blogs') || ($pageName == 'how-it-works') || ($pageName == 'signin') || ($pageName == 'forgot-password') || ($pageName == 'validate-otp') || ($pageName == 'reset-password') || ($pageName == 'student-signup') || ($pageName == 'mentor-signup') || ($pageName == 'mentors') || ($pageName == 'mentor-details')) {?>
   <link rel="stylesheet" type="text/css" href="<?=env('FRONT_ASSETS_URL')?>assets/css/master.css">
<?php //}?>

<link rel="stylesheet" type="text/css" href="<?=env('FRONT_ASSETS_URL')?>assets/css/responsive.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    function onSubmit() {
        document.getElementById("demo-form").submit();
    }
</script>
    
<style type="text/css">    
    .toast-success {
        background-color: #000;
        color: #28a745 !important;
    }
    .toast-error {
        background-color: #000;
        color: #dc3545 !important;
    }
    .toast-warning {
        background-color: #000;
        color: #ffc107 !important;
    }
    .toast-info {
        background-color: #000;
        color: #007bff !important;
    }
</style>