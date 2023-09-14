<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\GeneralSetting;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyQuestionOptions;
use App\Models\SurveyGrades;
use Auth;
use Session;
use Helper;
use Hash;
use Exception;

class SurveyController extends Controller
{
    public function __construct()
    {        
        $this->data = array(
            'title'             => 'Survey',
            'controller'        => 'SurveyController',
            'controller_route'  => 'survey',
            'primary_key'       => 'id',
        );
    }
    /* list */
        public function list(){
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' List';
            $page_name                      = 'survey.list';
            $data['rows']                   = Survey::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
            // Helper::pr($data['rows']);
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* list */
    /* add */
        public function add(Request $request){
            $data['module']           = $this->data;
            if($request->isMethod('post')){ 
                $postData = $request->all();
                // Helper::pr($postData);
                $question_array     = $postData['question'];
                $label_array        = $postData['label'];
                $fields = [
                                'question_type'         =>  $postData['question_type'],
                                'title'                 =>  $postData['survey_name'],
                                'slug'                  =>  Helper::clean($postData['survey_name']),
                                'short_description'     =>  $postData['short_description']
                        ];
                Survey::insert($fields);
                $ServeyLastID  = Survey::where('status', '!=', 3)->orderBy('id', 'DESC')->first();
                $serveyID = $ServeyLastID->id;
                if(!empty($question_array)){
                    for($k=0;$k<count($question_array);$k++){
                        $values = [
                                    'survey_id'         =>  $serveyID,
                                    'no_of_labels'      =>  $label_array[$k],
                                    'question_name'     =>  $question_array[$k],
                                    'rank'              =>  0
                                ];
                        SurveyQuestion::insert($values);
                        $QuestionLastId  = SurveyQuestion::where('status', '!=', 3)->orderBy('question_id', 'DESC')->first();
                        $opId = $QuestionLastId->question_id;
                            for($n=0;$n<count($postData['option'.$k.'']);$n++){
                                $values = [
                                            'survey_id'         =>  $serveyID,
                                            'question_id'       =>  $opId,
                                            'option_name'       =>  $postData['option'.$k.''][$n],
                                            'option_weight'     =>  $postData['score'.$k][$n]
                                        ];
                                SurveyQuestionOptions::insert($values);
                            }
                    }
                    return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Added Successfully !!!');
                }
            }
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' Add';
            $page_name                      = 'survey.add-edit';
            $data['row']                    = [];
            $data['questions']              = [];
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* add */
    /* edit */
        public function edit(Request $request, $id){
            $data['module']                 = $this->data;
            $id                             = Helper::decoded($id);
            if($request->isMethod('post')){
                $postData = $request->all();
                // Helper::pr($postData);
                // try{
                    $question_array     = $postData['question'];
                    $label_array        = $postData['label'];
                    $questionID_array   = $postData['questionID'];
                    $fields = [
                        'question_type'         =>  $postData['question_type'],
                        'title'                 =>  $postData['survey_name'],
                        'slug'                  =>  Helper::clean($postData['survey_name']),
                        'short_description'     =>  $postData['short_description']
                    ];
                    // Helper::pr($fields);
                    Survey::where('id', '=', $id)->update($fields);

                    if(!empty($question_array)){
                        $oldQuestion = 0;
                        for($j=0;$j<count($question_array);$j++){
                            if($question_array[$j] != '' && $label_array[$j] != ''){
                                $values = [
                                    'survey_id'         =>  $id,
                                    'no_of_labels'      =>  $label_array[$j],
                                    'question_name'     =>  $question_array[$j],
                                    'rank'              =>  2
                                ];
                                if($questionID_array[$j] != ''){
                                    SurveyQuestion::where('question_id', '=', $questionID_array[$j])->update($values);
                                    $question_id    = $questionID_array[$j];
                                } else {
                                    $question_id    = SurveyQuestion::insertGetId($values);
                                    /* question options for new */
                                        $opId       = $question_id;
                                        $p          = 0;
                                        if(array_key_exists('option'.$p,$postData)){
                                            $option     = $postData['option'.$p];
                                            $score      = $postData['score'.$p];
                                            for($n=0;$n<count($option);$n++){
                                                $values2 = [
                                                            'survey_id'         =>  $id,
                                                            'question_id'       =>  $question_id,
                                                            'option_name'       =>  $option[$n],
                                                            'option_weight'     =>  $score[$n],
                                                        ];
                                                SurveyQuestionOptions::insert($values2);
                                            }
                                        }
                                    /* question options for new */
                                }                                
                                
                                /* question options for existing */
                                    $opId       = $question_id;
                                    $k          = ($j + 101);
                                    if(array_key_exists('option'.$k,$postData)){
                                        $optionid   = $postData['optionid'.$k];
                                        $questionid = $postData['questionid'.$k];
                                        $option     = $postData['option'.$k];
                                        $score      = $postData['score'.$k];

                                        for($n=0;$n<count($optionid);$n++){
                                            $values2 = [
                                                        'survey_id'         =>  $id,
                                                        'question_id'       =>  $question_id,
                                                        'option_name'       =>  $option[$n],
                                                        'option_weight'     =>  $score[$n],
                                                    ];
                                            SurveyQuestionOptions::where('option_id', '=', $optionid[$n])->update($values2);
                                        }
                                    }
                                /* question options for existing */
                            }
                        }
                        // die;
                        return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Edited Successfully !!!');
                    }
                    // die;
                // }
                // catch (Exception $e) {
                //     //return $e->getMessage();
                // }

            }
            $title                          = $this->data['title'].' Update';
            $page_name                      = 'survey.add-edit';
            $data['row']                    = Survey::where($this->data['primary_key'], '=', $id)->first();
            $data['questions']              = SurveyQuestion::where('survey_id', '=', $id)->get();
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /* edit */
    /* delete */
        public function delete(Request $request, $id){
            $id                             = Helper::decoded($id);
            $fields = [
                        'status'             => 3
                    ];
            Survey::where($this->data['primary_key'], '=', $id)->update($fields);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Deleted Successfully !!!');
        }
    /* delete */
    /* change password */
        public function change_status(Request $request, $id){
            $id                             = Helper::decoded($id);
            $model                          = Survey::find($id);
            // $checkQuesID                    = SurveyQuestion::where('survey_id', '=', $id)->first();
            // $model                          = SurveyQuestion::find($checkQuesID->question_id);
            // $model                          = SurveyQuestionOptions::find($id);
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
    /* change password */
    /*Grade*/
        public function grade(Request $request, $id){
            $id                             = Helper::decoded($id);
            $data['maxWeight']              = SurveyQuestionOptions::where('survey_id','=',$id)->max('option_weight');
            $data['minWeight']              = SurveyQuestionOptions::where('survey_id','=',$id)->min('option_weight');
            if($request->isMethod('post')){ 
                $postData = $request->all();
                // Helper::pr($postData);
                $minArr     = $postData['minimum'];
                if(!empty($minArr)){
                    for($m=0;$m<count($minArr);$m++){
                        $values = [
                            'survey_id'     =>  $id,
                            'name'          =>  $postData['grade'][$m],
                            'minimum'       =>  $postData['minimum'][$m],
                            'maximum'       =>  $postData['maximum'][$m]
                        ];
                        SurveyGrades::insert($values);
                    }
                }
                return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', 'Grade Added Successfully !!!');
            }
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' Grade';
            $page_name                      = 'survey.grade';
            $data['row']                    = [];
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /*Grade*/
    /*Edit Grade*/
        public function edit_grade(Request $request, $id){
            $id                             = Helper::decoded($id);
            $data['maxWeight']              = SurveyQuestionOptions::where('survey_id','=',$id)->max('option_weight');
            $data['minWeight']              = SurveyQuestionOptions::where('survey_id','=',$id)->min('option_weight');
            $data['getSurvey']              = SurveyGrades::where('survey_id','=',$id)->get();
            // echo $id;die;
            // Helper::pr($data['getSurvey']);
            if($request->isMethod('post')){ 
                try {
                SurveyGrades::where('survey_id',$id)->delete();
                $postData   = $request->all();
                // Helper::pr($postData);
                $minArr     = $postData['minimum'];
                    if(!empty($minArr)){
                        for($m=0;$m<count($minArr);$m++){
                            $values = [
                                'survey_id'     =>  $id,
                                'name'          =>  $postData['grade'][$m],
                                'minimum'       =>  $postData['minimum'][$m],
                                'maximum'       =>  $postData['maximum'][$m]
                            ];
                            SurveyGrades::insert($values);
                        }
                    }
                }
                catch (Exception $e) {
                    //return $e->getMessage();
                }
                return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', 'Grade Edited Successfully !!!');
            }
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' Edit Grade';
            $page_name                      = 'survey.edit-grade';
            $data['row']                    = [];
            echo $this->admin_after_login_layout($title,$page_name,$data);
        }
    /*Edit grade*/
}
