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
   </body>
</html>