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
      $service_type_id          = $row->service_type_id;
      $service_id               = $row->service_id;
      $service_attribute_id     = $row->service_attribute_id;
    } else {
      $service_type_id          = '';
      $service_id               = '';
      $service_attribute_id     = '';
    }
    ?>
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <form method="POST" action="{{ url('admin/service-association/postData') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label for="service_id" class="col-md-2 col-lg-2 col-form-label">Service</label>
              <div class="col-md-10 col-lg-10">
                <select name="service_id" class="form-control" id="service_id" required>
                  <option value="" selected>Select Service</option>
                  <?php if($services){ foreach($services as $service){?>
                  <option value="<?=$service->id?>"><?=$service->name?></option>
                  <?php } }?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="service_type_id" class="col-md-2 col-lg-2 col-form-label">Service Type</label>
              <div class="col-md-10 col-lg-10">
                <select name="service_type_id" class="form-control" id="service_type_id" required>
                  <option value="" selected>Select Service Type</option>
                  <?php if($serviceTypes){ foreach($serviceTypes as $serviceType){?>
                  <option value="<?=$serviceType->id?>"><?=$serviceType->name?></option>
                  <?php } }?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="service_id" class="col-md-2 col-lg-2 col-form-label">Service Attribute</label>
              <div class="col-md-10 col-lg-10">
                <select name="service_attribute_id" class="form-control" id="service_attribute_id" required>
                  <option value="" selected>Select Service Attribute</option>
                  <?php if($serviceAttributes){ foreach($serviceAttributes as $serviceAttribute){?>
                  <option value="<?=$serviceAttribute->id?>"><?=$serviceAttribute->title?></option>
                  <?php } }?>
                </select>
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