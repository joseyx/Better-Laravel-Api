<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asiento extends Model
{
    protected $table = 'asientos';

    protected $fillable = [
        'identificador'
    ];

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }
}
