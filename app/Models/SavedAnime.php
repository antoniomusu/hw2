<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SavedAnime extends Model
{
    protected $table = 'savedanime';
    protected $primaryKey = "id_saved";
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany("App\Models\User", "username");
    }
    

}