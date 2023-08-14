<?php
use App\Helpers\Helper;
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
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p style="font-weight:bold;">Monday</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">09:30 AM</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">07:30 PM</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p style="font-weight:bold;">Tuesday</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">09:30 AM</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">07:30 PM</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p style="font-weight:bold;">Wednesday</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">09:30 AM</p>
              <p class="text-success">05:30 PM</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">02:30 PM</p>
              <p class="text-success">09:30 PM</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p style="font-weight:bold;">Thursday</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">09:30 AM</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">07:30 PM</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p style="font-weight:bold;">Friday</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">09:30 AM</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">07:30 PM</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p style="font-weight:bold;">Saturday</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-danger">Unavailable</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-danger">Unavailable</p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p style="font-weight:bold;">Sunday</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">09:30 AM</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <p class="text-success">07:30 PM</p>
            </div>
          </div>
          <hr>
          
        </div>
      </div>

    </div>
  </div>
</sectionPM