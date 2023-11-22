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

use Auth;
use Session;
use Helper;
use Hash;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->data = array(
            'title'             => 'Transaction',
            'controller'        => 'TransactionController',
            'controller_route'  => 'transactions',
            'primary_key'       => 'id',
        );
    }
    /* list */
    public function list()
    {
        $data['module']                 = $this->data;
        $data['transactions']           = AdminPayment::where('status', '=', 1)->orderBy('id', 'DESC')->get();

        $title                          = $this->data['title'] . ' List';
        $page_name                      = 'transactions.list';
        echo $this->admin_after_login_layout($title, $page_name, $data);
    }
    /* list */
    /* transactions */

    public function transactionsExport()
    {
        $data['title']                  = 'Transaction Data Export';
        $page_name                      = 'transaction-export';
        $transactions                   =  AdminPayment::where('status', '=', 1)->orderBy('id', 'DESC')->get();
        $data['rows']                   = [];

        if ($transactions) {
            foreach ($transactions as $val) {
                $mentor_dtl = $student_dtl = [];
                $booking =  Booking::where('id', '=', $val->booking_id)->first();
                if ($booking) {
                    $mentor = User::where('id', '=', $booking->mentor_id)->first();
                    $student = User::where('id', '=', $booking->student_id)->first();

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
                }

                $data['rows'][] = [
                    'type'          => ucfirst(strtolower($val->type)),
                    'request_date'  => date_format(date_create($val->created_at), "M d, Y h:i A"),
                    'booking_no'    => $booking->booking_no,
                    'mentor'        => $mentor_dtl,
                    'student'       => $student_dtl,
                    'opening_balance'    => number_format($val->closing_amt, 2),
                    'transaction_amount' => number_format($val->closing_amt, 2),
                    'closing_balance'    => number_format($val->closing_amt, 2)
                ];
            }
        }
        return view('admin.maincontents.' . $page_name, $data);
    }
}
