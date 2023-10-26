<?php
use App\Models\Booking;
use App\Models\GeneralSetting;
?>
<div class="account_wrapper">
   <?=$sidebar;?>
   <div class="wrapper account_inner_section d-flex flex-column min-vh-100 bg-light">
      <header class="header header-sticky mb-4">
         <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3 d-md-none" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="fa-solid fa-bars"></i>
            </button>
            <!--<a class="header-brand d-md-none" href="#">
               <img src="assets/img/logo.png" alt="logo">
               </a>-->
            <h4 class="pagestitle-item mb-0">Service</h4>
            <ul class="header-nav ms-auto">
               <!-- <li class="nav-item"><a class="nav-link" href="#">
                  <i class="fa-regular fa-bell"></i></a></li>
                  
                  <li class="nav-item"><a class="nav-link" href="#">
                  <i class="fa-regular fa-envelope-open"></i></a></li>-->
            </ul>
         </div>
         <!--<div class="header-divider"></div>-->
      </header>
      <div class="body flex-grow-1 px-3">
         <div class="container-lg">
            <div class="row">
               <div class="col-sm-12 col-lg-6">
                  <div class="card mb-4 text-white bg-whitebg">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
                              <!-- <div class="aftertop_part mb-2">
                                 <h3>Select type</h3>
                              </div> -->
                              <?php
                              if($mentor_services){ foreach($mentor_services as $mentor_service){
                              ?>
	                              <div class="metor_seriveall services" >
	                                 <div class="row">
	                                    <div class="service-card  col-md-12">
	                                       <div style="width: 100%;">
	                                          <div class="service-card-main">
	                                             <div class="title-section">
	                                                <h1 class="service-title" title="Discovery Call"><?=$mentor_service->title?></h1>
	                                                <div class="ant-service-public">
	                                                   <div class="ant-space-item" style="">
	                                                      <i class="fa-regular fa-eye"></i>
	                                                   </div>
	                                                   <div class="ant-space-item">Public</div>
	                                                </div>
	                                             </div>
	                                             <div class="ant-servceie_times">
	                                                <div class="ant-times-item" style=""><span><?=$mentor_service->duration?> mins<span style="margin-left: 6px;">|</span></span></div>
	                                                <div class="ant-amount-item"><span>₹ <?=$mentor_service->total_amount_payable?> </span></div>
	                                             </div>
	                                          </div>
	                                          <div class="service-card-footer">
	                                             <div class="ant-typography" style="display: flex; align-items: center; width: 100%; justify-content: space-between;">
	                                                <div class="ant-service_allbtn">
	                                                   <div class="ant-space-item" style="">
	                                                      <button type="button" class="ant-btn ant-btn-text">
	                                                      <i class="fa-solid fa-arrow-up-from-bracket"></i>
	                                                      </button>
	                                                   </div>
	                                                   <div class="ant-space-item" style="">
	                                                      <button type="button" class="ant-btn ant-btn-text">
	                                                      <i class="fa-regular fa-copy"></i>
	                                                      </button>
	                                                   </div>
	                                                   <div class="ant-space-item">
	                                                      <button type="button" class="ant-edit ant-btn-text"><span>Edit</span></button>
	                                                   </div>
	                                                </div>
	                                                <button type="button" id="author_bio_wrap_toggle" class="ant-graph ant-btn-text" style="background-color: rgb(243, 243, 241); padding: 0px;" onclick="toggleAnalytics(<?=$mentor_service->id?>);"><i class="fa-solid fa-chart-line"></i></button>
	                                             </div>
	                                          </div>
	                                       </div>
	                                    </div>
	                                    <div id="author_bio_wrap<?=$mentor_service->id?>" class="service-card-analytics" style="display: none;">
	                                    	<?php
	                                    	$bookingCount 						= Booking::where('mentor_service_id', '=', $mentor_service->id)->count();
	                                    	$bookingAmt 						= Booking::where('mentor_service_id', '=', $mentor_service->id)->sum('actual_amount');
	                                    	$actual_amount 					= $bookingAmt;
	                                    	$generalSetting 					= GeneralSetting::find('1');
	                                    	$stumento_commision_percent 	= $generalSetting->stumento_commision_percent;
				                            	$admin_commision            	= (($actual_amount * $stumento_commision_percent)/100);
				                            	$mentor_commision           	= ($actual_amount - $admin_commision);
	                                    	?>
	                                       <div class="service_metor_clickview">
	                                          <!-- <div class="sca-section">
	                                             <div class="sca-title">Views</div>
	                                             <div class="sca-value"><span>1</span></div>
	                                          </div> -->
	                                          <div class="sca-section">
	                                             <div class="sca-title">Bookings</div>
	                                             <div class="sca-value"><span><?=$bookingCount?></span></div>
	                                          </div>
	                                          <div class="sca-section">
	                                             <div class="sca-title">Earnings</div>
	                                             <div class="sca-value"><span>₹<?=$mentor_commision?></span></div>
	                                          </div>
	                                          <!-- <div class="sca-section">
	                                             <div class="sca-title">Conversion</div>
	                                             <div class="sca-value"><span>0.00%</span></div>
	                                          </div> -->
	                                       </div>
	                                    </div>
	                                 </div>
	                              </div>
                              <?php } }?>
                           </div>
                        </div>
                     </div>
                  </div>
               	</div>
               
                  <div class="col-sm-12 col-lg-6">
                    	<div class="card mb-4 text-white bg-whitebg">
	                  	<div class="card-body profile_cardbody">
	                  		<div class="metor_service">
	                  			<form>
	                  			  	<div class="mb-3">
		                  				<label for="exampleInputEmail1" class="form-label">Title</label>
		                  				<input type="text" class="form-control" placeholder="Name of Service" id="exampleInputEmail1">
	                  			  	</div>
	                  			  	<div class="mb-3">
		                  				<label for="exampleInputPassword1" class="form-label">Duration (mins)</label>
		                  				<input type="text" class="form-control" id="exampleInputPassword1">
	                  			  	</div>
	                  				<div class="input-group mb-3">
                  						<label for="basic-url" class="form-label">Amount (₹)</label>
                  					 	<div class="input-group">
	                  					  	<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-indian-rupee-sign"></i></span>
	                  					  	<input type="number" value="0" class="form-control">
	                  					</div>
	                  				</div>
	                  			  	<div class="d-grid gap-2">
                  			  			<button type="submit" class="btn btn-black">Next</button>
	                  				</div>
	                  			</form>
	                  		</div>
	                  		
	                  	</div>
                    	</div>
                  </div>
                  
               <!-- /.col-->
            </div>
         </div>
      </div>
   </div>
</div>