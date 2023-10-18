<?php
use App\Models\User;
use App\Models\MentorProfile;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\StudentProfile;
use App\Models\Booking;
use App\Models\BookingRating;
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
          <div class="table-responsive">
            <table class="table datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Request Date</th>
                  <th>Booking Number</th>
                  <th>Mentor</th>
                  <th>Requested Amount</th>
                  <th>Approve/Reject Date</th>
                  <th>Action<br>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if($withdrawls){ $sl=1; foreach($withdrawls as $row){
                    $request_booking_ids = json_decode($row->request_booking_ids);
                    $mentor = User::where('id', '=', $row->mentor_id)->first();
                  ?>
                    <tr>
                      <td><?=$sl++?></td>
                      <td><?=date_format(date_create($row->created_at), "M d, Y h:i A")?></td>
                      <td>
                        <?php
                        $booking_no = [];
                        if(!empty($request_booking_ids)){
                          for($w=0;$w<count($request_booking_ids);$w++){
                            $booking = Booking::where('id', '=', $request_booking_ids[$w])->first();
                            if($booking){
                              $booking_no[] = $booking->booking_no;
                            }
                          }
                        }
                        echo implode(", ", $booking_no);
                        ?>
                      </td>
                      <td>
                        <h6><i class="fa fa-user"></i> <?=(($mentor)?$mentor->name:'')?></h6>
                        <h6><i class="fa fa-envelope"></i> <?=(($mentor)?$mentor->email:'')?></h6>
                        <h6><i class="fa fa-mobile"></i> <?=(($mentor)?$mentor->phone:'')?></h6>
                      </td>
                      <td><?=number_format($row->request_amount,2)?></td>
                      <td>
                        <?php if($row->status == 1){?>
                          <h6><?=date_format(date_create($row->accept_reject_date), "M d, Y h:i A")?></h6>
                          <h6><?=$row->txn_no?></h6>
                        <?php } elseif($row->status == 3){?>
                          <?=date_format(date_create($row->accept_reject_date), "M d, Y h:i A")?>
                        <?php }?>
                      </td>
                      <td>
                        <?php if($row->status == 0){?>
                          <a href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->id).'/'.Helper::encoded(1))?>" class="btn btn-success btn-sm" title="Accept <?=$module['title']?>" onclick="return confirm('Do You Want To Accept This Request ?');"><i class="fa fa-check"></i> Click To Accept</a>
                          <br><br>
                          <a href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->id).'/'.Helper::encoded(3))?>" class="btn btn-danger btn-sm" title="Reject <?=$module['title']?>" onclick="return confirm('Do You Want To Reject This Request ?');"><i class="fa fa-times"></i> Click To Reject</a>
                          <br><br>
                          <span class="badge bg-warning">Request Done</span>
                        <?php } elseif($row->status == 1){?>
                          <span class="badge bg-success">Withdrwal Done</span>
                        <?php } elseif($row->status == 3){?>
                          <span class="badge bg-danger">Request Rejected</span>
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
</section>