<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genero extends Model
{
    protected $table = 'generos';

    protected $fillable = [
        'genero'
    ];

    public function generos():BelongsToMany
    {
        return $this->belongsToMany(Pelicula::class, 'generos_peliculas');
    }

    use HasFactory;
}
