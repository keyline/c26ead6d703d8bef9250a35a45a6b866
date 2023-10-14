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
        public function list(){
            $data['module']                         = $this->data;
            $data['all_bookings']                   = Booking::where('status', '>=', 1)->orderBy('id', 'DESC')->get();
            $data['upcoming_bookings']              = Booking::where('status', '=', 1)->orderBy('id', 'DESC')->get();
            $data['past_bookings']                  = Booking::where('status', '=', 2)->orderBy('id', 'DESC')->get();

            $title                                  = $this->data['title'].' List';
            $page_name                              = 'bookings.list';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
}
