<?php
use App\Models\Booking;
use App\Models\User;
use App\Models\AdminPayment;
use App\Models\MentorPayment;
use App\Models\Withdrawl;
use App\Models\MentorAvailability;
use App\Models\MentorSlot;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\GeneralSetting;

if($row){
	$service_attribute_id 	= $row->service_attribute_id;
	$title 						= $row->title;
	$description 				= $row->description;
	$duration 					= $row->duration;
	$slashed_amount 			= $row->slashed_amount;
	$total_amount_payable 	= $row->total_amount_payable;
	$status 						= $row->status;
} else {
	$service_attribute_id 	= '';
	$title 						= '';
	$description 				= '';
	$duration 					= '';
	$slashed_amount 			= '';
	$total_amount_payable 	= '';
	$status 						= '';
}
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
      <div class="col-xl-12">
		<?php if(session('success_message')) {?>
			<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide" role="alert">
			<?=session('success_message')?>
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php }?>
		<?php if(session('error_message')) {?>
			<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
			<?=session('error_message')?>
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php }?>
		</div>
      <div class="body flex-grow-1 px-3">
         <div class="container-lg">
            <div class="row">
               <div class="col-sm-12 col-lg-6">
                  <div class="card mb-4 text-white bg-whitebg">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-12">
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
	                                                <?php if($mentor_service->status){?>
		                                                <div class="ant-service-public">
		                                                   <div class="ant-space-item" style="">
		                                                      <i class="fa-regular fa-eye"></i>
		                                                   </div>
		                                                   <div class="ant-space-item">Public</div>
		                                                </div>
		                                             <?php } else {?>
		                                                <div class="ant-service-public">
		                                                   <div class="ant-space-item" style="">
		                                                      <i class="fa-regular fa-eye-slash"></i>
		                                                   </div>
		                                                   <div class="ant-space-item">Private</div>
		                                                </div>
	                                                <?php }?>
	                                             </div>
	                                             <div class="ant-servceie_times">
	                                                <div class="ant-times-item" style=""><span><?=$mentor_service->duration?> mins<span style="margin-left: 6px;">|</span></span></div>
	                                                <div class="ant-amount-item"><span>₹ <?=$mentor_service->total_amount_payable?> </span></div>
	                                             </div>
	                                          </div>
	                                          <div class="service-card-footer">
	                                             <div class="ant-typography" style="display: flex; align-items: center; width: 100%; justify-content: space-between;">
	                                                <div class="ant-service_allbtn">
	                                                   <!-- <div class="ant-space-item" style="">
	                                                      <button type="button" class="ant-btn ant-btn-text">
	                                                      <i class="fa-solid fa-arrow-up-from-bracket"></i>
	                                                      </button>
	                                                   </div>
	                                                   <div class="ant-space-item" style="">
	                                                      <button type="button" class="ant-btn ant-btn-text">
	                                                      <i class="fa-regular fa-copy"></i>
	                                                      </button>
	                                                   </div> -->
	                                                   <div class="ant-space-item">
	                                                      <a href="<?=url('user/mentor-service-edit/'.Helper::encoded($mentor_service->id))?>"><button type="button" class="ant-edit ant-btn-text"><span><i class="fa fa-edit"></i> Edit</span></button></a>
	                                                      <a href="<?=url('user/mentor-service-edit/'.Helper::encoded($mentor_service->id))?>"><button type="button" class="ant-edit ant-btn-text"><span><i class="fa fa-trash"></i> Delete</span></button></a>
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
                  			<form action="" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                    				@csrf
                  				<input type="hidden" name="mode" value="service">
										<input type="hidden" name="mentor_user_id" value="<?=$userId?>">
										<input type="hidden" name="id" value="<?=$id?>">
                  				<div class="mb-3">
	                  				<label for="service_attribute_id" class="form-label">Service Type</label>
	                  				<select class="form-control" id="service_attribute_id" name="service_attribute_id" onchange="getServiceDetails(this.value);">
	                  					<option value="" selected>Select Service Type</option>
	                  					<?php if($service_attrs){ foreach($service_attrs as $service_attr){?>
	                  						<?php
	                  						$checkMentorService = ServiceDetail::where('mentor_user_id', '=', $userId)->where('service_attribute_id', '=', $service_attr->id)->count();
	                  						//if($checkMentorService <= 0){
	                  						?>
			                  					<option value="<?=$service_attr->id?>" <?=(($service_attribute_id == $service_attr->id)?'selected':'')?>><?=$service_attr->title?></option>
			                  				<?php //}?>
		                  				<?php } }?>
	                  				</select>
                  			  	</div>
                  			  	<div class="mb-3">
	                  				<label for="title" class="form-label">Title</label>
	                  				<input type="text" class="form-control" placeholder="Title of Service" id="title" name="title" value="<?=$title?>">
                  			  	</div>
                  			  	<div class="mb-3">
	                  				<label for="description" class="form-label">Description</label>
	                  				<textarea class="form-control" placeholder="Description of Service" id="description" name="description" rows="5"><?=$description?></textarea>
                  			  	</div>
                  			  	<div class="mb-3">
	                  				<label for="duration" class="form-label">Duration (mins)</label>
	                  				<select class="form-control" id="duration" name="duration">
	                  					<option value="" selected>Select Duration</option>
	                  					<option value="30" <?=(($duration == 30)?'selected':'')?>>30 Mins</option>
	                  					<option value="60" <?=(($duration == 60)?'selected':'')?>>60 Mins</option>
	                  				</select>
                  			  	</div>
                  				<div class="input-group mb-3">
               						<label for="slashed_amount" class="form-label">Mark-up Amount (₹)</label>
               					 	<div class="input-group">
                  					  	<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                  					  	<input type="text" class="form-control" id="slashed_amount" name="slashed_amount" value="<?=$slashed_amount?>">
                  					</div>
                  				</div>
                  				<div class="input-group mb-3">
               						<label for="total_amount_payable" class="form-label">Actual Amount (₹)</label>
               					 	<div class="input-group">
                  					  	<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                  					  	<input type="text" class="form-control" id="total_amount_payable" name="total_amount_payable" value="<?=$total_amount_payable?>">
                  					</div>
                  				</div>
                  				<div class="mb-3">
	                  				<label for="status" class="form-label">Display</label>
	                  				<select class="form-control" id="status" name="status">
	                  					<option value="" selected>Select Display</option>
	                  					<option value="1" <?=(($status == 1)?'selected':'')?>>Public</option>
	                  					<option value="0" <?=(($status == 0)?'selected':'')?>>Private</option>
	                  				</select>
                  			  	</div>
                  			  	<div class="d-grid gap-2">
               			  			<button type="submit" class="btn btn-black">Save</button>
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
<script type="text/javascript">
	function getServiceDetails(service_attribute_id){
	    $.ajax({
	        type: "GET",
	        url: base_url + "get-default-service-details",
	        data: {key: 'facb6e0a6fcbe200dca2fb60dec75be7', source: 'WEB', service_attribute_id: service_attribute_id},
	        dataType: "JSON",
	        beforeSend: function () {
	            $(".metor_service").loading();
	        },
	        success: function (res) {
	            $(".metor_service").loading("stop");
	            $('#title').val(res.data.title);
	            $('#description').val(res.data.description);
	            $('#duration').val(res.data.duration);
	            $('#slashed_amount').val(res.data.slashed_amount);
	            $('#total_amount_payable').val(res.data.actual_amount);
	        },
	        error:function (xhr, ajaxOptions, thrownError){
	            $(".metor_service").loading("stop");
	            var res = xhr.responseJSON;
	            if(!res.status) {
	                toastAlert("error", res.message);
	            }
	        }
	    });
	}
</script>