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
        if($requestData['key'] == env('PROJECT_KEY')){
            $phone = substr($requestData['phone'], 4, 16);
            $checkEmail = User::where('email', '=', $requestData['email'])->first();
            if(empty($checkEmail)){
                $checkPhone = User::where('phone', '=', $phone)->count();
                if($checkPhone <= 0){
                    if($requestData['password'] == $requestData['confirm_password']){
                        $remember_token = rand(1000,9999);
                        $postData = [
                            'name'                  => $requestData['name'],
                            'email'                 => $requestData['email'],
                            'phone'                 => $phone,
                            'password'              => Hash::make($requestData['password']),
                            'country'               => 'United Arab Emirates',
                            'remember_token'        => $remember_token,
                            'status'                => 0,
                        ];
                        $id = User::insertGetId($postData);
                        // $this->sendMail('subhomoysamanta1989@gmail.com', $requestData['subject'], $requestData['message']);

                        $apiStatus          = TRUE;
                        http_response_code(200);
                        $apiResponse['redirectUrl']        = url('signup-otp/'.Helper::encoded($id));
                        $apiMessage         = 'Registered Successfully !!!';
                        $apiExtraField      = 'response_code';
                        $apiExtraData       = http_response_code();
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
            } else {
                if($checkEmail->status){
                    $apiStatus          = FALSE;
                    http_response_code(400);
                    $apiMessage         = 'Email Already Registered !!!';
                    $apiExtraField      = 'response_code';
                    $apiExtraData       = http_response_code();
                } else {
                    $remember_token = rand(1000,9999);
                    $postData = [
                        'name'                  => $requestData['name'],
                        'email'                 => $requestData['email'],
                        'phone'                 => $phone,
                        'password'              => Hash::make($requestData['password']),
                        'country'               => 'United Arab Emirates',
                        'remember_token'        => $remember_token,
                    ];
                    User::where('id', '=', $checkEmail->id)->update($postData);
                    $apiStatus          = TRUE;
                    http_response_code(200);
                    $apiResponse['redirectUrl']        = url('signup-otp/'.Helper::encoded($checkEmail->id));
                    $apiMessage         = 'Validate OTP !!!';
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
                    // $this->sendMail('subhomoysamanta1989@gmail.com', $requestData['subject'], $requestData['message']);

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
                // $this->sendMail('subhomoysamanta1989@gmail.com', $requestData['subject'], $requestData['message']);

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
