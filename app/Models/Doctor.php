<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = "doctors";
    protected $fillable = ['name', 'title', 'hospital_id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at','pivot'];
    public $timestamps = true;

    // relation 1 to *
    public function hospitalrelation()
    {
        return $this->belongsTo('App\Models\Hospital', 'hospital_id', 'id');
    }

    // relation * to *
    public function servicesRelation()
    {
        return $this->belongsToMany('App\Models\Service', 'doctors_services', 'doctor_id', 'service_id', 'id', 'id');
        // belongstomany arguments
        // 1- table to realte with this table
        // 2- pivottable between the tow tables
        //3- forign key for first table
        //4- forign key for second table
        //5- primary key for first table
        // 6- primary key for second table
    }
}
