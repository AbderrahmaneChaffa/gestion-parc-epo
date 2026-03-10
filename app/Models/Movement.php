<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Movement extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'movements';
    protected $fillable = ['equipment_id', 'type', 'quantite', 'direction_concernee', 'motif_ou_reference', 'date_mouvement', 'user_id'];

    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
