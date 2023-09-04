<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /* home */
    public function home(){
        $data[]         = [];
        $title          = 'Dashboard';
        $page_name      = 'index';
        echo $this->front_dashboard_layout($title,$page_name,$data);
    }
    /* home */
    /*profile*/
    public function profile(){
        $data[]         = [];
        $title          = 'Profile';
        $page_name      = 'profile';
        echo $this->front_dashboard_layout($title,$page_name,$data);
    }
    /*profile*/
    /*mentor-availability*/
    public function mentorAvailability(){
        $data[]         = [];
        $title          = 'Mentor Availability';
        $page_name      = 'mentor-availability';
        echo $this->front_dashboard_layout($title,$page_name,$data);
    }
    /*mentor-availability*/
    /*mentor-services */
    public function mentorServices(){
        $data[]         = [];
        $title          = 'Mentor Services';
        $page_name      = 'mentor-services';
        echo $this->front_dashboard_layout($title,$page_name,$data);
    }
    /*mentor-services */
}
