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

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="<?=$meta_description?>">
<meta name="keywords" content="<?=$meta_keyword?>">
<meta name="author" content="<?php echo $generalSetting->site_name;?>">

<title><?=$title;?></title>
<!-- Favicons -->
<link href="<?=env('UPLOADS_URL').$generalSetting->site_favicon?>" rel="icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>vendors/simplebar/css/simplebar.css">
<link rel="stylesheet" type="text/css" href="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>css/bvselect.css">
<link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link href="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>css/style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=env('FRONT_DASHBOARD_ASSETS_URL')?>css/responsive.css">
<style type="text/css">
	.sidebar-nav .nav-link.active {
	    color: #fff;
	    background: rgb(249 35 63);
	}
</style>