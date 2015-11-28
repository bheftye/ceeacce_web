<?php

namespace ceeacce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subjects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['clv', 'name', 'module', 'credits', 'length', 'order'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the post that owns the comment.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function module()
    {
        return $this->belongsTo('ceeacce\Module', 'module');
    }

    public function grades(){
        return $this->hasMany('ceeacce\Grade', 'id');
    }


}