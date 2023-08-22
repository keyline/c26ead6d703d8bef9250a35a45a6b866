<style>
   .info-content {
      width: 100%;
      max-width: 100%; 
   }
</style>
<section class="mentor-details-section">
   <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="mentor-dtl-left">
                  <div class="row">
                      <div class="col-12">
                          <div class="mentor-profile">
                              <div class="mentor-profile-left d-flex justify-content-center justify-content-md-start flex-wrap">
                                  <div class="profile-img">
                                      <img src="<?=env('UPLOADS_URL')?>team/<?=$teamMember->image?>" alt="<?=$teamMember->name?>" class="img-fluid">
                                  </div>
                                  <ul>
                                      <li><a href="javascript:void(0);"> <?=$teamMember->name?> <i class="fas fa-check check-icon" data-toggle="tooltip" title="Verified user"></i></a></li>
                                      <div class="rating">
                                          <i class="fa-solid fa-star"></i>
                                          <i class="fa-solid fa-star"></i>
                                          <i class="fa-solid fa-star"></i>
                                          <i class="fa-solid fa-star"></i>
                                          <i class="fa-solid fa-star"></i>
                                      </div>
                                      <!-- <li><i class="fas fa-globe-asia"></i> Kolkata</li> -->
                                      <li>
                                          <i class="fa-solid fa-font"></i> <?=$teamMember->designation?>
                                      </li>
                                      <li>
                                          <i class="fa-regular fa-newspaper"></i> <?=$teamMember->qualification?>
                                      </li>
                                      <li>
                                          <i class="fas fa-calendar-day"></i> <?=$teamMember->experience?>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="mentor-dtl-box">
                      <h4>About Me</h4>
                      <div class="overview-description">
                          <p><?=$teamMember->bio?></p>
                      </div>
                      <br>
                      <h4>Education</h4>
                      <div class="education-details">
                          <div class="info-list">
                              <div class="info-content">
                                  <h6><?=$teamMember->qualification?>
                              </div>
                              <!-- <div class="info-years">
                                  <strong>2017 - 2020</strong>
                              </div> -->
                          </div>
                      </div>
                      <!-- <div class="divider"></div> -->
                      <br>
                      <h4>Work Experience</h4>
                      <div class="education-details">
                          <div class="info-list">
                              <div class="info-content">
                                  <h6><?=$teamMember->experience?>
                              </div>
                              <!-- <div class="info-years">
                                  <strong>2021 - 2022</strong>
                              </div> -->
                          </div>
                      </div>
                      <!-- <div class="divider"></div> -->
                      <br>
                      <h4>Thoughts</h4>
                      <div class="education-details">
                          <div class="info-list">
                              <div class="info-content">
                                  <h6><?=$teamMember->thought?></h6>
                              </div>
                              <!-- <div class="info-years">
                                  <strong>2022</strong>
                              </div> -->
                          </div>
                      </div> 
                  </div>
              </div>
          </div>
      </div>
   </div>
</section>