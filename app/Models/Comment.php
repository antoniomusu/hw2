<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = "id_comment";
    public $timestamps = false;

    public function users(){
        return $this->belongsTo("App\Models\User");
    }
    

}