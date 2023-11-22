<?php
use App\Models\Booking;
use App\Models\User;
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
            <a href="<?=url('admin/transactions-export')?>" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export</a>
          <div class="table-responsive">
            <table class="table datatable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Type</th>
                  <th>Date</th>
                  <th>Booking No</th>
                  <th>Mentor</th>
                  <th>Student</th>
                  <th>Opening Balance</th>
                  <th>Transaction Amount</th>
                  <th>Closing Balance</th>
                  <!-- <th>Withdrawl</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                if($transactions) { $sl=1; foreach($transactions as $row){
                  $booking = Booking::where('id', '=', $row->booking_id)->first();
                  if($booking){
                    $mentor = User::where('id', '=', $booking->mentor_id)->first();
                    $student = User::where('id', '=', $booking->student_id)->first();
                  } else {
                    $mentor = [];
                    $student = [];
                  }
                ?>
                  <tr>
                    <td><?=$sl++?></td>
                    <td>
                      <?php if($row->type == 'CREDIT'){?>
                        <span class="badge bg-success">CREDIT</span>
                      <?php } else {?>
                        <span class="badge bg-danger">DEBIT</span>
                      <?php }?>
                    </td>
                    <td><?=(($row->created_at != '')?date_format(date_create($row->created_at), "M d, Y h:i A"):'')?></td>
                    <td><?=(($booking)?$booking->booking_no:'NA')?></td>
                    <td>
                        <h6><i class="fa fa-user"></i> <?=(($mentor)?$mentor->name:'')?></h6>
                        <h6><i class="fa fa-envelope"></i> <?=(($mentor)?$mentor->email:'')?></h6>
                        <h6><i class="fa fa-mobile"></i> <?=(($mentor)?$mentor->phone:'')?></h6>
                    </td>
                    <td>
                        <h6><i class="fa fa-user"></i> <?=(($student)?$student->name:'')?></h6>
                        <h6><i class="fa fa-envelope"></i> <?=(($student)?$student->email:'')?></h6>
                        <h6><i class="fa fa-mobile"></i> <?=(($student)?$student->phone:'')?></h6>
                    </td>
                    <td><?=number_format($row->opening_amt,2)?></td>
                    <td><?=number_format($row->student_pay_amt,2)?></td>
                    <td><?=number_format($row->closing_amt,2)?></td>
                    <!-- <td>
                      <?php if($row->status){?>
                        <span class="badge bg-success">YES</span>
                      <?php } else {?>
                        <span class="badge bg-danger">NO</span>
                      <?php }?>
                    </td> -->
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
