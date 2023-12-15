<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\GeneralSetting;
use App\Models\ServiceType;
use Auth;
use Session;
use Helper;
use Hash;

class ServiceTypeController extends Controller
{
    public function __construct()
    {        
        $this->data = array(
            'title'             => 'Service Type',
            'controller'        => 'ServiceTypeController',
            'controller_route'  => 'service-type',
            'primary_key'       => 'id',
        );
    }
    /* list */
        public function list(){
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' List';
            $page_name                      = 'service-type.list';
            $data['rows']                   = ServiceType::where('status', '!=', 3)->orderBy('rank', 'ASC')->get();
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
    /* add */
        public function add(Request $request){
            $data['module']           = $this->data;
            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'name'                      => 'required',
                    'homepage_service_title'    => 'required',
                    'description'               => 'required',
                ];
                if($this->validate($request, $rules)){
                    /* image */
                        $imageFile      = $request->file('image');
                        if($imageFile != ''){
                            $imageName      = $imageFile->getClientOriginalName();
                            $uploadedFile   = $this->upload_single_file('image', $imageName, 'service_type', 'image');
                            if($uploadedFile['status']){
                                $image = $uploadedFile['newFilename'];
                            } else {
                                return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                            }
                        } else {
                            return redirect()->back()->with(['error_message' => 'Please Upload Banner Image !!!']);
                        }
                    /* image */
                    $fields = [
                        'name'                      => $postData['name'],
                        'homepage_service_title'    => $postData['homepage_service_title'],
                        'slug'                      => Helper::clean($postData['name']),
                        'description'               => $postData['description'],
                        'image'                     => $image,
                        'rank'                      => (ServiceType::where('status', '!=', 3)->max('rank'))+1,
                    ];
                    ServiceType::insert($fields);
                    return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Inserted Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' Add';
            $page_name                      = 'service-type.add-edit';
            $data['row']                    = [];
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* add */
    /* edit */
        public function edit(Request $request, $id){
            $data['module']                 = $this->data;
            $id                             = Helper::decoded($id);
            $title                          = $this->data['title'].' Update';
            $page_name                      = 'service-type.add-edit';
            $data['row']                    = ServiceType::where($this->data['primary_key'], '=', $id)->first();
            
            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'name'                      => 'required',
                    'homepage_service_title'    => 'required',
                    'description'               => 'required',
                ];
                if($this->validate($request, $rules)){
                    /* image */
                        $imageFile      = $request->file('image');
                        if($imageFile != ''){
                            $imageName      = $imageFile->getClientOriginalName();
                            $uploadedFile   = $this->upload_single_file('image', $imageName, 'service_type', 'image');
                            if($uploadedFile['status']){
                                $image = $uploadedFile['newFilename'];
                            } else {
                                return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                            }
                        } else {
                            $image = $data['row']->image;
                        }
                    /* image */
                    $fields = [
                        'name'                      => $postData['name'],
                        'homepage_service_title'    => $postData['homepage_service_title'],
                        'slug'                      => Helper::clean($postData['name']),
                        'description'               => $postData['description'],
                        'image'                     => $image,
                        'updated_at'                => date('Y-m-d H:i:s')
                    ];
                    ServiceType::where($this->data['primary_key'], '=', $id)->update($fields);
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
            ServiceType::where($this->data['primary_key'], '=', $id)->update($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Deleted Successfully !!!');
        }
    /* delete */
    /* change status */
        public function change_status(Request $request, $id){
            $id                             = Helper::decoded($id);
            $model                          = ServiceType::find($id);
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
    /* sorting */
        public function sorting(Request $request){
            $id                             = $request->id;
            $rank                           = $request->rank;
            $fields = [
                'rank'             => $rank
            ];
            ServiceType::where($this->data['primary_key'], '=', $id)->update($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Ranked Successfully !!!');
        }
    /* sorting */
}
