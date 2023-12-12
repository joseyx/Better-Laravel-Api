<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaDeCine extends Model
{
    protected $table = 'sala_de_cine';

    protected $fillable = [
        'nombre',
        'capacidad',
        'desde',
        'hasta',
        'tipo'
    ];

    use HasFactory;
}
