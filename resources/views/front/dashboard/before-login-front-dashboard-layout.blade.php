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
      <form action="#" method="POST" id="demo-form">
         <br>
         <button class="g-recaptcha" data-sitekey="6LfEu0opAAAAAIP82Q9XnG0dYN81-_DteAszQFMN" data-callback="onSubmit" style="display: none;">Submit</button>
      </form>
   </body>
</html>