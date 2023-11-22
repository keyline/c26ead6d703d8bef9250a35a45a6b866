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
use App\Models\MentorProfile;
use App\Models\UserDocument;
use App\Models\MentorAvailability;
use App\Models\MentorSlot;
use App\Models\BookingRating;
use App\Models\Booking;
use App\Models\AdminPayment;
use App\Models\MentorPayment;
use App\Models\Service;
use App\Models\ServiceType;
use Auth;
use Session;
use Helper;
use Hash;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->data = array(
            'title'             => 'Booking',
            'controller'        => 'BookingController',
            'controller_route'  => 'bookings',
            'primary_key'       => 'id',
        );
    }
    /* list */
    public function list()
    {
        $data['module']                         = $this->data;
        $data['all_bookings']                   = Booking::where('status', '>=', 1)->where('payment_status', '=', 1)->orderBy('id', 'DESC')->get();
        $data['upcoming_bookings']              = Booking::where('status', '=', 1)->where('payment_status', '=', 1)->orderBy('id', 'DESC')->get();
        $data['past_bookings']                  = Booking::where('status', '=', 2)->where('payment_status', '=', 1)->orderBy('id', 'DESC')->get();
        $data['unpaid_bookings']                = Booking::where('status', '=', 0)->where('payment_status', '=', 0)->orderBy('id', 'DESC')->get();

        $title                                  = $this->data['title'] . ' List';
        $page_name                              = 'bookings.list';
        echo $this->admin_after_login_layout($title, $page_name, $data);
    }
    /* list */

    // Booking Export

    public function bookingExport()
    {
        $data['title']                  = 'Transaction Data Export';
        $page_name                      = 'booking-export';
        $bookings                       =  Booking::orderBy('id', 'DESC')->get();
        $data['rows']                   =  [];
        // $tot_payment_amt = $tot_gst_amt = $tot_admin_amt = $tot_mentor_amt = 0;
        if ($bookings) {
            foreach ($bookings as $booking) {
                $mentor   = User::where('id', '=', $booking->mentor_id)->first();
                $student  = User::where('id', '=', $booking->student_id)->first();
                $wallet   = AdminPayment::where('booking_id', '=', $booking->id)->first();
                $service_type = ServiceType::select('name')->where('id', '=', $booking->service_type_id)->first();
                $service = Service::select('name')->where('id', '=', $booking->service_id)->first();
                // mentor dtl
                if ($mentor) {
                    $mentor_dtl = [
                        'name' => $mentor->name,
                        'email' => $mentor->email,
                        'phone' => $mentor->phone,
                    ];
                }

                // student dtl
                if ($student) {
                    $student_dtl = [
                        'name' => $student->name,
                        'email' => $student->email,
                        'phone' => $student->phone,
                    ];
                }


                $data['rows'][] = [
                    'booking_no'    => $booking->booking_no,
                    'booking_date'  => date_format(date_create($booking->booking_date), "M d, Y"),
                    'mentor'        => $mentor_dtl,
                    'student'       => $student_dtl,
                    'service_type'  => $service_type ? $service_type->name : '',
                    'service'       => $service ? $service->name : '',
                    'duration'      => $booking->duration . ' mins',
                    'student_pay'   => number_format($booking->payment_amount, 2),
                    'gst'           => number_format($booking->gst_amount, 2),
                    'mentor_commission'   => number_format((($wallet) ? $wallet->mentor_commision : 0), 2),
                    'admin_commission'    => number_format((($wallet) ? $wallet->admin_commision : 0), 2),
                    'payment_status'      => $booking->payment_status == 0 ? 'Unpaid' : 'Paid',
                    'status'              => $booking->status != 0 ? ($booking->status == 2 ? 'Past bookings' : 'Upcoming bookings') : '',
                ];
            }
        }




        return view('admin.maincontents.' . $page_name, $data);
    }
}
