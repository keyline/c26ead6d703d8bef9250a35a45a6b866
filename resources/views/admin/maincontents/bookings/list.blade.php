<?php
use App\Models\User;
use App\Models\MentorProfile;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\StudentProfile;
use App\Models\AdminPayment;
use App\Models\MentorPayment;
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
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab3">Completed (<?=count($past_bookings)?>)</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab4">Unpaid (<?=count($unpaid_bookings)?>)</button>
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
                      <th>Booking No<br>Booking Date</th>
                      <th>Mentor</th>
                      <th>Student</th>
                      <th>Service Type<br> Service</th>
                      <th>Duration</th>
                      <th>Student Pay</th>
                      <th>GST</th>
                      <th>Mentor<br>Commission</th>
                      <th>Admin<br>Commission</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $tot_payment_amt = 0;
                    $tot_gst_amt = 0;
                    $tot_admin_amt = 0;
                    $tot_mentor_amt = 0;
                    if($all_bookings){ $sl=1;foreach($all_bookings as $booking){
                      $mentor   = User::where('id', '=', $booking->mentor_id)->first();
                      $student  = User::where('id', '=', $booking->student_id)->first();
                      $wallet   = AdminPayment::where('booking_id', '=', $booking->id)->first();
                    ?>
                      <tr>
                        <td><?=$sl++?></td>
                        <td>
                          <?=$booking->booking_no?><br>
                          <?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
                        </td>
                        <td>
                          <h6><i class="fa fa-user"></i> <?=(($mentor)?$mentor->name:'')?></h6>
                            <h6><i class="fa fa-envelope"></i> <?=(($mentor)?$mentor->email:'')?></h6>
                            <h6><i class="fa fa-mobile"></i> <?=(($mentor)?$mentor->phone:'')?></h6>
                          </td>
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
                        <td><?=number_format($booking->payment_amount,2)?></td>
                        <td><?=number_format($booking->gst_amount,2)?></td>
                        <td><?=number_format((($wallet)?$wallet->admin_commision:0), 2)?></td>
                        <td><?=number_format((($wallet)?$wallet->mentor_commision:0), 2)?></td>
                        <td>
                          <?php if($booking->payment_status){?>
                            <a href="<?=$booking->meeting_link?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-handshake"></i> Meeting Link</a>
                            <br><br>
                            <a href="<?=url('admin/mentor/print-mentor-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
                          <?php }?>
                        </td>
                      </tr>
                      <?php
                      $tot_payment_amt  += $booking->payment_amount;
                      $tot_gst_amt      += $booking->gst_amount;
                      $tot_admin_amt    += (($wallet)?$wallet->admin_commision:0);
                      $tot_mentor_amt   += (($wallet)?$wallet->mentor_commision:0);
                      ?>
                    <?php } }?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Total</td>
                      <td style="font-weight:bold;"><?=number_format($tot_payment_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_gst_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_admin_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_mentor_amt, 2)?></td>
                      <td></td>
                    </tr>
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
                      <th>Booking No<br>Booking Date</th>
                      <th>Mentor</th>
                      <th>Student</th>
                      <th>Service Type<br> Service</th>
                      <th>Duration</th>
                      <th>Student Pay</th>
                      <th>GST</th>
                      <th>Mentor<br>Commission</th>
                      <th>Admin<br>Commission</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $tot_payment_amt = 0;
                    $tot_gst_amt = 0;
                    $tot_admin_amt = 0;
                    $tot_mentor_amt = 0;
                    if($upcoming_bookings){ $sl=1;foreach($upcoming_bookings as $booking){
                      $mentor   = User::where('id', '=', $booking->mentor_id)->first();
                      $student  = User::where('id', '=', $booking->student_id)->first();
                      $wallet   = AdminPayment::where('booking_id', '=', $booking->id)->first();
                    ?>
                      <tr>
                        <td><?=$sl++?></td>
                        <td>
                          <?=$booking->booking_no?><br>
                          <?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
                        </td>
                        <td>
                          <h6><i class="fa fa-user"></i> <?=(($mentor)?$mentor->name:'')?></h6>
                            <h6><i class="fa fa-envelope"></i> <?=(($mentor)?$mentor->email:'')?></h6>
                            <h6><i class="fa fa-mobile"></i> <?=(($mentor)?$mentor->phone:'')?></h6>
                          </td>
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
                        <td><?=number_format($booking->payment_amount,2)?></td>
                        <td><?=number_format($booking->gst_amount,2)?></td>
                        <td><?=number_format((($wallet)?$wallet->admin_commision:0), 2)?></td>
                        <td><?=number_format((($wallet)?$wallet->mentor_commision:0), 2)?></td>
                        <td>
                          <?php if($booking->payment_status){?>
                            <a href="<?=$booking->meeting_link?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-handshake"></i> Meeting Link</a>
                            <br><br>
                            <a href="<?=url('admin/mentor/print-mentor-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
                          <?php }?>
                        </td>
                      </tr>
                      <?php
                      $tot_payment_amt  += $booking->payment_amount;
                      $tot_gst_amt      += $booking->gst_amount;
                      $tot_admin_amt    += (($wallet)?$wallet->admin_commision:0);
                      $tot_mentor_amt   += (($wallet)?$wallet->mentor_commision:0);
                      ?>
                    <?php } }?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Total</td>
                      <td style="font-weight:bold;"><?=number_format($tot_payment_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_gst_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_admin_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_mentor_amt, 2)?></td>
                      <td></td>
                    </tr>
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
                      <th>Booking No<br>Booking Date</th>
                      <th>Mentor</th>
                      <th>Student</th>
                      <th>Service Type<br> Service</th>
                      <th>Duration</th>
                      <th>Student Pay</th>
                      <th>GST</th>
                      <th>Mentor<br>Commission</th>
                      <th>Admin<br>Commission</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $tot_payment_amt = 0;
                    $tot_gst_amt = 0;
                    $tot_admin_amt = 0;
                    $tot_mentor_amt = 0;
                    if($past_bookings){ $sl=1;foreach($past_bookings as $booking){
                      $mentor   = User::where('id', '=', $booking->mentor_id)->first();
                      $student  = User::where('id', '=', $booking->student_id)->first();
                      $wallet   = AdminPayment::where('booking_id', '=', $booking->id)->first();
                    ?>
                      <tr>
                        <td><?=$sl++?></td>
                        <td>
                          <?=$booking->booking_no?><br>
                          <?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
                        </td>
                        <td>
                          <h6><i class="fa fa-user"></i> <?=(($mentor)?$mentor->name:'')?></h6>
                            <h6><i class="fa fa-envelope"></i> <?=(($mentor)?$mentor->email:'')?></h6>
                            <h6><i class="fa fa-mobile"></i> <?=(($mentor)?$mentor->phone:'')?></h6>
                          </td>
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
                        <td><?=number_format($booking->payment_amount,2)?></td>
                        <td><?=number_format($booking->gst_amount,2)?></td>
                        <td><?=number_format((($wallet)?$wallet->admin_commision:0), 2)?></td>
                        <td><?=number_format((($wallet)?$wallet->mentor_commision:0), 2)?></td>
                        <td>
                          <?php if($booking->payment_status){?>
                            <a href="<?=$booking->meeting_link?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-handshake"></i> Meeting Link</a>
                            <br><br>
                            <a href="<?=url('admin/mentor/print-mentor-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
                          <?php }?>
                        </td>
                      </tr>
                      <?php
                      $tot_payment_amt  += $booking->payment_amount;
                      $tot_gst_amt      += $booking->gst_amount;
                      $tot_admin_amt    += (($wallet)?$wallet->admin_commision:0);
                      $tot_mentor_amt   += (($wallet)?$wallet->mentor_commision:0);
                      ?>
                    <?php } }?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Total</td>
                      <td style="font-weight:bold;"><?=number_format($tot_payment_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_gst_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_admin_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_mentor_amt, 2)?></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade upcoming-booking-overview" id="tab4">
              <h5 style="font-weight: bold;">Unpaid Booking List</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Booking No<br>Booking Date</th>
                      <th>Mentor</th>
                      <th>Student</th>
                      <th>Service Type<br> Service</th>
                      <th>Duration</th>
                      <th>Student Pay</th>
                      <th>GST</th>
                      <th>Mentor<br>Commission</th>
                      <th>Admin<br>Commission</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $tot_payment_amt = 0;
                    $tot_gst_amt = 0;
                    $tot_admin_amt = 0;
                    $tot_mentor_amt = 0;
                    if($unpaid_bookings){ $sl=1;foreach($unpaid_bookings as $booking){
                      $mentor   = User::where('id', '=', $booking->mentor_id)->first();
                      $student  = User::where('id', '=', $booking->student_id)->first();
                      $wallet   = AdminPayment::where('booking_id', '=', $booking->id)->first();
                    ?>
                      <tr>
                        <td><?=$sl++?></td>
                        <td>
                          <?=$booking->booking_no?><br>
                          <?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?>
                        </td>
                        <td>
                          <h6><i class="fa fa-user"></i> <?=(($mentor)?$mentor->name:'')?></h6>
                            <h6><i class="fa fa-envelope"></i> <?=(($mentor)?$mentor->email:'')?></h6>
                            <h6><i class="fa fa-mobile"></i> <?=(($mentor)?$mentor->phone:'')?></h6>
                          </td>
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
                        <td><?=number_format($booking->payment_amount,2)?></td>
                        <td><?=number_format($booking->gst_amount,2)?></td>
                        <td><?=number_format((($wallet)?$wallet->admin_commision:0), 2)?></td>
                        <td><?=number_format((($wallet)?$wallet->mentor_commision:0), 2)?></td>
                        <td>
                          <?php if($booking->payment_status){?>
                            <a href="<?=url('admin/mentor/print-mentor-invoice/'.Helper::encoded($booking->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
                          <?php }?>
                        </td>
                      </tr>
                      <?php
                      $tot_payment_amt  += $booking->payment_amount;
                      $tot_gst_amt      += $booking->gst_amount;
                      $tot_admin_amt    += (($wallet)?$wallet->admin_commision:0);
                      $tot_mentor_amt   += (($wallet)?$wallet->mentor_commision:0);
                      ?>
                    <?php } }?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Total</td>
                      <td style="font-weight:bold;"><?=number_format($tot_payment_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_gst_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_admin_amt, 2)?></td>
                      <td style="font-weight:bold;"><?=number_format($tot_mentor_amt, 2)?></td>
                      <td></td>
                    </tr>
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