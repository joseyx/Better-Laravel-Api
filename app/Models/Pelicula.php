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
        'sinopsis',
        'poster',
        'fecha_estreno',
    ];

    use HasFactory;

    public function generos(): BelongsToMany
    {
        return $this->belongsToMany(Genero::class, 'generos_peliculas');
    }
}
