<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {

    if (!Auth::guest()) {
        // The user is logged in...
        return view('dashboard');
    }
    return view('login');

});

Route::get('login', function(){
    return view('login');
});

Route::post('auth/login','Auth\AuthController@logIn');

Route::post('user/register', 'Auth\AuthController@register');

Route::get('logout', function(){
    \Illuminate\Support\Facades\Auth::logout();
    return view('login');
});

Route::get('user/register',function(){
    return view('user/register');
});

Route::get('user/recover', function(){
   return view('user/recover');
});


Route::group(['middleware' => 'auth'], function()
{

    Route::get('dashboard', function()
    {
        return view('dashboard');
    });

    Route::get('plans', function()
    {
        return view('plan/index')->with('plans',\ceeacce\Plan::all());
    });

    Route::get('plan/{id}', function($id){
        return view('plan/plan')->with('plan', \ceeacce\Plan::findOrFail($id));
    });

    Route::get('students', function(){
        $defaultPagination = 20;
        return view('student/index')->with(['students'=> \ceeacce\Student::orderBy('last_name_p','asc')->paginate($defaultPagination), 'campuses' => \ceeacce\Campus::all()]);
    });

    Route::get('student/{id}', function($id){
        return view('student/student')->with(['student' => \ceeacce\Student::findOrFail($id), 'plans' => \ceeacce\Plan::all(), 'campuses'=> \ceeacce\Campus::all(), 'documents' => \ceeacce\Document::all()]);
    });

    Route::get('campuses', function(){
        return view('campus/index')->with('campuses', \ceeacce\Campus::all());
    });

    Route::get('campus/{id}', function($id){
        return view('campus/campus')->with('campus', \ceeacce\Campus::findOrFail($id));
    });

    Route::post('student/import', 'Student\StudentController@import');

    Route::post('student/import/grades', 'Student\StudentController@importGrades');

    Route::post('students', function(\Illuminate\Http\Request $request){
        $defaultPagination = 20;
        $searchString = $request->search;
        return view('student/index')->with(['students'=> \ceeacce\Student::where('name', 'like', $searchString)->orWhere('last_name_p','like',$searchString)->orWhere('last_name_m','like',$searchString)->orderBy('last_name_p','asc')->paginate($defaultPagination), 'campuses' => \ceeacce\Campus::all()]);
    });

    Route::post('student/save', 'Student\StudentController@save');

    Route::post('student/grades/save', 'Student\StudentController@saveGrades');

    Route::post('document/save', 'Document\DocumentController@save');

    Route::get('documents', function(){
        return view('document/index')->with('documents', \ceeacce\Document::all());
    });

    Route::get('document/create', function(){
        return view('document/create');
    });

    Route::get('document/{id}', function($id){
        return view('document/document')->with('document', \ceeacce\Document::findOrFail($id));
    });

    Route::get('document/kardex/{id}', 'Document\DocumentController@generateKardex');

    Route::get('close', function(){
        return view('close');
    });

});


View::composer('menu', function($view)
{
    $view->with('user', Auth::user());
});

