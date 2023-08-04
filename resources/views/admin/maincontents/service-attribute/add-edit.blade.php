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
      $service_type_id    = $row->service_type_id;
      $service_id         = $row->service_id;
      $name               = $row->name;
      $description        = $row->description;
      $duration           = $row->duration;
      $actual_amount      = $row->actual_amount;
      $slashed_amount     = $row->slashed_amount;
    } else {
      $service_type_id    = '';
      $service_id         = '';
      $name               = '';
      $description        = '';
      $duration           = '';
      $actual_amount      = '';
      $slashed_amount     = '';
    }
    ?>
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label for="service_type_id" class="col-md-2 col-lg-2 col-form-label">Service Type</label>
              <div class="col-md-10 col-lg-10">
                <select name="service_type_id" class="form-control" id="service_type_id" required>
                  <option value="" selected>Select Service Type</option>
                  <?php if($serviceTypes){ foreach($serviceTypes as $serviceType){?>
                  <option value="<?=$serviceType->id?>" <?=(($serviceType->id == $service_type_id)?'selected':'')?>><?=$serviceType->name?></option>
                  <?php } }?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="service_id" class="col-md-2 col-lg-2 col-form-label">Service</label>
              <div class="col-md-10 col-lg-10">
                <select name="service_id" class="form-control" id="service_id" required>
                  <option value="" selected>Select Service</option>
                  <?php if($services){ foreach($services as $service){?>
                  <option value="<?=$service->id?>" <?=(($service->id == $service_id)?'selected':'')?>><?=$service->name?></option>
                  <?php } }?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="name" class="col-md-2 col-lg-2 col-form-label">Name</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="name" class="form-control" id="name" value="<?=$name?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="description" class="col-md-2 col-lg-2 col-form-label">Description</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="description" class="form-control" id="description" rows="5" required><?=$description?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="duration" class="col-md-2 col-lg-2 col-form-label">Duration</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="duration" class="form-control" id="duration" value="<?=$duration?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="actual_amount" class="col-md-2 col-lg-2 col-form-label">Actual Amount</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="actual_amount" class="form-control" id="actual_amount" value="<?=$actual_amount?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="slashed_amount" class="col-md-2 col-lg-2 col-form-label">Slashed Amount</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="slashed_amount" class="form-control" id="slashed_amount" value="<?=$slashed_amount?>" required>
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