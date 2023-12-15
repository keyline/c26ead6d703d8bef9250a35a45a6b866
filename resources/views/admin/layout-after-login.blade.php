<!DOCTYPE html>
<html lang="en">
<head>
  <?=$head?>
  <style type="text/css">
    a.nav-link.active {
      color: #4154f1;
      background: #f6f9ff;
    }
    .sidebar-nav .nav-link {
      background: none;
      color: #012970;
    }
  </style>
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <?=$header?>
  </header><!-- End Header -->
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <?=$sidebar?>
  </aside><!-- End Sidebar-->
  <main id="main" class="main">
    <?=$maincontent?>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <?=$footer?>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/quill/quill.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script type="text/javascript">
    $(function(){
      $('.autohide').delay(5000).fadeOut('slow');
    })
    
  </script>
</body>
</html>