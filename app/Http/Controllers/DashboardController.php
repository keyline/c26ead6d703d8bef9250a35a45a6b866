<?php
namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use Hash;
use Auth;

class DashboardController extends Controller
{
    /* home */
    public function home(Request $request){
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                        'email'     => 'required|email|max:255',
                        'password'  => 'required|max:30',
                    ];
            if($this->validate($request, $rules)){
                if(Auth::guard('web')->attempt(['email' => $postData['email'], 'password' => $postData['password']])){
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
        echo $this->before_login_front_dashboard_layout($title,$page_name,$data);
    }
    /* home */
    /* index */
    public function index(){
        $data           = [];
        $title          = 'Dashboard';
        $page_name      = 'index';
        echo $this->front_dashboard_layout($title,$page_name,$data);
    }
    /* index */
    /*profile*/
    public function profile(Request $request){
        $userId = $request->session()->get('user_id');
        $getStudentId = MentorProfile::where('user_id', '=', $userId)->first();
        if($request->isMethod('post')){
            $postData = $request->all();
            if($request->post('mode')=='updateBankDetails'){
                $ID       = $postData['student_id'];
                // Helper::pr($postData);
                $rules = [
                        'account_type'        => 'required',
                        'bank_name'           => 'required',
                        'branch_name'         => 'required',
                        'acct_num'            => 'required',
                        'ifsc_code'           => 'required'
                    ];
                if($this->validate($request, $rules)){
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
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            if($request->post('mode0')=='updateEmail'){
                $ID       = $postData['student_id'];
                $postData = $request->all();
                $rules = [
                            'email'    => 'required'
                        ];
                if($this->validate($request, $rules)){
                $email           = $postData['email'];
                $fields = [
                            'email'          => $email,
                        ];
                $getID = MentorProfile::where('id', '=', $ID)->first();
                User::where('id', '=', $getID->user_id)->update($fields);
                return redirect()->back()->with('success_message', 'Your Email Updated Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            if($request->post('mode1')=='updateMobile'){
                $ID       = $postData['student_id'];
                $postData = $request->all();
                $rules = [
                    'mobile'    => 'required'
                ];
                if($this->validate($request, $rules)){
                $phone           = $postData['mobile'];
                $fields = [
                            'phone'          => $phone,
                        ];
                $getID = MentorProfile::where('id', '=', $ID)->first();
                User::where('id', '=', $getID->user_id)->update($fields);
                return redirect()->back()->with('success_message', 'Your Mobile Number Updated Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            if($request->post('mode2')=='updatePassword'){
                $ID       = $postData['student_id'];
                $postData = $request->all();
                $rules = [
                            'password'   => 'required'
                        ];
                if($this->validate($request, $rules)){
                $password        = $postData['password'];
                $fields = [
                            'password'  =>  Hash::make($password),
                        ];
                $getID = MentorProfile::where('id', '=', $ID)->first();
                User::where('id', '=', $getID->user_id)->update($fields);
                return redirect()->back()->with('success_message', 'Your Password Updated Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            if($request->post('mode10')=='updateData'){
                $postData = $request->all();
                $getDetail  = MentorProfile::where('id', '=', $getStudentId->id)->first();
                // Helper::pr($postData);
                $rules = [
                            'display_name'      => 'required',
                            'fname'             => 'required',
                            'lname'             => 'required',
                            'description'       => 'required',
                        ];
                    /* image */
                    $imageFile          = $request->file('image');
                    if($imageFile != ''){
                        $imageName      = $imageFile->getClientOriginalName();
                        $uploadedFile   = $this->upload_single_file('image', $imageName, 'user', 'image');
                        if($uploadedFile['status']){
                            $image = $uploadedFile['newFilename'];
                        } else {
                            return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                        }
                    } else {
                        $image = $getDetail->profile_pic;
                    }
                    /* image */
                    if($this->validate($request, $rules)){
                    $social_platform_array      = array_filter($postData['social_platform']);
                    $social_link_array          = array_filter($postData['social_url']);

                    $edu_institute              = array_filter($postData['edu_institute']);
                    $edu_title                  = array_filter($postData['edu_title']);
                    $edu_year                   = array_filter($postData['edu_year']);

                    $work_institute             = array_filter($postData['work_institute']);
                    $work_title                 = array_filter($postData['work_title']);
                    $work_year                  = array_filter($postData['work_year']);

                    $award_title                = array_filter($postData['award_title']);
                    $award_year                 = array_filter($postData['award_year']);
                    
                    $fields = [
                                'first_name'        => $postData['fname'],
                                'last_name'         => $postData['lname'],
                                'full_name'         => $postData['fname'].' '.$postData['lname'],
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
                    return redirect()->back()->with('success_message', 'Profile Updated Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
        }
        $data['socialPlatforms']    = SocialPlatform::where('status', '=', 1)->get();
        $data['languages']          = Language::where('status', '=', 1)->get();
        $data['subjects']           = Subject::where('status', '=', 1)->get();
        $data['profileDetail']      = MentorProfile::where('id', '=', $getStudentId->id)->first();
        // Helper::pr($data['profileDetail']);
        $title                      = 'Profile';
        $page_name                  = 'profile';
        echo $this->front_dashboard_layout($title,$page_name,$data);
    }
    /*profile*/
    /*mentor-availability*/
    public function mentorAvailability(){
        $data[]         = [];
        $title          = 'Mentor Availability';
        $page_name      = 'mentor-availability';
        echo $this->front_dashboard_layout($title,$page_name,$data);
    }
    /*mentor-availability*/
    /*mentor-services */
    public function mentorServices(){
        $data[]         = [];
        $title          = 'Mentor Services';
        $page_name      = 'mentor-services';
        echo $this->front_dashboard_layout($title,$page_name,$data);
    }
    /*mentor-services */
    /* survey */
        public function surveyList(){
            $data['surveys']    = Survey::where('status', '=', 1)->get();
            $title              = 'Survey List';
            $page_name          = 'survey-list';
            echo $this->front_dashboard_layout($title,$page_name,$data);
        }
        public function surveyDetails(Request $request, $id ){
            $id                 = Helper::decoded($id);
            $userId             = $request->session()->get('user_id');
            $data['user_id']    = $userId;
            $data['id']         = $id;
            if($request->isMethod('post')){
                $postData = $request->all();
                // Helper::pr($postData);
                if($postData['question_type']==1){
                    $noOfQuestions = SurveyQuestion::where('survey_id', '=', $id)->count();
                    for($i=1;$i<=$noOfQuestions;$i++){
                        // $options            = $postData['option'.$i];
                        $answer             = explode("/", $postData['option'.$i][0]);
                        $optionId           = $answer[0];
                        $factor             = Helper::decoded($answer[1]);
                        $weight             = Helper::decoded($answer[2]);
                        $fields =[
                                    'user_id'       =>  $userId,
                                    'survey_id'     =>  $id,
                                    'option_id'     =>  $optionId
                                ];
                        SurveyRecords::insert($fields);
                        $question_array[]     =  $optionId;
                        $sum = 0;
                        foreach ($question_array as $array) {
                            $getSurveyWeight     = SurveyQuestionOptions::where('option_id','=',$array[0])->where('status','=',1)->first();
                            $weightCount         = $getSurveyWeight->option_weight;
                            $sum += $weightCount;
                        }
                    }
                    $getSurveyGrade              = SurveyGrades::where('survey_id','=',$id)->where('minimum','<=',$sum)->where('maximum','>=',$sum)->first();
                    // Helper::pr($getSurveyGrade);
                    $values = [
                                'user_id'       =>  $userId,
                                'survey_id'     =>  $id,
                                'score'         =>  $sum,
                                'grade'         =>  $getSurveyGrade->name,
                                'grade_review'  =>  $getSurveyGrade->review
                            ];
                    SurveyResult::insert($values);
                    return redirect('user/survey-result/'.Helper::encoded($id));
                }
                if($postData['question_type']==2){
                    $noOfQuestions = SurveyQuestion::where('survey_id', '=', $id)->count();
                    for($i=1;$i<=$noOfQuestions;$i++){
                        // $options            = $postData['option'.$i];
                        $answer             = explode("/", $postData['option'.$i][0]);
                        $optionId           = $answer[0];
                        $factor             = Helper::decoded($answer[1]);
                        $weight             = Helper::decoded($answer[2]);
                        $fields =[
                                    'user_id'       =>  $userId,
                                    'survey_id'     =>  $id,
                                    'option_id'     =>  $optionId
                                ];
                        SurveyRecords::insert($fields);
                        $question_array[]     =  $optionId;
                        $sum = 0;
                        foreach ($question_array as $array) {
                            $getSurveyWeight     = SurveyQuestionOptions::where('option_id','=',$array[0])->where('status','=',1)->first();
                            $weightCount         = $getSurveyWeight->option_weight;
                            $sum += $weightCount;
                        }
                    }
                    $getSurveyGrade              = SurveyGrades::where('survey_id','=',$id)->where('minimum','<=',$sum)->where('maximum','>=',$sum)->first();
                    // Helper::pr($getSurveyGrade);
                    $values = [
                                'user_id'       =>  $userId,
                                'survey_id'     =>  $id,
                                'score'         =>  $sum,
                                'grade'         =>  $getSurveyGrade->name,
                                'grade_review'  =>  $getSurveyGrade->review
                            ];
                    SurveyResult::insert($values);
                    return redirect('user/survey-result/'.Helper::encoded($id));
                }
                if($postData['question_type']==3){
                    //MBTI
                    $noOfQuestions = SurveyQuestion::where('survey_id', '=', $id)->count();
                    $survey_result_array    = [];
                    $survey_result_weight   = [];
                    for($i=1;$i<=$noOfQuestions;$i++){
                        $answer             = explode("/", $postData['option'.$i][0]);
                        $optionId           = $answer[0];
                        $factor             = Helper::decoded($answer[1]);
                        $weight             = Helper::decoded($answer[2]);
                        $fields =   [
                                        'user_id'       =>  $userId,
                                        'survey_id'     =>  $id,
                                        'option_id'     =>  $optionId
                                    ];
                        SurveyRecords::insert($fields);
                        
                        $survey_result_array[] = $factor.'|'.$weight;
                        $survey_result_weight[] = $weight;
                    }
                    $vals = array_count_values($survey_result_array);
                    Helper::pr($vals,0);
                    $combinationSegment = [];
                    $getFactors = SurveyFactor::select('factor_id', 'factor_name')->where('survey_id', '=', $id)->where('status', '=', 1)->get();
                    if($getFactors){
                        foreach($getFactors as $getFactor){
                            $factor_id      = $getFactor->factor_id;
                            $factor_name    = explode("-", $getFactor->factor_name);
                            $factorElement1 = $factor_name[0]; // E S T J
                            $factorElement2 = $factor_name[1]; // I N F P

                            $firstCombination = $getFactor->factor_name.'|A';
                            $secondCombination = $getFactor->factor_name.'|B';
                            if($vals[$firstCombination] > $vals[$secondCombination]){
                                $combinationSegment[] = $factorElement1;
                            } else {
                                $combinationSegment[] = $factorElement2;
                            }                            
                        }
                    }
                    $combination = implode("", $combinationSegment);
                    $getCombination = SurveyCombinations::select('combination_description')->where('survey_id', '=', $id)->where('combination_code', '=', $combination)->where('status', '=', 1)->first();
                    $fields2 =[
                                'user_id'           =>  $userId,
                                'survey_id'         =>  $id,
                                'score'             =>  0,
                                'grade'             =>  $combination,
                                'grade_review'      =>  (($getCombination)?$getCombination->combination_description:''),
                            ];
                    // Helper::pr($fields2);die;
                    SurveyResult::insert($fields2);
                    return redirect('user/survey-result/'.Helper::encoded($id));
                }
            }
            $data['surveyQuestions']    = SurveyQuestion::where('survey_id','=',$id)->where('status', '=', 1)->get();
            $title          = 'Survey Details';
            $page_name      = 'survey-details';
            echo $this->front_dashboard_layout($title,$page_name,$data);
        }
        public function surveyResult(Request $request , $id){
            $userId                  = $request->session()->get('user_id');
            $id                      = Helper::decoded($id);
            $data['getResult']       = SurveyResult::where('user_id','=',$userId)->where('survey_id','=',$id)->where('status', '=', 1)->first();
            $data['totalQuestions']  = SurveyQuestion::where('survey_id','=',$id)->where('status', '=', 1)->count();
            $title                   = 'Survey Result';
            $page_name               = 'survey-result';
            echo $this->front_dashboard_layout($title,$page_name,$data);
        }
    /* survey */
    public function logout(Request $request){
        $request->session()->forget(['user_id', 'name', 'email', 'fname', 'lname', 'role', 'is_user_login']);
        Auth::guard('web')->logout();
        return redirect('/signin');
    }
}
