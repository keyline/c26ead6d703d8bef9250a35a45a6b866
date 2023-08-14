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
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1">All</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab2">Past</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab3">Upcoming</button>
            </li>
          </ul>
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active all-booking-overview" id="tab1">
              <h5 style="font-weight: bold;">All Booking List</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Booking No</th>
                      <th scope="col">Booking Date</th>
                      <th scope="col">Student Details</th>
                      <th scope="col">Service Type<br>Service<br>Service Attribute</th>
                      <th scope="col">Duration</th>
                      <th scope="col">Base Price</th>
                      <th scope="col">GST</th>
                      <th scope="col">Student Paid</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <tr>
                      <th scope="row">1</th>
                      <td>STUMENTO/2023-2024/000001</td>
                      <td>Aug 14, 2023 11:08 AM</td>
                      <td>
                        <h6><i class="fa fa-user"></i> Makenna Robel</h6>
                        <h6><i class="fa fa-envelope"></i> fjohnson@example.org</h6>
                        <h6><i class="fa fa-mobile"></i> 2931574210</h6>
                      </td>
                      <td>Discovery Call<br>Career Counselling<br>ONE TO ONE session ON mental health</td>
                      <td>60 mins</td>
                      <td>1000.00</td>
                      <td>118.00 (18%)</td>
                      <td>1180.00</td>
                      <td>
                        <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/print-invoice/'.Helper::encoded(1))?>" class="btn btn-outline-info btn-sm" title="Print Invoice"><i class="fa fa-print"></i></a>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade past-booking-overview" id="tab2">
              <h5 style="font-weight: bold;">Past Booking List</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Booking No</th>
                      <th scope="col">Booking Date</th>
                      <th scope="col">Mentor Details</th>
                      <th scope="col">Service Type<br>Service<br>Service Attribute</th>
                      <th scope="col">Duration</th>
                      <th scope="col">Price</th>
                      <th scope="col">GST</th>
                      <th scope="col">Total Amount</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <tr>
                      <th scope="row">1</th>
                      <td>STUMENTO/2023-2024/000001</td>
                      <td>Ayg 14, 2023 11:08 AM</td>
                      <td>
                        <h6><i class="fa fa-user"></i> Makenna Robel</h6>
                        <h6><i class="fa fa-envelope"></i> fjohnson@example.org</h6>
                        <h6><i class="fa fa-mobile"></i> 2931574210</h6>
                      </td>
                      <td>Discovery Call<br>Career Counselling<br>ONE TO ONE session ON mental health</td>
                      <td>60 mins</td>
                      <td>1000.00</td>
                      <td>118.00 (18%)</td>
                      <td>1180.00</td>
                      <td>
                        <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/print-invoice/'.Helper::encoded(1))?>" class="btn btn-outline-info btn-sm" title="Print Invoice"><i class="fa fa-print"></i></a>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade upcoming-booking-overview" id="tab3">
              <h5 style="font-weight: bold;">Upcoming Booking List</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Booking No</th>
                      <th scope="col">Booking Date</th>
                      <th scope="col">Mentor Details</th>
                      <th scope="col">Service Type<br>Service<br>Service Attribute</th>
                      <th scope="col">Duration</th>
                      <th scope="col">Price</th>
                      <th scope="col">GST</th>
                      <th scope="col">Total Amount</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <tr>
                      <th scope="row">1</th>
                      <td>STUMENTO/2023-2024/000001</td>
                      <td>Ayg 14, 2023 11:08 AM</td>
                      <td>
                        <h6><i class="fa fa-user"></i> Makenna Robel</h6>
                        <h6><i class="fa fa-envelope"></i> fjohnson@example.org</h6>
                        <h6><i class="fa fa-mobile"></i> 2931574210</h6>
                      </td>
                      <td>Discovery Call<br>Career Counselling<br>ONE TO ONE session ON mental health</td>
                      <td>60 mins</td>
                      <td>1000.00</td>
                      <td>118.00 (18%)</td>
                      <td>1180.00</td>
                      <td>
                        <a target="_blank" href="<?=url('admin/' . $controllerRoute . '/print-invoice/'.Helper::encoded(1))?>" class="btn btn-outline-info btn-sm" title="Print Invoice"><i class="fa fa-print"></i></a>
                      </td>
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