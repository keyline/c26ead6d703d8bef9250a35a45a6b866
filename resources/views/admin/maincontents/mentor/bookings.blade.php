<?php
use App\Models\User;
use App\Models\MentorProfile;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\StudentProfile;
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
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1">All (<?=count($all_bookings)?>)</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab2">Upcoming (<?=count($upcoming_bookings)?>)</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab3">Past (<?=count($past_bookings)?>)</button>
            </li>
          </ul>
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active all-booking-overview" id="tab1">
              <h5 style="font-weight: bold;">All Booking List</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Booking Number</th>
                      <th>Booking Date</th>
                      <th>Student Details</th>
                      <th>Service Type<br> Service</th>
                      <th>Duration</th>
                      <th>Student Paid Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($all_bookings){ $sl=1;foreach($all_bookings as $booking){
                      $student = User::where('id', '=', $booking->student_id)->first();
                    ?>
                      <tr>
                        <td><?=$sl++?></td>
                        <td><?=$booking->booking_no?></td>
                        <td>
                          <?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
                        </td>
                        <td>
                          <h6><i class="fa fa-user"></i> <?=(($student)?$student->name:'')?></h6>
                            <h6><i class="fa fa-envelope"></i> <?=(($student)?$student->email:'')?></h6>
                            <h6><i class="fa fa-mobile"></i> <?=(($student)?$student->phone:'')?></h6>
                          </td>
                        <td>
                          <?php
                          $service_type = ServiceType::select('name')->where('id', '=', $booking->service_type_id)->first();
                          echo (($service_type)?$service_type->name:'');
                          ?>
                          <br>
                          <?php
                          $service = Service::select('name')->where('id', '=', $booking->service_id)->first();
                          echo (($service)?$service->name:'');
                          ?>
                        </td>
                        <td><?=$booking->duration?> mins</td>
                        <td><?=number_format($booking->payable_amt,2)?></td>
                        <td>
                          <?php if($booking->payment_status){?>
                            <a href="<?=url('admin/mentor/print-mentor-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
                          <?php }?>
                        </td>
                      </tr>
                    <?php } }?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade past-booking-overview" id="tab2">
              <h5 style="font-weight: bold;">Upcoming Booking List</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Booking Number</th>
                      <th>Booking Date</th>
                      <th>Student Details</th>
                      <th>Service Type<br> Service</th>
                      <th>Duration</th>
                      <th>Student Paid Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($upcoming_bookings){ $sl=1;foreach($upcoming_bookings as $booking){
                      $student = User::where('id', '=', $booking->student_id)->first();
                    ?>
                      <tr>
                        <td><?=$sl++?></td>
                        <td><?=$booking->booking_no?></td>
                        <td>
                          <?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
                        </td>
                        <td>
                          <h6><i class="fa fa-user"></i> <?=(($student)?$student->name:'')?></h6>
                            <h6><i class="fa fa-envelope"></i> <?=(($student)?$student->email:'')?></h6>
                            <h6><i class="fa fa-mobile"></i> <?=(($student)?$student->phone:'')?></h6>
                          </td>
                        <td>
                          <?php
                          $service_type = ServiceType::select('name')->where('id', '=', $booking->service_type_id)->first();
                          echo (($service_type)?$service_type->name:'');
                          ?>
                          <br>
                          <?php
                          $service = Service::select('name')->where('id', '=', $booking->service_id)->first();
                          echo (($service)?$service->name:'');
                          ?>
                        </td>
                        <td><?=$booking->duration?> mins</td>
                        <td><?=number_format($booking->payable_amt,2)?></td>
                        <td>
                          <?php if($booking->payment_status){?>
                            <a href="<?=url('admin/mentor/print-mentor-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
                          <?php }?>
                        </td>
                      </tr>
                    <?php } }?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade upcoming-booking-overview" id="tab3">
              <h5 style="font-weight: bold;">Past Booking List</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Booking Number</th>
                      <th>Booking Date</th>
                      <th>Student Details</th>
                      <th>Service Type<br> Service</th>
                      <th>Duration</th>
                      <th>Student Paid Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($past_bookings){ $sl=1;foreach($past_bookings as $booking){
                      $student = User::where('id', '=', $booking->student_id)->first();
                    ?>
                      <tr>
                        <td><?=$sl++?></td>
                        <td><?=$booking->booking_no?></td>
                        <td>
                          <?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
                        </td>
                        <td>
                          <h6><i class="fa fa-user"></i> <?=(($student)?$student->name:'')?></h6>
                            <h6><i class="fa fa-envelope"></i> <?=(($student)?$student->email:'')?></h6>
                            <h6><i class="fa fa-mobile"></i> <?=(($student)?$student->phone:'')?></h6>
                          </td>
                        <td>
                          <?php
                          $service_type = ServiceType::select('name')->where('id', '=', $booking->service_type_id)->first();
                          echo (($service_type)?$service_type->name:'');
                          ?>
                          <br>
                          <?php
                          $service = Service::select('name')->where('id', '=', $booking->service_id)->first();
                          echo (($service)?$service->name:'');
                          ?>
                        </td>
                        <td><?=$booking->duration?> mins</td>
                        <td><?=number_format($booking->payable_amt,2)?></td>
                        <td>
                          <?php if($booking->payment_status){?>
                            <a href="<?=url('admin/mentor/print-mentor-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
                          <?php }?>
                        </td>
                      </tr>
                    <?php } }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>