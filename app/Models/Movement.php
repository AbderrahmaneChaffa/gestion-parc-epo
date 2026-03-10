<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = 'movements';
    protected $fillable = ['equipment_id', 'type', 'quantite', 'direction_concernee', 'motif_ou_reference', 'date_mouvement', 'user_id'];

    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }
}
