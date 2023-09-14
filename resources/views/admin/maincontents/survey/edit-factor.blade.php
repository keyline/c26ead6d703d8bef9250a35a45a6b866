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
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Survey </label>
               <div class="col-md-8 col-lg-8">
                <input type="text"class="form-control" id="minWeight" value="<?=$getSurvey->title;?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Factor </label>
               <div class="col-md-8 col-lg-8">
                <input type="text" class="form-control" id="factor" value="<?=$factor?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Factor Description </label>
               <div class="col-md-8 col-lg-8">
               <textarea  class="form-control" name="factor_description" id="factor_description" rows="2"><?=$getfactor->factor_description?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="page_name" class="col-md-2 col-lg-2 col-form-label">Range From Description </label>
               <div class="col-md-8 col-lg-8">
               <textarea  class="form-control" name="range_from_description" id="range_from_description" rows="2"><?=$getfactor->range_from_description?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="range_to_description" class="col-md-2 col-lg-2 col-form-label">Range To Description </label>
               <div class="col-md-8 col-lg-8">
               <textarea  class="form-control" name="range_to_description" id="range_to_description" rows="2"><?=$getfactor->range_to_description?></textarea>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary"><?=(($row)?'Save':'Save')?></button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</section>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
