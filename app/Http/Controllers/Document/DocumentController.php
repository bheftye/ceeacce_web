<?php

namespace ceeacce\Http\Controllers\Document;

use ceeacce\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use ceeacce\Http\Controllers\Controller;
use League\Csv\Reader;

class DocumentController extends Controller
{
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

}
