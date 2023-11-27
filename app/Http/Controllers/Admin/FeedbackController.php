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
use App\Models\Booking;
use App\Models\BookingRating;
use App\Models\AdminPayment;
use App\Models\MentorPayment;

use Auth;
use Session;
use Helper;
use Hash;

class FeedbackController extends Controller
{
    public function __construct()
    {        
        $this->data = array(
            'title'             => 'Booking Reviews',
            'controller'        => 'FeedbackController',
            'controller_route'  => 'feedbacks',
            'primary_key'       => 'id',
        );
    }
    /* list */
        public function list(){
            $data['module']                 = $this->data;
            $data['feedbacks']              = BookingRating::where('status', '!=', 3)->orderBy('id', 'DESC')->get();

            $title                          = $this->data['title'].' List';
            $page_name                      = 'feedbacks.list';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
    /* change status */
        public function change_status(Request $request, $id){
            $id                             = Helper::decoded($id);
            $model                          = BookingRating::find($id);
            if ($model->status == 1)
            {
                $model->status              = 0;
                $model->approve_tmestamp    = '';
                $msg                        = 'Disapproved';
            } else {
                $model->status              = 1;
                $model->approve_tmestamp    = date('Y-m-d H:i:s');
                $msg                        = 'Approved';
            }            
            $model->save();
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' '.$msg.' Successfully !!!');
        }
    /* change status */
    /* delete */
        public function delete(Request $request, $id){
            $id                             = Helper::decoded($id);
            $fields = [
                'status'             => 3
            ];
            BookingRating::where($this->data['primary_key'], '=', $id)->update($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Deleted Successfully !!!');
        }
    /* delete */
}
