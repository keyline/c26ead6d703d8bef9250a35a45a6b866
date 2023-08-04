<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\GeneralSetting;
use App\Models\BlogCategory;
use App\Models\Blog;
use Auth;
use Session;
use Helper;
use Hash;

class BlogController extends Controller
{
    public function __construct()
    {        
        $this->data = array(
            'title'             => 'Blog',
            'controller'        => 'BlogController',
            'controller_route'  => 'blog',
            'primary_key'       => 'id',
        );
    }
    /* list */
        public function list(){
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' List';
            $page_name                      = 'blog.list';
            $data['rows']                   = Blog::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
    /* add */
        public function add(Request $request){
            $data['module']           = $this->data;
            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'blog_category'             => 'required',
                    'title'                     => 'required',
                    'content_date'              => 'required',
                    'short_description'         => 'required',
                    'description'               => 'required',
                ];
                if($this->validate($request, $rules)){
                    /* blog image */
                        $imageFile      = $request->file('image');
                        if($imageFile != ''){
                            $imageName      = $imageFile->getClientOriginalName();
                            $uploadedFile   = $this->upload_single_file('image', $imageName, 'blog', 'image');
                            if($uploadedFile['status']){
                                $image = $uploadedFile['newFilename'];
                            } else {
                                return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                            }
                        } else {
                            return redirect()->back()->with(['error_message' => 'Please Upload Blog Image !!!']);
                        }
                    /* blog image */
                    $fields = [
                        'blog_category'             => $postData['blog_category'],
                        'title'                     => $postData['title'],
                        'slug'                      => Helper::clean($postData['title']),
                        'content_date'              => date_format(date_create($postData['content_date']), "Y-m-d"),
                        'short_description'         => $postData['short_description'],
                        'description'               => $postData['description'],
                        'image'                     => $image
                    ];
                    Blog::insert($fields);
                    return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Inserted Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' Add';
            $page_name                      = 'blog.add-edit';
            $data['row']                    = [];
            $data['blogCats']               = BlogCategory::where('status', '=', 1)->get();
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* add */
    /* edit */
        public function edit(Request $request, $id){
            $data['module']                 = $this->data;
            $id                             = Helper::decoded($id);
            $title                          = $this->data['title'].' Update';
            $page_name                      = 'blog.add-edit';
            $data['row']                    = Blog::where($this->data['primary_key'], '=', $id)->first();
            $data['blogCats']               = BlogCategory::where('status', '=', 1)->get();

            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'blog_category'             => 'required',
                    'title'                     => 'required',
                    'content_date'              => 'required',
                    'short_description'         => 'required',
                    'description'               => 'required',
                ];
                if($this->validate($request, $rules)){
                    /* blog image */
                        $imageFile      = $request->file('image');
                        if($imageFile != ''){
                            $imageName      = $imageFile->getClientOriginalName();
                            $uploadedFile   = $this->upload_single_file('image', $imageName, 'blog', 'image');
                            if($uploadedFile['status']){
                                $image = $uploadedFile['newFilename'];
                            } else {
                                return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                            }
                        } else {
                            $image = $data['row']->image;
                        }
                    /* blog image */
                    $fields = [
                        'blog_category'             => $postData['blog_category'],
                        'title'                     => $postData['title'],
                        'slug'                      => Helper::clean($postData['title']),
                        'content_date'              => date_format(date_create($postData['content_date']), "Y-m-d"),
                        'short_description'         => $postData['short_description'],
                        'description'               => $postData['description'],
                        'image'                     => $image,
                        'updated_at'                => date('Y-m-d H:i:s')
                    ];
                    Blog::where($this->data['primary_key'], '=', $id)->update($fields);
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
            Blog::where($this->data['primary_key'], '=', $id)->update($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Deleted Successfully !!!');
        }
    /* delete */
    /* change status */
        public function change_status(Request $request, $id){
            $id                             = Helper::decoded($id);
            $model                          = Blog::find($id);
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
