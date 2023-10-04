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

use App\Rules\ReCaptcha;
use Auth;
use Session;
use Helper;
use Hash;

class FrontController extends Controller
{
    /* home */
        public function home(){
            $data['banners']                = Banner::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['testimonials']           = Testimonial::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['serviceTypes']           = ServiceType::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['services']               = Service::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['faqs']                   = Faq::where('status', '=', 1)->where('is_home_page', '=', 1)->orderBy('id', 'DESC')->limit(5)->get();
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
            $data                           = [];
            $title                          = 'Mentor Details';
            $page_name                      = 'mentor-details';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* Mentor Details */
    /* Service Details */
        public function serviceDetails($displayName, $user_id){
            $user_id                        = Helper::decoded($user_id);
            $data                           = [];
            $title                          = 'Service Details';
            $page_name                      = 'service-details';
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
                    if(Auth::guard('web')->attempt(['email' => $postData['email'], 'password' => $postData['password'], 'valid' => 1])){
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
}
