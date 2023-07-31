<!doctype html>
<html>
<head>
  <?=$head?>
</head>
<body>
  <header class="header">
    <?=$header?>
  </header>
  <div class="inner-banner">
      <img src="<?=env('FRONT_ASSETS_URL')?>assets/img/inner-banner.png" class="w-100">
      <h3><?=$page_header?></h3>
    </div>
    <div class="after-login-layout">
      <div class="container">
        <div class="after-login-menu">
          <?=$menu?>
        </div>
        <div class="after-login-body">
          @if(session('success_message'))
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide" role="alert">
              {{ session('success_message') }}
            </div>
          @endif
          @if(session('error_message'))
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
              {{ session('error_message') }}
            </div>
          @endif
          <?=$maincontent?>
      </div>
    </div>      
  </div>
  <footer class="footer">
    <?=$footer?>
  </footer>
  <!-- Bootstrap core JavaScript --> 
  <!--<script src="https://code.jquery.com/jquery-3.4.1.js"></script>--> 
  <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/jquery.1.11.3.min.js"></script> 
  <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/bootstrap.min.js"></script>  
  <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/owl.carousel.js"></script>
  <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/theme.js"></script> 
  <script type="text/javascript" src="<?=env('FRONT_ASSETS_URL')?>assets/js/stellarnav.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/jquery.loading.js"></script>
  <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/sweetalert2.all.min.js"></script>
  <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/common-function.js"></script>
  <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/autotranslate.js"></script>
  <script type="text/javascript">
    $(function(){
      $('.autohide').delay(5000).fadeOut('slow');
    })
  </script>
  <script>
    let digitValidate = function(ele){
        console.log(ele.value);
        ele.value = ele.value.replace(/[^0-9]/g,'');
    }
    let tabChange = function(val){
        let ele = document.querySelectorAll('input');
        if(ele[val-1].value != ''){
          ele[val].focus()
        }else if(ele[val-1].value == ''){
          ele[val-2].focus()
        }   
    }
  </script>
</body>
</html>