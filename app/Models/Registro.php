<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registros';

    protected $fillable = [
        'codigo_socio',
        'acepta_terminos',
        'nombres',
        'correo',
        'telefono',
        'fecha_preferencia',
        'tipo_bungalow',
        'ip_address',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime',
    ];
}
