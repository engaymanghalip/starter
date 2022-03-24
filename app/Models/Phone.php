<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = "phones";
    protected $fillable = ['code','phone','user'];
    public $timestamps = false;

    public function user(){
        return $this -> belongsTo('App\User','user_id');
    }
}
