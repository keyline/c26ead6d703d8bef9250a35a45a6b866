<?php
use Illuminate\Support\Facades\Route;;
$routeName = Route::current();
$pageName = $routeName->uri();
?>
<!doctype html>
<html lang="en">
   <head>
      <?=$head?>
   </head>
   <body>
      <?=$maincontent?>
      <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
   </body>
</html>