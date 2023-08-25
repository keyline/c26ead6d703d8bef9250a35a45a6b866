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
use App\Models\BlogContent;
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
                    'slug'                      => 'required',
                    'content_date'              => 'required',
                    'short_description'         => 'required',
                    'description'               => 'required',
                    'meta_title'                => 'required',
                    'meta_keyword'              => 'required',
                    'meta_description'          => 'required',
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
                        'slug'                      => Helper::clean($postData['slug']),
                        'content_date'              => date_format(date_create($postData['content_date']), "Y-m-d"),
                        'short_description'         => $postData['short_description'],
                        'description'               => $postData['description'],
                        'meta_title'                => $postData['meta_title'],
                        'meta_keyword'              => $postData['meta_keyword'],
                        'meta_description'          => $postData['meta_description'],
                        'image'                     => $image
                    ];
                    $blog_id = Blog::insertGetId($fields);
                    /* blog content */
                        $table_of_content   = $postData['table_of_content'];
                        $summary            = $postData['summary'];
                        $content            = $postData['content'];
                        if(!empty($table_of_content)){
                            for($k=0;$k<count($table_of_content);$k++){
                                if($table_of_content[$k]){
                                    $fields2 = [
                                        'blog_id'                   => $blog_id,
                                        'table_of_content'          => $table_of_content[$k],
                                        'table_of_content_slug'     => Helper::clean($table_of_content[$k]),
                                        'summary'                   => $summary[$k],
                                        'content'                   => $content[$k],
                                    ];
                                    BlogContent::insert($fields2);
                                }                                
                            }
                        }
                    /* blog content */
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
            $data['blogContents']           = [];
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
            $data['blogContents']           = BlogContent::where('blog_id', '=', $id)->get();

            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'blog_category'             => 'required',
                    'title'                     => 'required',
                    'slug'                      => 'required',
                    'content_date'              => 'required',
                    'short_description'         => 'required',
                    'description'               => 'required',
                    'meta_title'                => 'required',
                    'meta_keyword'              => 'required',
                    'meta_description'          => 'required',
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
                        'slug'                      => Helper::clean($postData['slug']),
                        'content_date'              => date_format(date_create($postData['content_date']), "Y-m-d"),
                        'short_description'         => $postData['short_description'],
                        'description'               => $postData['description'],
                        'meta_title'                => $postData['meta_title'],
                        'meta_keyword'              => $postData['meta_keyword'],
                        'meta_description'          => $postData['meta_description'],
                        'image'                     => $image,
                        'updated_at'                => date('Y-m-d H:i:s')
                    ];
                    Blog::where($this->data['primary_key'], '=', $id)->update($fields);
                    BlogContent::where('blog_id',$id)->delete();
                    $blog_id = $id;
                    /* blog content */
                        $table_of_content   = $postData['table_of_content'];
                        $summary            = $postData['summary'];
                        $content            = $postData['content'];
                        if(!empty($table_of_content)){
                            for($k=0;$k<count($table_of_content);$k++){
                                if($table_of_content[$k]){
                                    $fields2 = [
                                        'blog_id'                   => $blog_id,
                                        'table_of_content'          => $table_of_content[$k],
                                        'table_of_content_slug'     => Helper::clean($table_of_content[$k]),
                                        'summary'                   => $summary[$k],
                                        'content'                   => $content[$k],
                                    ];
                                    BlogContent::insert($fields2);
                                }
                            }
                        }
                    /* blog content */
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
