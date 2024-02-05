<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\SocialPlatform;
use App\Models\Language;
use App\Models\Subject;
use App\Models\StudentProfile;
use App\Models\MentorProfile;
use App\Models\User;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyFactor;
use App\Models\SurveyGrades;
use App\Models\SurveyQuestionOptions;
use App\Models\SurveyResult;
use App\Models\SurveyRecords;
use App\Models\SurveyCombinations;
use App\Models\Booking;
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
use App\Models\RequireDocument;
use App\Models\UserDocument;
use App\Models\BookingRating;
use App\Models\PlatformRating;
use Illuminate\Support\Facades\Validator;
use Hash;
use Auth;
use Session;

class DashboardController extends Controller
{
    /* common */
    /* home */
    public function home(Request $request)
    {
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $rules = [
                'email'     => 'required|email|max:255',
                'password'  => 'required|max:30',
            ];
            if ($this->validate($request, $rules)) {
                if (Auth::guard('web')->attempt(['email' => $postData['email'], 'password' => $postData['password']])) {
                    $sessionData = Auth::guard('web')->user();
                    //  Helper::pr(Auth::guard('web')->user());
                    $request->session()->put('user_id', $sessionData->id);
                    $request->session()->put('name', $sessionData->name);
                    $request->session()->put('email', $sessionData->email);
                    $request->session()->put('role', $sessionData->role);
                    return redirect('dashboard/index');
                } else {
                    return redirect()->back()->with('error_message', 'Invalid Email Or Password !!!');
                }
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        $data[]         = [];
        $title          = 'Log in';
        $page_name      = 'signin';
        echo $this->before_login_front_dashboard_layout($title, $page_name, $data);
    }
    /* home */
    /* index */
    public function index()
    {
        $role                                   = Session::get('role');
        $userId                                 = Session::get('user_id');
        $user                                   = User::select('valid')->find($userId);

        if ($role == 1) {
            $data['all_bookings']                   = Booking::where('student_id', '=', $userId)->where('status', '>=', 1)->get();
            $data['upcoming_bookings']              = Booking::where('student_id', '=', $userId)->where('status', '=', 1)->get();
            $data['past_bookings']                  = Booking::where('student_id', '=', $userId)->where('status', '=', 2)->get();
            $data['transaction']                    = Booking::where('student_id', '=', $userId)->where('status', '=', 1)->sum('payment_amount');
        } else {
            $data           = [];
        }
        $data['isValid']                        = $user->valid != 1 ? false : true;
        $title          = 'Dashboard';
        $page_name      = 'index';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* index */
    /* profile*/
    public function profile(Request $request)
    {
        $userId         = $request->session()->get('user_id');
        $role           = $request->session()->get('role');
        if ($role == 2) {
            $getStudentId   = MentorProfile::where('user_id', '=', $userId)->first();
        } else {
            $getStudentId   = StudentProfile::where('user_id', '=', $userId)->first();
        }
        if ($request->isMethod('post')) {
            $postData                   = $request->all();

            if ($request->post('mode') == 'updateBankDetails') {

                $validator = Validator::make($request->all(), [
                    'student_id'  => 'required|max:255|min:1',
                    'account_type' => 'required|string|max:255',
                    'bank_name' => 'required|string|max:255|min:3|regex:/^[A-Za-z0-9 ]+$/',
                    'branch_name' => 'required|string|max:255|min:3|regex:/^[A-Za-z0-9 ]+$/',
                    'acct_num' => 'required|numeric|min:1',
                    'ifsc_code' => 'required|string|max:255|min:4',
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {

                    $ID                     = $postData['student_id'];
                    $account_type           = $postData['account_type'];
                    $bank_name              = $postData['bank_name'];
                    $branch_name            = $postData['branch_name'];
                    $account_number         = $postData['acct_num'];
                    $ifsc_code              = $postData['ifsc_code'];
                    $fields = [
                        'account_type'          => $account_type,
                        'bank_name'             => $bank_name,
                        'branch_name'           => $branch_name,
                        'account_number'        => $account_number,
                        'ifsc_code'             => $ifsc_code,
                    ];
                    // Helper::pr($fields);
                    MentorProfile::where('id', '=', $ID)->update($fields);
                    return redirect()->back()->with('success_message', 'Bank Details Updated Successfully !!!');
                }
            }
            if ($request->post('mode0') == 'updateEmail') {
                $validator = Validator::make($request->all(), [
                    'student_id'  => 'required|min:1',
                    'email' => 'required|email'
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {
                    $postData = $request->all();
                    $ID       = $postData['student_id'];
                    $email    = $postData['email'];
                    $fields = [
                        'email'          => $email,
                    ];

                    if ($role == 2) {
                        $getID = MentorProfile::where('id', '=', $ID)->first();
                        User::where('id', '=', $getID->user_id)->update($fields);
                    } else {
                        $getID = StudentProfile::where('id', '=', $ID)->first();
                        User::where('id', '=', $getID->user_id)->update($fields);
                    }
                    return redirect()->back()->with('success_message', 'Your Email Updated Successfully !!!');
                }
            }
            if ($request->post('mode1') == 'updateMobile') {

                $validator = Validator::make($request->all(), [
                    'student_id'  => 'required|min:1',
                    'mobile'      => 'required|digits:10'
                ]);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {
                    $postData = $request->all();
                    $ID       = $postData['student_id'];
                    $phone           = $postData['mobile'];
                    $fields = [
                        'phone'          => $phone,
                    ];
                    if ($role == 2) {
                        $getID = MentorProfile::where('id', '=', $ID)->first();
                        User::where('id', '=', $getID->user_id)->update($fields);
                    } else {
                        $getID = StudentProfile::where('id', '=', $ID)->first();
                        User::where('id', '=', $getID->user_id)->update($fields);
                    }
                    return redirect()->back()->with('success_message', 'Your Mobile Number Updated Successfully !!!');
                }
            }
            if ($request->post('mode2') == 'updatePassword') {
                $ID       = $postData['student_id'];
                $postData = $request->all();
                $rules = [
                    'password'   => 'required'
                ];
                if ($this->validate($request, $rules)) {
                    $password        = $postData['password'];
                    $fields = [
                        'password'  =>  Hash::make($password),
                    ];
                    if ($role == 2) {
                        $getID = MentorProfile::where('id', '=', $ID)->first();
                        User::where('id', '=', $getID->user_id)->update($fields);
                    } else {
                        $getID = StudentProfile::where('id', '=', $ID)->first();
                        User::where('id', '=', $getID->user_id)->update($fields);
                    }
                    return redirect()->back()->with('success_message', 'Your Password Updated Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            if ($request->post('mode10') == 'updateData') {
                $postData = $request->all();
                if ($role == 2) {
                    $getDetail  = MentorProfile::where('id', '=', $getStudentId->id)->first();
                } else {
                    $getDetail  = StudentProfile::where('id', '=', $getStudentId->id)->first();
                }


                $rules = [];
                if ($role == 2) {
                    $rules =  [
                        'fname'             => 'required|string|max:255|min:3|regex:/^[A-Za-z0-9 ]+$/',
                        'lname'             => 'required|string|regex:/^[A-Za-z0-9 ]+$/',
                        'description'       => 'required|string|max:255|min:3|regex:/^[A-Za-z0-9 ]+$/',
                        'languages'         => 'required',
                        'subjects'          => 'required',
                    ];
                } else {
                    $rules =  [
                        'fname'             => 'required|string|max:255|min:3|regex:/^[A-Za-z0-9 ]+$/',
                        'lname'             => 'required|string|regex:/^[A-Za-z0-9 ]+$/',
                        'description'       => 'required|string|max:255|min:3|regex:/^[A-Za-z0-9 ]+$/',
                    ];
                }


                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                } else {

                    /* image */
                    $imageFile          = $request->file('image');
                    if ($imageFile != '') {
                        $imageName      = $imageFile->getClientOriginalName();
                        $uploadedFile   = $this->upload_single_file('image', $imageName, 'user', 'image');
                        if ($uploadedFile['status']) {
                            $image = $uploadedFile['newFilename'];
                        } else {
                            return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                        }
                    } else {
                        $image = $getDetail->profile_pic;
                    }
                    /* image */
                    // if ($this->validate($request, $rules)) {
                    $social_platform_array      = array_filter($postData['social_platform']);
                    $social_link_array          = array_filter($postData['social_url']);
                    if ($role == 2) {
                        $edu_institute              = array_filter($postData['edu_institute']);
                        $edu_title                  = array_filter($postData['edu_title']);
                        $edu_year                   = array_filter($postData['edu_year']);

                        $work_institute             = array_filter($postData['work_institute']);
                        $work_title                 = array_filter($postData['work_title']);
                        $work_year                  = array_filter($postData['work_year']);

<<<<<<< HEAD
                            $award_title                = array_filter($postData['award_title']);
                            $award_year                 = array_filter($postData['award_year']);
                            $fields = [
                                'first_name'        => $postData['fname'],
                                'last_name'         => $postData['lname'],
                                'full_name'         => $postData['fname'] . ' ' . $postData['lname'],
                                'display_name'      => $postData['display_name'],
                                'description'       => $postData['description'],
                                'social_platform'   => json_encode($social_platform_array),
                                'social_url'        => json_encode($social_link_array),
                                'profile_pic'       => $image,
                                'city'              => $postData['city'],
                                'team_meeting_link' => $postData['team_meeting_link'],
                                'languages'         => ((!empty($postData['languages']))?json_encode($postData['languages']):[]),
                                'subjects'          => ((!empty($postData['subjects']))?json_encode($postData['subjects']):[]),
                                'edu_institute'     => json_encode($edu_institute),
                                'edu_title'         => json_encode($edu_title),
                                'edu_year'          => json_encode($edu_year),
                                'work_institute'    => json_encode($work_institute),
                                'work_title'        => json_encode($work_title),
                                'work_year'         => json_encode($work_year),
                                'award_title'       => json_encode($award_title),
                                'award_year'        => json_encode($award_year),
                                'updated_at'        => date('Y-m-d H:i:s'),
                            ];
                            // Helper::pr($fields);
                            MentorProfile::where('id', '=', $postData['user_id'])->update($fields);
                        } else {
                            $fields = [
                                'first_name'        => $postData['fname'],
                                'last_name'         => $postData['lname'],
                                'full_name'         => $postData['fname'] . ' ' . $postData['lname'],
                                'display_name'      => $postData['display_name'],
                                'about_yourself'    => $postData['description'],
                                'social_platform'   => json_encode($social_platform_array),
                                'social_url'        => json_encode($social_link_array),
                                'profile_pic'       => $image,
                                'city'              => $postData['city'],
                                'updated_at'        => date('Y-m-d H:i:s'),
                            ];
                            // Helper::pr($fields);
                            StudentProfile::where('id', '=', $postData['user_id'])->update($fields);

                            $doc_type   = $postData['doc_type'];
                            if ($doc_type != '') {
                                /* student documents */
                                $user_doc       = '';
                                $imageFile      = $request->file('user_doc');
                                if ($imageFile != '') {
                                    $imageName      = $imageFile->getClientOriginalName();
                                    $uploadedFile   = $this->upload_single_file('user_doc', $imageName, 'user', 'image');
                                    if ($uploadedFile['status']) {
                                        $user_doc       = $uploadedFile['newFilename'];
                                        $getRequiredDoc = RequireDocument::where('id', '=', $doc_type)->first();
                                        $postData3 = [
                                            'type'                  => 'STUDENT',
                                            'user_id'               => $userId,
                                            'doucument_id'          => $doc_type,
                                            'document_slug'         => Helper::clean((($getRequiredDoc) ? $getRequiredDoc->document : '')),
                                            'document'              => $user_doc
                                        ];
                                        // Helper::pr($postData3);
                                        $checkStudentDocument = UserDocument::where('user_id', '=', $userId)->where('type', '=', 'STUDENT')->first();
                                        if ($checkStudentDocument) {
                                            UserDocument::where('user_id', '=', $userId)->update($postData3);
                                        } else {
                                            UserDocument::insert($postData3);
                                        }
                                    }
                                } else {
                                    $user_doc = '';
                                }
                                /* student documents */
                            }
                        }
                        User::where('id', '=', $postData['user_id'])->update(['name' => $postData['fname'] . ' ' . $postData['lname']]);
                        return redirect()->back()->with('success_message', 'Profile Updated Successfully !!!');
=======
                        $award_title                = array_filter($postData['award_title']);
                        $award_year                 = array_filter($postData['award_year']);
                        $fields = [
                            'first_name'        => $postData['fname'],
                            'last_name'         => $postData['lname'],
                            'full_name'         => $postData['fname'] . ' ' . $postData['lname'],
                            'display_name'      => $postData['display_name'],
                            'description'       => $postData['description'],
                            'social_platform'   => json_encode($social_platform_array),
                            'social_url'        => json_encode($social_link_array),
                            'profile_pic'       => $image,
                            'city'              => $postData['city'],
                            'languages'         => json_encode($postData['languages']),
                            'subjects'          => json_encode($postData['subjects']),
                            'edu_institute'     => json_encode($edu_institute),
                            'edu_title'         => json_encode($edu_title),
                            'edu_year'          => json_encode($edu_year),
                            'work_institute'    => json_encode($work_institute),
                            'work_title'        => json_encode($work_title),
                            'work_year'         => json_encode($work_year),
                            'award_title'       => json_encode($award_title),
                            'award_year'        => json_encode($award_year),
                            'updated_at'        => date('Y-m-d H:i:s'),
                        ];
                        // Helper::pr($fields);
                        MentorProfile::where('id', '=', $postData['user_id'])->update($fields);
>>>>>>> shubha-local
                    } else {
                        $fields = [
                            'first_name'        => $postData['fname'],
                            'last_name'         => $postData['lname'],
                            'full_name'         => $postData['fname'] . ' ' . $postData['lname'],
                            'display_name'      => $postData['display_name'],
                            'about_yourself'    => $postData['description'],
                            'social_platform'   => json_encode($social_platform_array),
                            'social_url'        => json_encode($social_link_array),
                            'profile_pic'       => $image,
                            'city'              => $postData['city'],
                            'updated_at'        => date('Y-m-d H:i:s'),
                        ];
                        // Helper::pr($fields);
                        StudentProfile::where('id', '=', $postData['user_id'])->update($fields);

                        $doc_type   = $postData['doc_type'];
                        if ($doc_type != '') {
                            /* student documents */
                            $user_doc       = '';
                            $imageFile      = $request->file('user_doc');
                            if ($imageFile != '') {
                                $imageName      = $imageFile->getClientOriginalName();
                                $uploadedFile   = $this->upload_single_file('user_doc', $imageName, 'user', 'image');
                                if ($uploadedFile['status']) {
                                    $user_doc       = $uploadedFile['newFilename'];
                                    $getRequiredDoc = RequireDocument::where('id', '=', $doc_type)->first();
                                    $postData3 = [
                                        'type'                  => 'STUDENT',
                                        'user_id'               => $userId,
                                        'doucument_id'          => $doc_type,
                                        'document_slug'         => Helper::clean((($getRequiredDoc) ? $getRequiredDoc->document : '')),
                                        'document'              => $user_doc
                                    ];
                                    // Helper::pr($postData3);
                                    $checkStudentDocument = UserDocument::where('user_id', '=', $userId)->where('type', '=', 'STUDENT')->first();
                                    if ($checkStudentDocument) {
                                        UserDocument::where('user_id', '=', $userId)->update($postData3);
                                    } else {
                                        UserDocument::insert($postData3);
                                    }
                                }
                            } else {
                                $user_doc = '';
                            }
                            /* student documents */
                        }
                    }
                    $status =  User::where('id', '=', $userId)->update(['name' => $postData['fname'] . ' ' . $postData['lname']]);
                    if ($status) {
                        $request->session()->put('name', $postData['fname'] . ' ' . $postData['lname']);
                        return redirect()->back()->with('success_message', 'Profile Updated Successfully !!!');
                    }
                }
                // } else {
                //     return redirect()->back()->with('error_message', 'All Fields Required !!!');
                // }
            }
        }
        $data['socialPlatforms']    = SocialPlatform::where('status', '=', 1)->get();
        $data['languages']          = Language::where('status', '=', 1)->get();
        $data['subjects']           = Subject::where('status', '=', 1)->get();
        $data['documents']          = RequireDocument::where('status', '=', 1)->where('user_type', '=', 'student')->orderBy('id', 'ASC')->get();
        if ($role == 2) {
            $data['user_id']            = $userId;
            $data['profileDetail']      = MentorProfile::where('user_id', '=', $userId)->first();
            $page_name                  = 'profile';
        } else {
            $data['user_id']            = $userId;
            $data['profileDetail']      = StudentProfile::where('user_id', '=', $userId)->first();
            $page_name                  = 'student-profile';
        }
        $title                      = 'Profile';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* profile*/
    /* logout*/
    public function logout(Request $request)
    {
        $request->session()->forget(['user_id', 'name', 'email', 'fname', 'lname', 'role', 'is_user_login']);
        Auth::guard('web')->logout();
        return redirect('/signin');
    }
    /* logout*/
    /* common */
    /* survey */
<<<<<<< HEAD
        public function surveyList()
        {
            $data['surveyList']     = Survey::where('status', '=', 1)->get();
            $title                  = 'Survey List';
            $page_name              = 'survey-list';
            echo $this->front_dashboard_layout($title, $page_name, $data);
        }
        public function surveyDetails(Request $request, $id)
        {
            $id                         = Helper::decoded($id);
            $userId                     = $request->session()->get('user_id');
            $data['user_id']            = $userId;
            $data['id']                 = $id;
            if ($request->isMethod('post')) {
                $postData = $request->all();
                // Helper::pr($postData);
                $getSurvey          = Survey::where('status', '=', 1)->where('id', '=', $id)->first();
                if ($postData['question_type'] == 1) {
                    $noOfQuestions = SurveyQuestion::where('survey_id', '=', $id)->count();
                    $factor_array = [];
                    for ($i = 1; $i <= $noOfQuestions; $i++) {
                        // $options            = $postData['option'.$i];
                        $answer             = explode("/", $postData['option' . $i][0]);
                        $optionId           = $answer[0];
                        $factor             = Helper::decoded($answer[1]);
                        $weight             = Helper::decoded($answer[2]);
                        $fields = [
                            'user_id'       =>  $userId,
                            'survey_id'     =>  $id,
                            'option_id'     =>  $optionId
                        ];
                        SurveyRecords::insert($fields);
                        $question_array[]       =  $optionId;

                        
                        if(!in_array($factor, $factor_array)){
                            $factor_array[]         = $factor;
                        }
                    }
                    
                    $getFactorCount = SurveyGrades::where('status', '=', 1)->where('survey_id', '=', $id)->groupBy('factor')->count();
                    $splitArrays = [];
                    if($getFactorCount > 1){
                        if(!empty($factor_array)) {
                            for($f=0;$f<count($factor_array);$f++){
                                $noOfQuestionsFactorWises = SurveyQuestion::where('survey_id', '=', $id)->where('factor', '=', $factor_array[$f])->count();
                                $splitArrays[] = array_chunk($question_array, $noOfQuestionsFactorWises);
                            }
                        }
                        
                        $finalSplitArray = $splitArrays[0];
                        
                        if(!empty($finalSplitArray)){
                            for($a=0;$a<count($finalSplitArray);$a++){
                                $optionArray = $finalSplitArray[$a];
                                $sum = 0;
                                if(!empty($optionArray)){
                                    for($op=0;$op<count($optionArray);$op++){
                                        $getSurveyWeight     = SurveyQuestionOptions::where('option_id', '=', $optionArray[$op])->where('status', '=', 1)->first();
                                        $weightCount         = (($getSurveyWeight)?$getSurveyWeight->option_weight:0);
                                        $sum                += $weightCount;
                                    }
                                    $getSurveyGrade              = SurveyGrades::where('survey_id', '=', $id)->where('minimum', '<=', $sum)->where('maximum', '>=', $sum)->first();
                                    if($getSurveyGrade){
                                        $values = [
                                            'user_id'       =>  $userId,
                                            'survey_id'     =>  $id,
                                            'score'         =>  $sum,
                                            'grade'         =>  $getSurveyGrade->name,
                                            'factor'        =>  $getSurveyGrade->factor,
                                            'grade_review'  =>  $getSurveyGrade->review
                                        ];
                                        // Helper::pr($values);
                                        SurveyResult::insert($values);
                                    }
                                }
                            }
                        }
                        return redirect('user/survey-result/' . Helper::encoded($id));
                    } else {
                        $sum = 0;
                        foreach ($question_array as $array) {
                            $getSurveyWeight     = SurveyQuestionOptions::where('option_id', '=', $array[0])->where('status', '=', 1)->first();
                            $weightCount         = (($getSurveyWeight)?$getSurveyWeight->option_weight:0);
                            $sum                += $weightCount;
                        }
                        $getSurveyGrade              = SurveyGrades::where('survey_id', '=', $id)->where('minimum', '<=', $sum)->where('maximum', '>=', $sum)->first();
                        if($getSurveyGrade){
                            $values = [
                                'user_id'       =>  $userId,
                                'survey_id'     =>  $id,
                                'score'         =>  $sum,
                                'grade'         =>  $getSurveyGrade->name,
                                'factor'        =>  (($getSurvey)?$getSurvey->title:''),
                                'grade_review'  =>  $getSurveyGrade->review
                            ];
                            SurveyResult::insert($values);
                            return redirect('user/survey-result/' . Helper::encoded($id));
                        } else {
                            return redirect('user/survey-details/'.Helper::encoded($id));
                        }
                    }
                }
                if ($postData['question_type'] == 2) {
                    $noOfQuestions = SurveyQuestion::where('survey_id', '=', $id)->count();
                    $sum = 0;
                    for ($i = 1; $i <= $noOfQuestions; $i++) {
                        // $options            = $postData['option'.$i];
                        $answer             = explode("/", $postData['option' . $i][0]);
                        $optionId           = $answer[0];
                        $factor             = Helper::decoded($answer[1]);
                        $weight             = Helper::decoded($answer[2]);
                        $fields = [
                            'user_id'       =>  $userId,
                            'survey_id'     =>  $id,
                            'option_id'     =>  $optionId
                        ];
                        SurveyRecords::insert($fields);
                        $question_array[]     =  $optionId;
                        
                        // Helper::pr($question_array);
                        // foreach ($question_array as $array) {
                            $getSurveyWeight     = SurveyQuestionOptions::where('option_id', '=', $question_array[0])->where('status', '=', 1)->first();
                            $weightCount         = (($getSurveyWeight)?$getSurveyWeight->option_weight:0);
                            $sum                += $weightCount;
                        // }
                    }
                    // echo $id;
                    // echo '<br>';
                    // echo $sum;
                    // echo '<br>';
                    $getSurveyGrade              = SurveyGrades::where('survey_id', '=', $id)->where('minimum', '<=', $sum)->where('maximum', '>=', $sum)->first();
                    // Helper::pr($getSurveyGrade);
                    if($getSurveyGrade){
                        $values = [
                            'user_id'       =>  $userId,
                            'survey_id'     =>  $id,
                            'score'         =>  $sum,
                            'grade'         =>  $getSurveyGrade->name,
                            'factor'        =>  (($getSurvey)?$getSurvey->title:''),
                            'grade_review'  =>  $getSurveyGrade->review
                        ];
                        SurveyResult::insert($values);
                        return redirect('user/survey-result/' . Helper::encoded($id));
                    } else {
                        return redirect('user/survey-details/'.Helper::encoded($id));
                    }
                }
                if ($postData['question_type'] == 3) {
                    //MBTI
                    $noOfQuestions = SurveyQuestion::where('survey_id', '=', $id)->count();
                    $survey_result_array    = [];
                    $survey_result_weight   = [];
                    for ($i = 1; $i <= $noOfQuestions; $i++) {
                        $answer             = explode("/", $postData['option' . $i][0]);
                        $optionId           = $answer[0];
                        $factor             = Helper::decoded($answer[1]);
                        $weight             = Helper::decoded($answer[2]);
                        $fields =   [
                            'user_id'       =>  $userId,
                            'survey_id'     =>  $id,
                            'option_id'     =>  $optionId
                        ];
                        SurveyRecords::insert($fields);

                        $survey_result_array[] = $factor . '|' . $weight;
                        $survey_result_weight[] = $weight;
                    }
                    $vals = array_count_values($survey_result_array);
                    
                    $combinationSegment = [];
                    $getFactors = SurveyFactor::select('factor_id', 'factor_name')->where('survey_id', '=', $id)->where('status', '=', 1)->get();
                    // Helper::pr($vals);die;
                    if ($getFactors) {
                        foreach ($getFactors as $getFactor) {
                            $factor_id      = $getFactor->factor_id;
                            $factor_name    = explode("-", $getFactor->factor_name);
                            $factorElement1 = $factor_name[0]; // E S T J
                            $factorElement2 = $factor_name[1]; // I N F P

                            $firstCombination = $getFactor->factor_name . '|A';
                            $secondCombination = $getFactor->factor_name . '|B';
                            
                            if ((array_key_exists($firstCombination,$vals)) && (array_key_exists($secondCombination,$vals))){
                                if ($vals[$firstCombination] > $vals[$secondCombination]) {
                                    $combinationSegment[] = $factorElement1;
                                } else {
                                    $combinationSegment[] = $factorElement2;
                                }
                            } else {
                                $combinationSegment[] = $factorElement2;
                            }
                        }
                    }
                    // Helper::pr($combinationSegment);
                    $combination = implode("", $combinationSegment);
                    $getCombination = SurveyCombinations::select('combination_description')->where('survey_id', '=', $id)->where('combination_code', '=', $combination)->where('status', '=', 1)->first();
                    if($getCombination){
                        $fields2 = [
                            'user_id'           => $userId,
                            'survey_id'         => $id,
                            'score'             => 0,
                            'grade'             => $combination,
                            'factor'            => (($getSurvey)?$getSurvey->title:''),
                            'grade_review'      => (($getCombination) ? $getCombination->combination_description : ''),
                        ];
                        // Helper::pr($fields2);die;
                        SurveyResult::insert($fields2);
                        return redirect('user/survey-result/' . Helper::encoded($id));
                    } else {
                        return redirect('user/survey-details/'.Helper::encoded($id));
                    }
                }
            }

            $data['getSurvey']          = Survey::where('status', '=', 1)->where('id', '=', $id)->first();
            $data['surveyQuestions']    = SurveyQuestion::where('survey_id', '=', $id)->where('status', '=', 1)->get();
            $title                      = 'Survey Details';
            $page_name                  = 'survey-details';
            echo $this->front_dashboard_layout($title, $page_name, $data);
        }
        public function surveyResult(Request $request, $id)
        {
            $userId                  = $request->session()->get('user_id');
            $id                      = Helper::decoded($id);
            $data['getSurvey']       = Survey::where('status', '=', 1)->where('id', '=', $id)->first();
            $data['surveyGrades']    = SurveyGrades::where('status', '=', 1)->where('survey_id', '=', $id)->first();
            $data['getResults']      = SurveyResult::where('user_id', '=', $userId)->where('survey_id', '=', $id)->where('status', '=', 1)->get();
            $data['totalQuestions']  = SurveyQuestion::where('survey_id', '=', $id)->where('status', '=', 1)->count();
            $title                   = 'Survey Result';
            $page_name               = 'survey-result';
            echo $this->front_dashboard_layout($title, $page_name, $data);
=======
    public function surveyList()
    {
        $data['surveys']    = Survey::where('status', '=', 1)->get();
        $title              = 'Survey List';
        $page_name          = 'survey-list';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    public function surveyDetails(Request $request, $id)
    {
        $id                 = Helper::decoded($id);
        $userId             = $request->session()->get('user_id');
        $data['user_id']    = $userId;
        $data['id']         = $id;
        if ($request->isMethod('post')) {
            $postData = $request->all();

            if ($postData['question_type'] == 1) {
                $noOfQuestions = SurveyQuestion::where('survey_id', '=', $id)->count();

                for ($i = 1; $i <= $noOfQuestions; $i++) {
                    // $options            = $postData['option'.$i];
                    $answer             = explode("/", $postData['option' . $i][0]);
                    $optionId           = $answer[0];
                    $factor             = Helper::decoded($answer[1]);
                    $weight             = Helper::decoded($answer[2]);
                    $fields = [
                        'user_id'       =>  $userId,
                        'survey_id'     =>  $id,
                        'option_id'     =>  $optionId
                    ];
                    SurveyRecords::insert($fields);
                    $question_array[]     =  $optionId;
                    $sum = 0;
                    foreach ($question_array as $array) {
                        $getSurveyWeight     = SurveyQuestionOptions::where('option_id', '=', $array[0])->where('status', '=', 1)->first();
                        $weightCount         = (($getSurveyWeight) ? $getSurveyWeight->option_weight : 0);
                        $sum                += $weightCount;
                    }
                }
                $getSurveyGrade              = SurveyGrades::where('survey_id', '=', $id)->where('minimum', '<=', $sum)->where('maximum', '>=', $sum)->first();
                if ($getSurveyGrade) {
                    $values = [
                        'user_id'       =>  $userId,
                        'survey_id'     =>  $id,
                        'score'         =>  $sum,
                        'grade'         =>  $getSurveyGrade->name,
                        'grade_review'  =>  $getSurveyGrade->review
                    ];
                    SurveyResult::insert($values);
                    return redirect('user/survey-result/' . Helper::encoded($id));
                } else {
                    return redirect('user/survey-details/' . Helper::encoded($id));
                }
            }
            if ($postData['question_type'] == 2) {
                $noOfQuestions = SurveyQuestion::where('survey_id', '=', $id)->count();
                $sum = 0;
                for ($i = 1; $i <= $noOfQuestions; $i++) {
                    // $options            = $postData['option'.$i];
                    $answer             = explode("/", $postData['option' . $i][0]);
                    $optionId           = $answer[0];
                    $factor             = Helper::decoded($answer[1]);
                    $weight             = Helper::decoded($answer[2]);
                    $fields = [
                        'user_id'       =>  $userId,
                        'survey_id'     =>  $id,
                        'option_id'     =>  $optionId
                    ];
                    SurveyRecords::insert($fields);
                    $question_array[]     =  $optionId;

                    // Helper::pr($question_array);
                    // foreach ($question_array as $array) {
                    $getSurveyWeight     = SurveyQuestionOptions::where('option_id', '=', $question_array[0])->where('status', '=', 1)->first();
                    $weightCount         = (($getSurveyWeight) ? $getSurveyWeight->option_weight : 0);
                    $sum                += $weightCount;
                    // }
                }
                // echo $id;
                // echo '<br>';
                // echo $sum;
                // echo '<br>';
                $getSurveyGrade              = SurveyGrades::where('survey_id', '=', $id)->where('minimum', '<=', $sum)->where('maximum', '>=', $sum)->first();
                // Helper::pr($getSurveyGrade);
                if ($getSurveyGrade) {
                    $values = [
                        'user_id'       =>  $userId,
                        'survey_id'     =>  $id,
                        'score'         =>  $sum,
                        'grade'         =>  $getSurveyGrade->name,
                        'grade_review'  =>  $getSurveyGrade->review
                    ];
                    SurveyResult::insert($values);
                    return redirect('user/survey-result/' . Helper::encoded($id));
                } else {
                    return redirect('user/survey-details/' . Helper::encoded($id));
                }
            }
            if ($postData['question_type'] == 3) {
                //MBTI

                $noOfQuestions = SurveyQuestion::where('survey_id', '=', $id)->count();
                $survey_result_array    = [];
                $survey_result_weight   = [];
                for ($i = 1; $i <= $noOfQuestions; $i++) {

                    $answer             = explode("/", $postData['option' . $i][0]);
                    $optionId           = $answer[0];
                    $factor             = Helper::decoded($answer[1]);
                    $weight             = Helper::decoded($answer[2]);
                    $fields =   [
                        'user_id'       =>  $userId,
                        'survey_id'     =>  $id,
                        'option_id'     =>  $optionId
                    ];
                    SurveyRecords::insert($fields);

                    $survey_result_array[] = $factor . '|' . $weight;
                    $survey_result_weight[] = $weight;
                }
                $vals = array_count_values($survey_result_array);
                // Helper::pr($vals);die;
                $combinationSegment = [];
                $getFactors = SurveyFactor::select('factor_id', 'factor_name')->where('survey_id', '=', $id)->where('status', '=', 1)->get();
                if ($getFactors) {
                    foreach ($getFactors as $getFactor) {
                        $factor_id      = $getFactor->factor_id;
                        $factor_name    = explode("-", $getFactor->factor_name);
                        $factorElement1 = $factor_name[0]; // E S T J
                        $factorElement2 = $factor_name[1]; // I N F P

                        $firstCombination = $getFactor->factor_name . '|A';
                        $secondCombination = $getFactor->factor_name . '|B';
                        if ($vals[$firstCombination] > $vals[$secondCombination]) {
                            $combinationSegment[] = $factorElement1;
                        } else {
                            $combinationSegment[] = $factorElement2;
                        }
                    }
                }
                $combination = implode("", $combinationSegment);
                $getCombination = SurveyCombinations::select('combination_description')->where('survey_id', '=', $id)->where('combination_code', '=', $combination)->where('status', '=', 1)->first();
                if ($getCombination) {
                    $fields2 = [
                        'user_id'           =>  $userId,
                        'survey_id'         =>  $id,
                        'score'             =>  0,
                        'grade'             =>  $combination,
                        'grade_review'      => (($getCombination) ? $getCombination->combination_description : ''),
                    ];
                    // Helper::pr($fields2);die;
                    SurveyResult::insert($fields2);
                    return redirect('user/survey-result/' . Helper::encoded($id));
                } else {
                    return redirect('user/survey-details/' . Helper::encoded($id));
                }
            }
>>>>>>> shubha-local
        }
        $data['surveyQuestions']    = SurveyQuestion::where('survey_id', '=', $id)->where('status', '=', 1)->get();
        $title          = 'Survey Details';
        $page_name      = 'survey-details';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    public function surveyResult(Request $request, $id)
    {
        $userId                  = $request->session()->get('user_id');
        $id                      = Helper::decoded($id);
        $data['getResult']       = SurveyResult::where('user_id', '=', $userId)->where('survey_id', '=', $id)->where('status', '=', 1)->first();
        $data['totalQuestions']  = SurveyQuestion::where('survey_id', '=', $id)->where('status', '=', 1)->count();
        $title                   = 'Survey Result';
        $page_name               = 'survey-result';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* survey */
    /* student */
    /* student bookings */
    public function studentBookings()
    {
        $userId                                 = Session::get('user_id');
        $data['user_id']                        = $userId;
        $data['all_bookings']                   = Booking::where('student_id', '=', $userId)->where('status', '>=', 1)->orderBy('id', 'DESC')->get();
        $data['upcoming_bookings']              = Booking::where('student_id', '=', $userId)->where('status', '=', 1)->orderBy('id', 'DESC')->get();
        $data['past_bookings']                  = Booking::where('student_id', '=', $userId)->where('status', '=', 2)->orderBy('id', 'DESC')->get();
        $title          = 'Booking History';
        $page_name      = 'student-bookings';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* student bookings */
    /* student transaction */
    public function studentTransactions()
    {
        $userId                         = Session::get('user_id');
        $data['transactions']           = Booking::where('student_id', '=', $userId)->orderBy('id', 'DESC')->get();
        $title                          = 'Transaction History';
        $page_name                      = 'student-transactions';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* student transaction */
    /* print student invoice */
    public function printStudentInvoice($id)
    {
        $id                             = Helper::decoded($id);
        $data['row']                    = Booking::where('id', '=', $id)->first();
        $title                          = 'Student Invoice';
        $page_name                      = 'print-student-invoice';
        return view('front.dashboard.pages.' . $page_name, $data);
    }
    /* print student invoice */
    /* student feedback */
    public function studentFeedbackList(Request $request)
    {
        $userId                         = Session::get('user_id');
        $data['feedbacks']              = BookingRating::where('student_id', '=', $userId)->where('status', '=', 1)->orderBy('id', 'DESC')->get();
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $fields = [
                'mentor_id'         => $postData['mentor_id'],
                'mentor_service_id' => $postData['mentor_service_id'],
                'booking_id'        => $postData['booking_id'],
                'student_id'        => $postData['student_id'],
                'rating'            => $postData['stars'],
                'review'            => $postData['review'],
            ];
            // Helper::pr($fields);
            BookingRating::insert($fields);
            return redirect('user/student-feedback-list/')->with('success_message', 'Review Submitted Successfully. Wait For Admin Approval To Show !!!');
        }
        $title                          = 'Feedbacks';
        $page_name                      = 'student-feedback';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* student feedback */
    /* student booking cancel */
    public function studentBookingCancel(Request $request, $id)
    {
        $userId                         = Session::get('user_id');
        $id                             = Helper::decoded($id);
        $fields                         = [
            'status'            => 3,
            'cancel_by'         => $userId,
            'cancel_date_time'  => date('Y-m-d H:i:s'),
        ];
        Booking::where('id', '=', $id)->update($fields);
        return redirect('user/student-bookings/')->with('success_message', 'Booking Cancelled Successfully !!!');
    }
    /* student booking cancel */
    /* student platform feedback */
    public function studentPlatformFeedbackList(Request $request)
    {
        $userId                         = Session::get('user_id');
        $data['feedbacks']              = PlatformRating::where('user_id', '=', $userId)->where('status', '=', 1)->orderBy('id', 'DESC')->get();
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $fields = [
                'user_id'           => $userId,
                'user_type'         => 'STUDENT',
                'rating'            => $postData['stars'],
                'review'            => $postData['review'],
            ];
            // Helper::pr($fields);
            PlatformRating::insert($fields);
            return redirect('user/student-platform-feedback-list/')->with('success_message', 'Platform Review Submitted Successfully. Wait For Admin Approval To Show !!!');
        }
        $title                          = 'Platform Feedbacks';
        $page_name                      = 'student-platform-feedback-list';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* student platform feedback */
    /* student */
    /* mentor */
    /* mentor availability */
    public function mentorAvailability(Request $request)
    {
        $userId             = Session::get('user_id');
        $mentorAvlDays      = MentorAvailability::select('day_of_week_id')->where('mentor_user_id', '=', $userId)->where('is_active', '=', 1)->groupBy('day_of_week_id')->get();
        $mentorDBDays       = [];
        if ($mentorAvlDays) {
            foreach ($mentorAvlDays as $mentorAvlDay) {
                $mentorDBDays[]       = $mentorAvlDay->day_of_week_id;
            }
        }
        // Helper::pr($mentorDBDays);

        $sortOrderWeekDay = [0, 1, 2, 3, 4, 5, 6]; // Your choices
        //$daysOfWeek = \App\Models\DayOfWeek::orderBy('day_index', 'desc')->get();
        $daysOfWeek = \App\Models\DayOfWeek::all();
        // Sort the $items collection based on your choices
        $sortedDaysOfWeek = $daysOfWeek->sortBy(function ($item) use ($sortOrderWeekDay) {
            $choiceIndex = array_search($item->day_index, $sortOrderWeekDay);
            // If the choice is found in the $choices array, return its index; otherwise, return a high value.
            return $choiceIndex !== false ? $choiceIndex : count($sortOrderWeekDay);
        });
        $startPeriod = \Carbon\Carbon::parse('00:00');
        $endPeriod   = \Carbon\Carbon::parse('24:00');
        $period = \Carbon\CarbonPeriod::create($startPeriod, '15 minutes', $endPeriod)->excludeEndDate();
        $documents = \App\Models\RequireDocument::where('user_type', '=', 'mentor')->get();
        foreach ($period as $date) {
            $hours[] = array(
                'name' => $date->format('h:i A'),
                'value' => $date->format('Hi'),
                'selected_from' => '0900',
                'selected_to'   => '2000'
            );
        }
        // Helper::pr($sortedDaysOfWeek);
        $data['userId']                 = $userId;
        $data['mentor_days']            = $mentorDBDays;
        $data['slot_dropdown']          = $hours;
        $data['days']                   = $sortedDaysOfWeek;
        $data['documents']              = $documents;

        if ($request->isMethod('post')) {
            $postData = $request->all();
            // Helper::pr($postData);

            $days           = $request->input('day_of_week');
            $availabilities = $request->input('availability');
            $durations      = $request->input('duration');
            $no_of_slots    = $request->input('no_of_slot');
            MentorAvailability::where('mentor_user_id', '=', $userId)->delete($data);
            if ($days) {
                foreach ($days as $key => $value) {
                    $day_id = $key;
                    $data   = [];
                    if (is_array($availabilities['from'][$day_id])) {
                        // $data['day_of_week_id'] = ($day_id - 1);
                        $data['day_of_week_id'] = $day_id;
                        // $duration               = $durations[$day_id];
                        // $no_of_slot             = $no_of_slots[$day_id];
                        foreach ($availabilities['from'][$day_id] as $key => $value) {
                            $data['avail_from']     = date('H:i:s', strtotime($value));
                            $data['duration']       = $durations[$day_id][$key];
                            $data['no_of_slot']     = $no_of_slots[$day_id][$key];
                            $data['avail_to']       = date('H:i:s', strtotime($availabilities['to'][$day_id][$key]));
                            $data['mentor_user_id'] = $userId;
                            $data['is_active']      = 1;
                            MentorAvailability::insert($data);
                        }
                    }
                }
            }
            /* mentor slots add on approval of mentor */
            $id         = $userId;
            $mentorAvls = MentorAvailability::select('id', 'day_of_week_id', 'duration', 'no_of_slot', 'avail_from', 'avail_to')->where('is_active', '=', 1)->where('mentor_user_id', '=', $id)->get();
            MentorSlot::where('mentor_user_id', '=', $id)->delete();
            if ($mentorAvls) {
                foreach ($mentorAvls as $mentorAvl) {
                    $mentor_user_id             = $id;
                    $mentor_availability_id     = $mentorAvl->id;
                    $day_of_week_id             = $mentorAvl->day_of_week_id;
                    $duration                   = $mentorAvl->duration;
                    $no_of_slot                 = $mentorAvl->no_of_slot;
                    $from_time                  = $mentorAvl->avail_from;
                    $to_time                    = $mentorAvl->avail_to;
                    $currentDate                = date('Y-m-d');
                    $fTime                      = $currentDate . ' ' . $from_time;
                    $tTime                      = $currentDate . ' ' . $to_time;
                    $slots                      = Helper::SplitTime($fTime, $tTime, $duration);
                    if (!empty($slots)) {
                        for ($s = 0; $s < (count($slots) - 1); $s++) {
                            $sTime = $slots[$s];
                            $eTime = date('H:i:s', strtotime("+" . $duration . " minutes", strtotime($sTime)));
                            $fields = [
                                'mentor_user_id'            => $mentor_user_id,
                                'mentor_availability_id'    => $mentor_availability_id,
                                'day_of_week_id'            => $day_of_week_id,
                                'duration'                  => $duration,
                                'from_time'                 => $sTime,
                                'to_time'                   => $eTime,
                            ];
                            // Helper::pr($fields);
                            MentorSlot::insert($fields);
                        }
                    }
                }
            }
            /* mentor slots add on approval of mentor */

            return redirect('user/mentor-availability/')->with('success_message', 'Availability Updated Successfully !!!');
        }

        $title          = 'Booking Availability';
        $page_name      = 'mentor-availability';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* mentor availability */
    /* mentor bookings */
    public function mentorBookings()
    {
        $userId                                 = Session::get('user_id');
        $data['all_bookings']                   = Booking::where('mentor_id', '=', $userId)->where('status', '>=', 1)->orderBy('id', 'DESC')->get();
        $data['upcoming_bookings']              = Booking::where('mentor_id', '=', $userId)->where('status', '=', 1)->orderBy('id', 'DESC')->get();
        $data['past_bookings']                  = Booking::where('mentor_id', '=', $userId)->where('status', '=', 2)->orderBy('id', 'DESC')->get();
        $title          = 'Booking History';
        $page_name      = 'mentor-bookings';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* mentor bookings */
    /* mentor transaction */
    public function mentorTransactions(Request $request)
    {
        $userId                         = Session::get('user_id');
        $data['user_id']                = $userId;
        $data['mentor_balance']         = $this->getMentorBalance($userId);
        $data['transactions']           = MentorPayment::where('mentor_id', '=', $userId)->orderBy('id', 'DESC')->get();
        if ($request->isMethod('post')) {
            $postData = $request->all();
            if (array_key_exists("booking_ids", $postData)) {
                $request_amount         = 0;
                $request_booking_ids    = $postData['booking_ids'];
                if (!empty($request_booking_ids)) {
                    for ($b = 0; $b < count($request_booking_ids); $b++) {
                        $getBooking             = MentorPayment::where('booking_id', '=', $request_booking_ids[$b])->first();

                        $fields = [
                            'status'                     => 1
                        ];
                        MentorPayment::where('booking_id', '=', $request_booking_ids[$b])->update($fields);

                        if ($getBooking) {
                            if (!$getBooking->status) {
                                $request_amount         += $getBooking->transaction_amt;
                            }
                        }
                    }
                }
<<<<<<< HEAD
            }
            $title                          = 'Transaction History';
            $page_name                      = 'mentor-transactions';
            echo $this->front_dashboard_layout($title, $page_name, $data);
        }
        /* mentor transaction */
        /* print mentor invoice */
        public function printMentorInvoice($id)
        {
            $id                             = Helper::decoded($id);
            $data['row']                    = Booking::where('id', '=', $id)->first();
            $title                          = 'Mentor Invoice';
            $page_name                      = 'print-mentor-invoice';
            return view('front.dashboard.pages.' . $page_name, $data);
        }
        /* print mentor invoice */
        /* mentor-services */
        public function mentorServices(Request $request)
        {
            $userId                             = Session::get('user_id');
            $data['userId']                     = $userId;
            $data['mentor_services']            = ServiceDetail::where('status', '!=', 3)->where('mentor_user_id', '=', $userId)->orderBy('id', 'DESC')->get();
            $data['service_attrs']              = ServiceAttribute::select('id', 'title', 'duration', 'actual_amount', 'slashed_amount')->where('status', '=', 1)->get();

            if ($request->isMethod('post')) {
                $postData                   = $request->all();
                $generalSetting             = GeneralSetting::find('1');
                $stumento_commision_percent = $generalSetting->stumento_commision_percent;

                $total_amount_payable       = $postData['total_amount_payable'];
                $cgst_amount                = (($total_amount_payable * $generalSetting->cgst_percent) / 100);
                $sgst_amount                = (($total_amount_payable * $generalSetting->sgst_percent) / 100);
                $igst_amount                = (($total_amount_payable * $generalSetting->igst_percent) / 100);
                $admin_commision            = (($total_amount_payable * $stumento_commision_percent) / 100);
                $mentor_commision           = ($total_amount_payable - $admin_commision);

                $fields                 = [
                    'service_attribute_id'      => $postData['service_attribute_id'],
                    'mentor_user_id'            => $postData['mentor_user_id'],
                    'title'                     => $postData['title'],
                    'description'               => $postData['description'],
                    'duration'                  => $postData['duration'],
                    'slashed_amount'            => $postData['slashed_amount'],
                    'sgst_amount'               => $sgst_amount,
                    'cgst_amount'               => $cgst_amount,
                    'igst_amount'               => $igst_amount,
                    'total_amount_payable'      => $total_amount_payable,
                    'platform_charges'          => $admin_commision,
                    'mentor_payout_amount'      => $mentor_commision,
                    'promised_response_time'    => 30,
                    'sort_order'                => 1,
                    'countryid'                 => 101,
                    'status'                    => $postData['status'],
                ];
                // Helper::pr($fields);
                ServiceDetail::insert($fields);
                return redirect()->back()->with('success_message', 'Service Added Successfully !!!');
            }
            $title                              = 'Mentor Services';
            $page_name                          = 'mentor-services';
            echo $this->front_dashboard_layout($title, $page_name, $data);
        }
        public function mentorServiceEdit(Request $request, $id)
        {
            $id                                 = Helper::decoded($id);
            $userId                             = Session::get('user_id');
            $data['userId']                     = $userId;
            $data['id']                         = $id;
            $data['mentor_services']            = ServiceDetail::where('status', '!=', 3)->where('mentor_user_id', '=', $userId)->orderBy('id', 'DESC')->get();
            $data['service_attrs']              = ServiceAttribute::select('id', 'title', 'duration', 'actual_amount', 'slashed_amount')->where('status', '=', 1)->get();
            $data['row']                        = ServiceDetail::where('status', '!=', 3)->where('mentor_user_id', '=', $userId)->where('id', '=', $id)->first();
            if ($request->isMethod('post')) {
                $postData                   = $request->all();
                $generalSetting             = GeneralSetting::find('1');
                $stumento_commision_percent = $generalSetting->stumento_commision_percent;

                $total_amount_payable       = $postData['total_amount_payable'];
                $cgst_amount                = (($total_amount_payable * $generalSetting->cgst_percent) / 100);
                $sgst_amount                = (($total_amount_payable * $generalSetting->sgst_percent) / 100);
                $igst_amount                = (($total_amount_payable * $generalSetting->igst_percent) / 100);
                $admin_commision            = (($total_amount_payable * $stumento_commision_percent) / 100);
                $mentor_commision           = ($total_amount_payable - $admin_commision);

                $fields                 = [
                    'service_attribute_id'      => $postData['service_attribute_id'],
                    'mentor_user_id'            => $postData['mentor_user_id'],
                    'title'                     => $postData['title'],
                    'description'               => $postData['description'],
                    'duration'                  => $postData['duration'],
                    'slashed_amount'            => $postData['slashed_amount'],
                    'sgst_amount'               => $sgst_amount,
                    'cgst_amount'               => $cgst_amount,
                    'igst_amount'               => $igst_amount,
                    'total_amount_payable'      => $total_amount_payable,
                    'platform_charges'          => $admin_commision,
                    'mentor_payout_amount'      => $mentor_commision,
                    'promised_response_time'    => 30,
                    'sort_order'                => 1,
                    'countryid'                 => 101,
                    'status'                    => $postData['status'],
                ];
                // Helper::pr($fields);
                ServiceDetail::where('id', '=', $id)->update($fields);
                return redirect('user/mentor-services/')->with('success_message', 'Service Updated Successfully !!!');
            }
            $title                              = 'Mentor Services';
            $page_name                          = 'mentor-services-edit';
            echo $this->front_dashboard_layout($title, $page_name, $data);
        }
        public function mentorServiceDelete(Request $request, $id)
        {
            $id     = Helper::decoded($id);
            $fields = [
                'status' => 3
            ];
            ServiceDetail::where('id', '=', $id)->update($fields);
            return redirect('user/mentor-services/')->with('success_message', 'Service Deleted Successfully !!!');
        }
        /* mentor-services */
        /* mentor feedback */
        public function mentorFeedbackList()
        {
            $userId                         = Session::get('user_id');
            $data['feedbacks']              = BookingRating::where('mentor_id', '=', $userId)->where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $title                          = 'Feedbacks';
            $page_name                      = 'mentor-feedback';
            echo $this->front_dashboard_layout($title, $page_name, $data);
        }
        /* mentor feedback */
        /* mentor withdrawl */
        public function mentorWithdrawls()
        {
            $userId                         = Session::get('user_id');
            $data['withdrawls']             = Withdrawl::where('mentor_id', '=', $userId)->orderBy('id', 'DESC')->get();
            $title                          = 'Withdral Requests';
            $page_name                      = 'mentor-withdrawl';
            echo $this->front_dashboard_layout($title, $page_name, $data);
        }
        /* mentor withdrawl */
        /* mentor booking cancel */
        public function mentorBookingCancel(Request $request, $id)
        {
            $userId                         = Session::get('user_id');
            $id                             = Helper::decoded($id);
            $fields                         = [
                'status'            => 3,
                'cancel_by'         => $userId,
                'cancel_date_time'  => date('Y-m-d H:i:s'),
            ];
            Booking::where('id', '=', $id)->update($fields);
            return redirect('user/mentor-bookings/')->with('success_message', 'Booking Cancelled Successfully !!!');
        }
        /* mentor booking cancel */
        /* mentor booking cancel */
        public function mentorBookingComplete(Request $request, $id)
        {
            $userId                         = Session::get('user_id');
            $id                             = Helper::decoded($id);
            $fields                         = [
                'status'                => 2,
                'completed_by'          => $userId,
                'completed_date_time'   => date('Y-m-d H:i:s'),
            ];
            Booking::where('id', '=', $id)->update($fields);
            return redirect('user/mentor-bookings/')->with('success_message', 'Booking Marked As Completed Successfully !!!');
        }
        /* mentor booking cancel */
        /* mentor platform feedback */
        public function mentorPlatformFeedbackList(Request $request)
        {
            $userId                         = Session::get('user_id');
            $data['feedbacks']              = PlatformRating::where('user_id', '=', $userId)->where('status', '=', 1)->orderBy('id', 'DESC')->get();
            if ($request->isMethod('post')) {
                $postData = $request->all();
=======
>>>>>>> shubha-local
                $fields = [
                    'mentor_id'                     => $postData['mentor_id'],
                    'request_amount'                => $request_amount,
                    'request_booking_ids'           => json_encode($postData['booking_ids']),
                ];
                // Helper::pr($fields);
                Withdrawl::insert($fields);
                return redirect('user/mentor-transactions/')->with('success_message', 'Withdrawl Request Submitted Successfully !!!');
            } else {
                return redirect('user/mentor-transactions/')->with('error_message', 'Please Select Atleast One Booking For Withdrawl !!!');
            }
        }
        $title                          = 'Transaction History';
        $page_name                      = 'mentor-transactions';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* mentor transaction */
    /* print mentor invoice */
    public function printMentorInvoice($id)
    {
        $id                             = Helper::decoded($id);
        $data['row']                    = Booking::where('id', '=', $id)->first();
        $title                          = 'Mentor Invoice';
        $page_name                      = 'print-mentor-invoice';
        return view('front.dashboard.pages.' . $page_name, $data);
    }
    /* print mentor invoice */
    /* mentor-services */
    public function mentorServices(Request $request)
    {
        $userId                             = Session::get('user_id');
        $data['userId']                     = $userId;
        $data['mentor_services']            = ServiceDetail::where('status', '!=', 3)->where('mentor_user_id', '=', $userId)->orderBy('id', 'DESC')->get();
        $data['service_attrs']              = ServiceAttribute::select('id', 'title', 'duration', 'actual_amount', 'slashed_amount')->where('status', '=', 1)->get();

        if ($request->isMethod('post')) {
            $postData                   = $request->all();
            $generalSetting             = GeneralSetting::find('1');
            $stumento_commision_percent = $generalSetting->stumento_commision_percent;

            $total_amount_payable       = $postData['total_amount_payable'];
            $cgst_amount                = (($total_amount_payable * $generalSetting->cgst_percent) / 100);
            $sgst_amount                = (($total_amount_payable * $generalSetting->sgst_percent) / 100);
            $igst_amount                = (($total_amount_payable * $generalSetting->igst_percent) / 100);
            $admin_commision            = (($total_amount_payable * $stumento_commision_percent) / 100);
            $mentor_commision           = ($total_amount_payable - $admin_commision);

            $fields                 = [
                'service_attribute_id'      => $postData['service_attribute_id'],
                'mentor_user_id'            => $postData['mentor_user_id'],
                'title'                     => $postData['title'],
                'description'               => $postData['description'],
                'duration'                  => $postData['duration'],
                'slashed_amount'            => $postData['slashed_amount'],
                'sgst_amount'               => $sgst_amount,
                'cgst_amount'               => $cgst_amount,
                'igst_amount'               => $igst_amount,
                'total_amount_payable'      => $total_amount_payable,
                'platform_charges'          => $admin_commision,
                'mentor_payout_amount'      => $mentor_commision,
                'promised_response_time'    => 30,
                'sort_order'                => 1,
                'countryid'                 => 101,
                'status'                    => $postData['status'],
            ];
            // Helper::pr($fields);
            ServiceDetail::insert($fields);
            return redirect()->back()->with('success_message', 'Service Added Successfully !!!');
        }
        $title                              = 'Mentor Services';
        $page_name                          = 'mentor-services';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    public function mentorServiceEdit(Request $request, $id)
    {
        $id                                 = Helper::decoded($id);
        $userId                             = Session::get('user_id');
        $data['userId']                     = $userId;
        $data['id']                         = $id;
        $data['mentor_services']            = ServiceDetail::where('status', '!=', 3)->where('mentor_user_id', '=', $userId)->orderBy('id', 'DESC')->get();
        $data['service_attrs']              = ServiceAttribute::select('id', 'title', 'duration', 'actual_amount', 'slashed_amount')->where('status', '=', 1)->get();
        $data['row']                        = ServiceDetail::where('status', '!=', 3)->where('mentor_user_id', '=', $userId)->where('id', '=', $id)->first();
        if ($request->isMethod('post')) {
            $postData                   = $request->all();
            $generalSetting             = GeneralSetting::find('1');
            $stumento_commision_percent = $generalSetting->stumento_commision_percent;

            $total_amount_payable       = $postData['total_amount_payable'];
            $cgst_amount                = (($total_amount_payable * $generalSetting->cgst_percent) / 100);
            $sgst_amount                = (($total_amount_payable * $generalSetting->sgst_percent) / 100);
            $igst_amount                = (($total_amount_payable * $generalSetting->igst_percent) / 100);
            $admin_commision            = (($total_amount_payable * $stumento_commision_percent) / 100);
            $mentor_commision           = ($total_amount_payable - $admin_commision);

            $fields                 = [
                'service_attribute_id'      => $postData['service_attribute_id'],
                'mentor_user_id'            => $postData['mentor_user_id'],
                'title'                     => $postData['title'],
                'description'               => $postData['description'],
                'duration'                  => $postData['duration'],
                'slashed_amount'            => $postData['slashed_amount'],
                'sgst_amount'               => $sgst_amount,
                'cgst_amount'               => $cgst_amount,
                'igst_amount'               => $igst_amount,
                'total_amount_payable'      => $total_amount_payable,
                'platform_charges'          => $admin_commision,
                'mentor_payout_amount'      => $mentor_commision,
                'promised_response_time'    => 30,
                'sort_order'                => 1,
                'countryid'                 => 101,
                'status'                    => $postData['status'],
            ];
            // Helper::pr($fields);
            ServiceDetail::where('id', '=', $id)->update($fields);
            return redirect('user/mentor-services/')->with('success_message', 'Service Updated Successfully !!!');
        }
        $title                              = 'Mentor Services';
        $page_name                          = 'mentor-services-edit';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    public function mentorServiceDelete(Request $request, $id)
    {
        $id     = Helper::decoded($id);
        $fields = [
            'status' => 3
        ];
        ServiceDetail::where('id', '=', $id)->update($fields);
        return redirect('user/mentor-services/')->with('success_message', 'Service Deleted Successfully !!!');
    }
    /* mentor-services */
    /* mentor feedback */
    public function mentorFeedbackList()
    {
        $userId                         = Session::get('user_id');
        $data['feedbacks']              = BookingRating::where('mentor_id', '=', $userId)->where('status', '=', 1)->orderBy('id', 'DESC')->get();
        $title                          = 'Feedbacks';
        $page_name                      = 'mentor-feedback';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* mentor feedback */
    /* mentor withdrawl */
    public function mentorWithdrawls()
    {
        $userId                         = Session::get('user_id');
        $data['withdrawls']             = Withdrawl::where('mentor_id', '=', $userId)->orderBy('id', 'DESC')->get();
        $title                          = 'Withdral Requests';
        $page_name                      = 'mentor-withdrawl';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* mentor withdrawl */
    /* mentor booking cancel */
    public function mentorBookingCancel(Request $request, $id)
    {
        $userId                         = Session::get('user_id');
        $id                             = Helper::decoded($id);
        $fields                         = [
            'status'            => 3,
            'cancel_by'         => $userId,
            'cancel_date_time'  => date('Y-m-d H:i:s'),
        ];
        Booking::where('id', '=', $id)->update($fields);
        return redirect('user/mentor-bookings/')->with('success_message', 'Booking Cancelled Successfully !!!');
    }
    /* mentor booking cancel */
    /* mentor platform feedback */
    public function mentorPlatformFeedbackList(Request $request)
    {
        $userId                         = Session::get('user_id');
        $data['feedbacks']              = PlatformRating::where('user_id', '=', $userId)->where('status', '=', 1)->orderBy('id', 'DESC')->get();
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $fields = [
                'user_id'           => $userId,
                'user_type'         => 'MENTOR',
                'rating'            => $postData['stars'],
                'review'            => $postData['review'],
            ];
            // Helper::pr($fields);
            PlatformRating::insert($fields);
            return redirect('user/mentor-platform-feedback-list/')->with('success_message', 'Platform Review Submitted Successfully. Wait For Admin Approval To Show !!!');
        }
        $title                          = 'Platform Feedbacks';
        $page_name                      = 'mentor-platform-feedback-list';
        echo $this->front_dashboard_layout($title, $page_name, $data);
    }
    /* mentor platform feedback */
    /* mentor */
}
