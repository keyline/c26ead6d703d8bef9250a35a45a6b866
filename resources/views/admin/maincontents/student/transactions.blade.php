<?php
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
          
          <table class="table datatable">
            <thead>
              <tr>
                <th>#</th>
                <th>Booking No</th>
                <th>Mentor Details</th>
                <th>Txn No</th>
                <th>Transaction Date</th>
                <th>Payable/Payment Amount</th>
                <th>Payment Status</th>
                <th>Payment Method<br>Payment Mode</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if($transactions) { $sl=1; foreach($transactions as $row){
                $mentor = User::where('id', '=', $row->mentor_id)->first();
              ?>
              <tr>
                  <td><?=$sl++?></td>
                  <td><?=$row->booking_no?></td>
                  <td>
                      <h6><i class="fa fa-user"></i> <?=(($mentor)?$mentor->name:'')?></h6>
                      <h6><i class="fa fa-envelope"></i> <?=(($mentor)?$mentor->email:'')?></h6>
                      <h6><i class="fa fa-mobile"></i> <?=(($mentor)?$mentor->phone:'')?></h6>
                  </td>
                  <td><?=$row->txn_id?></td>
                  <td><?=(($row->payment_date_time != '')?date_format(date_create($row->payment_date_time), "M d, Y h:i A"):'')?></td>
                  <td><?=number_format($row->payable_amt,2)?></td>
                  <td>
                    <?php if($row->payment_status){?>
                      <span class="badge bg-success">SUCCESS</span>
                    <?php } else {?>
                      <span class="badge bg-danger">NOT PAID</span>
                    <?php }?>
                  </td>
                  <td>
                    <strong><?=$row->payment_method?></strong><br>
                    <strong><?=$row->payment_mode?></strong>
                  </td>
                  <td>
                    <?php if($row->payment_status){?>
                      <a href="<?=url('admin/student/print-student-invoice/'.Helper::encoded($row->id))?>" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print Invoice</a>
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
</section>