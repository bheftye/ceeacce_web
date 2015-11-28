<?php

namespace ceeacce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','order','plan'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->hasMany('ceeacce\Subject','module');
    }

    /**
     * Get the post that owns the comment.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function plan()
    {
        return $this->belongsTo('ceeacce\Plan', 'plan');
    }


}