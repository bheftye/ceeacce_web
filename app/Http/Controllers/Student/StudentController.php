<?php

namespace ceeacce\Http\Controllers\Student;

use ceeacce\Grade;
use ceeacce\Plan;
use ceeacce\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use ceeacce\Http\Controllers\Controller;
use League\Csv\Reader;
use ceeacce\Student;

class StudentController extends Controller
{
    private $types = ['EQU' => 'EQUIVALENCIA', 'EXT' => 'EXTRAORDINARIO', 'ORD' => 'ORDINARIO'];
    /*
    |--------------------------------------------------------------------------
    | Student Controller.
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
        $this->middleware('auth');
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Student Import.
     *
     * @param  Request  $request
     * @return boolean
     */
    protected function import(Request $request)
    {
        $campus_id = $request->campus_id;
        if ($request->hasFile('csv') and $request->file('csv')->isValid()) {
            $csvFile = $request->file('csv');
            $extension = $csvFile->getClientOriginalExtension();
            Storage::disk('csv')->put('import.'.$extension,  File::get($csvFile));
            $csv = Reader::createFromPath(storage_path().'/csv/'.'import.csv');
            foreach ($csv->fetch() as $studentArray) {
                $student = new Student();
                $student->clv =         $studentArray[0];
                $student->last_name_p = $studentArray[1];
                $student->last_name_m = $studentArray[2];
                $student->name =        $studentArray[3];
                $student->email =       $student->name.'.'.$student->last_name_p.'.'.$student->last_name_m.'@ceeac.com.mx';
                $student->year =        $studentArray[4];
                $student->period =      $studentArray[5];
                $student->course =      $studentArray[6];
                $student->grade =       $studentArray[7];
                $student->shift =       $studentArray[8];
                $student->group =       $studentArray[9];
                $student->campus = $campus_id;
                $student->plan = 1;
                $student -> save();

            }
            return redirect('students');
        }

        return redirect('students')->with('success', 'false');

    }

    protected function importGrades(Request $request){
        $student_id = $request->id_student;
        if ($request->hasFile('csv') and $request->file('csv')->isValid()){
            $csvFile = $request->file('csv');
            $extension = $csvFile->getClientOriginalExtension();
            Storage::disk('csv')->put('import.'.$extension,  File::get($csvFile));
            $csv = Reader::createFromPath(storage_path().'/csv/'.'import.csv');
            foreach ($csv->fetch() as $gradeArray) {

                $subject = Subject::where('name','like', "%".trim($gradeArray[0])."%")->first();
                if(isset($subject->id)){
                    if($subject->id != null){
                        $grade = Grade::firstOrCreate(['id_subject'=>$subject->id, 'id_student'=>$student_id]);
                        $grade->grade = $gradeArray[1];
                        $grade->date_taken = $gradeArray[2];
                        $grade->type = $this->types[trim($gradeArray[3])];
                        $grade->save();
                    }
                    continue;
                }
                else{
                    $subjectName = explode(' ',trim($gradeArray[0]));
                    $subjectsArray = array();
                    $idSubjectFit = 0;

                    foreach ($subjectName as $word){
                        $subjects = Subject::where('name','like', "%".mb_strtoupper($word)."%");
                        foreach($subjects as $object){
                            array_push($subjectsArray,$object);
                        }
                    }

                    $shortest = -1;

                    foreach($subjectsArray as $subjectTmp){
                        $lev = levenshtein($gradeArray[0],mb_strtoupper($subjectTmp->name));

                        if ($lev == 0) {
                            // closest word is this one (exact match)
                            $idSubjectFit = $subjectTmp->id;
                            break;
                            // break out of the loop; we've found an exact match
                        }

                        // if this distance is less than the next found shortest
                        // distance, OR if a next shortest word has not yet been found
                        if ($lev <= $shortest || $shortest < 0) {
                            // set the closest match, and shortest distance
                            $idSubjectFit = $subjectTmp->id;
                            $shortest = $lev;
                        }
                    }

                    if($idSubjectFit != 0){
                        $subject = Subject::find($idSubjectFit);
                        if(isset($subject->id) && $subject->id != null){
                            $grade = Grade::firstOrCreate(['id_subject'=>$subject->id, 'id_student'=>$student_id]);
                            $grade->grade = $gradeArray[1];
                            $grade->date_taken = $gradeArray[2];
                            $grade->type = $this->types[trim($gradeArray[3])];
                            $grade->save();
                        }
                    }
                    else{
                        if (strpos(trim($gradeArray[0]),'GRECOLATINAS') !== false) {
                            $subject = Subject::find(2);
                        }
                        else if(strpos(trim($gradeArray[0]),'ALGEBRA') !== false){
                            $subject = Subject::find(3);
                        }
                        else if(strpos(trim($gradeArray[0]),'GEOMETRIA PLANA') !== false){
                            $subject = Subject::find(8);
                        }
                        else if(strpos(trim($gradeArray[0]),'GEOMETRIA ANALITICA') !== false){
                            $subject = Subject::find(14);
                        }
                        else if(strpos(trim($gradeArray[0]),'CALCULO') !== false){
                            $subject = Subject::find(20);
                        }

                        $grade = Grade::firstOrCreate(['id_subject'=>$subject->id, 'id_student'=>$student_id]);
                        $grade->grade = $gradeArray[1];
                        $grade->date_taken = $gradeArray[2];
                        $grade->type = $this->types[trim($gradeArray[3])];
                        $grade->save();
                    }
                    continue;

                }

            }
            return redirect('student/'.$student_id);
        }

        return redirect('students');
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
     * Method that saves/updates the Studen info.
    */
    protected function save(Request $request){
        $data = $request->only(['clv', 'id','name', 'last_name_p', 'last_name_m', 'curp', 'email','birthday', 'year']);

        if($data['id'] != 0){
            $student = Student::find($data['id']);
        }
        else{
            $student = new Student();
        }

        $student->clv = $data['clv'];
        $student->name = $data['name'];
        $student->last_name_p = $data['last_name_p'];
        $student->last_name_m = $data['last_name_m'];
        $student->curp = $data['curp'];
        $student->email = $data['email'];
        $student->birthday = $data['birthday'];
        $student->year = $data['year'];


        if($student->save()){
            return redirect('student/'.$student->id)->with(['success' => 'true']);
        }

        return redirect('student/'.$student->id)->withInput($request)->with(['success' => 'warning']);
    }

}
