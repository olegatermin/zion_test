<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    public $incrementing = false;

    protected $fillable = [
        'id',
        'size',
        'viewers',
        'created_by'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
