<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pelicula extends Model
{
    protected $table = 'peliculas';

    protected $fillable = [
        'nombre',
        'genero',
        'sinopsis',
        'poster',
        'fecha_estreno',
        'color_fondo',
        'color_texto',
        'color_botones',
        'color_extra1',
        'color_extra2',
        'clasificacion',
        'duracion'
    ];

    public function horarios() {
        return $this->hasMany(Horario::class);
    }

    use HasFactory;

}
