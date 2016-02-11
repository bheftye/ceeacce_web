<?php

namespace ceeacce;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'clv', 'name', 'last_name_p', 'last_name_m', 'curp', 'email', 'birthday', 'year', 'period', 'course', 'grade', 'shift', 'group', 'campus', 'plan'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades()
    {
        return $this->hasMany('ceeacce\Grade', 'id');
    }

    public function plan(){
        return $this->belongsTo('ceeacce\Plan','plan');
    }

    public function campus(){
        return $this->belongsTo('ceeacce\Campus','campus');
    }

    public function calculateGPA(){
        $plan = Plan::findOrFail($this->plan);
        $gpa = 0;
        $subject_sum = 0;
        $subject_count = 0;
        foreach ($plan->modules as $module){
            foreach ($module->subjects as $subject){

                $grade = Grade::where(['id_subject' => $subject->id, "id_student" => $this->id])->first();
                $gradeValue = (isset($grade->grade)) ? $grade->grade : 0;
                if($gradeValue != 0 && is_numeric($gradeValue)){
                    $subject_count++;
                    $subject_sum += $gradeValue;
                }
            }
        }
        if($subject_count != 0){
            $gpa = $subject_sum / $subject_count;
            $gpa = round($gpa, 0, PHP_ROUND_HALF_UP);
        }
        return $gpa;
    }
}
