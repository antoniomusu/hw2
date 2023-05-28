<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    protected $primaryKey = "id_evento";
    public $timestamps = false;

    public function user(){
        return $this->belongsTo("App\Models\User", "user");
    }
    

}