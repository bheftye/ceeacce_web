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
}
