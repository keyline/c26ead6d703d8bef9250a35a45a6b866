<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\RequireDocument;
use App\Models\Survey;
use App\Models\UserDocument;
use App\Models\SurveyResult;
use App\Models\SurveyRecords;
use App\Models\BookingRating;
use App\Models\Booking;
use App\Models\AdminPayment;
use App\Models\MentorPayment;
use Auth;
use Session;
use Helper;
use Hash;
use DB;

class StudentController extends Controller
{
    public function __construct()
    {        
        $this->data = array(
            'title'             => 'Student',
            'controller'        => 'StudentController',
            'controller_route'  => 'student',
            'primary_key'       => 'id',
        );
    }
    /* list */
        public function list(){
            // DB::enableQueryLog();
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' List';
            $page_name                      = 'student.list';
            // $data['rows']                   = User::where('valid', '!=', 3)->orderBy('id', 'DESC')->get();
            // $data['rows']                   = StudentProfile::with('user')->whereRelation('user','role', '=', 1)->whereRelation('user','valid', '=', 1)->select('studentprofiles.*,user.valid,user.role')->get();
            $data['rows']                   = User::select('student_profiles.*','users.role','users.valid','users.email','users.phone')->join('student_profiles', 'student_profiles.user_id', '=', 'users.id')->where('users.valid', '!=', 3)->where('users.role', '=', 1)->orderBy('users.id', 'DESC')->get();
            // $query = DB::getQueryLog();
            // dd($query);
            // Helper::pr($data['rows']);
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
    /* edit */
        public function edit(Request $request, $id){
            $data['module']                 = $this->data;
            $id                             = Helper::decoded($id);
            $title                          = $this->data['title'].' Update';
            $page_name                      = 'student.add-edit';
            $data['row']                    = Source::where($this->data['primary_key'], '=', $id)->first();

            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'name'             => 'required',
                ];
                if($this->validate($request, $rules)){
                    $fields = [
                        'name'                  => $postData['name'],
                        'updated_at'            => date('Y-m-d H:i:s')
                    ];
                    Source::where($this->data['primary_key'], '=', $id)->update($fields);
                    return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Updated Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* edit */
    /* delete */
        public function delete(Request $request, $id){
            $id                             = Helper::decoded($id);
            $fields = [
                'valid'             => 3
            ];
            User::where($this->data['primary_key'], '=', $id)->update($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Deleted Successfully !!!');
        }
    /* delete */
    /* change status */
        public function change_status(Request $request, $id){
            $id                             = Helper::decoded($id);
            $model                          = User::find($id);
            if ($model->valid == 1)
            {
                $model->valid  = 0;
                $msg            = 'Deactivated';
            } else {
                $model->valid  = 1;
                $msg            = 'Activated';
            }            
            $model->save();
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' '.$msg.' Successfully !!!');
        }
    /* change status */
    /* bookings */
        public function bookings($id){
            $id                                     = Helper::decoded($id);
            $data['student']                        = StudentProfile::where('user_id', '=', $id)->first();
            $data['module']                         = $this->data;
            $data['all_bookings']                   = Booking::where('student_id', '=', $id)->where('status', '>=', 1)->orderBy('id', 'DESC')->get();
            $data['upcoming_bookings']              = Booking::where('student_id', '=', $id)->where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['past_bookings']                  = Booking::where('student_id', '=', $id)->where('status', '=', 2)->orderBy('id', 'DESC')->get();
            
            $title                          = 'Booking List Of '.(($data['student'])?$data['student']->first_name.' '.$data['student']->last_name:'');
            $page_name                      = 'student.bookings';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* bookings */
    /*profile*/
        public function profile(Request $request , $id){
            $id    = Helper::decoded($id);
            // echo $id;die;
            if($request->isMethod('post')){
                if($request->post('mode')=='updateDocument'){
                    $postData = $request->all();
                    // Helper::pr($postData);
                    $getDocumentName = RequireDocument::where('id', '=', $postData['doucument_id'])->first();
                    $studentDocument = UserDocument::where('user_id', '=', $id)->first();
                    $rules = [
                                'doucument_id'      => 'required',
                                'image'             => 'required',
                            ];
                    if($this->validate($request, $rules)){
                        /* Document */
                            $imageFile      = $request->file('image');
                            if($imageFile != ''){
                                $imageName         = $imageFile->getClientOriginalName();
                                $imageFileType     = pathinfo($imageName, PATHINFO_EXTENSION);
                                // Helper::pr($imageFileType);
                                if(($imageFileType == 'jpg') || ($imageFileType == 'png') || ($imageFileType == 'jpeg') || ($imageFileType == 'svg')) {
                                    // echo 'hii';die;
                                    $uploadedFile  = $this->upload_single_file('image', $imageName, 'user', 'image');
                                }else{
                                    $uploadedFile  = $this->upload_single_file('image', $imageName, 'user', 'pdf');
                                }
                                if($uploadedFile['status']){
                                    $image = $uploadedFile['newFilename'];
                                } else {
                                    return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                                }
                            } else {
                                $image = $studentDocument->document;
                            }
                        /* Document */
                        $checkMentorDocument = UserDocument::where('user_id', '=', $id)->first();
                        $fields = [
                                    'type'              => $postData['type'],
                                    'user_id'           => $postData['user_id'],
                                    'doucument_id'      => $postData['doucument_id'],
                                    'document_slug'     => Helper::clean($getDocumentName->document),
                                    'document'          => $image,
                                    'updated_at'        => date('Y-m-d H:i:s')
                                ];
                        if(!empty($checkMentorDocument)){
                            UserDocument::where('user_id', '=', $id)->update($fields);
                        } else {
                            UserDocument::insert($fields);
                        }
                        return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Document Updated Successfully !!!');
                    } else {
                        return redirect()->back()->with('error_message', 'All Fields Required !!!');
                    }
                }
                if($request->post('mode')=='updatebasic'){
                    $postData = $request->all();
                    // Helper::pr($postData);
                    $studentRow                = User::select('student_profiles.*','users.role','users.valid','users.email','users.phone')->join('student_profiles', 'student_profiles.user_id', '=', 'users.id')->where('users.valid', '!=', 3)->where('users.role', '=', 1)->where('user_id', '=', $id)->first();
                    $rules = [
                                'first_name'        => 'required',
                                'last_name'         => 'required',
                                'display_name'      => 'required',
                                'email'             => 'required',
                                'phone'             => 'required',
                            ];
                    if($this->validate($request, $rules)){
                        /* profile image */
                            $imageFile      = $request->file('image');
                            if($imageFile != ''){
                                $imageName          = $imageFile->getClientOriginalName();
                                $imageFileType      = pathinfo($imageName, PATHINFO_EXTENSION);
                                $uploadedFile       = $this->upload_single_file('image', $imageName, 'user', 'image');
                                if($uploadedFile['status']){
                                    $image = $uploadedFile['newFilename'];
                                } else {
                                    return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                                }
                            } else {
                                $image = $studentRow->profile_pic;
                            }
                        /* profile image */
                        $fields = [
                                    'name'              => $postData['first_name'].' '.$postData['last_name'],
                                    'email'             => $postData['email'],
                                    'phone'             => $postData['phone'],
                                    'updated_at'        => date('Y-m-d H:i:s')
                                ];
                        // Helper::pr($fields);
                        User::where('id', '=', $id)->update($fields);

                        $fields = [
                                    'first_name'        => $postData['first_name'],
                                    'last_name'         => $postData['last_name'],
                                    'full_name'         => $postData['first_name'].' '.$postData['last_name'],
                                    'display_name'      => $postData['display_name'],
                                    'profile_pic'       => $image,
                                    'updated_at'        => date('Y-m-d H:i:s')
                                ];
                        // Helper::pr($fields);
                        StudentProfile::where('user_id', '=', $id)->update($fields);

                        return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Basic Details Updated Successfully !!!');
                    } else {
                        return redirect()->back()->with('error_message', 'All Fields Required !!!');
                    }
                }
            }
            $data['student']                = User::select('student_profiles.*','users.role','users.valid','users.email','users.phone')->join('student_profiles', 'student_profiles.user_id', '=', 'users.id')->where('users.valid', '!=', 3)->where('users.role', '=', 1)->where('user_id', '=', $id)->first();
            $data['module']                 = $this->data;
            $title                          = 'Profile: '.(($data['student'])?$data['student']->first_name.' '.$data['student']->last_name:'');
            $page_name                      = 'student.profile';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /*profile*/
    /* transactions */
        public function transactions($id){
            $id                             = Helper::decoded($id);
            $data['student']                = StudentProfile::where('user_id', '=', $id)->first();
            $data['module']                 = $this->data;
            $data['transactions']           = Booking::where('student_id', '=', $id)->orderBy('id', 'DESC')->get();

            $title                          = 'Transactions List Of '.(($data['student'])?$data['student']->first_name.' '.$data['student']->last_name:'');
            $page_name                      = 'student.transactions';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* transactions */
    /* print student invoice */
        public function printStudentInvoice($id){
            $id                             = Helper::decoded($id);
            $data['row']                    = Booking::where('id', '=', $id)->first();
            $title                          = 'Student Invoice';
            $page_name                      = 'print-student-invoice';
            return view('admin.maincontents.student.'.$page_name, $data);
        }
    /* print student invoice */
    /* surveys */
        public function survey($id){
            $id                             = Helper::decoded($id);
            $data['user_id']                = $id;
            $data['student']                = StudentProfile::where('user_id', '=', $id)->first();
            $data['surveyResults']          = SurveyResult::where('user_id', '=', $id)->where('status','=',1)->get();
            // Helper::pr($data['surveyResults']);
            $data['module']                 = $this->data;
            $title                          = 'Participated Survey List Of '.(($data['student'])?$data['student']->first_name.' '.$data['student']->last_name:'');
            $page_name                      = 'student.survey';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
        public function viewSurveyDetails($userid , $surveyid){
            $userid                         = Helper::decoded($userid);
            $surveyid                       = Helper::decoded($surveyid);
            $data['survey']                 = Survey::where('id', '=', $surveyid)->where('status','=',1)->first();
            $data['module']                 = $this->data;
            $title                          = 'Survey Details Of '. $data['survey']->title;
            $data['answersRecords']         = SurveyRecords::where('user_id', '=', $userid)->where('survey_id','=',$surveyid)->where('status','=',1)->get();
            $page_name                      = 'student.survey-details';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* surveys */
}
