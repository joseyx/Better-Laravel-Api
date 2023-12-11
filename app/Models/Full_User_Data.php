<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Full_User_Data extends Model
{
    use HasFactory;

    protected $table = 'full_user_data';

    protected $fillable = [
        'lastName',
        'cedula',
        'telefono',
        'direccion',
        'ciudad',
        'estado',
        'foto'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
