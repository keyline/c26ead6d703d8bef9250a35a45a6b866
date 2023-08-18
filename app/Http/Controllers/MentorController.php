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
use App\Models\User;
use App\Models\Testimonial;
use Auth;
use Session;
use Helper;
use Hash;

class MentorController extends Controller
{
    /* authentication */
        public function mentorSignup(Request $request){
            $data                           = [];
            $title                          = 'Mentor Signup';
            $page_name                      = 'mentor-signup';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function mentorSignup2(Request $request){
            $data                           = [];
            $title                          = 'Mentor Signup';
            $page_name                      = 'mentor-signup-2';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function mentorSignup3(Request $request){
            $data                           = [];
            $title                          = 'Mentor Signup';
            $page_name                      = 'mentor-signup-3';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
        public function mentorSignup4(Request $request){
            $data                           = [];
            $title                          = 'Mentor Signup';
            $page_name                      = 'mentor-signup-4';
            echo $this->front_before_login_layout($title,$page_name,$data);
        }
    /* authentication */    
}
