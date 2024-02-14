<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\Page;
use App\Models\Testimonial;
use App\Models\Enquiry;
use App\Models\EmailLog;
use App\Models\Faq;
use App\Models\HowItWork;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\BlogContent;
use App\Models\Team;
use App\Models\Banner;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceDetail;
use App\Models\ServiceTypeAttribute;
use App\Models\MentorAvailability;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\MentorProfile;
use App\Models\UserActivity;
use App\Models\UserDocument;
use App\Models\RequireDocument;
use App\Models\BookingRating;
use App\Models\MentorSlot;
use App\Models\Booking;

use Auth;
use Session;
use Helper;
use Hash;

class ApiController extends Controller
{
    
    public function validateSignupOtp(Request $request){
        $apiStatus          = TRUE;
        $apiMessage         = '';
        $apiResponse        = [];
        $apiExtraField      = '';
        $apiExtraData       = '';
        $requestData        = $request->all();
        if($requestData['key'] == env('PROJECT_KEY')){
            $id         = $requestData['id'];
            $otp        = $requestData['otp1'].$requestData['otp2'].$requestData['otp3'].$requestData['otp4'];
            $getUser    = User::where('id', '=', $id)->first();
            if($getUser){
                $remember_token = $getUser->remember_token;
                if($remember_token == $otp){
                    $postData = [
                        'remember_token'        => '',
                        'status'                => 1,
                    ];
                    User::where('id', '=', $id)->update($postData);
                    $this->sendMail('subhomoysamanta1989@gmail.com', $requestData['subject'], $requestData['message']);

                    $apiStatus                          = TRUE;
                    http_response_code(200);
                    $apiResponse['redirectUrl']         = url('signin/');
                    $apiMessage                         = 'OTP Validated. Thank You !!!';
                    $apiExtraField                      = 'response_code';
                    $apiExtraData                       = http_response_code();
                } else {
                    $apiStatus          = FALSE;
                    http_response_code(400);
                    $apiMessage         = 'OTP Mismatched !!!';
                    $apiExtraField      = 'response_code';
                    $apiExtraData       = http_response_code();
                }
            } else {
                $apiStatus          = FALSE;
                http_response_code(400);
                $apiMessage         = 'User Not Found !!!';
                $apiExtraField      = 'response_code';
                $apiExtraData       = http_response_code();
            }
        } else {
            http_response_code(400);
            $apiStatus          = FALSE;
            $apiMessage         = $this->getResponseCode(http_response_code());
            $apiExtraField      = 'response_code';
            $apiExtraData       = http_response_code();
        }
        $this->response_to_json($apiStatus, $apiMessage, $apiResponse, $apiExtraField, $apiExtraData);
    }
    public function resendOtp(Request $request){
        $apiStatus          = TRUE;
        $apiMessage         = '';
        $apiResponse        = [];
        $apiExtraField      = '';
        $apiExtraData       = '';
        $requestData        = $request->all();
        if($requestData['key'] == env('PROJECT_KEY')){
            $id         = $requestData['id'];
            $getUser    = User::where('id', '=', $id)->first();
            if($getUser){
                $remember_token = rand(1000,9999);
                $postData = [
                    'remember_token'        => $remember_token
                ];
                User::where('id', '=', $id)->update($postData);
                $this->sendMail('subhomoysamanta1989@gmail.com', $requestData['subject'], $requestData['message']);

                $apiStatus                          = TRUE;
                http_response_code(200);
                $apiMessage                         = 'OTP Resend !!!';
                $apiExtraField                      = 'response_code';
                $apiExtraData                       = http_response_code();
            } else {
                $apiStatus          = FALSE;
                http_response_code(400);
                $apiMessage         = 'User Not Found !!!';
                $apiExtraField      = 'response_code';
                $apiExtraData       = http_response_code();
            }
        } else {
            http_response_code(400);
            $apiStatus          = FALSE;
            $apiMessage         = $this->getResponseCode(http_response_code());
            $apiExtraField      = 'response_code';
            $apiExtraData       = http_response_code();
        }
        $this->response_to_json($apiStatus, $apiMessage, $apiResponse, $apiExtraField, $apiExtraData);
    }
    public function mentorFilter(Request $request){
        $apiStatus          = TRUE;
        $apiMessage         = 'Data Available !!!';
        $apiResponse        = [];
        $apiExtraField      = '';
        $apiExtraData       = '';
        $requestData        = $request->all();
        $mentors            = [];
        if($requestData['key'] == env('PROJECT_KEY')){
            $mentor_name    = $requestData['mentor_name'];
            $service_id     = $requestData['service_id'];
            $day_no         = $requestData['day_no'];
            if($mentor_name == '' && $service_id == '' && $day_no == ''){ // 1
                //
                $mentorLists                    = User::select('mentor_profiles.*','users.role','users.valid','users.email','users.phone')->join('mentor_profiles', 'mentor_profiles.user_id', '=', 'users.id')->where('users.valid', '=', 1)->where('users.role', '=', 2)->orderBy('users.id', 'DESC')->get();
                if($mentorLists){
                    foreach($mentorLists as $mentorList){
                        /* service details */
                            $service_attribute_ids = [];
                            $getServiceDetails = ServiceDetail::select('service_attribute_id')->where('mentor_user_id', '=', $mentorList->user_id)->where('status', '=', 1)->get();
                            if($getServiceDetails){
                                foreach($getServiceDetails as $getServiceDetail){
                                    $service_attribute_ids[] = $getServiceDetail->service_attribute_id;
                                }
                            }
                            $service_ids = [];
                            if(!empty($service_attribute_ids)){
                                for($s=0;$s<count($service_attribute_ids);$s++){
                                    $getServiceDetails2 = ServiceTypeAttribute::select('service_id')->where('service_attribute_id', '=', $service_attribute_ids[$s])->where('is_active', '=', 1)->first();
                                    if($getServiceDetails2){
                                        if(!in_array($getServiceDetails2->service_id, $service_ids)){
                                            $service_ids[] = $getServiceDetails2->service_id;
                                        }
                                    }
                                }
                            }
                            $serviceNames = [];
                            if(!empty($service_ids)){
                                for($s=0;$s<count($service_ids);$s++){
                                    $service = Service::select('name')->where('id', '=', $service_ids[$s])->where('status', '=', 1)->first();
                                    if($service){
                                        $serviceNames[] = (($service)?$service->name:'');
                                    }
                                }
                            }
                        /* service details */
                        /* availability */
                            $todayNo        = date('w');
                            $checkMentorAvl = MentorAvailability::where('mentor_user_id', '=', $mentorList->user_id)->where('day_of_week_id', '=', $todayNo)->count();
                            $weekDays       = [];
                            $dayOfWeeks     = MentorAvailability::select('day_of_week_id')->where('mentor_user_id', '=', $mentorList->user_id)->get();
                            if($dayOfWeeks){
                                foreach($dayOfWeeks as $dayOfWeek){
                                    $weekDays[]       = $dayOfWeek->day_of_week_id;
                                }
                            }
                        /* availability */
                        /* rating */
                            $getLastReview = BookingRating::where('mentor_id', '=', $mentorList->user_id)->where('status', '=', 1)->orderBy('id', 'DESC')->first();
                        /* rating */
                        $mentors[] = [
                            'mentor_id'     => $mentorList->user_id,
                            'name'          => $mentorList->full_name,
                            'display_name'  => $mentorList->display_name,
                            'email'         => $mentorList->email,
                            'phone'         => $mentorList->phone,
                            'qualification' => $mentorList->qualification,
                            'experience'    => $mentorList->experience,
                            'service_name'  => implode(",", $serviceNames),
                            'service_count' => count($service_ids),
                            'avl_today'     => (($checkMentorAvl > 0)?1:0),
                            'avg_rating'    => $this->getAvgRating($mentorList->user_id),
                            'last_review'   => (($getLastReview)?$getLastReview->review:''),
                            'profile_image' => (($mentorList->profile_pic != '')?env('UPLOADS_URL').'user/'.$mentorList->profile_pic:env('NO_IMAGE_AVATAR')),
                        ];
                    }
                }
            } elseif($mentor_name != '' && $service_id == '' && $day_no == ''){ // 2
                //
                $mentorLists                    = User::select('mentor_profiles.*','users.role','users.valid','users.email','users.phone')->join('mentor_profiles', 'mentor_profiles.user_id', '=', 'users.id')->where('users.valid', '=', 1)->where('users.role', '=', 2)->where('users.name', 'LIKE', '%'.$mentor_name.'%')->orderBy('users.id', 'DESC')->get();
                if($mentorLists){
                    foreach($mentorLists as $mentorList){
                        /* service details */
                            $service_attribute_ids = [];
                            $getServiceDetails = ServiceDetail::select('service_attribute_id')->where('mentor_user_id', '=', $mentorList->user_id)->where('status', '=', 1)->get();
                            if($getServiceDetails){
                                foreach($getServiceDetails as $getServiceDetail){
                                    $service_attribute_ids[] = $getServiceDetail->service_attribute_id;
                                }
                            }
                            $service_ids = [];
                            if(!empty($service_attribute_ids)){
                                for($s=0;$s<count($service_attribute_ids);$s++){
                                    $getServiceDetails2 = ServiceTypeAttribute::select('service_id')->where('service_attribute_id', '=', $service_attribute_ids[$s])->where('is_active', '=', 1)->first();
                                    if($getServiceDetails2){
                                        if(!in_array($getServiceDetails2->service_id, $service_ids)){
                                            $service_ids[] = $getServiceDetails2->service_id;
                                        }
                                    }
                                }
                            }
                            $serviceNames = [];
                            if(!empty($service_ids)){
                                for($s=0;$s<count($service_ids);$s++){
                                    $service = Service::select('name')->where('id', '=', $service_ids[$s])->where('status', '=', 1)->first();
                                    if($service){
                                        $serviceNames[] = (($service)?$service->name:'');
                                    }
                                }
                            }
                        /* service details */
                        /* availability */
                            $todayNo        = date('w');
                            $checkMentorAvl = MentorAvailability::where('mentor_user_id', '=', $mentorList->user_id)->where('day_of_week_id', '=', $todayNo)->count();
                            $weekDays       = [];
                            $dayOfWeeks     = MentorAvailability::select('day_of_week_id')->where('mentor_user_id', '=', $mentorList->user_id)->get();
                            if($dayOfWeeks){
                                foreach($dayOfWeeks as $dayOfWeek){
                                    $weekDays[]       = $dayOfWeek->day_of_week_id;
                                }
                            }
                        /* availability */
                        /* rating */
                            $getLastReview = BookingRating::where('mentor_id', '=', $mentorList->user_id)->where('status', '=', 1)->orderBy('id', 'DESC')->first();
                        /* rating */
                        $mentors[] = [
                            'mentor_id'     => $mentorList->user_id,
                            'name'          => $mentorList->full_name,
                            'display_name'  => $mentorList->display_name,
                            'email'         => $mentorList->email,
                            'phone'         => $mentorList->phone,
                            'qualification' => $mentorList->qualification,
                            'experience'    => $mentorList->experience,
                            'service_name'  => implode(",", $serviceNames),
                            'service_count' => count($service_ids),
                            'avl_today'     => (($checkMentorAvl > 0)?1:0),
                            'avg_rating'    => $this->getAvgRating($mentorList->user_id),
                            'last_review'   => (($getLastReview)?$getLastReview->review:''),
                            'profile_image' => (($mentorList->profile_pic != '')?env('UPLOADS_URL').'user/'.$mentorList->profile_pic:env('NO_IMAGE_AVATAR')),
                        ];
                    }
                }
            } elseif($mentor_name == '' && $service_id != '' && $day_no == ''){ // 3
                //
                $mentorLists                    = User::select('mentor_profiles.*','users.role','users.valid','users.email','users.phone')->join('mentor_profiles', 'mentor_profiles.user_id', '=', 'users.id')->where('users.valid', '=', 1)->where('users.role', '=', 2)->orderBy('users.id', 'DESC')->get();
                if($mentorLists){
                    foreach($mentorLists as $mentorList){
                        /* service details */
                            $service_attribute_ids = [];
                            $getServiceDetails = ServiceDetail::select('service_attribute_id')->where('mentor_user_id', '=', $mentorList->user_id)->where('status', '=', 1)->get();
                            if($getServiceDetails){
                                foreach($getServiceDetails as $getServiceDetail){
                                    $service_attribute_ids[] = $getServiceDetail->service_attribute_id;
                                }
                            }
                            $service_ids = [];
                            if(!empty($service_attribute_ids)){
                                for($s=0;$s<count($service_attribute_ids);$s++){
                                    $getServiceDetails2 = ServiceTypeAttribute::select('service_id')->where('service_attribute_id', '=', $service_attribute_ids[$s])->where('is_active', '=', 1)->first();
                                    if($getServiceDetails2){
                                        if(!in_array($getServiceDetails2->service_id, $service_ids)){
                                            $service_ids[] = $getServiceDetails2->service_id;
                                        }
                                    }
                                }
                            }
                            $serviceNames = [];
                            if(!empty($service_ids)){
                                for($s=0;$s<count($service_ids);$s++){
                                    $service = Service::select('name')->where('id', '=', $service_ids[$s])->where('status', '=', 1)->first();
                                    if($service){
                                        $serviceNames[] = (($service)?$service->name:'');
                                    }
                                }
                            }
                        /* service details */
                        /* availability */
                            $todayNo        = date('w');
                            $checkMentorAvl = MentorAvailability::where('mentor_user_id', '=', $mentorList->user_id)->where('day_of_week_id', '=', $todayNo)->count();
                            $weekDays       = [];
                            $dayOfWeeks     = MentorAvailability::select('day_of_week_id')->where('mentor_user_id', '=', $mentorList->user_id)->get();
                            if($dayOfWeeks){
                                foreach($dayOfWeeks as $dayOfWeek){
                                    $weekDays[]       = $dayOfWeek->day_of_week_id;
                                }
                            }
                        /* availability */
                        /* rating */
                            $getLastReview = BookingRating::where('mentor_id', '=', $mentorList->user_id)->where('status', '=', 1)->orderBy('id', 'DESC')->first();
                        /* rating */
                        if(in_array($service_id, $service_ids)){
                            $mentors[] = [
                                'mentor_id'     => $mentorList->user_id,
                                'name'          => $mentorList->full_name,
                                'display_name'  => $mentorList->display_name,
                                'email'         => $mentorList->email,
                                'phone'         => $mentorList->phone,
                                'qualification' => $mentorList->qualification,
                                'experience'    => $mentorList->experience,
                                'service_name'  => implode(",", $serviceNames),
                                'service_count' => count($service_ids),
                                'avl_today'     => (($checkMentorAvl > 0)?1:0),
                                'avg_rating'    => $this->getAvgRating($mentorList->user_id),
                                'last_review'   => (($getLastReview)?$getLastReview->review:''),
                                'profile_image' => (($mentorList->profile_pic != '')?env('UPLOADS_URL').'user/'.$mentorList->profile_pic:env('NO_IMAGE_AVATAR')),
                            ];
                        }
                    }
                }
            } elseif($mentor_name == '' && $service_id == '' && $day_no != ''){ // 4
                //
                $mentorLists                    = User::select('mentor_profiles.*','users.role','users.valid','users.email','users.phone')->join('mentor_profiles', 'mentor_profiles.user_id', '=', 'users.id')->where('users.valid', '=', 1)->where('users.role', '=', 2)->orderBy('users.id', 'DESC')->get();
                if($mentorLists){
                    foreach($mentorLists as $mentorList){
                        /* service details */
                            $service_attribute_ids = [];
                            $getServiceDetails = ServiceDetail::select('service_attribute_id')->where('mentor_user_id', '=', $mentorList->user_id)->where('status', '=', 1)->get();
                            if($getServiceDetails){
                                foreach($getServiceDetails as $getServiceDetail){
                                    $service_attribute_ids[] = $getServiceDetail->service_attribute_id;
                                }
                            }
                            $service_ids = [];
                            if(!empty($service_attribute_ids)){
                                for($s=0;$s<count($service_attribute_ids);$s++){
                                    $getServiceDetails2 = ServiceTypeAttribute::select('service_id')->where('service_attribute_id', '=', $service_attribute_ids[$s])->where('is_active', '=', 1)->first();
                                    if($getServiceDetails2){
                                        if(!in_array($getServiceDetails2->service_id, $service_ids)){
                                            $service_ids[] = $getServiceDetails2->service_id;
                                        }
                                    }
                                }
                            }
                            $serviceNames = [];
                            if(!empty($service_ids)){
                                for($s=0;$s<count($service_ids);$s++){
                                    $service = Service::select('name')->where('id', '=', $service_ids[$s])->where('status', '=', 1)->first();
                                    if($service){
                                        $serviceNames[] = (($service)?$service->name:'');
                                    }
                                }
                            }
                        /* service details */
                        /* availability */
                            $todayNo        = date('w');
                            $checkMentorAvl = MentorAvailability::where('mentor_user_id', '=', $mentorList->user_id)->where('day_of_week_id', '=', $todayNo)->count();
                            $weekDays       = [];
                            $dayOfWeeks     = MentorAvailability::select('day_of_week_id')->where('mentor_user_id', '=', $mentorList->user_id)->get();
                            if($dayOfWeeks){
                                foreach($dayOfWeeks as $dayOfWeek){
                                    $weekDays[]       = $dayOfWeek->day_of_week_id;
                                }
                            }
                        /* availability */
                        /* rating */
                            $getLastReview = BookingRating::where('mentor_id', '=', $mentorList->user_id)->where('status', '=', 1)->orderBy('id', 'DESC')->first();
                        /* rating */
                        if(in_array($day_no, $weekDays)){
                            $mentors[] = [
                                'mentor_id'     => $mentorList->user_id,
                                'name'          => $mentorList->full_name,
                                'display_name'  => $mentorList->display_name,
                                'email'         => $mentorList->email,
                                'phone'         => $mentorList->phone,
                                'qualification' => $mentorList->qualification,
                                'experience'    => $mentorList->experience,
                                'service_name'  => implode(",", $serviceNames),
                                'service_count' => count($service_ids),
                                'avl_today'     => (($checkMentorAvl > 0)?1:0),
                                'avg_rating'    => $this->getAvgRating($mentorList->user_id),
                                'last_review'   => (($getLastReview)?$getLastReview->review:''),
                                'profile_image' => (($mentorList->profile_pic != '')?env('UPLOADS_URL').'user/'.$mentorList->profile_pic:env('NO_IMAGE_AVATAR')),
                            ];
                        }
                    }
                }
            } elseif($mentor_name != '' && $service_id != '' && $day_no == ''){ // 5
                //
                $mentorLists                    = User::select('mentor_profiles.*','users.role','users.valid','users.email','users.phone')->join('mentor_profiles', 'mentor_profiles.user_id', '=', 'users.id')->where('users.valid', '=', 1)->where('users.role', '=', 2)->where('users.name', 'LIKE', '%'.$mentor_name.'%')->orderBy('users.id', 'DESC')->get();
                if($mentorLists){
                    foreach($mentorLists as $mentorList){
                        /* service details */
                            $service_attribute_ids = [];
                            $getServiceDetails = ServiceDetail::select('service_attribute_id')->where('mentor_user_id', '=', $mentorList->user_id)->where('status', '=', 1)->get();
                            if($getServiceDetails){
                                foreach($getServiceDetails as $getServiceDetail){
                                    $service_attribute_ids[] = $getServiceDetail->service_attribute_id;
                                }
                            }
                            $service_ids = [];
                            if(!empty($service_attribute_ids)){
                                for($s=0;$s<count($service_attribute_ids);$s++){
                                    $getServiceDetails2 = ServiceTypeAttribute::select('service_id')->where('service_attribute_id', '=', $service_attribute_ids[$s])->where('is_active', '=', 1)->first();
                                    if($getServiceDetails2){
                                        if(!in_array($getServiceDetails2->service_id, $service_ids)){
                                            $service_ids[] = $getServiceDetails2->service_id;
                                        }
                                    }
                                }
                            }
                            $serviceNames = [];
                            if(!empty($service_ids)){
                                for($s=0;$s<count($service_ids);$s++){
                                    $service = Service::select('name')->where('id', '=', $service_ids[$s])->where('status', '=', 1)->first();
                                    if($service){
                                        $serviceNames[] = (($service)?$service->name:'');
                                    }
                                }
                            }
                        /* service details */
                        /* availability */
                            $todayNo        = date('w');
                            $checkMentorAvl = MentorAvailability::where('mentor_user_id', '=', $mentorList->user_id)->where('day_of_week_id', '=', $todayNo)->count();
                            $weekDays       = [];
                            $dayOfWeeks     = MentorAvailability::select('day_of_week_id')->where('mentor_user_id', '=', $mentorList->user_id)->get();
                            if($dayOfWeeks){
                                foreach($dayOfWeeks as $dayOfWeek){
                                    $weekDays[]       = $dayOfWeek->day_of_week_id;
                                }
                            }
                        /* availability */
                        /* rating */
                            $getLastReview = BookingRating::where('mentor_id', '=', $mentorList->user_id)->where('status', '=', 1)->orderBy('id', 'DESC')->first();
                        /* rating */
                        if(in_array($service_id, $service_ids)){
                            $mentors[] = [
                                'mentor_id'     => $mentorList->user_id,
                                'name'          => $mentorList->full_name,
                                'display_name'  => $mentorList->display_name,
                                'email'         => $mentorList->email,
                                'phone'         => $mentorList->phone,
                                'qualification' => $mentorList->qualification,
                                'experience'    => $mentorList->experience,
                                'service_name'  => implode(",", $serviceNames),
                                'service_count' => count($service_ids),
                                'avl_today'     => (($checkMentorAvl > 0)?1:0),
                                'avg_rating'    => $this->getAvgRating($mentorList->user_id),
                                'last_review'   => (($getLastReview)?$getLastReview->review:''),
                                'profile_image' => (($mentorList->profile_pic != '')?env('UPLOADS_URL').'user/'.$mentorList->profile_pic:env('NO_IMAGE_AVATAR')),
                            ];
                        }
                    }
                }
            } elseif($mentor_name == '' && $service_id != '' && $day_no != ''){ // 6
                //
                $mentorLists                    = User::select('mentor_profiles.*','users.role','users.valid','users.email','users.phone')->join('mentor_profiles', 'mentor_profiles.user_id', '=', 'users.id')->where('users.valid', '=', 1)->where('users.role', '=', 2)->orderBy('users.id', 'DESC')->get();
                if($mentorLists){
                    foreach($mentorLists as $mentorList){
                        /* service details */
                            $service_attribute_ids = [];
                            $getServiceDetails = ServiceDetail::select('service_attribute_id')->where('mentor_user_id', '=', $mentorList->user_id)->where('status', '=', 1)->get();
                            if($getServiceDetails){
                                foreach($getServiceDetails as $getServiceDetail){
                                    $service_attribute_ids[] = $getServiceDetail->service_attribute_id;
                                }
                            }
                            $service_ids = [];
                            if(!empty($service_attribute_ids)){
                                for($s=0;$s<count($service_attribute_ids);$s++){
                                    $getServiceDetails2 = ServiceTypeAttribute::select('service_id')->where('service_attribute_id', '=', $service_attribute_ids[$s])->where('is_active', '=', 1)->first();
                                    if($getServiceDetails2){
                                        if(!in_array($getServiceDetails2->service_id, $service_ids)){
                                            $service_ids[] = $getServiceDetails2->service_id;
                                        }
                                    }
                                }
                            }
                            $serviceNames = [];
                            if(!empty($service_ids)){
                                for($s=0;$s<count($service_ids);$s++){
                                    $service = Service::select('name')->where('id', '=', $service_ids[$s])->where('status', '=', 1)->first();
                                    if($service){
                                        $serviceNames[] = (($service)?$service->name:'');
                                    }
                                }
                            }
                        /* service details */
                        /* availability */
                            $todayNo        = date('w');
                            $checkMentorAvl = MentorAvailability::where('mentor_user_id', '=', $mentorList->user_id)->where('day_of_week_id', '=', $todayNo)->count();
                            $weekDays       = [];
                            $dayOfWeeks     = MentorAvailability::select('day_of_week_id')->where('mentor_user_id', '=', $mentorList->user_id)->get();
                            if($dayOfWeeks){
                                foreach($dayOfWeeks as $dayOfWeek){
                                    $weekDays[]       = $dayOfWeek->day_of_week_id;
                                }
                            }
                        /* availability */
                        /* rating */
                            $getLastReview = BookingRating::where('mentor_id', '=', $mentorList->user_id)->where('status', '=', 1)->orderBy('id', 'DESC')->first();
                        /* rating */
                        if(in_array($service_id, $service_ids)){
                            if(in_array($day_no, $weekDays)){
                                $mentors[] = [
                                    'mentor_id'     => $mentorList->user_id,
                                    'name'          => $mentorList->full_name,
                                    'display_name'  => $mentorList->display_name,
                                    'email'         => $mentorList->email,
                                    'phone'         => $mentorList->phone,
                                    'qualification' => $mentorList->qualification,
                                    'experience'    => $mentorList->experience,
                                    'service_name'  => implode(",", $serviceNames),
                                    'service_count' => count($service_ids),
                                    'avl_today'     => (($checkMentorAvl > 0)?1:0),
                                    'avg_rating'    => $this->getAvgRating($mentorList->user_id),
                                    'last_review'   => (($getLastReview)?$getLastReview->review:''),
                                    'profile_image' => (($mentorList->profile_pic != '')?env('UPLOADS_URL').'user/'.$mentorList->profile_pic:env('NO_IMAGE_AVATAR')),
                                ];
                            }
                        }
                    }
                }
            } elseif($mentor_name != '' && $service_id == '' && $day_no != ''){ // 7
                //
                $mentorLists                    = User::select('mentor_profiles.*','users.role','users.valid','users.email','users.phone')->join('mentor_profiles', 'mentor_profiles.user_id', '=', 'users.id')->where('users.valid', '=', 1)->where('users.role', '=', 2)->where('users.name', 'LIKE', '%'.$mentor_name.'%')->orderBy('users.id', 'DESC')->get();
                if($mentorLists){
                    foreach($mentorLists as $mentorList){
                        /* service details */
                            $service_attribute_ids = [];
                            $getServiceDetails = ServiceDetail::select('service_attribute_id')->where('mentor_user_id', '=', $mentorList->user_id)->where('status', '=', 1)->get();
                            if($getServiceDetails){
                                foreach($getServiceDetails as $getServiceDetail){
                                    $service_attribute_ids[] = $getServiceDetail->service_attribute_id;
                                }
                            }
                            $service_ids = [];
                            if(!empty($service_attribute_ids)){
                                for($s=0;$s<count($service_attribute_ids);$s++){
                                    $getServiceDetails2 = ServiceTypeAttribute::select('service_id')->where('service_attribute_id', '=', $service_attribute_ids[$s])->where('is_active', '=', 1)->first();
                                    if($getServiceDetails2){
                                        if(!in_array($getServiceDetails2->service_id, $service_ids)){
                                            $service_ids[] = $getServiceDetails2->service_id;
                                        }
                                    }
                                }
                            }
                            $serviceNames = [];
                            if(!empty($service_ids)){
                                for($s=0;$s<count($service_ids);$s++){
                                    $service = Service::select('name')->where('id', '=', $service_ids[$s])->where('status', '=', 1)->first();
                                    if($service){
                                        $serviceNames[] = (($service)?$service->name:'');
                                    }
                                }
                            }
                        /* service details */
                        /* availability */
                            $todayNo        = date('w');
                            $checkMentorAvl = MentorAvailability::where('mentor_user_id', '=', $mentorList->user_id)->where('day_of_week_id', '=', $todayNo)->count();
                            $weekDays       = [];
                            $dayOfWeeks     = MentorAvailability::select('day_of_week_id')->where('mentor_user_id', '=', $mentorList->user_id)->get();
                            if($dayOfWeeks){
                                foreach($dayOfWeeks as $dayOfWeek){
                                    $weekDays[]       = $dayOfWeek->day_of_week_id;
                                }
                            }
                        /* availability */
                        /* rating */
                            $getLastReview = BookingRating::where('mentor_id', '=', $mentorList->user_id)->where('status', '=', 1)->orderBy('id', 'DESC')->first();
                        /* rating */
                        if(in_array($day_no, $weekDays)){
                            $mentors[] = [
                                'mentor_id'     => $mentorList->user_id,
                                'name'          => $mentorList->full_name,
                                'display_name'  => $mentorList->display_name,
                                'email'         => $mentorList->email,
                                'phone'         => $mentorList->phone,
                                'qualification' => $mentorList->qualification,
                                'experience'    => $mentorList->experience,
                                'service_name'  => implode(",", $serviceNames),
                                'service_count' => count($service_ids),
                                'avl_today'     => (($checkMentorAvl > 0)?1:0),
                                'avg_rating'    => $this->getAvgRating($mentorList->user_id),
                                'last_review'   => (($getLastReview)?$getLastReview->review:''),
                                'profile_image' => (($mentorList->profile_pic != '')?env('UPLOADS_URL').'user/'.$mentorList->profile_pic:env('NO_IMAGE_AVATAR')),
                            ];
                        }
                    }
                }
            } elseif($mentor_name != '' && $service_id != '' && $day_no != ''){ // 8
                //
                $mentorLists                    = User::select('mentor_profiles.*','users.role','users.valid','users.email','users.phone')->join('mentor_profiles', 'mentor_profiles.user_id', '=', 'users.id')->where('users.valid', '=', 1)->where('users.role', '=', 2)->where('users.name', 'LIKE', '%'.$mentor_name.'%')->orderBy('users.id', 'DESC')->get();
                if($mentorLists){
                    foreach($mentorLists as $mentorList){
                        /* service details */
                            $service_attribute_ids = [];
                            $getServiceDetails = ServiceDetail::select('service_attribute_id')->where('mentor_user_id', '=', $mentorList->user_id)->where('status', '=', 1)->get();
                            if($getServiceDetails){
                                foreach($getServiceDetails as $getServiceDetail){
                                    $service_attribute_ids[] = $getServiceDetail->service_attribute_id;
                                }
                            }
                            $service_ids = [];
                            if(!empty($service_attribute_ids)){
                                for($s=0;$s<count($service_attribute_ids);$s++){
                                    $getServiceDetails2 = ServiceTypeAttribute::select('service_id')->where('service_attribute_id', '=', $service_attribute_ids[$s])->where('is_active', '=', 1)->first();
                                    if($getServiceDetails2){
                                        if(!in_array($getServiceDetails2->service_id, $service_ids)){
                                            $service_ids[] = $getServiceDetails2->service_id;
                                        }
                                    }
                                }
                            }
                            $serviceNames = [];
                            if(!empty($service_ids)){
                                for($s=0;$s<count($service_ids);$s++){
                                    $service = Service::select('name')->where('id', '=', $service_ids[$s])->where('status', '=', 1)->first();
                                    if($service){
                                        $serviceNames[] = (($service)?$service->name:'');
                                    }
                                }
                            }
                        /* service details */
                        /* availability */
                            $todayNo        = date('w');
                            $checkMentorAvl = MentorAvailability::where('mentor_user_id', '=', $mentorList->user_id)->where('day_of_week_id', '=', $todayNo)->count();
                            $weekDays       = [];
                            $dayOfWeeks     = MentorAvailability::select('day_of_week_id')->where('mentor_user_id', '=', $mentorList->user_id)->get();
                            if($dayOfWeeks){
                                foreach($dayOfWeeks as $dayOfWeek){
                                    $weekDays[]       = $dayOfWeek->day_of_week_id;
                                }
                            }
                        /* availability */
                        /* rating */
                            $getLastReview = BookingRating::where('mentor_id', '=', $mentorList->user_id)->where('status', '=', 1)->orderBy('id', 'DESC')->first();
                        /* rating */
                        if(in_array($service_id, $service_ids)){
                            if(in_array($day_no, $weekDays)){
                                $mentors[] = [
                                    'mentor_id'     => $mentorList->user_id,
                                    'name'          => $mentorList->full_name,
                                    'display_name'  => $mentorList->display_name,
                                    'email'         => $mentorList->email,
                                    'phone'         => $mentorList->phone,
                                    'qualification' => $mentorList->qualification,
                                    'experience'    => $mentorList->experience,
                                    'service_name'  => implode(",", $serviceNames),
                                    'service_count' => count($service_ids),
                                    'avl_today'     => (($checkMentorAvl > 0)?1:0),
                                    'avg_rating'    => $this->getAvgRating($mentorList->user_id),
                                    'last_review'   => (($getLastReview)?$getLastReview->review:''),
                                    'profile_image' => (($mentorList->profile_pic != '')?env('UPLOADS_URL').'user/'.$mentorList->profile_pic:env('NO_IMAGE_AVATAR')),
                                ];
                            }
                        }
                    }
                }
            }
            $data['mentors']            = $mentors;
            $filter_html                = view('front/pages/ajax-mentors', $data);
            echo $filter_html;die;
            // $apiResponse                = [
            //     // 'mentor_count'  => count($mentors),
            //     'mentor_html'   => $filter_html,
            // ];
            // $apiStatus                          = TRUE;
            // http_response_code(200);
            // $apiMessage                         = 'Data Available !!!';
            // $apiExtraField                      = 'response_code';
            // $apiExtraData                       = http_response_code();
        } else {
            http_response_code(400);
            $apiStatus          = FALSE;
            $apiMessage         = $this->getResponseCode(http_response_code());
            $apiExtraField      = 'response_code';
            $apiExtraData       = http_response_code();
        }
        $this->response_to_json($apiStatus, $apiMessage, $apiResponse, $apiExtraField, $apiExtraData);
    }
    public function getMentorTimeSlots(Request $request){
        $apiStatus          = TRUE;
        $apiMessage         = '';
        $apiResponse        = [];
        $apiExtraField      = '';
        $apiExtraData       = '';
        $requestData        = $request->all();
        if($requestData['key'] == env('PROJECT_KEY')){
            $mentor_user_id         = $requestData['mentor_user_id'];
            $getUser    = User::where('id', '=', $mentor_user_id)->first();
            if($getUser){
                
                $booking_date   = $requestData['booking_date'];
                $duration       = $requestData['duration'];
                $day_no         = Helper::getDayNo(date_format(date_create($booking_date), "D"));
                $mentor_slots   = [];
                $getMentorSlots = MentorSlot::select('id', 'from_time', 'to_time')->where('status', '=', 1)->where('mentor_user_id', '=', $mentor_user_id)->where('day_of_week_id', '=', $day_no)->where('duration', '=', $duration)->get();
                if($getMentorSlots){
                    foreach($getMentorSlots as $getMentorSlot){
                        $checkBookedTimeSlots = Booking::select('id')->where('status', '<', 2)->where('mentor_id', '=', $mentor_user_id)->where('booking_date', '=', $booking_date)->where('booking_slot_from', '=', $getMentorSlot->from_time)->count();
                        if($checkBookedTimeSlots <= 0){
                            $mentor_slots[]   = [
                                'slot_id'   => $getMentorSlot->id,
                                'from_time' => date_format(date_create($getMentorSlot->from_time), "h:i A"),
                                'to_time'   => date_format(date_create($getMentorSlot->to_time), "h:i A")
                            ];
                        }
                    }
                }
                if(!empty($mentor_slots)){
                    $apiResponse                        = $mentor_slots;
                    $apiStatus                          = TRUE;
                    http_response_code(200);
                    $apiMessage                         = $duration.' Mins Slots Available !!!';
                    $apiExtraField                      = 'response_code';
                    $apiExtraData                       = http_response_code();
                } else {
                    $apiStatus                          = FALSE;
                    http_response_code(200);
                    $apiMessage                         = $duration.' Mins Slots Not Available !!!';
                    $apiExtraField                      = 'response_code';
                    $apiExtraData                       = http_response_code();
                }
            } else {
                $apiStatus          = FALSE;
                http_response_code(400);
                $apiMessage         = 'User Not Found !!!';
                $apiExtraField      = 'response_code';
                $apiExtraData       = http_response_code();
            }
        } else {
            http_response_code(400);
            $apiStatus          = FALSE;
            $apiMessage         = $this->getResponseCode(http_response_code());
            $apiExtraField      = 'response_code';
            $apiExtraData       = http_response_code();
        }
        $this->response_to_json($apiStatus, $apiMessage, $apiResponse, $apiExtraField, $apiExtraData);
    }
    public function getDefaultServiceDetails(Request $request){
        $apiStatus          = TRUE;
        $apiMessage         = '';
        $apiResponse        = [];
        $apiExtraField      = '';
        $apiExtraData       = '';
        $requestData        = $request->all();
        if($requestData['key'] == env('PROJECT_KEY')){
            $default_service_data           = [];
            $service_attribute_id           = $requestData['service_attribute_id'];
            $getDefaultServiceData          = ServiceAttribute::where('status', '=', 1)->where('id', '=', $service_attribute_id)->first();
            if($getDefaultServiceData){
                $default_service_data   = [
                    'title'             => $getDefaultServiceData->title,
                    'description'       => $getDefaultServiceData->description,
                    'duration'          => (int)$getDefaultServiceData->duration,
                    'actual_amount'     => $getDefaultServiceData->actual_amount,
                    'slashed_amount'    => $getDefaultServiceData->slashed_amount,
                ];
            }
            $apiResponse                        = $default_service_data;
            $apiStatus                          = TRUE;
            http_response_code(200);
            $apiMessage                         = 'Data Available !!!';
            $apiExtraField                      = 'response_code';
            $apiExtraData                       = http_response_code();
        } else {
            http_response_code(400);
            $apiStatus          = FALSE;
            $apiMessage         = $this->getResponseCode(http_response_code());
            $apiExtraField      = 'response_code';
            $apiExtraData       = http_response_code();
        }
        $this->response_to_json($apiStatus, $apiMessage, $apiResponse, $apiExtraField, $apiExtraData);
    }
}
