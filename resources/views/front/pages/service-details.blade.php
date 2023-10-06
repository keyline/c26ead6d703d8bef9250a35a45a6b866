<!-- mentor details start -->
<section class="mentor-details-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="mentor-dtl-left">
          <div class="row">
            <div class="col-12">
              <div class="mentor-profile mentortime_bg service-mentordetails">
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
          <!--
                  <div class="user-booking"><a href="javascript:;" class="user-booking-model">Book Appointment</a></div>
                  -->
          <form method="POST" action="">
            @csrf
            <input type="hidden" name="mentor_user_id" id="mentor_user_id" value="<?=$mentorService['mentor_id']?>">
            <input type="hidden" name="mentor_service_id" id="mentor_service_id" value="<?=$mentorService['id']?>">
            <input type="hidden" name="service_type_id" id="service_type_id" value="<?=$mentorService['service_type_id']?>">
            <input type="hidden" name="service_attribute_id" id="service_attribute_id" value="<?=$mentorService['service_attribute_id']?>">
            <input type="hidden" name="service_id" id="service_id" value="<?=$mentorService['service_id']?>">
            <input type="hidden" name="duration" id="duration" value="<?=$mentorService['duration']?>">
            <input type="hidden" name="booking_date" id="booking_date">
            <input type="hidden" name="booking_slot_from" id="booking_slot_from">
            <input type="hidden" name="booking_slot_to" id="booking_slot_to">

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
              <div class="input-group mb-3">
                <button type="submit" class="next-btn" disabled>Confirm Details</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- mentor details end -->