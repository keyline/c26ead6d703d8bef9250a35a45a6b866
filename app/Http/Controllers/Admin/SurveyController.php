<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\GeneralSetting;
use App\Models\Survey;
use App\models\SurveyFactor;
use App\Models\SurveyQuestion;
use App\Models\SurveyQuestionOptions;
use App\Models\SurveyGrades;
use App\models\QuestionTypes;
use App\models\SurveyCombinations;
use Auth;
use Session;
use Helper;
use Hash;
use Exception;
use DB;
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
                // Helper::pr($postData);die;
                /* survey table */
                    $question_array     = $postData['question'];
                    $factor_array       = $postData['factor'];
                    $label_array        = $postData['label'];
                    $fields = [
                                    'question_type'         =>  $postData['question_type'],
                                    'title'                 =>  $postData['survey_name'],
                                    'slug'                  =>  Helper::clean($postData['survey_name']),
                                    'short_description'     =>  $postData['short_description'],
                                    'guideline'             =>  $postData['guideline']
                            ];
                    $survey_id = Survey::insertGetId($fields);
                /* survey table */
                /* survey question & option table */
                    $ServeyLastID   = Survey::where('status', '!=', 3)->orderBy('id', 'DESC')->first();
                    $serveyID       = $ServeyLastID->id;
                    $factorNames    = [];
                    if(!empty($question_array)){
                        for($k=0;$k<count($question_array);$k++){

                            if($factor_array[$k] == ''){
                                $factor_name    = $postData['survey_name'];
                            } else {
                                $factor_name    = $factor_array[$k];
                            }
                            if(!in_array($factor_name, $factorNames)){
                                $factorNames[]    = $factor_name;
                            }

                            $values = [
                                        'survey_id'         =>  $serveyID,
                                        'no_of_labels'      =>  $label_array[$k],
                                        'question_name'     =>  $question_array[$k],
                                        'factor'            =>  $factor_name,
                                        'rank'              =>  0
                                    ];
                            SurveyQuestion::insert($values);
                            $QuestionLastId  = SurveyQuestion::where('status', '!=', 3)->orderBy('question_id', 'DESC')->first();
                            $opId = $QuestionLastId->question_id;
                            for($n=0;$n<count($postData['option'.$k.'']);$n++){
                                $values = [
                                    'survey_id'         =>  $serveyID,
                                    'question_id'       =>  $opId,
                                    'factor'            =>  $factor_name,
                                    'option_name'       =>  $postData['option'.$k.''][$n],
                                    'option_weight'     =>  $postData['score'.$k][$n]
                                ];
                                SurveyQuestionOptions::insert($values);
                            }
                        }
                    }
                /* survey question & option table */
                /* survey factor table */
                    $factor_count = count($factorNames);
                    if(!empty($factorNames)){
                        for($f=0;$f<count($factorNames);$f++){
                            $fname = $factorNames[$f];
                            $minWeight = SurveyQuestionOptions::where('survey_id','=',$survey_id)->where('factor','=',$factorNames[$f])->min('option_weight');
                            $maxWeight = SurveyQuestionOptions::where('survey_id','=',$survey_id)->where('factor','=',$factorNames[$f])->max('option_weight');
                            if($postData['question_type'] == 3){
                                $range_from = 0;
                            } else {
                                $range_from = $minWeight;
                            }

                            $no_of_question = SurveyQuestion::where('survey_id','=',$survey_id)->where('factor','=',$factorNames[$f])->count();
                            if($factor_count <= 1){
                                // without factor
                                $getOptionWeights = SurveyQuestionOptions::select('option_weight')->where('survey_id','=',$survey_id)->where('factor','=',$fname)->sum('option_weight');
                                $no_of_label = $label_array[0];
                                if($postData['question_type'] == 2){
                                    $range_to = $no_of_question; // boolean
                                } elseif($postData['question_type'] == 3){
                                    $range_to = 0; // combination
                                } elseif($postData['question_type'] == 1) {
                                    $range_to = ($getOptionWeights / $no_of_label); // mcq
                                }
                            } else {
                                // with factor
                                if($postData['question_type'] == 3){
                                    $range_to = 0;
                                } else {
                                    $range_to = ($no_of_question * $maxWeight); // 7 * 7
                                }
                            }
                            
                            $fields2 = [
                                'survey_id'         =>  $survey_id,
                                'factor_name'       =>  $factorNames[$f],
                                'range_from'        =>  $range_from,
                                'range_to'          =>  $range_to
                            ];
                            // Helper::pr($fields2);
                            SurveyFactor::insert($fields2);
                        }
                    }
                /* survey factor table */
                return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Added Successfully !!!');

            }
            $data['module']                 = $this->data;
            $title                          = $this->data['title'].' Add';
            $page_name                      = 'survey.add-edit';
            $data['row']                    = [];
            $data['questions']              = [];
            $data['question_types']              = QuestionTypes::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
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
                    $factor_array       = $postData['factor'];
                    $label_array        = $postData['label'];
                    $questionID_array   = $postData['questionID'];
                    $fields = [
                        'question_type'         =>  $postData['question_type'],
                        'title'                 =>  $postData['survey_name'],
                        'slug'                  =>  Helper::clean($postData['survey_name']),
                        'short_description'     =>  $postData['short_description'],
                        'guideline'             =>  $postData['guideline']
                    ];
                    // Helper::pr($fields);
                    Survey::where('id', '=', $id)->update($fields);

                    $factorNames    = [];
                    if(!empty($question_array)){
                        $oldQuestion    = 0;
                        $no_of_question = SurveyQuestion::where('survey_id','=',$id)->count();
                        for($j=0;$j<count($question_array);$j++){

                            if($question_array[$j] != ''){
                                if($factor_array[$j] == ''){
                                    $factor_name    = $postData['survey_name'];
                                } else {
                                    $factor_name    = $factor_array[$j];
                                }
                                if(!in_array($factor_name, $factorNames)){
                                    $factorNames[]    = $factor_name;
                                }
                            }

                            if($question_array[$j] != '' && $label_array[$j] != ''){
                                $values = [
                                    'survey_id'         =>  $id,
                                    'no_of_labels'      =>  $label_array[$j],
                                    'question_name'     =>  $question_array[$j],
                                    'factor'            =>  $factor_name,
                                    'rank'              =>  2
                                ];
                                if($questionID_array[$j] != ''){
                                    SurveyQuestion::where('question_id', '=', $questionID_array[$j])->update($values);
                                    $question_id    = $questionID_array[$j];
                                } else {
                                    $question_id    = SurveyQuestion::insertGetId($values);
                                    /* question options for new */
                                        $opId       = $question_id;
                                        $p          = ($j - $no_of_question);
                                        // echo 'option'.$p.'<br>';
                                        // echo 'option'.$p.'<br>';
                                        if(array_key_exists('option'.$p,$postData)){
                                            $option     = $postData['option'.$p];
                                            $score      = $postData['score'.$p];
                                            for($n=0;$n<count($option);$n++){
                                                $values2 = [
                                                            'survey_id'         =>  $id,
                                                            'question_id'       =>  $question_id,
                                                            'factor'            =>  $factor_name,
                                                            'option_name'       =>  $option[$n],
                                                            'option_weight'     =>  $score[$n],
                                                        ];
                                                // Helper::pr($values2,0);
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
                                                        'factor'            =>  $factor_name,
                                                        'option_name'       =>  $option[$n],
                                                        'option_weight'     =>  $score[$n],
                                                    ];
                                            SurveyQuestionOptions::where('option_id', '=', $optionid[$n])->update($values2);
                                        }
                                    }
                                /* question options for existing */
                            }
                            
                        }
                    }
                    // Helper::pr($factorNames);
                    /* survey factor table */
                        $survey_id      = $id;
                        $factor_count   = count($factorNames);
                        if(!empty($factorNames)){
                            for($f=0;$f<count($factorNames);$f++){
                                $fname = $factorNames[$f];
                                $minWeight = SurveyQuestionOptions::where('survey_id','=',$survey_id)->where('factor','=',$factorNames[$f])->min('option_weight');
                                $maxWeight = SurveyQuestionOptions::where('survey_id','=',$survey_id)->where('factor','=',$factorNames[$f])->max('option_weight');
                                if($postData['question_type'] == 3){
                                    $range_from = 0;
                                } else {
                                    $range_from = $minWeight;
                                }

                                $no_of_question = SurveyQuestion::where('survey_id','=',$survey_id)->where('factor','=',$factorNames[$f])->count();
                                if($factor_count <= 1){
                                    // without factor
                                    $getOptionWeights = SurveyQuestionOptions::select('option_weight')->where('survey_id','=',$survey_id)->where('factor','=',$fname)->sum('option_weight');
                                    $no_of_label = $label_array[0];
                                    if($postData['question_type'] == 2){
                                        $range_to = $no_of_question; // boolean
                                    } elseif($postData['question_type'] == 3){
                                        $range_to = 0; // combination
                                    } elseif($postData['question_type'] == 1) {
                                        $range_to = ($getOptionWeights / $no_of_label); // mcq
                                    }
                                } else {
                                    // with factor
                                    if($postData['question_type'] == 3){
                                        $range_to = 0;
                                    } else {
                                        $range_to = ($no_of_question * $maxWeight); // 7 * 7
                                    }
                                }

                                $checkSurveyFactor = SurveyFactor::where('survey_id', '=', $survey_id)->where('factor_name', '=', $factorNames[$f])->first();
                                if($checkSurveyFactor){
                                    $fields2 = [
                                        'range_from'        =>  $range_from,
                                        'range_to'          =>  $range_to
                                    ];
                                    SurveyFactor::where('survey_id', '=', $survey_id)->where('factor_id', '=', $checkSurveyFactor->factor_id)->update($fields2);
                                } else {
                                    $fields2 = [
                                        'survey_id'         =>  $survey_id,
                                        'factor_name'       =>  $factorNames[$f],
                                        'range_from'        =>  $range_from,
                                        'range_to'          =>  $range_to
                                    ];
                                    // Helper::pr($fields2);
                                    SurveyFactor::insert($fields2);
                                }                                
                            }
                        }
                    /* survey factor table */

                // die;
                return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', $this->data['title'].' Edited Successfully !!!');
            }
            $title                          = $this->data['title'].' Update';
            $page_name                      = 'survey.add-edit';
            $data['row']                    = Survey::where($this->data['primary_key'], '=', $id)->first();
            $data['questions']              = SurveyQuestion::where('survey_id', '=', $id)->get();
            $data['question_types']         = QuestionTypes::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
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
        public function grade(Request $request, $id , $factor){
            $id                          = Helper::decoded($id);
            $factor                      = Helper::decoded($factor);
            $data['checkSurveyFactor']   = SurveyFactor::where('survey_id', '=', $id)->where('factor_name', '=', $factor)->first();

            $data['range_from'] = $data['checkSurveyFactor']->range_from;
            $data['range_to']   = $data['checkSurveyFactor']->range_to;
           
            if($request->isMethod('post')){
                $postData = $request->all();
                // Helper::pr($postData);
                $minArr     = $postData['minimum'];
                if(!empty($minArr)){
                    for($m=0;$m<count($minArr);$m++){
                        $values = [
                            'survey_id'     =>  $id,
                            'name'          =>  $postData['grade'][$m],
                            'factor'        =>  $postData['factor'][$m],
                            'minimum'       =>  $postData['minimum'][$m],
                            'maximum'       =>  $postData['maximum'][$m],
                            'review'        =>  $postData['review'][$m]
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
        public function edit_grade(Request $request, $id , $factor){
            $id                             = Helper::decoded($id);
            $factor                         = Helper::decoded($factor);

            $data['getSurvey']              = SurveyGrades::where('survey_id','=',$id)->get();
            $data['checkSurveyFactor']   = SurveyFactor::where('survey_id', '=', $id)->where('factor_name', '=', $factor)->first();

            $data['range_from'] = $data['checkSurveyFactor']->range_from;
            $data['range_to']   = $data['checkSurveyFactor']->range_to;

            if($request->isMethod('post')){ 
                try {
                SurveyGrades::where('survey_id',$id)->delete();
                $postData   = $request->all();
                $minArr     = $postData['minimum'];
                    if(!empty($minArr)){
                        for($m=0;$m<count($minArr);$m++){
                            $values = [
                                'survey_id'     =>  $id,
                                'name'          =>  $postData['grade'][$m],
                                'factor'        =>  $postData['factor'][$m],
                                'minimum'       =>  $postData['minimum'][$m],
                                'maximum'       =>  $postData['maximum'][$m],
                                'review'        =>  $postData['review'][$m]
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
    /*Edit Factor*/
    public function factor(Request $request, $id , $factor){
        $id                             = Helper::decoded($id);
        $factor                         = Helper::decoded($factor);
        $data['getSurvey']              = Survey::where('id','=',$id)->first();
        $data['factor']                 = $factor;
        if($request->isMethod('post')){
            $postData = $request->all();
            // Helper::pr($postData);
                $values = [
                            'factor_description'          =>  $postData['factor_description'],
                            'range_from_description'      =>  $postData['range_from_description'],
                            'range_to_description'        =>  $postData['range_to_description']
                        ];
            SurveyFactor::where('survey_id', '=', $id)->where('factor_name', '=', $factor)->update($values);
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', 'Factor Updated Successfully !!!');
        }
        $data['module']                 = $this->data;
        $data['getfactor']              = SurveyFactor::where('survey_id', '=', $id)->where('factor_name', '=', $factor)->first();
        $title                          = $this->data['title'].' Edit Factor';
        $page_name                      = 'survey.edit-factor';
        $data['row']                    = [];
        echo $this->admin_after_login_layout($title,$page_name,$data);
    }
    /*Edit Factor*/
    /*Edit combination*/
    public function combination(Request $request, $id ){
        $id                             = Helper::decoded($id);
        $data['getSurveyCombination']   = SurveyCombinations::where('survey_id','=',$id)->get();
        $data['combination_id']         = $id;
        if($request->isMethod('post')){
            $postData = $request->all();
            if($data['getSurveyCombination']){
                SurveyCombinations::where('survey_id','=', $id)->delete();
                $codeArr     = $postData['code'];
                if(!empty($codeArr)){
                    for($m=0;$m<count($codeArr);$m++){
                        if($postData['code'][$m] != '' && $postData['combination'][$m] != ''){
                            $values = [
                                'survey_id'                 =>  $id,
                                'combination_code'          =>  $postData['code'][$m],
                                'combination_description'   =>  $postData['combination'][$m]
                            ];
                            SurveyCombinations::insert($values);
                        }
                    }
                }
            }else{
                $codeArr     = $postData['code'];
                if(!empty($codeArr)){
                    for($m=0;$m<count($codeArr);$m++){
                        if($postData['code'][$m] != '' && $postData['combination'][$m] != ''){
                            $values = [
                                'survey_id'                 =>  $id,
                                'combination_code'          =>  $postData['code'][$m],
                                'combination_description'   =>  $postData['combination'][$m]
                            ];
                            SurveyCombinations::insert($values);
                        }
                    }
                }
            }
            
            return redirect("admin/" . $this->data['controller_route'] . "/list")->with('success_message', 'Combination Updated Successfully !!!');
        }
        $data['module']                 = $this->data;
        $title                          = $this->data['title'].' Edit Combination';
        $page_name                      = 'survey.edit-combination';
        $data['row']                    = [];
        echo $this->admin_after_login_layout($title,$page_name,$data);
    }
    /*Edit combination*/
}
