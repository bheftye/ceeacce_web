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
        return view('plan/plan')->with('plan', \ceeacce\Plan::find($id));
    });

    Route::get('students', function(){
        $defaultPagination = 20;
        return view('student/index')->with(['students'=> \ceeacce\Student::orderBy('last_name_p','asc')->paginate($defaultPagination), 'campuses' => \ceeacce\Campus::all()]);
    });

    Route::get('student/{id}', function($id){
        return view('student/student')->with(['student' => \ceeacce\Student::find($id), 'plans' => \ceeacce\Plan::all(), 'campuses'=> \ceeacce\Campus::all()]);
    });

    Route::get('campuses', function(){
        return view('campus/index')->with('campuses', \ceeacce\Campus::all());
    });

    Route::get('campus/{id}', function($id){
        return view('campus/campus')->with('campus', \ceeacce\Campus::find($id));
    });

    Route::post('student/import', 'Student\StudentController@import');

    Route::post('student/{id}/grades', 'Student\StudentController@saveGrades');

    Route::post('student/{id}', 'Student\StudentController@saveInfo');

    Route::post('student/import/grades', 'Student\StudentController@importGrades');

    Route::post('students', function(\Illuminate\Http\Request $request){
        $defaultPagination = 20;
        $searchString = $request->search;
        return view('student/index')->with(['students'=> \ceeacce\Student::where('name', 'like', $searchString)->orWhere('last_name_p','like',$searchString)->orWhere('last_name_m','like',$searchString)->orderBy('last_name_p','asc')->paginate($defaultPagination), 'campuses' => \ceeacce\Campus::all()]);
    });

});


View::composer('menu', function($view)
{
    $view->with('user', Auth::user());
});

