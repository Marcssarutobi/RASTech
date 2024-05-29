<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    use HasFactory;
    protected $fillable = ["image","name_prod","categorie_id","qte","PVente","description"];

    public function categories(){
        return $this->belongsTo(Categories::class);
    }
    
    public function commandes(){
        return $this->hasMany(Commande::class);
    }
}
