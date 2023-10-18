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
use App\Models\Withdrawl;

use Auth;
use Session;
use Helper;
use Hash;

class WithdrawlController extends Controller
{
    public function __construct()
    {        
        $this->data = array(
            'title'             => 'Withdrawl Request',
            'controller'        => 'WithdrawlController',
            'controller_route'  => 'withdrawls',
            'primary_key'       => 'id',
        );
    }
    /* list */
        public function list(){
            $data['module']                 = $this->data;
            $data['withdrawls']             = Withdrawl::orderBy('id', 'DESC')->get();

            $title                          = $this->data['title'].' List';
            $page_name                      = 'withdrawls.list';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
    /* change status */
        public function change_status(Request $request, $id, $status){
            $id                             = Helper::decoded($id);
            $status                         = Helper::decoded($status);
            $model                          = Withdrawl::find($id);

            if($status == 1){
                $model->status  = $status;
                $msg            = 'Accepted';
                // update mentor payment
                    $request_booking_ids    = json_decode($model->request_booking_ids);
                    if(!empty($request_booking_ids)){
                        for($b=0;$b<count($request_booking_ids);$b++){
                            $getBooking             = MentorPayment::where('booking_id', '=', $request_booking_ids[$b])->first();
                            $fields = [
                                'status'                     => 2
                            ];
                            MentorPayment::where('booking_id', '=', $request_booking_ids[$b])->update($fields);

                            // deduct payment
                                $payment_id = $request_booking_ids[$b];
                                /* admin payments */
                                    $generalSetting             = GeneralSetting::find('1');
                                    $booking                    = Booking::where('id', '=', $payment_id)->first();
                                    $adminBalance               = $this->getAdminBalance();
                                    $transactionAmt             = $model->request_amount;
                                    $closing_amt                = ($adminBalance - $transactionAmt);
                                    $fields2        = array(
                                                    'type'                  => 'DEBIT',
                                                    'mentor_id'             => $booking->mentor_id,
                                                    'booking_id'            => $payment_id,
                                                    'opening_amt'           => $adminBalance,
                                                    'student_pay_amt'       => $transactionAmt,
                                                    'closing_amt'           => $closing_amt,
                                                    'gst_percent'           => 0,
                                                    'gst_amount'            => 0,
                                                    'admin_commision'       => 0,
                                                    'mentor_commision'      => 0,
                                                );
                                    // Helper::pr($fields2,0);
                                    AdminPayment::insert($fields2);
                                /* admin payments */
                                /* mentor payments */
                                    $mentorBalance              = $this->getMentorBalance($booking->mentor_id);
                                    $mentor_closing_amt         = ($mentorBalance - $transactionAmt);
                                    $fields3        = array(
                                                    'type'                  => 'DEBIT',
                                                    'mentor_id'             => $booking->mentor_id,
                                                    'booking_id'            => $payment_id,
                                                    'opening_amt'           => $mentorBalance,
                                                    'transaction_amt'       => $transactionAmt,
                                                    'closing_amt'           => $mentor_closing_amt
                                                );
                                    // Helper::pr($fields3,0);
                                    MentorPayment::insert($fields3);
                                /* mentor payments */
                            // deduct payment
                        }
                    }
                    // die;
                // update mentor payment
            } elseif($status == 3){
                $model->status  = $status;
                $msg            = 'Rejected';
                // update mentor payment
                    $request_booking_ids    = json_decode($model->request_booking_ids);
                    // Helper::pr($request_booking_ids);
                    if(!empty($request_booking_ids)){
                        for($b=0;$b<count($request_booking_ids);$b++){
                            $getBooking             = MentorPayment::where('booking_id', '=', $request_booking_ids[$b])->first();
                            $fields = [
                                'status'                     => 0
                            ];
                            MentorPayment::where('booking_id', '=', $request_booking_ids[$b])->update($fields);
                        }
                    }
                // update mentor payment
            }            
            $model->save();
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' '.$msg.' Successfully !!!');
        }
    /* change status */
}
