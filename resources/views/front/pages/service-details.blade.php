<!-- mentor details start -->
<section class="mentor-details-section">
  <div class="container">
    <div class="row">
      @if(session('success_message'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide" role="alert">
          {{ session('success_message') }}
        </div>
      @endif
      @if(session('error_message'))
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
          {{ session('error_message') }}
        </div>
      @endif
      <div class="col-lg-6">
        <div class="mentor-dtl-left">
          <div class="row">
            <div class="col-12">
              <div class="mentor-profile mentortime_bg">
                <div class="metor_goback">
                  <a href="<?=url('mentor-details/'.$mentorService['display_name'].'/'.Helper::encoded($mentorService['mentor_id']))?>">
                    <i class="fa-solid fa-arrow-left"></i>
                  </a>
                  <h3><?=$mentorService['name']?></h3>
                </div>
                <div class="mentor-profile-left mentor-prfile_flex">
                  <div class="mentortime_title">
                    <h3><?=$mentorService['title']?></h3>
                    <h5><?=$mentorService['service_name']?></h5>
                    <h6><?=$mentorService['service_type_name']?></h6>
                    <div class="mentortime_rating">
                      <i class="fa-solid fa-star"></i> <?=$mentorService['rating_star']?>/5 (RATINGS)
                    </div>
                  </div>
                  <div class="profile-img">
                    <img src="<?=$mentorService['profile_image']?>" alt="<?=$mentorService['name']?>" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mentor-dtl-box booking-banner ">
            <div class="row product-tags mb-4">
              <div class="ant-col doc-tag col-md-6">
                <div class="booking-page-footer public-profile-pricing" style="color: rgb(20, 20, 20); display: flex; align-items: center; width: fit-content;">
                  <div style="text-align: center;">
                    <s style="font-weight: 700; color: rgb(102, 102, 102); font-size: 14px; display: inline-block; margin-right: 8px;"><i class="fa fa-inr"></i><?=$mentorService['slashed_amount']?></s>
                    <span style="display: inline-block;"><i class="fa fa-inr"></i><?=$mentorService['total_amount_payable']?> </span>
                  </div>
                </div>
              </div>
              <div class="ant-col doc-tag col-md-6">
                <i class="fa-regular fa-calendar"></i> <?=$mentorService['duration']?> mins meeting
              </div>
            </div>
            <p><?=$mentorService['description']?></p>
            <!-- <div class="divider"></div> -->
            <br>
            <?php if($testimonials){?>
            <div class="mentor-testimonials_section">
              <h4 class="pb-4">Testimonials</h4>
              <div id="mentor-testimonials" class="owl-carousel owl-theme">
                <?php foreach($testimonials as $testimonial) {?>
                  <div class="item">
                    <div class="mettesti_inner">
                      <h4><?=$testimonial['student_name']?></h4>
                      <p><?=$testimonial['review']?></p>
                    </div>
                  </div>
                <?php }?>
              </div>
            </div>
          <?php }?>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="mentor-dtl-right metor_information">
          <!-- <form method="POST" action="">
            @csrf -->
            <input type="hidden" id="mentor_user_id" value="<?=$mentorService['mentor_id']?>">
            <input type="hidden" id="duration" value="<?=$mentorService['duration']?>">
            <div class="time-box mentor-dtl-box">
              <h4>Available Timings</h4>
              <div id="timing-slider" class="owl-carousel owl-theme">
                <?php if($date_range){ foreach($date_range as $date_range_row){?>
                  <div class="item" onclick="getTimeSlots('<?=$date_range_row['actual_date']?>');">
                    <!-- <div class="timing-box active"> -->
                    <div class="timing-box" id="cal<?=$date_range_row['actual_date']?>" data-id="<?=$date_range_row['actual_date']?>">
                      <p><?=$date_range_row['date_day']?></p>
                      <h6><?=$date_range_row['display_date']?></h6>
                    </div>
                  </div>
                <?php } }?>
              </div>
              <br>
              <div class="time-picker-box">
                <h4>Pick a time</h4>
                <ul class="d-flex flex-wrap time-picker-list">
                </ul>
              </div>
              <div class="input-group mb-3"><?php if((session('is_user_login') == 1) && (session('role') == 1)){?>
                <form method="POST" action="" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="mode" value="DIRECT">
                  <input type="hidden" name="key" value="facb6e0a6fcbe200dca2fb60dec75be7">
                  <input type="hidden" name="source" value="WEB">
                  <input type="hidden" name="mentor_user_id" value="<?=$mentorService['mentor_id']?>">
                  <input type="hidden" name="mentor_service_id" value="<?=$mentorService['id']?>">
                  <input type="hidden" name="service_type_id" value="<?=$mentorService['service_type_id']?>">
                  <input type="hidden" name="service_attribute_id" value="<?=$mentorService['service_attribute_id']?>">
                  <input type="hidden" name="service_id" value="<?=$mentorService['service_id']?>">
                  <input type="hidden" name="duration" value="<?=$mentorService['duration']?>">
                  <input type="hidden" name="payable_amt" value="<?=$mentorService['total_amount_payable']?>">

                  <input type="hidden" name="booking_date" id="booking_date3">
                  <input type="hidden" name="booking_slot_from" id="booking_slot_from3">
                  <input type="hidden" name="booking_slot_to" id="booking_slot_to3">
                  <button type="submit" class="next-btn" disabled>Book Appointment</button>
                </form>
              <?php } else {?>
                <button type="button" class="next-btn" disabled data-bs-toggle="modal" data-bs-target="#bookingModal" data-backdrop="static" data-keyboard="false">Book Appointment</button>
              <?php }?>
              </div>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- mentor details end -->

<!-- Authentication & Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 60%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=$mentorService['name']?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-lg-6 col-sm-6">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <h5>Booking Details are as follows</h5>
                <table class="table table-striped">
                  <tr>
                    <th>Mentor</th>
                    <td><?=$mentorService['name']?></td>
                  </tr>
                  <tr>
                    <th>Service Title</th>
                    <td><?=$mentorService['title']?></td>
                  </tr>
                  <tr>
                    <th>Service Type</th>
                    <td><?=$mentorService['service_type_name']?></td>
                  </tr>
                  <tr>
                    <th>Service Name</th>
                    <td><?=$mentorService['service_name']?></td>
                  </tr>
                  <tr>
                    <th>Booking Date/Time</th>
                    <td><span id="bookingDate"></span> <span id="bookingFTime"></span> - <span id="bookingTTime"></span></td>
                  </tr>
                  <tr>
                    <th>Session Fee</th>
                    <td><?=$mentorService['total_amount_payable']?></td>
                  </tr>
                  <tr>
                    <th>Session Duration</th>
                    <td><?=$mentorService['duration']?> Mins</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-6">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Sign Up</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Sign In</button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <h5>Hi, you can signup from here</h5>
                <form method="POST" action="" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="mode" value="SIGNUP">
                  <input type="hidden" name="key" value="facb6e0a6fcbe200dca2fb60dec75be7">
                  <input type="hidden" name="source" value="WEB">
                  <input type="hidden" name="mentor_user_id" value="<?=$mentorService['mentor_id']?>">
                  <input type="hidden" name="mentor_service_id" value="<?=$mentorService['id']?>">
                  <input type="hidden" name="service_type_id" value="<?=$mentorService['service_type_id']?>">
                  <input type="hidden" name="service_attribute_id" value="<?=$mentorService['service_attribute_id']?>">
                  <input type="hidden" name="service_id" value="<?=$mentorService['service_id']?>">
                  <input type="hidden" name="duration" value="<?=$mentorService['duration']?>">
                  <input type="hidden" name="payable_amt" value="<?=$mentorService['total_amount_payable']?>">

                  <input type="hidden" name="booking_date" id="booking_date1">
                  <input type="hidden" name="booking_slot_from" id="booking_slot_from1">
                  <input type="hidden" name="booking_slot_to" id="booking_slot_to1">

                  <div class="row">
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                         <input type="text" class="form-control requiredCheck" name="fname" id="fname" placeholder="First name" data-check="First name" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                         <input type="text" class="form-control requiredCheck" name="lname" id="lname" placeholder="Last name" data-check="Last name" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                         <input type="email" class="form-control requiredCheck" name="email" id="email" placeholder="Email address" data-check="Email address" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                         <input type="tel" class="form-control requiredCheck" name="phone" id="phone" placeholder="Phone number" data-check="Phone number" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                         <input type="password" class="form-control requiredCheck" name="password" id="password" placeholder="Set password" data-check="Set password" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                         <input type="password" class="form-control requiredCheck" name="confirm_password" id="confirm_password" placeholder="Confirm password" data-check="Confirm password" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                         <select class="form-control" name="doc_type" id="doc_type">
                            <option value="" selected>Select Document</option>
                            <?php if($documents){ foreach($documents as $document){?>
                            <option value="<?=$document->id?>"><?=$document->document?></option>
                            <?php } }?>
                         </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                         <input type="file" class="form-control" name="user_doc" id="fileName" placeholder="Confirm password" data-check="Upload Document" accept="image/png, image/gif, image/jpeg, application/pdf" onchange="validateFileType(this)">
                         <small class="text-primary">Only jpg, jpeg, png & pdf files & less than 2 MB files are allowed</small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                     <button type="submit" class="login-btn">Sign Up</button>
                  </div>
                </form>
              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <h5>Hi, you can signin from here</h5>
                <form method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" class="form-control" name="mode" value="SIGNIN">
                  <input type="hidden" class="form-control" name="key" value="facb6e0a6fcbe200dca2fb60dec75be7">
                  <input type="hidden" class="form-control" name="source" value="WEB">
                  <input type="hidden" name="mentor_user_id" value="<?=$mentorService['mentor_id']?>">
                  <input type="hidden" name="mentor_service_id" value="<?=$mentorService['id']?>">
                  <input type="hidden" name="service_type_id" value="<?=$mentorService['service_type_id']?>">
                  <input type="hidden" name="service_attribute_id" value="<?=$mentorService['service_attribute_id']?>">
                  <input type="hidden" name="service_id" value="<?=$mentorService['service_id']?>">
                  <input type="hidden" name="duration" value="<?=$mentorService['duration']?>">
                  <input type="hidden" name="payable_amt" value="<?=$mentorService['total_amount_payable']?>">

                  <input type="hidden" name="booking_date" id="booking_date2">
                  <input type="hidden" name="booking_slot_from" id="booking_slot_from2">
                  <input type="hidden" name="booking_slot_to" id="booking_slot_to2">

                  <div class="form-group">
                     <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required>
                  </div>
                  <div class="form-group">
                     <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                     <button class="login-btn" type="submit">Sign In</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>