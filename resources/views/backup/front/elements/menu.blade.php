<?php
use Illuminate\Support\Facades\Route;;
$routeName = Route::current();
$pageName = $routeName->uri();
// dd($routeName);
?>
<ul>
    <li><a href="<?=url('dashboard')?>" <?=(($pageName == 'dashboard')?'class="active"':'')?>>Dashboard</a></li>
    <li><a href="<?=url('translate')?>" <?=(($pageName == 'translate')?'class="active"':'')?>>Translate</a></li>
    <li><a href="<?=url('translate-history')?>" <?=(($pageName == 'translate-history')?'class="active"':'')?>>Transaction History</a></li>
    <li><a href="<?=url('update-profile')?>" <?=(($pageName == 'update-profile')?'class="active"':'')?>>Update Profile</a></li>
    <li><a href="<?=url('change-password')?>" <?=(($pageName == 'change-password')?'class="active"':'')?>>Change Password</a></li>
    <li><a href="<?=url('signout')?>">Sign Out</a></li>
</ul>