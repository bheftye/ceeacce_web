<?php

namespace ceeacce;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'id_student','id_subject', 'grade', 'date_taken','type'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function students()
    {
        return $this->belongsToMany('ceeacce\Student', 'id_student');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subjects(){
        return $this->belongsToMany('ceeacce\Subject','id_subject');
    }
}
