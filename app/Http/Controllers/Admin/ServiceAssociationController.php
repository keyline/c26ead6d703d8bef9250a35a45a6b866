<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\GeneralSetting;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceAttribute;
use App\Models\ServiceTypeAttribute;
use Auth;
use Session;
use Helper;
use Hash;

class ServiceAssociationController extends Controller
{
    public function __construct()
    {        
        $this->data = array(
            'title'             => 'Service Association',
            'controller'        => 'ServiceAssociationController',
            'controller_route'  => 'service-association',
        );
    }
    public function index(){
        $data['module']                 = $this->data;
        $title                          = $this->data['title'].' Add';
        $page_name                      = 'service-association.index';
        $data['row']                    = [];
        $data['serviceTypes']           = ServiceType::where('status', '=', 1)->get();
        $data['serviceAttributes']      = ServiceAttribute::where('status', '=', 1)->get();
        $data['services']               = Service::where('status', '=', 1)->get();
        echo $this->admin_after_login_layout($title,$page_name,$data);
    }
    public function postData(Request $request){
        $postData = $request->all();
        $rules = [
            'service_type_id'           => 'required',
            'service_id'                => 'required',
            'service_attribute_id'      => 'required',
        ];
        if($this->validate($request, $rules)){
                $fields = [
                    'service_id'                => $postData['service_id'],
                    'service_type_id'           => $postData['service_type_id'],
                    'service_attribute_id'      => $postData['service_attribute_id']
                ];
                ServiceTypeAttribute::insert($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/")->with('success_message', $this->data['title'].' Inserted Successfully !!!');
        } else {
            return redirect()->back()->with('error_message', 'All Fields Required !!!');
        }
    } 

}
