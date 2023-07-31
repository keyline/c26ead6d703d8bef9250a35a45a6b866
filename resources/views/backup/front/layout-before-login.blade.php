<!doctype html>
<html>
<head>
  <?=$head?>
</head>
<body>
  <div class="auth-layout">
    <?=$maincontent?>
  </div>
  <!-- Bootstrap core JavaScript --> 
  <!--<script src="https://code.jquery.com/jquery-3.4.1.js"></script>--> 
  <!-- <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/jquery.1.11.3.min.js"></script>  -->
  <script src="https://code.jquery.com/jquery-3.2.0.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
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
    $("#phone").keydown(function(e) {
      var oldvalue=$(this).val();
      var field=this;
      setTimeout(function () {
          if(field.value.indexOf('+971') !== 0) {
              $(field).val(oldvalue);
          } 
      }, 1);
    });
    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    }
    var timeoutHandle;
    function countdown(minutes, seconds) {
        function tick() {
            var counter = document.getElementById("timer");
            counter.innerHTML =
                minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
            seconds--;
            if (seconds <=0) {
                counter.innerHTML = '';
                document.getElementById("resend-div").style.display = "block";
            } else if (seconds > 0) {
                timeoutHandle = setTimeout(tick, 1000);
            } else {
                if (minutes >= 1) {
                    // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
                    setTimeout(function () {
                        countdown(minutes - 1, 59);
                    }, 1000);
                }
            }
        }
        tick();
    }
    countdown(0, 10);
  </script>
</body>
</html>