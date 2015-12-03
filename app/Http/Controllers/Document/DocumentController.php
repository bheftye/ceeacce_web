<?php

namespace ceeacce\Http\Controllers\Document;

use ceeacce\Document;
use ceeacce\Grade;
use ceeacce\Plan;
use ceeacce\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Validator;
use ceeacce\Http\Controllers\Controller;
use DocxTemplate\TemplateFactory;

class DocumentController extends Controller
{
    private $months = [1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'];
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
     * Create a new document controller instance.
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
     * Method that saves/updates the Document info.
     */
    protected function save(Request $request){
        $data = $request->only(['name','id']);
        $name = $data['name'];
        $id = (isset($request->id))?$data['id']: 0;

        if ($request->hasFile('document') and $request->file('document')->isValid()) {

            $newTemplate = $request->file('document');
            $extension = $newTemplate->getClientOriginalExtension();
            $documentName = uniqid(random_int(0,100));

            Storage::disk('word')->put($documentName.'.'.$extension,  File::get($newTemplate));

            if($id != 0){
                $document = Document::findOrFail($id);
            }
            else{
                $document = new Document();
            }
            $document->name = $name;
            $document->document_name = $documentName.'.'.$extension;
            $document->extension = $extension;
            if($document->save()){
                return redirect('document/'.$document->id);
            }
            return redirect('document/create')->withInput($request)->with(['success' => 'warning']);

        }

        return redirect('documents')->with('success', 'false');
    }

    /**
     * Method that generates the Kardex document.
    */
    protected function generateKardex($id_student){
        $student = Student::findOrFail($id_student);

        if(isset($student->id) && $id_student!= 0){
            $plan = Plan::findOrFail($student->plan);
            $kardexTemplate = Document::where('name', 'like', '%Kardex%')->first();

            if(isset($kardexTemplate->document_name)){
                $templateCopy = 'kardex.'.$kardexTemplate->extension;
                if(Storage::disk('word')->has('kardex.docx')){
                    Storage::disk('word')->delete('kardex.docx');
                }

                //Storage::disk('word')->copy($kardexTemplate->document_name, $templateCopy);

                //$templateProcessor = new TemplateProcessor(storage_path('wordtemplate/'.$templateCopy));
                $template = TemplateFactory::load(storage_path('wordtemplate/'.$kardexTemplate->document_name));



                //Student Data
                /*$templateProcessor->setValue('[names]', $student->names);
                $templateProcessor->setValue('[last_name_p]', $student->last_name_p);
                $templateProcessor->setValue('[last_name_m]', $student->last_name_m);
                $templateProcessor->setValue('[clv]', $student->clv);*/

                $template->assign('[names]', $student->names);
                $template->assign('[last_name_p]', $student->last_name_p);
                $template->assign('[last_name_m]', $student->last_name_m);
                $template->assign('[clv]', $student->clv);

                //Date Data
                /*$templateProcessor->setValue('[day]', date('j'));
                $templateProcessor->setValue('[mont]', $this->months[date('n')]);
                $templateProcessor->setValue('[year]', date('y'));*/

                $template->assign('[day]', date('j'));
                $template->assign('[mont]', $this->months[date('n')]);
                $template->assign('[year]', date('y'));


                foreach ($plan->modules as $module){
                    foreach ($module->subjects as $subject){

                            //Subject-Grade Data Preparing
                            $grade = Grade::where(['id_subject'=>$subject->id, "id_student"=>$student->id])->first();
                            $gradeValue = (isset($grade->grade))? $grade->grade : "";
                            $dateValue = (isset($grade->grade))? $grade->date_taken:"";
                            $typeValue = (isset($grade->grade))? $grade->type:"";

                            //Subject-Grade Data
                            /*$templateProcessor->setValue('['.$subject->clv.']', $subject->name);
                            $templateProcessor->setValue('['.$subject->clv.'-grade]',$gradeValue);
                            $templateProcessor->setValue('['.$subject->clv.'-date]','');
                            $templateProcessor->setValue('['.$subject->clv.'-type]','');*/

                        $template->assign('['.$subject->clv.']', $subject->name);
                        $template->assign('['.$subject->clv.'-grade]',$gradeValue);
                        $template->assign('['.$subject->clv.'-date]','');
                        $template->assign('['.$subject->clv.'-type]','');
                    }
                }
                $template->save(storage_path('wordtemplate/'.$templateCopy));
                return response()->download(storage_path('wordtemplate/'.$templateCopy));
            }
            return redirect('/close');
        }
    }

}
