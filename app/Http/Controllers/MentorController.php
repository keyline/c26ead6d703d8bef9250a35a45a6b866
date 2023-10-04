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
use App\Rules\UniqueProfileSlug;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MentorController extends Controller
{
    /* authentication */
    public function createStep1(Request $request)
    {
        //get the in progress data from session storage
        $mentor = $request->session()->get('mentor');
        //$testimonial = \App\Models\Testimonial::where('status', '=', 1)->orderBy('id', 'DESC')->get();
        //['testimonials' => $testimonial]
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
            'email'         => 'required|email|unique:users',
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

        $user = \App\Models\User::create([
                'name' => implode(" ", [$validated['first_name'], $validated['last_name']]),
                'email' => $validated['email'],
                'phone' => $validated['phone_number'],
                'role' => 2,
                'valid' => 0,
                'password' => \bcrypt($validated['password'])
        ]);

        //$mentor = \App\Models\MentorProfile::create();
        $mentorData = [
            'user_id'       => $user->id,
            'first_name'    => trim($validated['first_name']),
            'last_name'     => trim($validated['last_name']),
            'display_name'  => implode("_", [$validated['first_name'], $validated['last_name']]),
            'mobile'        => $validated['phone_number'],
            'full_name'     => implode(" ", [$validated['first_name'], $validated['last_name']]),
            'timezone'      => 'Asia/Kolkata',

        ];

        //Storing in session
        if(empty($request->session()->get('user'))) {
            //instantiate model and fill model instance save later
            //$user = new \App\Models\User();

            $mentor = new \App\Models\MentorProfile();

            //$user->fill($userData);

            $mentor->fill($mentorData);

            $request->session()->put('user', $user);

            $request->session()->put('mentor', $mentor);

        } else {
            $mentor = $request->session()->get('mentor');


            $user = $request->session()->get('user');

            //$user->fill($userData);
            //$mentor->fill($mentorData);


            $request->session()->put('user', $user);

            $request->session()->put('mentor', $mentor);

        }

        return redirect('mentor/step2');

    }
    public function createStep2(Request $request)
    {
        if(empty($request->session()->get('mentor'))) {
            return redirect('mentor/signup');

        }
        $onboarding = $request->session()->get('mentor');

        //dd($onboarding);
        //Data needed for rendering the page
        //service type choices
        $service_types = \App\Models\ServiceType::all();

        return view('front.mentor.onboarding.create-step2', ['serviceTypes' => $service_types, 'current_mentor' => $onboarding]);

        //$data                           = [];
        //$title                          = 'Mentor Signup';
        //$page_name                      = 'mentor-signup-2';
        //echo $this->front_before_login_layout($title, $page_name, $data);
    }
    public function postCreateStep2(Request $request)
    {
        if(empty($request->session()->get('mentor'))) {
            return \redirect('mentor/signup');
        }

        $mentor = $request->session()->get('mentor');

        $validator = Validator::make($request->all(), [
            'social_url'    => 'required',
            'profile_slug'  => ['required',
                                    new UniqueProfileSlug()],
            'registration_intent' => 'required',
            'intended_service_type' => 'required',

        ]);

        if($validator->fails()) {

            $username = $this->generateUniqueProfileSlug($mentor->display_name);


            return redirect('mentor/step2')
                        ->withErrors($validator)
                        ->withInput(['profile_slug' => $username]);



        }

        // Retrieve the validated input...
        $validated = $validator->validated();
        //process the form
        $mentor->social_url = $validated['social_url'];
        $mentor->display_name =  $validated['profile_slug'];
        $mentor->registration_intent = $validated['registration_intent'];
        //$request->session()->put('mentor', $mentor);

        //attaching service types to mentor
        if(empty($request->session()->get('mentor'))) {
            $request->session()->put('mentor', $mentor);

        }

        $mentor->save();

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

        $types2 =    \App\Models\ServiceType::with(['serviceAttributes' => function ($query) {
            $query->where('service_id', '=', 2);
        }])->get();




        return \view('front.mentor.onboarding.create-step3', ['services' => $services, 'types' => $types, 'mental_health' => $types2]);
    }

    public function postCreateStep3(Request $request)
    {
        //dd($request->all());


        $validator = Validator::make($request->all(), [
                    'service'     => 'required',
                    'services'    => 'required',


                ]);

        if($validator->fails()) {

            return redirect('mentor/create/step3')
                        ->withErrors($validator)
                        ->withInput();

        }


        // Retrieve the validated input...
        $validated = $validator->validated();

        $user = $request->session()->get('user');

        if(empty($user)) {
            //redirect back to step1
            return \redirect('mentor/signup');
        }

        foreach ($validated['services'] as $service) {
            $data = [];
            //service attribute details
            $serviceAttribute = \App\Models\ServiceAttribute::find($service);
            $data['service_attribute_id'] = $serviceAttribute->id;
            $data['mentor_user_id'] = $user->id;
            $data['title'] = $serviceAttribute->title;
            $data['description'] = $serviceAttribute->description;
            $data['duration'] = $serviceAttribute->duration;
            $data['sgst_amount'] = $serviceAttribute->actual_amount * 9 / 100;
            $data['cgst_amount'] = $serviceAttribute->actual_amount * 9 / 100;
            $data['igst_amount'] = $serviceAttribute->actual_amount * 18 / 100;
            $data['total_amount_payable'] = $serviceAttribute->actual_amount;
            $data['platform_charges'] = $serviceAttribute->actual_amount * 10 / 100;
            $data['mentor_payout_amount'] = $serviceAttribute->actual_amount - $data['platform_charges'];
            $data['promised_response_time'] = 30;
            $data['sort_order'] = 1;
            $data['countryid'] = 101;
            $data['service_url'] = ' ';
            //$insert_schedule[] = $data;
            \App\Models\ServiceDetail::create($data);
        }

        //dd($insert_schedule);


        /**
         if(empty($request->session()->get('mentor_to_service'))) {
             $serviceDetails = new \App\Models\ServiceDetail();

             $serviceDetails->fill($insert_schedule);

             $request->session()->put('mentor_to_service', $serviceDetails);

         } else {
             $serviceDetails = $request->session()->get('mentor_to_service');

             $serviceDetails->fill($insert_schedule);

             $request->session()->put('mentor_to_service', $serviceDetails);
         }
         */
        //data collect done proceed to next step

        return \redirect('mentor/step4');

    }

    public function createStep4()
    {
        $sortOrderWeekDay = [6,7,1,2,3,4,5]; // Your choices


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


        $period = \Carbon\CarbonPeriod::create($startPeriod, '15 minutes', $endPeriod)
            ->excludeEndDate();
        $documents = \App\Models\RequireDocument::where('user_type', '=', 'mentor')->get();


        foreach ($period as $date) {
            # code...
            $hours[] = array('name' => $date->format('h:i A'),
                             'value' => $date->format('Hi'),
                             'selected_from' => '0900',
                             'selected_to'   => '2000'
        );

        }

        //dd($hours);
        //return \view('front.mentor.onboarding.create-step4', ['slot_dropdown' => $hours, 'days' => $daysOfWeek, 'documents' => $documents]);

        return \view('front.mentor.onboarding.create-step4-v2', ['slot_dropdown' => $hours, 'days' => $sortedDaysOfWeek, 'documents' => $documents]);

    }

    public function postCreateStep4(Request $request)
    {
        //dd($request->all());
        if(empty($request->session()->get('mentor'))) {
            return \redirect('mentor/signup');
        }

        $mentor = $request->session()->get('mentor');



        $input = $request->all();

        $days = $request->input('day_of_week');

        $file = $request->input('docs_attachment');
        $file_insert_schedule = [];

        $request->validate(
            [
                       'docs_attachment.*' => 'nullable|mimes:jpeg,jpg,pdf,pdfs|max:1024',
        ],
            $messages = [
        "docs_attachment.*.mimes" => "Only PDF, JPEG are allowed.",
        "docs_attachment.*.max" => "Max file size must be 1Mb",
    ]
        );

        if($request->hasfile('docs_attachment')) {

            $saveDocument = new \App\Models\UserDocument();


            foreach($request->file('docs_attachment') as $key => $file) {

                $name = "mentor_attachment_" . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/mentor_attachment', $name);

                //get document id
                $document = \App\Models\RequireDocument::where('document', '=', $key)->first();

                $file_insert_schedule['document'] = $name;
                $file_insert_schedule['document_slug'] = $path;
                $file_insert_schedule['document_id'] = $document->id;
                $file_insert_schedule['user_id'] = $mentor->user_id;
                $file_insert_schedule['type'] = 'MENTOR';

                //$file_insert_schedule[] = $data;

            }

            Log::channel('custom')->info('Mentor Onboarding: file attachment'. var_export($file_insert_schedule, true));


            $saveDocument->fill($file_insert_schedule);

        }


        $availabilities = $request->input('availability');

        //Duration
        $durations = $request->input('duration');

        //No of Slots
        $no_of_slots = $request->input('no_of_slot');

        $insert_schedule = [];

        foreach ($days as $key => $value) {
            $day_id = $key;
            $data = [];
            if(is_array($availabilities['from'][$day_id])) {
                $data['day_of_week_id'] = $day_id;
                $duration = $durations[$day_id];
                $no_of_slot = $no_of_slots[$day_id];
                foreach($availabilities['from'][$day_id] as $key => $value) {

                    $data['avail_from'] = date('H:i:s', strtotime($value));
                    $data['duration'] = $duration;
                    $data['no_of_slot'] = $no_of_slot;
                    $data['avail_to'] = date('H:i:s', strtotime($availabilities['to'][$day_id][$key]));
                    $data['mentor_user_id'] = $mentor->user_id;
                    $data['is_active'] = 1;
                    $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                    $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();



                    $insert_schedule[] = $data;

                }


            }
        }

        //dd($insert_schedule);

        if(empty($request->session()->get('mentor_availabilities'))) {

            $availability = new \App\Models\MentorAvailability();
            //$availabilityModel->fill($insert_schedule);
            $request->session()->put('mentor_availabilities', $availability);

        } else {
            $availability = $request->session()->get('mentor_availabilities');
            //$availabilityModel->fill($insert_schedule);
            $request->session()->put('mentor_availabilities', $availability);

        }
        //dd($insert_schedule);
        $availability::insert($insert_schedule);
        if(!empty($file_insert_schedule)) {
            //Saving files
            $saveDocument->save();
        }

        //get user
        // $user = \App\Models\User::where('id', '=', $mentor->user_id)->first();
        // $request->session()->put('user_id', $mentor->user_id);
        // $request->session()->put('name', $user->name);
        // $request->session()->put('fname', ($user) ?? $user->first_name);
        // $request->session()->put('lname', ($user) ?? $user->last_name);
        // $request->session()->put('email', $user->email);
        // $request->session()->put('role', $user->role);
        // $request->session()->put('is_user_login', 1);


        /* user activity */
        // $activityData = [
        //     'user_email'        => $user->email,
        //     'user_name'         => $user->name,
        //     'user_type'         => 'USER',
        //     'ip_address'        => $request->ip(),
        //     'activity_type'     => 10,
        //     'activity_details'  => 'Signup Success !!!',
        //     'platform_type'     => 'WEB',
        // ];


        // \App\Models\UserActivity::insert($activityData);

        $request->session()->flush();


        return redirect('signin');

        // dd('unauthenticated');

    }

    public function getTimeSlotItem(Request $request)
    {
        if (!request()->action) {
            abort('500');
        }

        $data = $request->validate([
            'day' => 'required',
            'action' => 'required'
        ]);

        $daysOfWeek[] = \App\Models\DayOfWeek::where('day_text', $data['day'])->first();


        $startPeriod = \Carbon\Carbon::parse('00:00');
        $endPeriod   = \Carbon\Carbon::parse('24:00');


        $period = \Carbon\CarbonPeriod::create($startPeriod, '15 minutes', $endPeriod)
            ->excludeEndDate();


        foreach ($period as $date) {
            # code...
            $hours[] = array('name' => $date->format('h:i A'),
                             'value' => $date->format('Hi'),
                             'selected_from' => '0900',
                             'selected_to'   => '2000'
                );

        }

        $actionClass = $data['action'] !== 'stumentoAjx_new_slot_add' ? 'deleteItem' : 'add__slot__parent';
        $iconClass = $data['action'] !== 'stumentoAjx_new_slot_add' ? 'minus' : 'plus';


        if ($request->ajax()) {
            $html = \View::make('components.nested-time-schedule')
            ->with(['daysOfWeek' => $daysOfWeek,
                     'slot_dropdown' => $hours,
                     'actionclass' =>  $actionClass,
                    'iconclass' =>  $iconClass,
                    ])
            ->render();
            return response()->json(['html' => $html,
                                    'containerIdentity' => strtolower($daysOfWeek[0]->day_text),
                                    ]);
        }

    }

    public function renderComponentAfterChange(Request $request)
    {

        if (!request()->action) {
            abort('500');
        }

        $durationDataSource = array([
            'id' => 30,
            'text' => '30 mins'

        ],
        [
            'id' => 60,
            'text' => '60 mins'

        ],
    );

        $timeSlotsDataSource = array(
                [
                "id" => 1,
                "text" => 'One',

            ],
            [
                "id" => 2,
                "text" => 'Two'
            ],
            [
                "id" => 3,
                "text" => 'Three'
            ],
            [
                "id" => 4,
                "text" => 'Four'
            ],
            [
                "id" => 5,
                "text" => 'Five'
            ],
            [
                "id" => 6,
                "text" => 'Six'
            ],
            [
                "id" => 7,
                "text" => 'Seven'
            ],
            [
                "id" => 8,
                "text" => 'Eight'
            ],
            [
                "id" => 9,
                "text" => 'Nine'
            ],
            [
                "id" => 10,
                "text" => 'Ten',

            ],
            [
               "id" => 11,
               "text" => 'Eleven',


            ]
        );


        $data = $request->validate([
                    'day' => 'required',
                    'fromTime' => 'required',
                    'duration' => 'required',
                    'slots'    => 'required',
                    'endTime'   => 'required',
                    'action' => 'required'
                ]);

        $daysOfWeek[] = \App\Models\DayOfWeek::where('day', $data['day'])->first();


        $startPeriod = \Carbon\Carbon::parse('00:00');
        $endPeriod   = \Carbon\Carbon::parse('24:00');


        $period = \Carbon\CarbonPeriod::create($startPeriod, '15 minutes', $endPeriod)
                    ->excludeEndDate();

        $fromTime = \Carbon\Carbon::parse($data['fromTime']);

        $endTime = $fromTime->addMinutes($data['slots'] * $data['duration']);



        foreach ($period as $date) {
            # code...
            $hours[] = array('name' => $date->format('h:i A'),
                             'value' => $date->format('Hi'),
                             'selected_from' => $data['fromTime'],
                             'selected_to'   => $endTime->format('Hi'),
                );

        }


        $actionClass = $data['action'] !== 'stumento__ajax__update__slot' ? 'deleteItem' : 'add__slot__parent';
        $iconClass = $data['action'] !== 'stumento__ajax__update__slot' ? 'minus' : 'plus';

        //return options data duration
        foreach ($durationDataSource as &$value) {
            # code...
            if(in_array($value['id'], [$data['duration']])) {
                $value['selected'] = true;
            }
        }

        //return options data no. of slots

        foreach ($timeSlotsDataSource as &$value) {
            # code...
            if(in_array($value['id'], [$data['slots']])) {
                $value['selected'] = true;
            }
        }



        if ($request->ajax()) {
            $html = \View::make('components.nested-time-schedule')
            ->with(['daysOfWeek' => $daysOfWeek,
                     'slot_dropdown' => $hours,
                     'actionclass' =>  $actionClass,
                    'iconclass' =>  $iconClass,
                    ])
            ->render();
            return response()->json(['html' => $html,
                                    'containerIdentity' => strtolower($daysOfWeek[0]->day_text),
                                    'selectedTimeFrom'  => $data['fromTime'],
                                    'durations'  => $durationDataSource,
                                    'slots'      => $timeSlotsDataSource,
                                    ]);
        }









    }

    public function generateUniqueProfileSlug($fullName, $length = 5)
    {

        $username = strtolower(str_replace(' ', '_', $fullName));

        while(\App\Models\MentorProfile::where('display_name', $username)->exists()) {
            $randomString = Str::random($length);
            $username = $username . $randomString;
        }

        return $username;


    }
    /* authentication */
}
