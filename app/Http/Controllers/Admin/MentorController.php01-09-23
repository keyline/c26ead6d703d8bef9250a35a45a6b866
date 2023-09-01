<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\Helper as HelpersHelper;
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
use Auth;
use Session;
use Helper;
use Hash;
use DB;

class MentorController extends Controller
{
    public function __construct()
    {        
        $this->data = array(
            'title'             => 'Mentor',
            'controller'        => 'MentorController',
            'controller_route'  => 'mentor',
            'primary_key'       => 'id',
        );
    }
    /* list */
        public function list(){
            // DB::enableQueryLog();
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' List';
            $page_name                      = 'mentor.list';
            // $data['rows']                   = User::where('valid', '!=', 3)->orderBy('id', 'DESC')->get();
            // $data['rows']                   = StudentProfile::with('user')->whereRelation('user','role', '=', 1)->whereRelation('user','valid', '=', 1)->select('studentprofiles.*,user.valid,user.role')->get();
            $data['rows']                   = User::select('mentor_profiles.*','users.role','users.valid','users.email','users.phone')->join('mentor_profiles', 'mentor_profiles.user_id', '=', 'users.id')->where('users.valid', '!=', 3)->where('users.role', '=', 2)->orderBy('users.id', 'DESC')->get();
            // $query = DB::getQueryLog();
            // dd($query);
            // Helper::pr($data['rows']);
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
    /* edit */
        public function edit(Request $request, $id){
            $data['module']                 = $this->data;
            $id                             = Helper::decoded($id);
            $title                          = $this->data['title'].' Update';
            $page_name                      = 'mentor.add-edit';
            $data['row']                    = Source::where($this->data['primary_key'], '=', $id)->first();

            if($request->isMethod('post')){
                $postData = $request->all();
                $rules = [
                    'name'             => 'required',
                ];
                if($this->validate($request, $rules)){
                    $fields = [
                        'name'                  => $postData['name'],
                        'updated_at'            => date('Y-m-d H:i:s')
                    ];
                    Source::where($this->data['primary_key'], '=', $id)->update($fields);
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
                'valid'             => 3
            ];
            User::where($this->data['primary_key'], '=', $id)->update($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Deleted Successfully !!!');
        }
    /* delete */
    /* change status */
        public function change_status(Request $request, $id){
            $id                             = Helper::decoded($id);
            $model                          = User::find($id);
            if ($model->valid == 1)
            {
                $model->valid  = 0;
                $msg            = 'Deactivated';
            } else {
                $model->valid  = 1;
                $msg            = 'Activated';
            }            
            $model->save();
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' '.$msg.' Successfully !!!');
        }
    /* change status */
    /* availability */
        public function availability($id){
            $id                             = Helper::decoded($id);
            $data['mentor']                 = MentorProfile::where('user_id', '=', $id)->first();
            $data['module']                 = $this->data;
            $title                          = 'Availability Of '.(($data['mentor'])?$data['mentor']->first_name.' '.$data['mentor']->last_name:'');
            $page_name                      = 'mentor.availability';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* availability */
    /* assigned services */
        public function assignedServices($id){
            $id                             = Helper::decoded($id);
            $data['mentor']                 = MentorProfile::where('user_id', '=', $id)->first();
            $data['module']                 = $this->data;
            $title                          = 'Assigned Services Of '.(($data['mentor'])?$data['mentor']->first_name.' '.$data['mentor']->last_name:'');
            $page_name                      = 'mentor.assigned-services';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* assigned services */
    /* bookings */
        public function bookings($id){
            $id                             = Helper::decoded($id);
            $data['mentor']                 = MentorProfile::where('user_id', '=', $id)->first();
            $data['module']                 = $this->data;
            $title                          = 'Booking List Of '.(($data['mentor'])?$data['mentor']->first_name.' '.$data['mentor']->last_name:'');
            $page_name                      = 'mentor.bookings';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* bookings */
    /* transactions */
        public function transactions($id){
            $id                             = Helper::decoded($id);
            $data['mentor']                 = MentorProfile::where('user_id', '=', $id)->first();
            $data['module']                 = $this->data;
            $title                          = 'Transactions List Of '.(($data['mentor'])?$data['mentor']->first_name.' '.$data['mentor']->last_name:'');
            $page_name                      = 'mentor.transactions';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* transactions */
    /* payouts */
        public function payouts($id){
            $id                             = Helper::decoded($id);
            $data['mentor']                 = MentorProfile::where('user_id', '=', $id)->first();
            $data['module']                 = $this->data;
            $title                          = 'Passbook Of '.(($data['mentor'])?$data['mentor']->first_name.' '.$data['mentor']->last_name:'');
            $page_name                      = 'mentor.payouts';
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* payouts */
    /*profile*/
    public function profile(Request $request , $id){
        $id    = Helper::decoded($id);
        // echo $id;die;
        if($request->isMethod('post')){
            if($request->post('mode')=='updateDocument'){
                $postData = $request->all();
                // Helper::pr($postData);
                $getDocumentName = RequireDocument::where('id', '=', $postData['doucument_id'])->first();
                $mentorDocument  = UserDocument::where('user_id', '=', $id)->first();
                $rules = [
                            'doucument_id'      => 'required',
                            'image'             => 'required',
                        ];
                if($this->validate($request, $rules)){
                    /* Document */
                        $imageFile      = $request->file('image');
                        if($imageFile != ''){
                            $imageName         = $imageFile->getClientOriginalName();
                            $imageFileType     = pathinfo($imageName, PATHINFO_EXTENSION);
                            if($imageFileType == 'jpg' && 'png' && 'jepg' && 'svg'){
                                $uploadedFile  = $this->upload_single_file('image', $imageName, 'mentor_document', 'image');
                            }else{
                                $uploadedFile  = $this->upload_single_file('image', $imageName, 'mentor_document', 'pdf');
                            }
                            if($uploadedFile['status']){
                                $image = $uploadedFile['newFilename'];
                            } else {
                                return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                            }
                        } else {
                            $image = $mentorDocument->document;
                        }
                    /* Document */
                    $fields = [
                                'type'             => $postData['type'],
                                // 'mentor_id'        => $postData['mentor_id'],
                                'user_id'          => $postData['user_id'],
                                'doucument_id'     => $postData['doucument_id'],
                                'document_slug'    => Helper::clean($getDocumentName->document),
                                'document'         => $image,
                                'updated_at'     => date('Y-m-d H:i:s')
                            ];
                    // Helper::pr($fields);
                    UserDocument::where('user_id', '=', $id)->update($fields);
                    return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Document Updated Successfully !!!');
                } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }else{
                $postData = $request->all();
                $getDocumentName = RequireDocument::where('id', '=', $postData['doucument_id'])->first();
                $rules = [
                        'doucument_id'      => 'required',
                        'image'             => 'required',
                    ];
            if($this->validate($request, $rules)){
            /* document upload */
            $imageFile      = $request->file('image');
            if($imageFile != ''){
                $imageName         = $imageFile->getClientOriginalName();
                $imageFileType     = pathinfo($imageName, PATHINFO_EXTENSION);
                if($imageFileType == 'jpg' && 'png' && 'jepg' && 'svg'){
                    $uploadedFile  = $this->upload_single_file('image', $imageName, 'mentor_document', 'image');
                }else{
                    $uploadedFile  = $this->upload_single_file('image', $imageName, 'mentor_document', 'pdf');
                }
                if($uploadedFile['status']){
                    $image = $uploadedFile['newFilename'];
                } else {
                    return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                }
            } else {
                return redirect()->back()->with(['error_message' => 'Please Upload Banner Image !!!']);
            }
            /* document upload */
            $fields = [
                        'type'             => $postData['type'],
                        // 'mentor_id'        => $postData['mentor_id'],
                        'user_id'          => $postData['user_id'],
                        'doucument_id'     => $postData['doucument_id'],
                        'document_slug'    => Helper::clean($getDocumentName->document),
                        'document'         => $image
                    ];
            // Helper::pr($fields);
            UserDocument::insert($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Document Uploaded Successfully !!!');
            } else {
                    return redirect()->back()->with('error_message', 'All Fields Required !!!');
                }
            }
        }
        $data['mentor']                 = MentorProfile::where('user_id', '=', $id)->first();
        $data['module']                 = $this->data;
        $title                          = 'Profile: '.(($data['mentor'])?$data['mentor']->first_name.' '.$data['mentor']->last_name:'');
        $page_name                      = 'mentor.profile';
        echo $this->admin_after_login_layout($title,$page_name,$data);
    }
/*profile*/
}
