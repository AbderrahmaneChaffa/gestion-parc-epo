<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    protected $table = 'equipements';
    protected $fillable = ['designation', 'categorie', 'quantite_en_stock', 'seuil_alerte', 'user_id'];

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
