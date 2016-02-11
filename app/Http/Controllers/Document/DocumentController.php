<?php

namespace ceeacce\Http\Controllers\Document;

use ceeacce\Document;
use ceeacce\Grade;
use ceeacce\NumberToWordsHelper;
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
    const MIN_APPROVAL = 60;
    const MAX_APPROVAL = 100;
    private $numberToWordsHelper;

    private $tens = [
        30 => 'TREINTA',
        40 => 'CUARENTA',
        50 => 'CINCUENTA',
        60 => 'SESENTA',
        70 => 'SETENTA',
        80 => 'OCHENTA',
        90 => 'NOVENTA',
        100 => 'CIEN'
    ];

    private $tenths = [
        1 => 'UNO',
        2 => 'DOS',
        3 => 'TRES',
        4 => 'CUATRO',
        5 => 'CINCO',
        6 => 'SEIS',
        7 => 'SIETE',
        8 => 'OCHO',
        9 => 'NUEVE',
        10 => 'DIEZ',
        11 => 'ONCE',
        12 => 'DOCE',
        13 => 'TRECE',
        14 => 'CATORCE',
        15 => 'QUINCE',
        16 => 'DIECISEIS',
        17 => 'DIECISIETE',
        18 => 'DIECIOCHO',
        19 => 'DIECINUEVE',
        20 => 'VEINTE',
        21 => 'VEINTIUNO',
        22 => 'VEINTIDOS',
        23 => 'VEINTITRES',
        24 => 'VEINTICUATRO',
        25 => 'VEINTICINCO',
        26 => 'VEINTISEIS',
        27 => 'VEINTISIETE',
        28 => 'VEINTIOCHO',
        29 => 'VEINTINUEVE'
    ];

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

                $templateProcessor = new TemplateProcessor(storage_path('wordtemplate/'.$kardexTemplate->document_name));

                //$template = TemplateFactory::load(storage_path('wordtemplate/'.$kardexTemplate->document_name));


                //Student Data
                $templateProcessor->setValue('name', $student->name);
                $templateProcessor->setValue('last_name_p', $student->last_name_p);
                $templateProcessor->setValue('last_name_m', $student->last_name_m);
                $templateProcessor->setValue('clv', $student->clv);
                $templateProcessor->setValue('gpa', $student->calculateGPA());

                /*$template->assign(['name' => $student->name]);
                $template->assign(['last_name_p' => $student->last_name_p]);
                $template->assign(['last_name_m' => $student->last_name_m]);
                $template->assign(['clv' => $student->clv]);*/

                //Date Data
                $templateProcessor->setValue('day', date('j').' de ');
                $templateProcessor->setValue('month', $this->months[date('n')].' de ');
                $templateProcessor->setValue('year', date('o'));

                /*$template->assign(['day' => date('j').' de ']);
                $template->assign(['month' => $this->months[date('n')].' de ']);
                $template->assign(['year' => date('o')]);*/


                foreach ($plan->modules as $module){
                    foreach ($module->subjects as $subject){

                        //Subject-Grade Data Preparing
                        $grade = Grade::where(['id_subject' => $subject->id, "id_student" => $student->id])->first();
                        $gradeValue = (isset($grade->grade)) ? $grade->grade : "";
                        $dateValue = (isset($grade->grade)) ? $grade->date_taken : "";
                        $typeValue = (isset($grade->grade)) ? $grade->type : "";

                        //Subject-Grade Data
                        $templateProcessor->setValue(strtolower(str_replace('-','_',$subject->clv)) , $subject->name);
                        $templateProcessor->setValue(strtolower(str_replace('-','_',$subject->clv)).'_grade' , $gradeValue);
                        $templateProcessor->setValue(strtolower(str_replace('-','_',$subject->clv)).'_date' , $dateValue);
                        $templateProcessor->setValue(strtolower(str_replace('-','_',$subject->clv)).'_type' , $typeValue);

                        /*$template->assign([strtolower(str_replace('-','',$subject->clv)) => $subject->name]);
                        $template->assign([strtolower(str_replace('-','',$subject->clv)).'_grade' => $gradeValue]);
                        $template->assign([strtolower(str_replace('-','',$subject->clv)).'_date' => $dateValue]);
                        $template->assign([strtolower(str_replace('-','',$subject->clv)).'_type' => $typeValue]);*/
                    }
                }
                //$template->save(storage_path('wordtemplate/'.$templateCopy));
                $templateProcessor -> saveAs(storage_path('wordtemplate/'.$templateCopy));

                return response()->download(storage_path('wordtemplate/'.$templateCopy));
            }
            return redirect('/close');
        }
    }

    /**
     * Method that generates the certificate document
     */
    protected function generateCertificate($id_student){
        $student = Student::findOrFail($id_student);
        $this->numberToWordsHelper = new NumberToWordsHelper();

        if(isset($student->id) && $id_student!= 0){
            $plan = Plan::findOrFail($student->plan);
            $certificateTemplate = Document::where('name', 'like', '%Certificado Completo CEEAC%')->first();

            if(isset($certificateTemplate->document_name)){
                $templateCopy = 'certificado.'.$certificateTemplate->extension;
                if(Storage::disk('word')->has('certificado.docx')){
                    Storage::disk('word')->delete('certificado.docx');
                }

                $templateProcessor = new TemplateProcessor(storage_path('wordtemplate/'.$certificateTemplate->document_name));

                //Student Data
                $templateProcessor->setValue('name', $student->name);
                $templateProcessor->setValue('last_name_p', $student->last_name_p);
                $templateProcessor->setValue('last_name_m', $student->last_name_m);
                $templateProcessor->setValue('curp', $student->curp);
                $templateProcessor->setValue('gpa', $student->calculateGPA());

                //Date Data Created
                $templateProcessor->setValue('day_txt', strtolower($this->numberToWordsHelper->convert(date('j'))));
                $templateProcessor->setValue('month_txt', strtolower($this->months[date('n')]));
                $templateProcessor->setValue('year_txt', strtolower($this->numberToWordsHelper->convert(date('o'))));

                //Last Class Taken
                $lastGrade = Grade::where(["id_student" => $student->id])->orderBy('date_taken','desc')->first();
                $lastDateArray = explode('/', $lastGrade->date_taken);
                $last_date = $this->numberToWordsHelper->convert($lastDateArray[2])." DE ".strtoupper($this->months[intval($lastDateArray[1])]." DE ".$this->numberToWordsHelper->convert($lastDateArray[0])).".";
                $templateProcessor->setValue('lastdate', $last_date);

                foreach ($plan->modules as $module){
                    foreach ($module->subjects as $subject){

                        //Subject-Grade Data Preparing
                        $grade = Grade::where(['id_subject' => $subject->id, "id_student" => $student->id])->first();
                        $gradeValue = (isset($grade->grade)) ? $grade->grade : "";
                        $gradeTxt = (isset($grade->grade)) ? $this->transformNumberToText($grade->grade) : "";
                        $typeValue = (isset($grade->grade)) ? $grade->type : "";

                        //Subject-Grade Data
                        $shotClv = strtolower(str_replace('-','_',$subject->clv));
                        $templateProcessor->setValue($shotClv, $subject->name);
                        $templateProcessor->setValue($shotClv.'_grade' , $gradeValue);
                        $templateProcessor->setValue($shotClv.'_gradetxt' , $gradeTxt);
                        $templateProcessor->setValue($shotClv.'_type' , $typeValue);

                    }
                }
                //$template->save(storage_path('wordtemplate/'.$templateCopy));
                $templateProcessor -> saveAs(storage_path('wordtemplate/'.$templateCopy));

                return response()->download(storage_path('wordtemplate/'.$templateCopy));
            }
            return redirect('/close');
        }
    }

    /**
     * Method that
     */
    private function transformNumberToText($number)
    {
        if(is_numeric($number) && $number >= self::MIN_APPROVAL && $number <= self::MAX_APPROVAL)
        {
            return $this->getNumberInWords($number);
        }
        if(!is_numeric($number) && $number == "A")
        {
            return "APROBADO";
        }
    }

    private function getNumberInWords($number)
    {
        $numberInWords = "";
        $residue = $number % 10;
        if($residue == 0)
        {
            $numberInWords.= $this->tens[$number];
        }
        else{
            $tenths = $this->tenths[$residue];
            $tens = $this->tens[$number - $residue];
            $numberInWords = $tens.' Y '.$tenths;
        }
        return $numberInWords;
    }

}
