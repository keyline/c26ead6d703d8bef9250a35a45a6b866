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
use App\Models\AdminPayment;
use App\Models\MentorPayment;

use App\Rules\ReCaptcha;
use Auth;
use Session;
use Helper;
use Hash;
use DateTime;
use DateTimeZone;

class FrontController extends Controller
{
    /* home */
        public function home(){
            $data['banners']                = Banner::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['testimonials']           = Testimonial::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['serviceTypes']           = ServiceType::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['services']               = Service::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['faqs']                   = Faq::where('status', '=', 1)->where('is_home_page', '=', 1)->orderBy('id', 'DESC')->limit(5)->get();

            $mentors                        = [];
            $mentorLists                    = User::select('mentor_profiles.*','users.role','users.valid','users.email','users.phone')->join('mentor_profiles', 'mentor_profiles.user_id', '=', 'users.id')->where('users.valid', '=', 1)->where('users.role', '=', 2)->inRandomOrder()->limit(6)->get();
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
                        $serviceNames       = [];
                        $serviceClassNames  = [];
                        if(!empty($service_ids)){
                            for($s=0;$s<count($service_ids);$s++){
                                $service = Service::select('name', 'class_name')->where('id', '=', $service_ids[$s])->where('status', '=', 1)->first();
                                if($service){
                                    $serviceNames[]         = (($service)?$service->name:'');
                                    $serviceClassNames[]    = (($service)?$service->class_name:'');
                                }
                            }
                        }
                    /* service details */
                    /* availability */
                        $todayNo        = date('w');
                        $checkMentorAvl = MentorAvailability::where('mentor_user_id', '=', $mentorList->user_id)->where('day_of_week_id', '=', $todayNo)->count();
                    /* availability */
                    /* rating */
                        $getLastReview = BookingRating::where('mentor_id', '=', $mentorList->user_id)->where('status', '=', 1)->orderBy('id', 'DESC')->first();
                    /* rating */
                    $mentors[] = [
                        'mentor_id'             => $mentorList->user_id,
                        'name'                  => $mentorList->full_name,
                        'display_name'          => $mentorList->display_name,
                        'email'                 => $mentorList->email,
                        'phone'                 => $mentorList->phone,
                        'qualification'         => $mentorList->qualification,
                        'experience'            => $mentorList->experience,
                        'service_name'          => implode(",", $serviceNames),
                        'service_class_name'    => implode(" ", $serviceClassNames),
                        'service_count'         => count($service_ids),
                        'avl_today'             => (($checkMentorAvl > 0)?1:0),
                        'avg_rating'            => $this->getAvgRating($mentorList->user_id),
                        'last_review'           => (($getLastReview)?$getLastReview->review:''),
                        'profile_image'         => (($mentorList->profile_pic != '')?env('UPLOADS_URL').'user/'.$mentorList->profile_pic:env('NO_IMAGE_AVATAR')),
                    ];
                }
            }
            // Helper::pr($mentors);
            $data['mentors']                = $mentors;

            $title                          = 'Home';
            $page_name                      = 'home';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* home */
    /* about us */
        public function aboutUs(){
            $data['page']                   = Page::where('page_slug', '=', 'about-us')->first();
            $data['owner']                  = Team::where('status', '=', 1)->where('is_owner', '=', 1)->first();
            $data['teamMembers']            = Team::where('status', '=', 1)->where('is_owner', '=', 0)->get();
            $title                          = 'About Us';
            $page_name                      = 'about-us';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* about us */
    /* team member profile */
        public function teamMemberProfile($id){
            $id                             = Helper::decoded($id);
            $data['teamMember']             = Team::where('status', '=', 1)->where('id', '=', $id)->first();
            $title                          = (($data['teamMember'])?$data['teamMember']->name:'Team Member Profile');
            $page_name                      = 'team-member-profile';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* team member profile */
    /* contact us */
        public function contactUs(Request $request){
            $data                           = [];
            $title                          = 'Contact Us';
            $page_name                      = 'contact-us';
            if($request->isMethod('post')){
                $postData = $request->all();
                // Helper::pr($postData);
                $rules = [
                    'name'               => 'required',
                    'email'              => 'required',
                    'phone'              => 'required',
                    'subject'            => 'required',
                    'description'        => 'required',
                    'recaptcha_response' => ['required', new ReCaptcha]
                ];
                if($this->validate($request, $rules)){
                    $name               = $postData['name'];
                    $email              = $postData['email'];
                    $phone              = $postData['phone'];
                    $subject            = $postData['subject'];
                    $msg                = $postData['description'];

                    $fields = [
                        'name'              => $name,
                        'email'             => $email,
                        'phone'             => $phone,
                        'subject'           => $subject,
                        'description'       => $msg,
                    ];
                    // Helper::pr($fields);
                    Enquiry::insert($fields);

                    /* email sent */
                        $generalSetting             = GeneralSetting::find('1');
                        $subject                    = $generalSetting->site_name.' :: Contact Enquiry From '.$name.' ('.$email.')';
                        $message                    = view('front.email-templates.contact-us',$fields);
                        // echo $message;die;
                        // $this->sendMail($generalSetting->system_email, $subject, $message);
                    /* email sent */
                    /* email log save */
                        $postData2 = [
                            'name'                  => $name,
                            'email'                 => $email,
                            'subject'               => $subject,
                            'message'               => $message
                        ];
                        EmailLog::insertGetId($postData2);
                    /* email log save */
                    
                    
                    return redirect()->back()->with('success_message', 'You Enquiry Submitted Successfully. We Will Contact You Soon !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* contact us */
    /* How It Works */
        public function howItWorks(){
            $data['faqs']                   = Faq::where('status', '=' , 1)->orderBy('id', 'DESC')->get();
            $data['howitworks']             = HowItWork::where('status', '=' , 1)->orderBy('rank', 'ASC')->get();
            $title                          = 'How It Works';
            $page_name                      = 'how-it-works';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* How It Works */
    /* Blogs */
        public function blogs(){
            $data['firstBlog']                  = Blog::select('blogs.*','blog_categories.name')->join('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category')->where('blogs.status', '=', 1)->orderBy('blogs.id', 'DESC')->first();
            $data['blogs']                      = Blog::select('blogs.*','blog_categories.name')->join('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category')->where('blogs.status', '=', 1)->orderBy('blogs.id', 'DESC')->get();
            $data['blog_count']                 = count($data['blogs']);
            // Helper::pr($data['blogs']);
            $title                              = 'Blogs';
            $page_name                          = 'blogs';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* Blogs */
    /* Blog Details */
        public function blogDetails($slug){
            $data['firstBlog']                  = Blog::select('blogs.*','blog_categories.name')->join('blog_categories', 'blog_categories.id', '=', 'blogs.blog_category')->where('blogs.status', '=', 1)->where('blogs.slug', '=', $slug)->first();
            $blog_id                            = (($data['firstBlog'])?$data['firstBlog']->id:'');
            $blog_category                      = (($data['firstBlog'])?$data['firstBlog']->blog_category:'');
            $data['blogContents']               = BlogContent::where('blog_id', '=', $blog_id)->get();
            $data['recentBlogs']                = Blog::where('status', '=', 1)->orderBy('id', 'DESC')->limit(6)->get();
            $data['relatedArticles']            = Blog::where('status', '=', 1)->where('blog_category', '=', $blog_category)->orderBy('id', 'DESC')->get();
            $title                              = (($data['firstBlog'])?$data['firstBlog']->title:'');;
            $page_name                          = 'blog-details';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* Blog Details */
    /* page */
        public function page($slug){
            $data['page']                   = Page::where('page_slug', '=', $slug)->first();
            $title                          = (($data['page'])?$data['page']->page_name:"Page");
            $page_name                      = 'page-content';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* page */
    /* Mentors */
        public function mentors(){
            $mentors                        = [];
            $mentorLists                    = User::select('mentor_profiles.*','users.role','users.valid','users.email','users.phone')->join('mentor_profiles', 'mentor_profiles.user_id', '=', 'users.id')->where('users.valid', '=', 1)->where('users.role', '=', 2)->inRandomOrder()->limit(6)->get();
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
            // Helper::pr($mentors);
            $data['mentors']                = $mentors;
            $data['services']               = Service::select('id', 'name')->where('status', '=', 1)->get();
            $title                          = 'Mentors';
            $page_name                      = 'mentors';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* Mentors */
    /* Mentor Details */
        public function mentorDetails($displayName, $user_id){
            $user_id                        = Helper::decoded($user_id);
            $data['profileDetail']          = MentorProfile::where('user_id', '=', $user_id)->first();
            $data['rating_star']            = $this->getAvgRating($user_id);
            $getMentorAvls                  = MentorAvailability::select('day_of_week_id')->where('mentor_user_id', '=', $user_id)->orderBy('day_of_week_id', 'ASC')->get();
            $avl_days                       = [];
            if($getMentorAvls){
                foreach($getMentorAvls as $getMentorAvl){
                    $avl_days[] = Helper::getShortDayName($getMentorAvl->day_of_week_id);
                }
            }
            $data['avl_days']               = $avl_days;
            $mentor_services                = [];
            $getServiceDetails = ServiceDetail::select('id', 'service_attribute_id', 'title', 'description', 'duration', 'total_amount_payable', 'slashed_amount')->where('mentor_user_id', '=', $user_id)->where('status', '=', 1)->get();
            if($getServiceDetails){
                foreach($getServiceDetails as $getServiceDetail){
                    $service_attribute_id   = $getServiceDetail->service_attribute_id;
                    $getServiceDetails2     = ServiceTypeAttribute::select('service_id')->where('service_attribute_id', '=', $service_attribute_id)->where('is_active', '=', 1)->first();
                    if($getServiceDetails2){
                        $service = Service::select('name')->where('id', '=', $getServiceDetails2->service_id)->where('status', '=', 1)->first();
                        if($service){
                            $mentor_services[] = [
                                'mentor_service_id'         => $getServiceDetail->id,
                                'service_id'                => $getServiceDetails2->service_id,
                                'service_attribute_id'      => $service_attribute_id,
                                'service_category'          => $service->name,
                                'service_title'             => $getServiceDetail->title,
                                'service_description'       => $getServiceDetail->description,
                                'service_duration'          => $getServiceDetail->duration,
                                'service_amount'            => $getServiceDetail->total_amount_payable,
                                'service_slashed_amount'    => $getServiceDetail->slashed_amount,
                            ];
                        }
                    }
                }
            }
            $data['mentor_services']        = $mentor_services;
            
            $title                          = 'Mentor Details';
            $page_name                      = 'mentor-details';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* Mentor Details */
    /* Service Details */
        public function serviceDetails(Request $request, $displayName, $mentor_service_id){
            $mentor_service_id              = Helper::decoded($mentor_service_id);
            $mentorService                  = $this->getServiceDetails($mentor_service_id);
            $bookingTestimonials            = BookingRating::where('mentor_id', '=', $mentorService['mentor_id'])->where('mentor_service_id', '=', $mentor_service_id)->where('status', '=', 1)->get();
            $testimonials                   = [];
            if($bookingTestimonials){ foreach($bookingTestimonials as $bookingTestimonial){
                $studentProfile          = StudentProfile::where('user_id', '=', $bookingTestimonial->student_id)->first();
                $testimonials[] = [
                    'student_id'    => $bookingTestimonial->student_id,
                    'student_name'  => (($studentProfile)?$studentProfile->full_name:''),
                    'student_image' => (($studentProfile)?(($studentProfile->profile_pic != '')?env('UPLOADS_URL').'user/'.$studentProfile->profile_pic:env('NO_IMAGE_AVATAR')):env('NO_IMAGE_AVATAR')),
                    'review'        => $bookingTestimonial->review,
                ];
            } }
            /* available dates for booking */
                $generalSetting         = GeneralSetting::find('1');
                $date_available         = $generalSetting->date_available;
                $datetime               = new DateTime('tomorrow');
                $startDate              = $datetime->format('Y-m-d');
                $endDate                = date('Y-m-d', strtotime('+'.$date_available.' days'));
                $dateList               = Helper::getDatesFromRange($startDate, $endDate);
                $date_range             = [];
                if(!empty($dateList)){
                    for($d=0;$d<count($dateList);$d++){
                        $date_range[]             = [
                            'actual_date'   => $dateList[$d],
                            'display_date'  => date_format(date_create($dateList[$d]), "d M"),
                            'date_day'      => date_format(date_create($dateList[$d]), "D"),
                        ];
                    }
                }
            /* available dates for booking */
            $data['date_range']             = $date_range;
            $data['mentorService']          = $mentorService;
            $data['testimonials']           = $testimonials;
            $data['documents']              = RequireDocument::where('status', '=', 1)->where('user_type', '=', 'student')->orderBy('id', 'ASC')->get();

            if($request->isMethod('post')){
                $postData = $request->all();
                // Helper::pr($postData);
                /* direct */
                    if($postData['mode'] == 'DIRECT'){
                        $getLastBooking     = Booking::select('id', 'sl_no')->orderBy('id', 'DESC')->first();
                        if($getLastBooking){
                            $sl_no = $getLastBooking->sl_no + 1;
                            $booking_no = 'STUMENTO/'.str_pad($sl_no, 6, "0", STR_PAD_LEFT);
                        } else {
                            $sl_no = 1;
                            $booking_no = 'STUMENTO/'.str_pad($sl_no, 6, "0", STR_PAD_LEFT);
                        }
                        /* gst calculation */
                            $actual_amount  = $postData['payable_amt'];
                            $gst_percent    = $generalSetting->igst_percent;
                            $gst_amount     = (($actual_amount * $gst_percent)/100);
                            $payable_amt    = $actual_amount + $gst_amount;
                        /* gst calculation */
                        /* booking submit */
                            $activityData   = [
                                'sl_no'                 => $sl_no,
                                'booking_no'            => $booking_no,
                                'mentor_id'             => $postData['mentor_user_id'],
                                'student_id'            => $request->session()->get('user_id'),
                                'mentor_service_id'     => $postData['mentor_service_id'],
                                'service_type_id'       => $postData['service_type_id'],
                                'service_attribute_id'  => $postData['service_attribute_id'],
                                'service_id'            => $postData['service_id'],
                                'booking_date'          => $postData['booking_date'],
                                'booking_slot_from'     => date_format(date_create($postData['booking_slot_from']), "H:i:s"),
                                'booking_slot_to'       => date_format(date_create($postData['booking_slot_to']), "H:i:s"),
                                'booking_date_time'     => date('Y-m-d H:i:s'),
                                'duration'              => $postData['duration'],
                                'discount'              => 0,
                                'actual_amount'         => $actual_amount,
                                'gst_percent'           => $gst_percent,
                                'gst_amount'            => $gst_amount,
                                'payable_amt'           => $payable_amt,
                            ];
                            // Helper::pr($activityData);
                            $booking_id = Booking::insertGetId($activityData);
                        /* booking submit */
                        /* metting lnk generation */

                        /* metting lnk generation */
                        return redirect('booking-success/'.Helper::encoded($booking_id));
                    }
                /* direct */
                /* signin */
                    if($postData['mode'] == 'SIGNIN'){
                        $rules = [
                            'email'     => 'required|email|max:255',
                            'password'  => 'required|max:30',
                        ];
                        if($this->validate($request, $rules)){
                            if(Auth::guard('web')->attempt(['email' => $postData['email'], 'password' => $postData['password'], 'valid' => 1, 'role' => 1])){
                                // Helper::pr(Auth::guard('web')->user());
                                $sessionData    = Auth::guard('web')->user();
                                $user_id        = $sessionData['id'];
                                $role           = $sessionData['role'];
                                if($role == 1){
                                    $getUserProfile = StudentProfile::where('user_id', '=', $user_id)->first();
                                } else {
                                    $getUserProfile = MentorProfile::where('user_id', '=', $user_id)->first();
                                }
                                $request->session()->put('user_id', $sessionData['id']);
                                $request->session()->put('name', $sessionData['name']);
                                $request->session()->put('fname', (($getUserProfile)?$getUserProfile->first_name:''));
                                $request->session()->put('lname', (($getUserProfile)?$getUserProfile->last_name:''));
                                $request->session()->put('email', $sessionData['email']);
                                $request->session()->put('role', $sessionData['role']);
                                $request->session()->put('is_user_login', 1);
                                // Helper::pr($request->session()->all());die;

                                /* user activity */
                                    $activityData = [
                                        'user_email'        => $sessionData['email'],
                                        'user_name'         => $sessionData['name'],
                                        'user_type'         => 'USER',
                                        'ip_address'        => $request->ip(),
                                        'activity_type'     => 1,
                                        'activity_details'  => 'Signin Success !!!',
                                        'platform_type'     => 'WEB',
                                    ];
                                    UserActivity::insert($activityData);
                                /* user activity */

                                $getLastBooking     = Booking::select('id', 'sl_no')->orderBy('id', 'DESC')->first();
                                if($getLastBooking){
                                    $sl_no = $getLastBooking->sl_no + 1;
                                    $booking_no = 'STUMENTO/'.str_pad($sl_no, 6, "0", STR_PAD_LEFT);
                                } else {
                                    $sl_no = 1;
                                    $booking_no = 'STUMENTO/'.str_pad($sl_no, 6, "0", STR_PAD_LEFT);
                                }
                                /* gst calculation */
                                    $actual_amount  = $postData['payable_amt'];
                                    $gst_percent    = $generalSetting->igst_percent;
                                    $gst_amount     = (($actual_amount * $gst_percent)/100);
                                    $payable_amt    = $actual_amount + $gst_amount;
                                /* gst calculation */
                                /* booking submit */
                                    $activityData   = [
                                        'sl_no'                 => $sl_no,
                                        'booking_no'            => $booking_no,
                                        'mentor_id'             => $postData['mentor_user_id'],
                                        'student_id'            => $sessionData['id'],
                                        'mentor_service_id'     => $postData['mentor_service_id'],
                                        'service_type_id'       => $postData['service_type_id'],
                                        'service_attribute_id'  => $postData['service_attribute_id'],
                                        'service_id'            => $postData['service_id'],
                                        'booking_date'          => $postData['booking_date'],
                                        'booking_slot_from'     => date_format(date_create($postData['booking_slot_from']), "H:i:s"),
                                        'booking_slot_to'       => date_format(date_create($postData['booking_slot_to']), "H:i:s"),
                                        'booking_date_time'     => date('Y-m-d H:i:s'),
                                        'duration'              => $postData['duration'],
                                        'discount'              => 0,
                                        'actual_amount'         => $actual_amount,
                                        'gst_percent'           => $gst_percent,
                                        'gst_amount'            => $gst_amount,
                                        'payable_amt'           => $payable_amt,
                                    ];
                                    // Helper::pr($activityData);
                                    $booking_id = Booking::insertGetId($activityData);
                                /* booking submit */
                                /* metting lnk generation */

                                /* metting lnk generation */
                                return redirect('booking-success/'.Helper::encoded($booking_id));
                            } else {
                                /* email sent */
                                    $generalSetting             = GeneralSetting::find('1');
                                    $subject                    = $generalSetting->site_name.' :: Failed Signin';
                                    $message                    = view('front.email-templates.failed-login',$postData);
                                    // echo $message;die;
                                    // $this->sendMail($postData['email'], $subject, $message);
                                /* email sent */
                                /* email log save */
                                    $postData2 = [
                                        'name'                  => '',
                                        'email'                 => $postData['email'],
                                        'subject'               => $subject,
                                        'message'               => $message
                                    ];
                                    EmailLog::insertGetId($postData2);
                                /* email log save */
                                /* user activity */
                                    $activityData = [
                                        'user_email'        => $postData['email'],
                                        'user_name'         => '',
                                        'user_type'         => 'USER',
                                        'ip_address'        => $request->ip(),
                                        'activity_type'     => 0,
                                        'activity_details'  => 'Invalid Email Or Password !!!',
                                        'platform_type'     => 'WEB',
                                    ];
                                    UserActivity::insert($activityData);
                                /* user activity */
                                return redirect()->back()->with('error_message', 'Invalid Email Or Password !!!');
                            }
                        } else {
                            return redirect()->back()->with('error_message', 'All Fields Required !!!');
                        }
                    }
                /* signin */
                /* signup */
                    if($postData['mode'] == 'SIGNUP'){
                        $requestData        = $postData;
                        $fname              = $requestData['fname'];
                        $lname              = $requestData['lname'];
                        $phone              = $requestData['phone'];
                        $doc_type           = $requestData['doc_type'];
                        $getRequiredDoc = RequireDocument::where('id', '=', $doc_type)->first();
                        $checkEmail = User::where('email', '=', $requestData['email'])->first();
                        if(empty($checkEmail)){
                            $checkPhone = User::where('phone', '=', $phone)->count();
                            if($checkPhone <= 0){
                                if($requestData['password'] == $requestData['confirm_password']){
                                    $remember_token = rand(1000,9999);
                                    $postData = [
                                        'name'                  => $fname.' '.$lname,
                                        'email'                 => $requestData['email'],
                                        'email_verified_at'     => date('Y-m-d H:i:s'),
                                        'phone'                 => $phone,
                                        'password'              => Hash::make($requestData['password']),
                                        'remember_token'        => $remember_token,
                                        'role'                  => 1,
                                        'valid'                 => 1,
                                    ];
                                    $id = User::insertGetId($postData);
                                    if($doc_type != ''){
                                        /* student documents */
                                            $user_doc       = '';
                                            $imageFile      = $request->file('user_doc');
                                            if($imageFile != ''){
                                                $imageName      = $imageFile->getClientOriginalName();
                                                $uploadedFile   = $this->upload_single_file('user_doc', $imageName, 'user', 'image');
                                                if($uploadedFile['status']){
                                                    $user_doc = $uploadedFile['newFilename'];

                                                    $postData3 = [
                                                        'type'                  => 'STUDENT',
                                                        'user_id'               => $id,
                                                        'doucument_id'          => $doc_type,
                                                        'document_slug'         => Helper::clean((($getRequiredDoc)?$getRequiredDoc->document:'')),
                                                        'document'              => $user_doc
                                                    ];
                                                    UserDocument::insert($postData3);
                                                } else {
                                                    $user_doc = '';
                                                }
                                            } else {
                                                $user_doc = '';
                                            }
                                        /* student documents */
                                    }
                                    /* student profile table */
                                        $postData2 = [
                                            'user_id'               => $id,
                                            'first_name'            => $fname,
                                            'last_name'             => $lname,
                                            'full_name'             => $fname.' '.$lname,
                                            'profile_pic'           => ''
                                        ];
                                        StudentProfile::insert($postData2);
                                    /* student profile table */
                                    /* email sent */
                                        $generalSetting             = GeneralSetting::find('1');
                                        $subject                    = $generalSetting->site_name.' :: Signup Complete';
                                        $message                    = view('front.email-templates.student-signup',$requestData);
                                        // $this->sendMail($requestData['email'], $subject, $message);
                                    /* email sent */
                                    /* email log save */
                                        $postData2 = [
                                            'name'                  => $fname.' '.$lname,
                                            'email'                 => $requestData['email'],
                                            'subject'               => $subject,
                                            'message'               => $message
                                        ];
                                        EmailLog::insertGetId($postData2);
                                    /* email log save */
                                    /* set session */
                                        if(Auth::guard('web')->attempt(['email' => $requestData['email'], 'password' => $requestData['password'], 'valid' => 1, 'role' => 1])){
                                            // Helper::pr(Auth::guard('web')->user());die;
                                            $sessionData    = Auth::guard('web')->user();
                                            $user_id        = $sessionData['id'];
                                            $role           = $sessionData['role'];
                                            if($role == 1){
                                                $getUserProfile = StudentProfile::where('user_id', '=', $user_id)->first();
                                            } else {
                                                $getUserProfile = MentorProfile::where('user_id', '=', $user_id)->first();
                                            }
                                            $request->session()->put('user_id', $sessionData['id']);
                                            $request->session()->put('name', $sessionData['name']);
                                            $request->session()->put('fname', (($getUserProfile)?$getUserProfile->first_name:''));
                                            $request->session()->put('lname', (($getUserProfile)?$getUserProfile->last_name:''));
                                            $request->session()->put('email', $sessionData['email']);
                                            $request->session()->put('role', $sessionData['role']);
                                            $request->session()->put('is_user_login', 1);
                                            // Helper::pr($request->session()->all());die;

                                            /* user activity */
                                                $activityData = [
                                                    'user_email'        => $sessionData['email'],
                                                    'user_name'         => $sessionData['name'],
                                                    'user_type'         => 'USER',
                                                    'ip_address'        => $request->ip(),
                                                    'activity_type'     => 1,
                                                    'activity_details'  => 'Signin Success !!!',
                                                    'platform_type'     => 'WEB',
                                                ];
                                                UserActivity::insert($activityData);
                                            /* user activity */

                                            $getLastBooking     = Booking::select('id', 'sl_no')->orderBy('id', 'DESC')->first();
                                            if($getLastBooking){
                                                $sl_no = $getLastBooking->sl_no + 1;
                                                $booking_no = 'STUMENTO/'.str_pad($sl_no, 6, "0", STR_PAD_LEFT);
                                            } else {
                                                $sl_no = 1;
                                                $booking_no = 'STUMENTO/'.str_pad($sl_no, 6, "0", STR_PAD_LEFT);
                                            }
                                            /* gst calculation */
                                                $actual_amount  = $postData['payable_amt'];
                                                $gst_percent    = $generalSetting->igst_percent;
                                                $gst_amount     = (($actual_amount * $gst_percent)/100);
                                                $payable_amt    = $actual_amount + $gst_amount;
                                            /* gst calculation */
                                            /* booking submit */
                                                $activityData   = [
                                                    'sl_no'                 => $sl_no,
                                                    'booking_no'            => $booking_no,
                                                    'mentor_id'             => $requestData['mentor_user_id'],
                                                    'student_id'            => $sessionData['id'],
                                                    'mentor_service_id'     => $requestData['mentor_service_id'],
                                                    'service_type_id'       => $requestData['service_type_id'],
                                                    'service_attribute_id'  => $requestData['service_attribute_id'],
                                                    'service_id'            => $requestData['service_id'],
                                                    'booking_date'          => $requestData['booking_date'],
                                                    'booking_slot_from'     => date_format(date_create($requestData['booking_slot_from']), "H:i:s"),
                                                    'booking_slot_to'       => date_format(date_create($requestData['booking_slot_to']), "H:i:s"),
                                                    'booking_date_time'     => date('Y-m-d H:i:s'),
                                                    'duration'              => $requestData['duration'],
                                                    'discount'              => 0,
                                                    'actual_amount'         => $actual_amount,
                                                    'gst_percent'           => $gst_percent,
                                                    'gst_amount'            => $gst_amount,
                                                    'payable_amt'           => $payable_amt,
                                                ];
                                                $booking_id = Booking::insertGetId($activityData);
                                                // Helper::pr($activityData);
                                            /* booking submit */
                                            /* metting lnk generation */

                                            /* metting lnk generation */

                                            return redirect('booking-success/'.Helper::encoded($booking_id));
                                        } else {
                                            return redirect()->back()->with('error_message', 'Invalid Email Or Password !!!');
                                        }
                                    /* set session */
                                    return redirect('booking-success/'.Helper::encoded($booking_id));
                                } else {
                                    return redirect()->back()->with('error_message', 'Password & Confirm Password Does Not Matched !!!');
                                }
                            } else {
                                return redirect()->back()->with('error_message', 'Phone Already Registered !!!');
                            }
                        }
                    }
                /* signup */
            }

            $title                          = 'Service Details';
            $page_name                      = 'service-details';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function bookingSuccess($id){
            $booking_id                     = Helper::decoded($id);
            $data['booking']                = Booking::where('id', '=', $booking_id)->first();
            $data['return_url']             = url('payment/callback');
            $data['surl']                   = url('payment/success');
            $data['furl']                   = url('payment/failed');

            $title                          = 'Booking Success';
            $page_name                      = 'booking-success';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function paymentSuccess($id){
            $booking_id                     = Helper::decoded($id);
            $data['booking']                = Booking::where('id', '=', $booking_id)->first();
            $title                          = 'Payment Success';
            $page_name                      = 'payment-success';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function paymentFailed() {
            $data                           = [];
            $title                          = 'Payment Failed | '.$generalSetting->site_name;            
            $page_name                      = 'payment-failed';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* Service Details */
    /* authentication */
        public function studentSignup(Request $request){
            $data['testimonials']           = Testimonial::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['testimonialsData']       = view('front.elements.side-testimonial',$data);
            $data['documents']              = RequireDocument::where('status', '=', 1)->where('user_type', '=', 'student')->orderBy('id', 'ASC')->get();
            $title                          = 'Student Signup';
            $page_name                      = 'student-signup';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function signupOtp($id){
            $id                             = Helper::decoded($id);
            $data['id']                     = $id;
            $title                          = 'Signup OTP';
            $page_name                      = 'signup-otp';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function forgotPassword(Request $request){
            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'email'     => 'required|email|max:255'
                ];
                if($this->validate($request, $rules)){
                    $email = $postData['email'];
                    $checkUser = User::where('email', '=', $email)->where('valid', '=', 1)->first();
                    if($checkUser){
                        $remember_token = rand(100000,999999);
                        $postData = [
                            'remember_token'        => $remember_token,
                        ];
                        // Helper::pr($postData);
                        User::where('id', '=', $checkUser->id)->update($postData);

                        /* email sent */
                            $generalSetting             = GeneralSetting::find('1');
                            $subject                    = $generalSetting->site_name.' :: One Time Password';
                            $message                    = view('front.email-templates.otp',$postData);
                            // echo $message;die;
                            // $this->sendMail($requestData['email'], $subject, $message);
                        /* email sent */
                        /* email log save */
                            $postData2 = [
                                'name'                  => $checkUser->name,
                                'email'                 => $checkUser->email,
                                'subject'               => $subject,
                                'message'               => $message
                            ];
                            EmailLog::insertGetId($postData2);
                        /* email log save */

                        return redirect('validate-otp/'.Helper::encoded($checkUser->id))->with('success_message', 'OTP Is Send To Your Registered Email !!!');
                    } else {
                        return redirect()->back()->with('error_message', 'You Are Not Registered With Us !!!');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $data['testimonials']           = Testimonial::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['testimonialsData']       = view('front.elements.side-testimonial',$data);
            $title                          = 'Forgot Password';
            $page_name                      = 'forgot-password';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function validateOtp(Request $request, $id){
            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'otp1'     => 'required|max:1',
                    'otp2'     => 'required|max:1',
                    'otp3'     => 'required|max:1',
                    'otp4'     => 'required|max:1',
                    'otp5'     => 'required|max:1',
                    'otp6'     => 'required|max:1',
                ];
                if($this->validate($request, $rules)){
                    $id     = $postData['id'];
                    $otp1   = $postData['otp1'];
                    $otp2   = $postData['otp2'];
                    $otp3   = $postData['otp3'];
                    $otp4   = $postData['otp4'];
                    $otp5   = $postData['otp5'];
                    $otp6   = $postData['otp6'];
                    $otp    = ($otp1.$otp2.$otp3.$otp4.$otp5.$otp6);
                    $checkUser = User::where('id', '=', $id)->first();
                    if($checkUser){
                        $remember_token = $checkUser->remember_token;
                        if($remember_token == $otp){
                            $postData = [
                                'remember_token'        => '',
                            ];
                            User::where('id', '=', $checkUser->id)->update($postData);
                            return redirect('reset-password/'.Helper::encoded($checkUser->id))->with('success_message', 'OTP Validated. Now Reset Your Password !!!');
                        } else {
                            return redirect()->back()->with('error_message', 'OTP Mismatched !!!');
                        }
                    } else {
                        return redirect()->back()->with('error_message', 'We Don\'t Recognize You !!!');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $data['testimonials']           = Testimonial::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['testimonialsData']       = view('front.elements.side-testimonial',$data);
            $id                             = Helper::decoded($id);
            $data['id']                     = $id;
            $title                          = 'Validate OTP';
            $page_name                      = 'validate-otp';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function resetPassword(Request $request, $id){
            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'password'              => 'required',
                    'confirm_password'      => 'required'
                ];
                if($this->validate($request, $rules)){
                    $id                 = $postData['id'];
                    $password           = $postData['password'];
                    $confirm_password   = $postData['confirm_password'];
                    $checkUser = User::where('id', '=', $id)->first();
                    if($checkUser){
                        if($password == $confirm_password){
                            $postData = [
                                'password'        => Hash::make($password),
                            ];
                            User::where('id', '=', $checkUser->id)->update($postData);

                            /* email sent */
                                $generalSetting             = GeneralSetting::find('1');
                                $subject                    = $generalSetting->site_name.' :: Reset Password';
                                $message                    = view('front.email-templates.change-password',$checkUser);
                                // echo $message;die;
                                // $this->sendMail($requestData['email'], $subject, $message);
                            /* email sent */
                            /* email log save */
                                $postData2 = [
                                    'name'                  => $checkUser->name,
                                    'email'                 => $checkUser->email,
                                    'subject'               => $subject,
                                    'message'               => $message
                                ];
                                EmailLog::insertGetId($postData2);
                            /* email log save */
                            return redirect('signin/')->with('success_message', 'Password Reset Successfully. Please Sign In !!!');
                        } else {
                            return redirect()->back()->with('error_message', 'Password & Confirm Password Does Not Matched !!!');
                        }
                    } else {
                        return redirect()->back()->with('error_message', 'We Don\'t Recognize You !!!');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $data['testimonials']           = Testimonial::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['testimonialsData']       = view('front.elements.side-testimonial',$data);
            $id                             = Helper::decoded($id);
            $data['id']                     = $id;
            $title                          = 'Reset Password';
            $page_name                      = 'reset-password';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function signin(Request $request){
            if($request->isMethod('post')){
                $postData = $request->all();
                // Helper::pr($postData);
                $rules = [
                    'email'     => 'required|email|max:255',
                    'password'  => 'required|max:30',
                ];
                if($this->validate($request, $rules)){
                    
                    if(Auth::guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'valid' => 1])){
                        // Helper::pr(Auth::guard('web')->user());
                        $sessionData    = Auth::guard('web')->user();
                        $user_id        = $sessionData['id'];
                        $role           = $sessionData['role'];
                        if($role == 1){
                            $getUserProfile = StudentProfile::where('user_id', '=', $user_id)->first();
                        } else {
                            $getUserProfile = MentorProfile::where('user_id', '=', $user_id)->first();
                        }
                        $request->session()->put('user_id', $sessionData['id']);
                        $request->session()->put('name', $sessionData['name']);
                        $request->session()->put('fname', (($getUserProfile)?$getUserProfile->first_name:''));
                        $request->session()->put('lname', (($getUserProfile)?$getUserProfile->last_name:''));
                        $request->session()->put('email', $sessionData['email']);
                        $request->session()->put('role', $sessionData['role']);
                        $request->session()->put('is_user_login', 1);
                        // Helper::pr($request->session()->all());die;

                        /* user activity */
                            $activityData = [
                                'user_email'        => $sessionData['email'],
                                'user_name'         => $sessionData['name'],
                                'user_type'         => 'USER',
                                'ip_address'        => $request->ip(),
                                'activity_type'     => 1,
                                'activity_details'  => 'Signin Success !!!',
                                'platform_type'     => 'WEB',
                            ];
                            UserActivity::insert($activityData);
                        /* user activity */

                        return redirect('user/dashboard');
                    } else {
                        /* email sent */
                            $generalSetting             = GeneralSetting::find('1');
                            $subject                    = $generalSetting->site_name.' :: Failed Signin';
                            $message                    = view('front.email-templates.failed-login',$postData);
                            // echo $message;die;
                            // $this->sendMail($postData['email'], $subject, $message);
                        /* email sent */
                        /* email log save */
                            $postData2 = [
                                'name'                  => '',
                                'email'                 => $postData['email'],
                                'subject'               => $subject,
                                'message'               => $message
                            ];
                            EmailLog::insertGetId($postData2);
                        /* email log save */
                        /* user activity */
                            $activityData = [
                                'user_email'        => $postData['email'],
                                'user_name'         => '',
                                'user_type'         => 'USER',
                                'ip_address'        => $request->ip(),
                                'activity_type'     => 0,
                                'activity_details'  => 'Invalid Email Or Password !!!',
                                'platform_type'     => 'WEB',
                            ];
                            UserActivity::insert($activityData);
                        /* user activity */
                        return redirect()->back()->with('error_message', 'Invalid Email Or Password !!!');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $data['testimonials']           = Testimonial::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['testimonialsData']       = view('front.elements.side-testimonial',$data);
            $title                          = 'Sign In';
            $page_name                      = 'signin';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function signout(Request $request){
            $user_email                             = $request->session()->get('email');
            $user_name                              = $request->session()->get('name');
            /* user activity */
                $activityData = [
                    'user_email'        => $user_email,
                    'user_name'         => $user_name,
                    'user_type'         => 'USER',
                    'ip_address'        => $request->ip(),
                    'activity_type'     => 2,
                    'activity_details'  => 'You Are Successfully Logged Out !!!',
                    'platform_type'     => 'WEB',
                ];
                UserActivity::insert($activityData);
            /* user activity */

            $request->session()->forget(['user_id', 'name', 'fname', 'lname', 'email', 'role']);
            Auth::guard('web')->logout();
            return redirect('signin')->with('success_message', 'You Are Successfully Logged Out !!!');
        }
    /* authentication */
    /* dashboard */
        public function dashboard(){
            $data                           = [];
            $title                          = 'Dashboard';
            $page_name                      = 'dashboard';
            echo $this->front_after_login_layout($title,$page_name,$data);
        }
    /* dashboard */
    /* Update profile */
        public function updateProfile(Request $request){
            $uId                            = session('user_id');
            $data['getUser']                = User::where('id', '=', $uId)->where('status', '=', 1)->first();
            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'name'          => 'required',
                    'phone'         => 'required',
                ];
                if($this->validate($request, $rules)){
                    $name           = $postData['name'];
                    $phone          = $postData['phone'];
                    $checkPhone     = User::where('phone', '=', $phone)->where('id', '!=', $uId)->count();
                    if($checkPhone <= 0){
                        /* profile image */
                            $imageFile      = $request->file('image');
                            if($imageFile != ''){
                                $imageName      = $imageFile->getClientOriginalName();
                                $uploadedFile   = $this->upload_single_file('image', $imageName, 'user', 'image');
                                if($uploadedFile['status']){
                                    $image = $uploadedFile['newFilename'];
                                } else {
                                    return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                                }
                            } else {
                                $image = $data['getUser']->image;
                            }
                        /* profile image */
                        $fields = [
                            'name'            => $name,
                            'phone'           => $phone,
                            'image'           => $image,
                        ];
                        User::where('id', '=', $uId)->update($fields);
                        return redirect()->back()->with('success_message', 'Profile Updated Successfully !!!');
                    } else {
                        return redirect()->back()->with('error_message', 'Phone Number Already Exists !!!');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $title                          = 'Update Profile';
            $page_name                      = 'update-profile';
            echo $this->front_after_login_layout($title,$page_name,$data);
        }
    /* Update profile */
    /* Change Password */
        public function changePassword(Request $request){
            $data       = [];
            $uId        = session('user_id');
            $getUser    = User::where('id', '=', $uId)->where('status', '=', 1)->first();
            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'old_password'          => 'required|min:8|max:15',
                    'new_password'          => 'required|min:8|max:15',
                    'confirm_password'      => 'required|min:8|max:15',
                ];
                if($this->validate($request, $rules)){
                    $old_password       = $postData['old_password'];
                    $new_password       = $postData['new_password'];
                    $confirm_password   = $postData['confirm_password'];
                    if(Hash::check($old_password, $getUser->password)){
                        if(!Hash::check($new_password, $getUser->password)){
                            if($new_password == $confirm_password){
                                $fields = [
                                    'password'            => Hash::make($new_password)
                                ];
                                User::where('id', '=', $uId)->update($fields);
                                return redirect()->back()->with('success_message', 'Password Changed Successfully !!!');
                            } else {
                                return redirect()->back()->with('error_message', 'New & Confirm Password Does Not Matched !!!');
                            }
                        } else {
                            return redirect()->back()->with('error_message', 'Existing & New Password Will Be Different !!!');
                        }
                    } else {
                        return redirect()->back()->with('error_message', 'Current Password Is Incorrect !!!');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $title                          = 'Change Password';
            $page_name                      = 'change-password';
            echo $this->front_after_login_layout($title,$page_name,$data);
        }
    /* Change Password */
    ############################### Razor Pay Code ##########################################
        // initialized cURL Request
        private function get_curl_handle($payment_id, $amount)  {
            $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
            $key_id = env('RAZOR_KEY_ID');
            $key_secret = env('RAZOR_KEY_SECRET');
            $fields_string = "amount=$amount";
            //cURL Request
            $ch = curl_init();
            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
            return $ch;
        }
        // callback method
        public function callback(Request $request) {
            if (!empty($request->razorpay_payment_id) && !empty($request->merchant_order_id)) {
                $razorpay_payment_id    = $request->razorpay_payment_id;
                $merchant_order_id      = $request->merchant_order_id;
                $currency_code          = 'INR';
                $amount                 = $request->merchant_total;
                $success                = false;
                $error                  = '';
                // Helper::pr($request->all());die;
                try {                
                    $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
                    //execute post
                    $result = curl_exec($ch);
                    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    if ($result === false) {
                        $success = false;
                        $error = 'Curl error: '.curl_error($ch);
                    } else {
                        $response_array     = json_decode($result, true);
                        $payment_id         = $response_array['description'];

                        $booking            = Booking::where('id', '=', $payment_id)->first();
                        $generalSetting     = GeneralSetting::find('1');
                        $service            = Service::select('name')->where('id', '=', $booking->service_id)->first();
                        $meeting_topic      = $generalSetting->site_name.' '.(($service)?$service->name:'');
                        /* meeting link generate */
                            $token = $this->generateToken();
                            $start_time = $booking->booking_date.' '.$booking->booking_slot_from;
                            $response = $this->getZoomMeetingLink($meeting_topic, $start_time, $booking->duration, $token);
                            // Helper::pr($response);die;
                        /* meeting link generate */
                        
                        
                        /* booking table update */
                            $fields     = array(
                                            'payment_status'        => 1,
                                            'txn_id'                => $response_array['id'],
                                            'payment_amount'        => ($response_array['amount']/100),
                                            'payment_date_time'     => date('Y-m-d H:i:s'),
                                            'payment_method'        => 'RAZORPAY',
                                            'payment_mode'          => $response_array['method'],
                                            'card_id'               => $response_array['card_id'],
                                            'status'                => 1,
                                            'meeting_link'          => $response['join_url'],
                                            'meeting_passcode'      => $response['password'],
                                        );
                            Booking::where('id', '=', $payment_id)->update($fields);
                        /* booking table update */
                        /* admin payments */
                            $generalSetting             = GeneralSetting::find('1');
                            $booking                    = Booking::where('id', '=', $payment_id)->first();
                            $adminBalance               = $this->getAdminBalance();
                            $transactionAmt             = ($response_array['amount']/100);
                            $closing_amt                = ($adminBalance + $transactionAmt);
                            $actual_amount              = $booking->actual_amount;
                            $stumento_commision_percent = $generalSetting->stumento_commision_percent;
                            $admin_commision            = (($actual_amount * $stumento_commision_percent)/100);
                            $mentor_commision           = ($actual_amount - $admin_commision);
                            $fields2        = array(
                                            'type'                  => 'CREDIT',
                                            'mentor_id'             => $booking->mentor_id,
                                            'booking_id'            => $payment_id,
                                            'opening_amt'           => $adminBalance,
                                            'student_pay_amt'       => $transactionAmt,
                                            'closing_amt'           => $closing_amt,
                                            'gst_percent'           => $booking->gst_percent,
                                            'gst_amount'            => $booking->gst_amount,
                                            'admin_commision'       => $admin_commision,
                                            'mentor_commision'      => $mentor_commision,
                                        );
                            AdminPayment::insert($fields2);
                        /* admin payments */
                        /* mentor payments */
                            $mentorBalance              = $this->getMentorBalance($booking->mentor_id);
                            $mentor_closing_amt         = ($mentorBalance + $mentor_commision);
                            $fields3        = array(
                                            'type'                  => 'CREDIT',
                                            'mentor_id'             => $booking->mentor_id,
                                            'booking_id'            => $payment_id,
                                            'opening_amt'           => $mentorBalance,
                                            'transaction_amt'       => $mentor_commision,
                                            'closing_amt'           => $mentor_closing_amt
                                        );
                            MentorPayment::insert($fields3);
                        /* mentor payments */

                        /* email sent */
                            $mentor             = User::select('name', 'email')->where('id', '=', $booking->mentor_id)->first(); 
                            $student            = User::select('name', 'email')->where('id', '=', $booking->student_id)->first(); 
                            $postData                   = [
                                'mentor'            => (($mentor)?$mentor->name:''),
                                'student'           => (($student)?$student->name:''),
                                'booking_no'        => $booking->booking_no,
                                'booking_date'      => date_format(date_create($booking->booking_date), "M d, Y"),
                                'booking_time'      => date_format(date_create($booking->booking_slot_from), "h:i A"),
                                'payment_date_time' => date_format(date_create($booking->payment_date_time), "M d, Y h:i A"),
                                'payment_amount'    => $booking->payment_amount,
                                'payment_status'    => (($booking->payment_status)?'Success':'Failed'),
                                'meeting_link'      => $response['join_url'],
                                'meeting_passcode'  => $response['password'],
                                'meeting_duration'  => $response['duration'],
                            ];
                            $subject                    = $generalSetting->site_name.' :: Meeting';
                            $message                    = view('front.email-templates.meeting',$postData);
                            // echo $message;die;
                            $this->sendMail((($mentor)?$mentor->email:''), $subject, $message);
                            $this->sendMail((($student)?$student->email:''), $subject, $message);
                        /* email sent */
                        /* email log save */
                            $postData2 = [
                                'name'                  => (($mentor)?$mentor->name:''),
                                'email'                 => (($mentor)?$mentor->email:''),
                                'subject'               => $subject,
                                'message'               => $message
                            ];
                            EmailLog::insertGetId($postData2);
                        /* email log save */

                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                        } else {
                            $success = false;
                            echo "<pre>";print_r($response_array);exit;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                    }
                    //close connection
                    curl_close($ch);
                } catch (Exception $e) {
                    $success = false;
                    $error = 'OPENCART_ERROR:Request to Razorpay Failed';
                }
                if ($success === true) {
                    if (!$payment_id) {
                        return redirect('/payment/success/'.Helper::encoded($payment_id))->with('success_message', 'Payment Completed Successfully !!!');
                    } else {
                        return redirect('/payment/success/'.Helper::encoded($payment_id))->with('success_message', 'Payment Completed Successfully !!!');
                    }
                } else {
                    return redirect('/payment/success/'.Helper::encoded($payment_id))->with('success_message', 'Payment Completed Successfully !!!');
                }
            } else {
                echo 'An error occured. Contact site administrator, please!';
            }
        }
    ############################### Razor Pay Code ##########################################
        public function generateToken(){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://zoom.us/oauth/token?grant_type=account_credentials&account_id=Y1Ox9BecRJyCpTM55y-HXg',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Basic SDlnYTBFcVJUeDJhMU83WF9GYU9pZzpUMjhaN0tnOGRZb1NNQmMzN3VvdHFBdzV3bWVxNWU0TA==',
                'Cookie: __cf_bm=EtmOL0DFzDLmCxNhI1kIi8Q25RDmEFKf7xbwsqhKfJk-1698748615-0-AcfC8FGfmofOg/k185JQ0aaoNv02Usbzu3xRnP+/DqsNxdN7uULEK56klkl75mO+8MJQbsUTJw68hgMiMnUvE+k=; _zm_chtaid=875; _zm_cms_guid=0ENXPwrnAC1fFxXOUsIkNUJXA0QVAS2w_1kvuvYVnSmBE6RYaLuBjYLJf2K5FNC0CVk0wxkJsMnMy4Q32645K8x8UvibiCM.9m3qAMF2sHXjROt3; _zm_ctaid=L_79c-soThqbFDBUvHpO8Q.1698748615732.9c9cf47f9faf0e491d8db5e87a078bbb; _zm_mtk_guid=de4bd927a83a417d9263c7964763717e; _zm_page_auth=us05_c_BSt5ByaxQKuVDpgdJPEXYw; _zm_ssid=us05_c_yiniqDVjQnax75L272vovw; cred=D829E1F05F3A1EAA116E6B553580B6B9'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);
            $access_token = $response->access_token;
            return $access_token;
        }
        public function getZoomMeetingLink($topic, $start_time, $duration, $token) {
            $passcode = rand(100000,999999);

            $dateTime = $start_time; 
            $timezone_from = 'Asia/Kolkata'; 
            $newDateTime = new DateTime($dateTime, new DateTimeZone($timezone_from)); 
            $newDateTime->setTimezone(new DateTimeZone("UTC")); 
            $dateTimeUTC = $newDateTime->format("Y-m-dTh:i:sZ");
            // echo $dateTimeUTC;die;

            //2024-03-25T07:32:55Z

            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.zoom.us/v2/users/me/meetings',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
              "topic": "'.$topic.'",
              "type": 2,
              "start_time": "'.$dateTimeUTC.'",
              "duration": '.$duration.',
              "timezone": "Asia/Kolkata",
              "password": "'.$passcode.'",
              "agenda": "'.$topic.'",
              "settings": {
                "host_video": true,
                "participant_video": true,
                "join_before_host": true,
                "mute_upon_entry": true,
                "breakout_room": {
                  "enable": true
                }
              }
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$token,
                'Cookie: __cf_bm=JzUxVQnZYpU3LuppxQXkSOs7I5PVYpa6.Xm1ch4H7Iw-1698744249-0-AVCBsCsgc0866iTn1Eqmqys8DkWZOIi6cMhTP0niJVPvRD/cwj2wBjqzSQZu51kEeTksl8z/vbgIdWhIud9T8Ho=; _zm_cms_guid=0ENXPwrnAC1fFxXOUsIkNUJXA0QVAS2w_1kvuvYVnSmBE6RYaLuBjYLJf2K5FNC0CVk0wxkJsMnMy4Q32645K8x8UvibiCM.9m3qAMF2sHXjROt3; _zm_mtk_guid=de4bd927a83a417d9263c7964763717e; _zm_page_auth=us05_c_BSt5ByaxQKuVDpgdJPEXYw; _zm_ssid=us05_c_yiniqDVjQnax75L272vovw; cred=B0F5EACCD11B42EF8EE0056AE067A5B2'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);
            $meeting_response = [
                'start_time'    => $response->start_time,
                'duration'      => $response->duration,
                'timezone'      => $response->timezone,
                'agenda'        => $response->agenda,
                'join_url'      => $response->join_url,
                'password'      => $response->password,
            ];
            return $meeting_response;
        }
}
