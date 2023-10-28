<div class="pagetitle">
  <h1><?=$page_header?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Home</a></li>
      <li class="breadcrumb-item active"><?=$page_header?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
  <div class="row">
    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Student <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=$student?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Mentor <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=$mentor?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Survey <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=$survey?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Paid Booking <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=$paid_booking?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Unpaid Booking <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=$unpaid_booking?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Transaction <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=$transaction?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Withdrawl Request <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=$withdrawl_request?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Withdrawl Accept <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=$withdrawl_accept?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Withdrawl Reject <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=$withdrawl_reject?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Withdrawl Pending <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=($withdrawl_request - ($withdrawl_accept + $withdrawl_reject))?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xxl-3 col-md-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Booking Amount <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=number_format($booking_amount,0)?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Admin Commission <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=number_format($admin_commission,0)?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Mentor Commission <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=number_format($mentor_commission,0)?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-3 col-md-3">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Withdrawl Amount <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="fa fa-database"></i>
                </div>
                <div class="ps-3">
                  <h6><?=number_format($withdrawl_amount,0)?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div><!-- End Left side columns -->
  </div>
</section>