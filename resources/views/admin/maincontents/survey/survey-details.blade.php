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
            <div class="col-md-3">
              <h6>Survey Type</h6>
            </div>
            <div class="col-md-9">
              <small>MCQ</small>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <h6>Description</h6>
            </div>
            <div class="col-md-9">
              <small>Self-esteem is determined by how you view yourself. We all value ourselves.Each of us has an opinion of who we are.There are several factors that can influence how you view yourself. It's possible for people to experience recurring shifts in their self-perception. However, some people don't always feel good about themselves. They may not value themselves highly.</small>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <h6>Guidelines</h6>
            </div>
            <div class="col-md-9">
              <small>Please click the appropriate answer for each item, depending on whether you Strongly agree, agree, disagree, or strongly disagree with it.</small>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <h6>No Of Questions</h6>
            </div>
            <div class="col-md-9">
              <small>10</small>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body pt-3">
          <ul class="list-group">
            <li class="list-group-item">
              <h5>Q. dfasfasdfas</h5>
              <h5>A. dfasfasdfas</h5>
            </li>
            <li class="list-group-item">
              <h5>Q. dfasfasdfas</h5>
              <h5>A. dfasfasdfas</h5>
            </li>
            <li class="list-group-item">
              <h5>Q. dfasfasdfas</h5>
              <h5>A. dfasfasdfas</h5>
            </li>
            <li class="list-group-item">
              <h5>Q. dfasfasdfas</h5>
              <h5>A. dfasfasdfas</h5>
            </li>
            <li class="list-group-item">
              <h5>Q. dfasfasdfas</h5>
              <h5>A. dfasfasdfas</h5>
            </li>
            <li class="list-group-item">
              <h5>Q. dfasfasdfas</h5>
              <h5>A. dfasfasdfas</h5>
            </li>
          </ul>
          
        </div>
      </div>

    </div>
  </div>
</section>