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
            <h1>Booking Success</h1>
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
               <h3>You are one step away to confirm your slot!</h3>
               <div class="table-responsive">
                  <?php
                     $productinfo         = $booking->id;
                     $txnid               = time();
                     $surl                = $surl;
                     $furl                = $furl;        
                     $key_id              = env('RAZOR_KEY_ID');
                     $currency_code       = env('CURRENCY_CODE');            
                     $total               = ($booking->payable_amt* 100);
                     $amount              = $booking->payable_amt;
                     $merchant_order_id   = $booking->id;
                     $card_holder_name    = (($studentUser)?$studentUser->name:'');
                     $email               = (($studentUser)?$studentUser->email:'');
                     $phone               = (($studentUser)?$studentUser->phone:'');
                     $name                = env('APP_NAME');
                     $return_url          = $return_url;
                  ?>
                  <form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
                     @csrf
                     <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                     <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                     <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
                     <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
                     <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
                     <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
                     <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
                     <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
                     <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
                  </form>
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
                           <th>Actual amount</th>
                           <td><?=number_format($booking->actual_amount,2)?></td>
                        </tr>
                        <tr>
                           <th>Actual amount</th>
                           <td><?=number_format($booking->gst_amount,2)?> (<?=number_format($booking->gst_percent,0)?> %)</td>
                        </tr>
                        <tr>
                           <th>Actual amount</th>
                           <td><?=number_format($booking->payable_amt,2)?></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="paynow_btn">
                  <!-- <a href="javascript:void(0);">Pay Now  <strong><i class="fa-solid fa-indian-rupee-sign"></i> <?=$booking->payable_amt?></strong></a> -->
                  <input id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="PAY NOW" class="btn btn-success" />
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpay_options = {
    key: "<?php echo $key_id; ?>",
    amount: "<?php echo $total; ?>",
    name: "<?php echo $name; ?>",
    description: "<?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
    prefill: {
      name:"<?php echo $card_holder_name; ?>",
      email: "<?php echo $email; ?>",
      contact: "<?php echo $phone; ?>"
    },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
        }
    }
  };
  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubmit(el){
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }  
</script>