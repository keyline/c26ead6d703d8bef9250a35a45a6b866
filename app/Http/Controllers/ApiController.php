<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\MentorProfile;
use App\Models\EmailLog;
use App\Models\UserDocument;
use App\Models\RequireDocument;
use Auth;
use Session;
use Helper;
use Hash;

class ApiController extends Controller
{
    public function signup(Request $request)
    {
        $apiStatus          = TRUE;
        $apiMessage         = '';
        $apiResponse        = [];
        $apiExtraField      = '';
        $apiExtraData       = '';
        $requestData        = $request->all();
        // Helper::pr($requestData);
        if($requestData['key'] == env('PROJECT_KEY')){
            $fname      = $requestData['fname'];
            $lname      = $requestData['lname'];
            $phone      = $requestData['phone'];
            $doc_type   = $requestData['doc_type'];
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
                                        // Helper::pr($postData3);
                                        UserDocument::insert($postData3);

                                    } else {
                                        $apiStatus          = FALSE;
                                        http_response_code(400);
                                        $apiMessage         = $uploadedFile['message'];
                                        $apiExtraField      = 'response_code';
                                        $apiExtraData       = http_response_code();
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
                            // Helper::pr($postData2);
                            StudentProfile::insert($postData2);
                        /* student profile table */
                        /* email sent */
                            $generalSetting             = GeneralSetting::find('1');
                            $subject                    = $generalSetting->site_name.' :: Signup Complete';
                            $message                    = view('front.email-templates.student-signup',$requestData);
                            // echo $message;die;
                            $this->sendMail($requestData['email'], $subject, $message);
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
                            
                        /* set session */

                        $apiStatus          = TRUE;
                        http_response_code(200);
                        $apiResponse['redirectUrl']        = url('signin/');
                        $apiMessage         = 'Registered Successfully !!!';
                        $apiExtraField      = 'response_code';
                        $apiExtraData       = http_response_code();
                        // if(Auth::guard('web')->attempt(['email' => $requestData['email'], 'password' => $requestData['password'], 'valid' => 1])){
                            
                        //     $sessionData = Auth::guard('web')->user();
                        //     $request->session()->put('user_id', $id);
                        //     $request->session()->put('fullname', $fname.' '.$lname);
                        //     $request->session()->put('fname', $fname);
                        //     $request->session()->put('lname', $lname);
                        //     $request->session()->put('email', $requestData['email']);
                        //     $request->session()->put('role', 1);
                        //     // Helper::pr($request->session()->all());die;
                            
                        //     $apiStatus          = TRUE;
                        //     http_response_code(200);
                        //     $apiResponse['redirectUrl']        = url('dashboard/');
                        //     $apiMessage         = 'Registered Successfully !!!';
                        //     $apiExtraField      = 'response_code';
                        //     $apiExtraData       = http_response_code();
                        // } else {
                        //     $apiStatus          = FALSE;
                        //     http_response_code(400);
                        //     $apiMessage         = 'Invalid Email Or Password !!!';
                        //     $apiExtraField      = 'response_code';
                        //     $apiExtraData       = http_response_code();
                        // }
                    } else {
                        $apiStatus          = FALSE;
                        http_response_code(400);
                        $apiMessage         = 'Password & Confirm Password Does Not Matched !!!';
                        $apiExtraField      = 'response_code';
                        $apiExtraData       = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    http_response_code(400);
                    $apiMessage         = 'Phone Already Registered !!!';
                    $apiExtraField      = 'response_code';
                    $apiExtraData       = http_response_code();
                }
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
}
