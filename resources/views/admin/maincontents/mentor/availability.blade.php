<?php
use App\Helpers\Helper;
$controllerRoute = $module['controller_route'];
use App\Models\MentorSlot;
use App\Models\Booking;
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
            <?php if($getSlotAvailability){ foreach($getSlotAvailability as $slot){ 
            $getSlots = MentorSlot::select('from_time', 'to_time')->where('mentor_availability_id', '=', $slot->id)->get();
            ?>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h5><?=Helper::getShortDayName($slot->day_of_week_id)?></h5>
                  <small><?=date('h:i A', strtotime($slot->avail_from));?> - <?= date('h:i A', strtotime($slot->avail_to));?></small>
                </div>
                <div class="card-body">
                  <div class="row">
                    <?php if($getSlots){ foreach($getSlots as $getSlot){ ?>
                      <div class="col-md-3">
                        <span class="badge bg-primary"><?=date('h:i A', strtotime($getSlot->from_time))?></span>
                      </div>
                    <?php } }?>
                  </div>
                </div>
              </div>
            </div>
          <?php } }else{ ?>
            
          <?php } ?>
        </div> 
          
          <!-- <div class="row">
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
          <hr> -->
         
        </div>
      </div>

    </div>
  </div>
</sectionPM