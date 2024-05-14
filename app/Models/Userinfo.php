<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    use HasFactory;
    protected $fillable = ["profil","nom","prenom","phone","ville","quartier","user_id"];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
