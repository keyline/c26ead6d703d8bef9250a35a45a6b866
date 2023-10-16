<?php
use App\Helpers\Helper;
use App\Models\ServiceDetail;
use App\Models\ServiceAttribute;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\ServiceTypeAttribute;
$controllerRoute = $module['controller_route'];
?>
<div class="pagetitle">
  <h1><?=$page_header?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Home</a></li>
      <li class="breadcrumb-item active"><?=$page_header?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
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
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body pt-3">
          <div class="row">
            <?php
            if($assign_services){ foreach($assign_services as $assign_service){
              $service_type_attribute = ServiceTypeAttribute::select('service_type_id', 'service_id')->where('service_attribute_id', '=', $assign_service->service_attribute_id)->first();
              if($service_type_attribute){
                $serviceType = ServiceType::select('name')->where('id', '=', $service_type_attribute->service_type_id)->first();
                $service = Service::select('name')->where('id', '=', $service_type_attribute->service_id)->first();
              } else {
                $serviceType  = [];
                $service      = [];
              }
              
            ?>
              <div class="col-lg-3">
                <!-- Card with an image on top -->
                <div class="card">
                  <!-- <img src="http://localhost/stumento/public/uploads/1690805871logo.jpeg" class="card-img-top" alt="..."> -->
                  <div class="card-body">
                    <h class="card-title"><?=$assign_service->title?></h>
                    <p><?=$assign_service->description?></p>
                    <p class="card-text">Service Type : <?=(($serviceType)?$serviceType->name:'')?></p>
                    <p class="card-text">Service : <?=(($service)?$service->name:'')?></p>
                    <span style="float: left;">Price : <?=$assign_service->total_amount_payable?></span>
                    <span style="float: right;">Duration : <?=$assign_service->duration?> mins</span>
                  </div>
                </div><!-- End Card with an image on top -->
              </div>
            <?php } }?>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>