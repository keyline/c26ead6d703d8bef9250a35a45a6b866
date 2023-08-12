<?php
use App\Helpers\Helper;
$controllerRoute = $module['controller_route'];
?>
<div class="pagetitle">
  <h1><?=$page_header?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Home</a></li>
      <li class="breadcrumb-item active"><a href="<?=url('admin/' . $controllerRoute . '/list/')?>"><?=$module['title']?> List</a></li>
      <li class="breadcrumb-item active"><?=$page_header?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section profile">
  <div class="row">
    <div class="col-xl-12">
      @if(session('success_message'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide" role="alert">
          {{ session('success_message') }}
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if(session('error_message'))
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
          {{ session('error_message') }}
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </div>
    <?php
    if($row){
      $code             = $row->code;
      $currency         = $row->currency;
      $display_text     = $row->display_text;
    } else {
      $code             = '';
      $currency         = '';
      $display_text     = '';
    }
    ?>
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label for="code" class="col-md-2 col-lg-2 col-form-label">Code</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="code" class="form-control" id="code" value="<?=$code?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="currency" class="col-md-2 col-lg-2 col-form-label">Currency</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="currency" class="form-control" id="currency" value="<?=$currency?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="display_text" class="col-md-2 col-lg-2 col-form-label">Display Text</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="display_text" class="form-control" id="display_text" value="<?=$display_text?>" required>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary"><?=(($row)?'Save':'Add')?></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>