<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\GeneralSetting;
use App\Models\Faq;
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
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' List';
            $page_name                      = 'bookings.list';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
}
