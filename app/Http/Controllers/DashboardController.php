<?php
namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use App\Models\User;
use Hash;

class DashboardController extends Controller
{
    /* home */
    public function home(){
        $data[]         = [];
        $title          = 'Dashboard';
        $page_name      = 'index';
        echo $this->front_dashboard_layout($title,$page_name,$data);
    }
    /* home */
    /*profile*/
    public function profile(Request $request){
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
                StudentProfile::where('id', '=', $ID)->update($fields);
                return redirect()->back()->with('success_message', 'Your Bank Details Updated Successfully !!!');
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
                $getID = StudentProfile::where('id', '=', $ID)->first();
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
                $getID = StudentProfile::where('id', '=', $ID)->first();
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
                $getID = StudentProfile::where('id', '=', $ID)->first();
                User::where('id', '=', $getID->user_id)->update($fields);
                return redirect()->back()->with('success_message', 'Your Password Updated Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            if($request->post('mode10')=='updateData'){
                $postData = $request->all();
                // Helper::pr($postData);
                $rules = [
                            'page_link'         => 'required',
                            'fname'             => 'required',
                            'lname'             => 'required',
                            'dname'             => 'required',
                            'intro'             => 'required',
                            'about_yourself'    => 'required',
                            'image'             => 'required'
                        ];
                if($this->validate($request, $rules)){
                    /* image */
                    $imageFile      = $request->file('image');
                    if($imageFile != ''){
                        $imageName      = $imageFile->getClientOriginalName();
                        $uploadedFile   = $this->upload_single_file('image', $imageName, 'student', 'image');
                        if($uploadedFile['status']){
                            $image = $uploadedFile['newFilename'];
                        } else {
                            return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                        }
                    } else {
                        return redirect()->back()->with(['error_message' => 'Please Upload Banner Image !!!']);
                    }
                    /* image */
                    $fields = [
                                'first_name'        => $postData['fname'],
                                'last_name'         => $postData['lname'],
                                'full_name'         => $postData['dname'],
                                'page_link'         => $postData['page_link'],
                                'stumento_intro'    => $postData['intro'],
                                'about_yourself'    => $postData['about_yourself'],
                                'social_link'       => $postData['wrapped'],
                                'profile_pic'       => $image,
                                'updated_at'        => date('Y-m-d H:i:s'),
                            ];
                    // Helper::pr($fields);
                    StudentProfile::where('id', '=', $postData['student_id'])->update($fields);
                    return redirect()->back()->with('success_message', 'Your Details Updated Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
        }
        $data['profileDetail']  = StudentProfile::where('id', '=', 100)->first();
        $title                  = 'Profile';
        $page_name              = 'profile';
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
}
