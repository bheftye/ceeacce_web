<?php

namespace ceeacce\Http\Controllers\Plan;

use ceeacce\Subject;
use Illuminate\Http\Request;
use Validator;
use ceeacce\Plan;
use ceeacce\Http\Controllers\Controller;

class PlanController extends Controller
{
    private $types = ['EQU' => 'EQUIVALENCIA', 'EXT' => 'EXTRAORDINARIO', 'ORD' => 'ORDINARIO'];
    /*
    |--------------------------------------------------------------------------
    | Plan Controller.
    |--------------------------------------------------------------------------
    |
    | This controller takes care of importing students, adding new students and
    | all operations related to students.
    |
    */



    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
        ]);
    }

    /**
     * Method that saves the Student Grades from the form.
     */
    protected function saveGrades(Request $request){
        $id_student = $request->id_student;
        $ids_subject = $request->ids;
        $grades = $request->grades;
        $dates_taken = $request->dates_taken;
        $types = $request->types;

        $index = 0;//first position
        foreach($ids_subject as $id_subject){
            $grade = Grade::firstOrCreate(['id_subject'=>$id_subject, 'id_student'=>$id_student]);
            $grade->grade = $grades[$index];
            $grade->date_taken = $dates_taken[$index];
            $grade->type = $types[$index];
            $grade->save();
            $index++;
        }

        return redirect('student/'.$id_student);
    }

    /**
     * Method that updates the Plan info.
     */
    protected function update(Request $request){
        $data = $request->only(['id','name']);

        $validator =  Validator::make($data, [
            'name' => 'required|max:255',
            'id' => 'required',
        ]);

        $plan = Plan::findOrFail($data['id']);

        $plan->name = $data['name'];

        if(!$validator->fails() && $plan->save()){
            return redirect('plan/'.$plan->id)->with(['success' => 'true']);
        }

        return redirect('plan/'.$plan->id)->withInput($request)->withErrors($validator)->with(['success' => 'warning']);
    }

    /*
     * Method that updates the Plan of studies' module's subjects.
     * */
    protected function updateModule(Request $request){
        $data = $request->only(['subjects_ids','subjects_names','subjects_credits', 'subjects_clvs', 'subjects_lengths']);

        $validator =  Validator::make($data, [
            'subjects_ids' => 'array',
            'subjects_names' => 'array',
            'subjects_clvs' => 'array',
            'subjects_lengths' => 'array',
        ]);

        if(!$validator->fails()):
            $indexHelper = 0; //Default Value for iteration
            foreach ($data['subjects_ids'] as $subject_id):

                $subject = Subject::findOrFail($subject_id);
                $subject->name = $data['subjects_names'][$indexHelper];
                $subject->credits = $data['subjects_credits'][$indexHelper];
                $subject->clv = $data['subjects_clvs'][$indexHelper];
                $subject->length = $data['subjects_lengths'][$indexHelper];

                $subjectData = [
                    'name' =>  $data['subjects_names'][$indexHelper],
                    'credits' => $data['subjects_credits'][$indexHelper],
                    'clv' => $data['subjects_clvs'][$indexHelper],
                    'length' => $data['subjects_lengths'][$indexHelper],
                ];

                $subjectValidator =  Validator::make($subjectData, [
                    'name' => 'required|string|max:255',
                    'credits' => 'required|numeric',
                    'clv' => 'required|string|max:255',
                    'length' => 'required|numeric',
                ]);

                if(!$subjectValidator->fails()):
                    $subject->save();
                else:
                    return redirect()->back()->withErrors($subjectValidator);
                endif;

                $indexHelper++;
            endforeach;
        else:
            return redirect()->back()->withErrors($validator);
        endif;

        return redirect()->back();
    }


}
