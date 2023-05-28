<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'username';
    protected $keyType = "string";
    protected $autoIncrement= false;
    public $timestamps = false;

    public function saves()
    {
        return $this->hasMany("App\Models\savedAnime", 'username');
    }

    public function comments()
    {
        return $this->hasMany("App\Models\Comment", "user");
    }

    public function events()
    {
        return $this->hasMany("App\Models\Event", "user");
    }
}
