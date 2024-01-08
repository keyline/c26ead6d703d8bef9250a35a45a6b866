<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\GeneralSetting;
use App\Models\MetaInformation;
use Auth;
use Session;
use Helper;
use Hash;

class MetaController extends Controller
{
    public function __construct()
    {        
        $this->data = array(
            'title'             => 'Meta Information',
            'controller'        => 'MetaController',
            'controller_route'  => 'meta',
            'primary_key'       => 'id',
        );
    }
    /* list */
        public function list(){
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' List';
            $page_name                      = 'meta.list';
            $data['rows']                   = MetaInformation::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
    /* add */
        public function add(Request $request){
            $data['module']           = $this->data;
            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'page_link'                     => 'required',
                    'page_title'                    => 'required',
                    'meta_keyword'                  => 'required',
                    'meta_description'              => 'required',
                ];
                if($this->validate($request, $rules)){
                    $url = url('/');
                    $page_slug = explode($url.'/', $postData['page_link']);
                    $fields = [
                        'page_link'                         => $postData['page_link'],
                        'page_slug'                         => $page_slug[1],
                        'page_title'                        => $postData['page_title'],
                        'meta_keyword'                      => $postData['meta_keyword'],
                        'meta_description'                  => $postData['meta_description'],
                    ];
                    // Helper::pr($fields);
                    MetaInformation::insert($fields);
                    return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Inserted Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' Add';
            $page_name                      = 'meta.add-edit';
            $data['row']                    = [];
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* add */
    /* edit */
        public function edit(Request $request, $id){
            $data['module']                 = $this->data;
            $id                             = Helper::decoded($id);
            $title                          = $this->data['title'].' Update';
            $page_name                      = 'meta.add-edit';
            $data['row']                    = MetaInformation::where($this->data['primary_key'], '=', $id)->first();
            
            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'page_link'                     => 'required',
                    'page_title'                    => 'required',
                    'meta_keyword'                  => 'required',
                    'meta_description'              => 'required',
                ];
                if($this->validate($request, $rules)){
                    $url = url('/');
                    $page_slug = explode($url.'/', $postData['page_link']);
                    $fields = [
                        'page_link'                         => $postData['page_link'],
                        'page_slug'                         => $page_slug[1],
                        'page_title'                        => $postData['page_title'],
                        'meta_keyword'                      => $postData['meta_keyword'],
                        'meta_description'                  => $postData['meta_description'],
                    ];
                    MetaInformation::where($this->data['primary_key'], '=', $id)->update($fields);
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
            MetaInformation::where($this->data['primary_key'], '=', $id)->update($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Deleted Successfully !!!');
        }
    /* delete */
    /* change status */
        public function change_status(Request $request, $id){
            $id                             = Helper::decoded($id);
            $model                          = MetaInformation::find($id);
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
            MetaInformation::where($this->data['primary_key'], '=', $id)->update($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Ranked Successfully !!!');
        }
    /* sorting */
}