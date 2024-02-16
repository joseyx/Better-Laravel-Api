<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $table = 'salas';

    protected $fillable = [
        'nombre',
        'filas',
        'asientos_por_fila',
        'tipo'
    ];

    use HasFactory;
}
