<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Equipement extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'equipements';
    protected $fillable = ['designation', 'categorie', 'quantite_en_stock', 'seuil_alerte', 'user_id'];

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
