<?php
use App\Models\User;
use App\Models\MentorProfile;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\StudentProfile;
use App\Helpers\Helper;

$studentUser      = User::where('id', '=', $booking->student_id)->first();
$student          = StudentProfile::where('user_id', '=', $booking->student_id)->first();
$mentor           = MentorProfile::where('user_id', '=', $booking->mentor_id)->first();
?>
<!-- ********|| BANNER STARTS ||******** -->
<div class="inner_slider_final_section">
   <div class="container-fluid px-0">
      <div class="innerpage_banner">
         <div class="innerbanner_img"><img src="<?=env('FRONT_ASSETS_URL')?>assets/images/success_banner.jpg" alt="banner"></div>
         <div class="innerbanner_bredcum">
            <h1>Payment Success</h1>
         </div>
      </div>
   </div>
</div>
<!-- ********|| BANNER ENDS ||******** -->
<section class="about_section_one">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="sucees_usertable">
               <div class="sucess_icon"><i class="fa-solid fa-check"></i></div>
               <h3>Payment Success!</h3>
               <div class="table-responsive">
                  <table  class="table table-bordered">
                     <tbody>
                        <tr>
                           <th>Booking Number</th>
                           <td><?=$booking->booking_no?></td>
                        </tr>
                        <tr>
                           <th>Student Name</th>
                           <td>
                             <?php
                             echo (($student)?$student->full_name:'');
                             ?>
                           </td>
                        </tr>
                        <tr>
                           <th>Mentor Name</th>
                           <td>
                             <?php
                             echo (($mentor)?$mentor->full_name:'');
                             ?>
                           </td>
                        </tr>
                        <tr>
                           <th>Booking Date/Time</th>
                           <td><?=date_format(date_create($booking->booking_date), "M d, Y")?> <?=date_format(date_create($booking->booking_slot_from), "h:i A")?> - <?=date_format(date_create($booking->booking_slot_to), "h:i A")?></td>
                        </tr>
                        <tr>
                           <th>Service Type</th>
                           <td>
                             <?php
                             $service_type = ServiceType::select('name')->where('id', '=', $booking->service_type_id)->first();
                             echo (($service_type)?$service_type->name:'');
                             ?>
                           </td>
                        </tr>
                        <tr>
                           <th>Service Name</th>
                           <td>
                             <?php
                             $service = Service::select('name')->where('id', '=', $booking->service_id)->first();
                             echo (($service)?$service->name:'');
                             ?>
                           </td>
                        </tr>
                        <tr>
                           <th>Duration</th>
                           <td><?=$booking->duration?> Mins</td>
                        </tr>
                        <tr>
                           <th>Payment amount</th>
                           <td><?=number_format($booking->payment_amount,2)?></td>
                        </tr>
                        <tr>
                           <th>Txn No.</th>
                           <td><?=$booking->txn_id?></td>
                        </tr>
                        <tr>
                           <th>Payment Time</th>
                           <td><?=date_format(date_create($booking->payment_date_time), "M d, Y h:i A")?></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="paynow_btn">
                  <a href="<?=url('user/student-transactions')?>"><strong><i class="fa fa-arrow-right"></i> Go To Transactions</strong></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>