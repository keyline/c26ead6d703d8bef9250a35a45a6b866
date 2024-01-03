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
      $page_link            = $row->page_link;
      $page_title           = $row->page_title;
      $meta_keyword         = $row->meta_keyword;
      $meta_description     = $row->meta_description;
    } else {
      $page_link            = '';
      $page_title           = '';
      $meta_keyword         = '';
      $meta_description     = '';
    }
    ?>
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label for="page_link" class="col-md-2 col-lg-2 col-form-label">Page Link</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="page_link" class="form-control" id="page_link" value="<?=$page_link?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="page_title" class="col-md-2 col-lg-2 col-form-label">Page Title</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="page_title" class="form-control" id="page_title" value="<?=$page_title?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="meta_keyword" class="col-md-2 col-lg-2 col-form-label">Meta Keywords</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="meta_keyword" class="form-control" id="meta_keyword" rows="5" required><?=$meta_keyword?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="meta_description" class="col-md-2 col-lg-2 col-form-label">Meta Description</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="meta_description" class="form-control" id="meta_description" rows="5" required><?=$meta_description?></textarea>
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