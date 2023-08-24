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
    public function createStep1(Request $request)
    {
        //get the in progress data from session storage
        $mentor = $request->session()->get('mentor');
        //populating data if any present in session
        $data                           = [];
        $title                          = 'Mentor Signup';
        $page_name                      = 'mentor-signup';
        echo $this->front_before_login_layout($title, $page_name, $data);
    }

    public function postCreateStep1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email' => 'required|email|unique:users',
            'phone_number'  => 'required',
            'password'      => 'required|confirmed|min:6',

        ]);

        if($validator->fails()) {

            return redirect('mentor-signup')
                                    ->withErrors($validator)
                                    ->withInput();

        }

        // Retrieve the validated input data...
        $validated = $validator->valid();

        $userData = array(
                'name' => implode(" ", [$validated->first_name, $validated->last_name]),
                'email' => $validated->email,
                'phone' => $validated->phone_number,
                'role' => 2,
                'valid' => 0,
                'password' => \bcrypt($validated->password)
        );

        $mentorData = array(
                'first_name'    => $validated->first_name,
                'last_name'     => $validated->last_name,
                'display_name'  => implode(" ", [$validated->first_name, $validated->last_name]),
                'mobile'        => $validated->phone_number,
        );

        //Storing in session
        if(empty($request->session()->get('user'))) {
            //instantiate model and fill model instance save later
            $user = new User();

            $mentor = new MentorProfile();

            $user->fill($userData);

            $mentor->fill($mentorData);

            $request->session()->put('user', $user);

            $request->session()->put('onboarding', $mentor);

        } else {
            $mentor = $request->session()->get('onboarding');


            $user = $request->session()->get('user');

            $user->fill($userData);
            $mentor->fill($mentorData);


            $request->session()->put('user', $user);

            $request->session()->put('onboarding', $mentor);

        }

        return redirect('create-step2');

    }
    public function mentorSignup2(Request $request)
    {
        $data                           = [];
        $title                          = 'Mentor Signup';
        $page_name                      = 'mentor-signup-2';
        echo $this->front_before_login_layout($title, $page_name, $data);
    }
    public function mentorSignup3(Request $request)
    {
        $data                           = [];
        $title                          = 'Mentor Signup';
        $page_name                      = 'mentor-signup-3';
        echo $this->front_before_login_layout($title, $page_name, $data);
    }
    public function mentorSignup4(Request $request)
    {
        $data                           = [];
        $title                          = 'Mentor Signup';
        $page_name                      = 'mentor-signup-4';
        echo $this->front_before_login_layout($title, $page_name, $data);
    }
    /* authentication */
}
