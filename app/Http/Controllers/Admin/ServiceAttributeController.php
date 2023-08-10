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

class ServiceAttributeController extends Controller
{
    public function __construct()
    {        
        $this->data = array(
            'title'             => 'Service Attribute',
            'controller'        => 'ServiceAttributeController',
            'controller_route'  => 'service-attribute',
            'primary_key'       => 'id',
        );
    }
    /* list */
        public function list(){
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' List';
            $page_name                      = 'service-attribute.list';
            // $data['rows']                   = ServiceAttribute::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
            $data['rows']                   = DB::table('service_type_attribute')
                                                ->join('service_types', 'service_type_attribute.service_type_id', '=', 'service_types.id')
                                                ->join('services', 'service_type_attribute.service_id', '=', 'services.id')
                                                ->join('service_attributes', 'service_type_attribute.service_attribute_id', '=', 'service_attributes.id')
                                                ->select('service_attributes.*', 'service_types.name AS service_type_name', 'services.name AS service_name')
                                                ->where('service_attributes.status', '!=', 3)
                                                ->orderBy('service_attributes.id', 'DESC')
                                                ->get();
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
    /* add */
        public function add(Request $request){
            $data['module']           = $this->data;
            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'service_type_id'           => 'required',
                    'service_id'                => 'required',
                    'title'                     => 'required',
                    'description'               => 'required',
                    'duration'                  => 'required',
                    'actual_amount'             => 'required',
                    'slashed_amount'            => 'required',
                ];
                if($this->validate($request, $rules)){
                    $fields = [
                        'title'                     => $postData['title'],
                        'slug'                      => Helper::clean($postData['title']),
                        'description'               => $postData['description'],
                        'duration'                  => $postData['duration'],
                        'actual_amount'             => $postData['actual_amount'],
                        'slashed_amount'            => $postData['slashed_amount'],
                    ];
                    $service_attribute_id  = ServiceAttribute::insertGetId($fields);
                    /* service type attribute table insertion */
                        $fields2 = [
                            'service_type_id'           => $postData['service_type_id'],
                            'service_attribute_id'      => $service_attribute_id,
                            'service_id'                => $postData['service_id']
                        ];
                        ServiceTypeAttribute::insert($fields2);
                    /* service type attribute table insertion */
                    return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Inserted Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' Add';
            $page_name                      = 'service-attribute.add-edit';
            $data['row']                    = [];
            $data['serviceTypes']           = ServiceType::where('status', '=', 1)->get();
            $data['services']               = Service::where('status', '=', 1)->get();
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* add */
    /* edit */
        public function edit(Request $request, $id){
            $data['module']                 = $this->data;
            $id                             = Helper::decoded($id);
            $title                          = $this->data['title'].' Update';
            $page_name                      = 'service-attribute.add-edit';
            // $data['row']                    = ServiceAttribute::where($this->data['primary_key'], '=', $id)->first();
            $data['row']                    = DB::table('service_type_attribute')
                                                ->join('service_attributes', 'service_type_attribute.service_attribute_id', '=', 'service_attributes.id')
                                                ->select('*')
                                                ->where('service_attributes.id', '=', $id)
                                                ->first();
            // Helper::pr($data['row']);

            $data['serviceTypes']           = ServiceType::where('status', '=', 1)->get();
            $data['services']               = Service::where('status', '=', 1)->get();

            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'service_type_id'           => 'required',
                    'service_id'                => 'required',
                    'title'                      => 'required',
                    'description'               => 'required',
                    'duration'                  => 'required',
                    'actual_amount'             => 'required',
                    'slashed_amount'            => 'required',
                ];
                if($this->validate($request, $rules)){
                    $fields = [
                        'title'                     => $postData['title'],
                        'slug'                      => Helper::clean($postData['title']),
                        'description'               => $postData['description'],
                        'duration'                  => $postData['duration'],
                        'actual_amount'             => $postData['actual_amount'],
                        'slashed_amount'            => $postData['slashed_amount'],
                        'updated_at'                => date('Y-m-d H:i:s')
                    ];
                    ServiceAttribute::where($this->data['primary_key'], '=', $id)->update($fields);

                    /* service type attribute table insertion */
                        $fields2 = [
                            'service_type_id'           => $postData['service_type_id'],
                            'service_id'                => $postData['service_id']
                        ];
                        ServiceTypeAttribute::where('service_attribute_id', '=', $id)->update($fields2);
                    /* service type attribute table insertion */

                    return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Updated Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* edit */
    /* delete */
        public function delete(Request $request, $id){
            $id                             = Helper::decoded($id);
            $fields = [
                'status'             => 3
            ];
            ServiceAttribute::where($this->data['primary_key'], '=', $id)->update($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Deleted Successfully !!!');
        }
    /* delete */
    /* change status */
        public function change_status(Request $request, $id){
            $id                             = Helper::decoded($id);
            $model                          = ServiceAttribute::find($id);
            if ($model->status == 1)
            {
                $model->status  = 0;
                $msg            = 'Deactivated';
            } else {
                $model->status  = 1;
                $msg            = 'Activated';
            }            
            $model->save();
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' '.$msg.' Successfully !!!');
        }
    /* change status */
}
