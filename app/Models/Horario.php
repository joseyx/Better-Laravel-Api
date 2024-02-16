<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{

    use HasFactory;
    protected $table = 'horarios';

    protected $fillable = [
        'hora',
        'sala_id',
        'pelicula_id'
    ];

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }

    public function asientos()
    {
        return $this->hasMany(Asiento::class);
    }
}
