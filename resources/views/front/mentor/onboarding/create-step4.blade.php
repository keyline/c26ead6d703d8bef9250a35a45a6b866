<section class="mentor_element">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="metor_dashboard_top">
               <div class="metor_progess">
                  <div class="stepper-wrapper">
                     <div class="stepper-item first + completed"></div>
                     <div class="stepper-item  + completed"></div>
                     <div class="stepper-item  + completed">
                     </div>
                     <div class="stepper-item  + active">
                        <img class="img-fluid" src="{{ env('FRONT_ASSETS_URL') }}assets/images/bulb_icon.png" alt="logo">
                     </div>
                     <div class="last-counter stepper-item  + ">
                        <div class="progress-dot step-counter"></div>
                     </div>
                  </div>
                  <div class="me_probar"></div>
                  <!--<div class="met_prolight"><img class="img-fluid" src="{{ env('FRONT_ASSETS_URL') }}assets/images/bulb_icon.png" alt="logo"></div>-->
               </div>
            </div>
         </div>
      </div>
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-8 col-sm-8">
            <div class="metor_dashboard">
               <div class="metor_information">
                  <h2>Great! Now let's set your availability</h2>
                  <p class="text-muted mb-4">Let your audience know when you're available. You can edit this later</p>
                  <div class="metor_step1_form">
                     <form>
                        <div class="ant-col ant-col-24 add-slots">
                           <div class="row slot-item">
                              <div class="col-md-3">
                                 <div class="slot_weeksday">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                       <label class="form-check-label" for="flexCheckChecked">
                                       Saturday
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <div class="slots-section">
                                    <div class="slots-select-box">
                                       <div class="slot_starttime">
                                          <select id="selectbox">
                                             <option value="1">12.00 AM</option>
                                             <option value="2">12.15 AM</option>
                                             <option value="3">12.30 AM</option>
                                             <option value="4">12.45 AM</option>
                                             <option value="5">1.00 AM</option>
                                             <option value="6">1.15 AM</option>
                                             <option value="7">1.30 AM</option>
                                             <option value="8">1.45 AM</option>
                                             <option value="9">2.00 AM</option>
                                          </select>
                                       </div>
                                       <div style="display: inline; margin: 0px 1em;">-</div>
                                       <div class="slot_endtime">
                                          <select id="selectbox2">
                                             <option value="1">12.00 AM</option>
                                             <option value="2">12.15 AM</option>
                                             <option value="3">12.30 AM</option>
                                             <option value="4">12.45 AM</option>
                                             <option value="5">1.00 AM</option>
                                             <option value="6">1.15 AM</option>
                                             <option value="7">1.30 AM</option>
                                             <option value="8">1.45 AM</option>
                                             <option value="9">2.00 AM</option>
                                          </select>
                                       </div>
                                       <button class="add-slot-btn"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <div class="btn-apply-all"><a href="#">Apply To All</a></div>
                                 </div>
                              </div>
                           </div>
                           <div class="row slot-item">
                              <div class="col-md-3">
                                 <div class="slot_weeksday">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                       <label class="form-check-label" for="flexCheckChecked">
                                       Sunday
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <div class="slots-section">
                                    <div class="slots-select-box">
                                       <div class="slot_starttime">
                                          <select id="selectbox3">
                                             <option value="1">12.00 AM</option>
                                             <option value="2">12.15 AM</option>
                                             <option value="3">12.30 AM</option>
                                             <option value="4">12.45 AM</option>
                                             <option value="5">1.00 AM</option>
                                             <option value="6">1.15 AM</option>
                                             <option value="7">1.30 AM</option>
                                             <option value="8">1.45 AM</option>
                                             <option value="9">2.00 AM</option>
                                          </select>
                                       </div>
                                       <div style="display: inline; margin: 0px 1em;">-</div>
                                       <div class="slot_endtime">
                                          <select id="selectbox4">
                                             <option value="1">12.00 AM</option>
                                             <option value="2">12.15 AM</option>
                                             <option value="3">12.30 AM</option>
                                             <option value="4">12.45 AM</option>
                                             <option value="5">1.00 AM</option>
                                             <option value="6">1.15 AM</option>
                                             <option value="7">1.30 AM</option>
                                             <option value="8">1.45 AM</option>
                                             <option value="9">2.00 AM</option>
                                          </select>
                                       </div>
                                       <button class="add-slot-btn"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <div class="btn-apply-all"><a href="#">Apply To All</a></div>
                                 </div>
                              </div>
                           </div>
                           <div class="row slot-item">
                              <div class="col-md-3">
                                 <div class="slot_weeksday">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                       <label class="form-check-label" for="flexCheckChecked">
                                       Monday
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <div class="slots-section">
                                    <div class="slots-select-box">
                                       <div class="slot_starttime">
                                          <select id="selectbox5">
                                             <option value="1">12.00 AM</option>
                                             <option value="2">12.15 AM</option>
                                             <option value="3">12.30 AM</option>
                                             <option value="4">12.45 AM</option>
                                             <option value="5">1.00 AM</option>
                                             <option value="6">1.15 AM</option>
                                             <option value="7">1.30 AM</option>
                                             <option value="8">1.45 AM</option>
                                             <option value="9">2.00 AM</option>
                                          </select>
                                       </div>
                                       <div style="display: inline; margin: 0px 1em;">-</div>
                                       <div class="slot_endtime">
                                          <select id="selectbox6">
                                             <option value="1">12.00 AM</option>
                                             <option value="2">12.15 AM</option>
                                             <option value="3">12.30 AM</option>
                                             <option value="4">12.45 AM</option>
                                             <option value="5">1.00 AM</option>
                                             <option value="6">1.15 AM</option>
                                             <option value="7">1.30 AM</option>
                                             <option value="8">1.45 AM</option>
                                             <option value="9">2.00 AM</option>
                                          </select>
                                       </div>
                                       <button class="add-slot-btn"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <div class="btn-apply-all"><a href="#">Apply To All</a></div>
                                 </div>
                              </div>
                           </div>
                           <div class="row slot-item">
                              <div class="col-md-3">
                                 <div class="slot_weeksday">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                       <label class="form-check-label" for="flexCheckChecked">
                                       Tuesday
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <div class="slots-section">
                                    <div class="ant-typography slots-unavailable">Unavailable</div>
                                 </div>
                              </div>
                           </div>
                           <div class="row slot-item">
                              <div class="col-md-3">
                                 <div class="slot_weeksday">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                       <label class="form-check-label" for="flexCheckChecked">
                                       Wednesday
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <div class="slots-section">
                                    <div class="ant-typography slots-unavailable">Unavailable</div>
                                 </div>
                              </div>
                           </div>
                           <div class="row slot-item">
                              <div class="col-md-3">
                                 <div class="slot_weeksday">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                       <label class="form-check-label" for="flexCheckChecked">
                                       Thursday
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <div class="slots-section">
                                    <div class="ant-typography slots-unavailable">Unavailable</div>
                                 </div>
                              </div>
                           </div>
                           <div class="row slot-item">
                              <div class="col-md-3">
                                 <div class="slot_weeksday">
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                       <label class="form-check-label" for="flexCheckChecked">
                                       Friday
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-9">
                                 <div class="slots-section">
                                    <div class="ant-typography slots-unavailable">Unavailable</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="input-group mb-3">
                           <!--<button class="next-btn">Next</button>-->
                           <a href="mentor3.html" class="next-btn">Finish</a>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="rightside_testslider">
               <div class="login_sidebar_testimorial">
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
                  <div class="testmoric_item">
                     <div class="testimor_quote"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutationo.png" alt="icon"></div>
                     <div class="testimori_content">I was looking for online career counselling after 12th and one of my friends suggested StuMento. The best part of StuMento is that  I got to choose from multiple career counsellers from the comfort of my home. Thanks to the sessions, Now I am so much more clear about my career now👍</div>
                     <div class="testomori_profile">
                        <div class="testmori_prof_img"><img src="{{ env('FRONT_ASSETS_URL') }}assets/images/testi_qutati_img.png" alt="icon"></div>
                        <div class="testmori_name">
                           <h3>Vijay</h3>
                           <h5>Recent 12th graduate</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>