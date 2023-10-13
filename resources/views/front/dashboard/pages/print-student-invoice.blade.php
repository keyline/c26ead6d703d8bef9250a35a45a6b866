<?php
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GeneralSetting;
use App\Models\MentorProfile;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\StudentProfile;
use App\Helpers\Helper;
$generalSetting     = GeneralSetting::find('1');
$student 			= User::where('id', '=', $row->student_id)->first();
$mentor 			= User::where('id', '=', $row->mentor_id)->first();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$generalSetting->site_name?>-Invoice-<?=$row->booking_no?></title>
    <link rel="stylesheet" href="<?=env('FRONT_ASSETS_URL')?>assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" 
   href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
       crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="margin-top:20px; background-color:#eee;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="position: relative; display: flex; flex-direction: column; min-width: 0; word-wrap: break-word; background-color: #fff; background-clip: border-box; border: 0 solid rgba(0,0,0,.125); border-radius: 1rem; box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);">
                    <div class="card-body">
                        <div class="invoice-title">
                            <div class="d-flex justify-content-between align-items-baseline flex-wrap">
                                <div class="mb-sm-4">
                                    <h2 class="mb-1" style="color: #f9233f;">
                                    	<?=$generalSetting->site_name?>
                                    </h2>
                                 </div>
                                 <h4 style="font-size: 18px;">Invoice #<?=$row->booking_no?> <span class="badge bg-success ms-2">Paid</span></h4>
                            </div>
                            
                            <div class="text-muted">
                                <p class="mb-1 d-flex align-items-center"> <i class="fa-solid fa-location-dot me-2"></i> <?=$generalSetting->description?></p>
                                <p class="mb-1 d-flex align-items-center"><i class="fa-solid fa-envelope me-2 mt-1"></i> <?=$generalSetting->site_mail?></p>
                                <p class="d-flex align-items-center"><i class="fa-solid fa-mobile me-2"></i> <?=$generalSetting->site_phone?></p>
                            </div>
                        </div>
    
                        <hr class="my-4">
    
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="mb-3">Billed To:</h5>
                                    <h5 class="mb-2"><?=(($student)?$student->name:'')?></h5>
                                    <!-- <p class="mb-1"><?=(($student)?$student->name:'')?></p> -->
                                    <p class="mb-1"><?=(($student)?$student->email:'')?></p>
                                    <p><?=(($student)?$student->phone:'')?></p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                        <p>#<?=$row->booking_no?></p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                        <p><?=(($row->payment_date_time != '')?date_format(date_create($row->payment_date_time), "M d, Y h:i A"):'')?></p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Mentor Details:</h5>
                                        <h5 class="mb-2"><?=(($mentor)?$mentor->name:'')?></h5>
	                                    <p class="mb-1"><?=(($mentor)?$mentor->email:'')?></p>
	                                    <p><?=(($mentor)?$mentor->phone:'')?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                        <div class="py-2">
                            <h5 class="font-size-15">Order Summary</h5>
    
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <!-- <th style="width: 70px;">No.</th> -->
                                            <th colspan="3">Service</th>
                                            <th>Price</th>
                                            <th class="text-end" style="width: 120px;">Total</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        <tr>
                                            <!-- <th scope="row">01</th> -->
                                            <td colspan="3">
                                                <div>
                                                    <h5 class="text-truncate mb-1" style="font-size: 16px;">
                                                    	<?php
						                             	$service_type = ServiceType::select('name')->where('id', '=', $row->service_type_id)->first();
						                             	echo (($service_type)?$service_type->name:'');
						                             	?>
                                                    </h5>
                                                    <p class="text-muted mb-0">
                                                    	<?php
						                             	$service = Service::select('name')->where('id', '=', $row->service_id)->first();
						                             	echo (($service)?$service->name:'');
						                             	?>
                                                    </p>
                                                    <p class="text-muted mb-0">
                                                    	<?=$row->duration?> Mins
                                                    </p>
                                                </div>
                                            </td>
                                            <td><?=number_format($row->actual_amount,2)?></td>
                                            <td class="text-end"><?=number_format($row->actual_amount,2)?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                            <td class="text-end"><?=number_format($row->actual_amount,2)?></td>
                                        </tr>
                                        <!-- end tr -->
                                        <!-- <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                Discount :</th>
                                            <td class="border-0 text-end">- $25.50</td>
                                        </tr> -->
                                        <!-- end tr -->
                                        <!-- <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                Shipping Charge :</th>
                                            <td class="border-0 text-end">$20.00</td>
                                        </tr> -->
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                GST</th>
                                            <td class="border-0 text-end">(<?=number_format($row->gst_percent,0)?> %) <?=number_format($row->gst_amount,2)?></td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                            <td class="border-0 text-end"><h4 class="m-0 fw-semibold"><?=number_format($row->payment_amount,2)?></h4></td>
                                        </tr>
                                        <!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                    <!-- <a href="#" class="btn w-md" style="color: #fff; background-color: #f9233f; border-color: #f9233f;">Send</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?=env('FRONT_ASSETS_URL')?>assets/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>