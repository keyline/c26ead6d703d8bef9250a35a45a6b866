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
        //$data                           = [];
        //$title                          = 'Mentor Signup';
        //$page_name                      = 'mentor-signup';
        //echo $this->front_before_login_layout($title, $page_name, $data);
        return \view('front.mentor.onboarding.create-step1');

    }

    public function postCreateStep1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email' => 'required|email|unique:users',
            'phone_number'  => 'required|max:10',
            'password'      => 'required|confirmed|min:6',

        ]);

        if($validator->fails()) {

            return redirect('mentor/signup')
                                    ->withErrors($validator)
                                    ->withInput();

        }

        // Retrieve the validated input data...
        $validated = $validator->valid();

        $userData = array(
                'name' => implode(" ", [$validated['first_name'], $validated['last_name']]),
                'email' => $validated['email'],
                'phone' => $validated['phone_number'],
                'role' => 2,
                'valid' => 0,
                'password' => \bcrypt($validated['password'])
        );

        $mentorData = array(
                'first_name'    => $validated['first_name'],
                'last_name'     => $validated['last_name'],
                'display_name'  => implode(" ", [$validated['first_name'], $validated['last_name']]),
                'mobile'        => $validated['phone_number'],
                'full_name'     => implode(" ", [$validated['first_name'], $validated['last_name']]),
        );

        //Storing in session
        if(empty($request->session()->get('user'))) {
            //instantiate model and fill model instance save later
            $user = new \App\Models\User();

            $mentor = new \App\Models\MentorProfile();

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

        return redirect('mentor/step2');

    }
    public function createStep2(Request $request)
    {
        $onboarding = $request->session()->get('onboarding');
        //Data needed for rendering the page
        //service type choices
        $service_types = \App\Models\ServiceType::all();

        return view('front.mentor.onboarding.create-step2', ['serviceTypes' => $service_types]);

        //$data                           = [];
        //$title                          = 'Mentor Signup';
        //$page_name                      = 'mentor-signup-2';
        //echo $this->front_before_login_layout($title, $page_name, $data);
    }
    public function postCreateStep2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'social_url'    => 'required',
            'profile_slug'  => 'required',
            'referral_from' => 'required',
            'intended_service_type' => 'required',

        ]);

        if($validator->fails()) {

            return redirect('mentor/create/step2')
                        ->withErrors($validator)
                        ->withInput();


        }

        // Retrieve the validated input...
        $validated = $validator->validated();
        //process the form
        $mentor = $request->session()->get('onboarding');
        $mentor->social_url = $validated['social_url'];
        $mentor->display_name = $validated['profile_slug'];
        $mentor->registration_intent = $validated['registration_intent'];
        $request->session()->put('onboarding', $mentor);

        //attaching service types to mentor
        if(empty($request->session()->get('intended_services'))) {
            $request->session()->put('intended_services', $validated['intended_service_type']);

        }

        //data collect done proceed to next step
        return redirect('mentor/step3');




        //$data                           = [];
        //$title                          = 'Mentor Signup';
        //$page_name                      = 'mentor-signup-3';
        //echo $this->front_before_login_layout($title, $page_name, $data);
    }
    public function createStep3(Request $request)
    {
        // $services = \App\Models\Service::with(['serviceTypes' => function ($query) {
        //     $query->where('service_type_id', '=', 2);
        // }])->get();

        //$services = \App\Models\Service::with(['serviceTypes', 'serviceAttributes'])->get();
        $services = \App\Models\Service::all();
        $types =    \App\Models\ServiceType::with(['serviceAttributes' => function ($query) {
            $query->where('service_id', '=', 1);
        }])->get();
        //$types = [];
        //dd($services);


        //dd(\App\Models\ServiceType::with('services')->get());

        //$mentalHealth = \App\Models\Service::find(1)->serviceTypes()->where('is_default', 0)->get();

        //$careerCounselling = \App\Models\Service::find(2)->serviceAttributes()->where('is_default', 0)->get();

        //return \view('front.mentor.onboarding.create-step3', ['services' => $services, 'mentalHealth' => $mentalHealth, 'careerCounselling' => $careerCounselling]);

        return \view('front.mentor.onboarding.create-step3', ['services' => $services, 'types' => $types]);

        //$data                           = [];
        //$title                          = 'Mentor Signup';
        //$page_name                      = 'mentor-signup-4';
        //echo $this->front_before_login_layout($title, $page_name, $data);
    }

    public function postCreateStep3(Request $request)
    {

    }

    public function createStep4()
    {
        return \view('front.mentor.onboarding.create-step4');
    }

    public function postCreateStep4()
    {

    }
    /* authentication */
}
