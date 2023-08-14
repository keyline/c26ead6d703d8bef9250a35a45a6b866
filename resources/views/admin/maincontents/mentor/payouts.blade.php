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
          
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Type</th>
                <th scope="col">Txn No</th>
                <th scope="col">Date</th>
                <th scope="col">Particulars</th>
                <th scope="col">Opening Balance</th>
                <th scope="col">Debit</th>
                <th scope="col">Credit</th>
                <th scope="col">Closing Balance</th>
              </tr>
            </thead>
            <tbody>
              
              <!-- <tr>
                <th scope="row">1</th>
                <td><span class="badge bg-success">CREDIT</span></td>
                <td>h4684h8945b6758945674565467</td>
                <td>Aug 14, 2023 11:10 AM</td>
                <td>Percival Kling (Student) paid you for ONE TO ONE session ON mental health session</td>
                <td>1000.00</td>
                <td>-</td>
                <td>180.00</td>
                <td>1180.00</td>
              </tr> -->
              <tr>
                <th scope="row">1</th>
                <td><span class="badge bg-danger">DEBIT</span></td>
                <td>h4684h8945b6758945674565467</td>
                <td>Aug 14, 2023 11:10 AM</td>
                <td>Stumento payout</td>
                <td>1000.00</td>
                <td>-</td>
                <td>180.00</td>
                <td>1180.00</td>
              </tr>

            </tbody>
          </table>
          
        </div>
      </div>

    </div>
  </div>
</section>