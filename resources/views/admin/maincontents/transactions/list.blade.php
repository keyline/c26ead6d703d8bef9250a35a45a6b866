Base <?php
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
                  <th scope="col">#</th>
                  <th scope="col">Booking No<br>Txn No<br>Date</th>
                  <th scope="col">Mentor</th>
                  <th scope="col">Student</th>
                  <th scope="col">Base Price</th>
                  <th scope="col">GST</th>
                  <th scope="col">Student Paid</th>
                  <th scope="col">Platform Charges</th>
                  <th scope="col">My Payment</th>
                  <th scope="col">Payment Status</th>
                  <th scope="col">Payment Method</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                
                <tr>
                  <th scope="row">1</th>
                  <td>STUMENTO/2023-2024/000001<br>h4684h8945b6758945674565467<br>Aug 14, 2023 11:10 AM</td>
                  <td>
                    <h6><i class="fa fa-user"></i> Makenna Robel</h6>
                    <h6><i class="fa fa-envelope"></i> fjohnson@example.org</h6>
                    <h6><i class="fa fa-mobile"></i> 2931574210</h6>
                  </td>
                  <td>
                    <h6><i class="fa fa-user"></i> Makenna Robel</h6>
                    <h6><i class="fa fa-envelope"></i> fjohnson@example.org</h6>
                    <h6><i class="fa fa-mobile"></i> 2931574210</h6>
                  </td>
                  <td>1000.00</td>
                  <td>118.00 (18%)</td>
                  <td>1180.00</td>
                  <td>200.00 (20 %)</td>
                  <td>800.00 (80 %)</td>
                  <td><span class="badge bg-success">SUCCESS</span></td>
                  <td>Razor Pay</td>
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
</section>