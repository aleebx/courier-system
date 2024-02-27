<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'color',
        'descripcion',
        'mensaje',
    ];

    public function pedido_seguimiento()
    {
        return $this->hasMany(Pedido_seguimiento::class, 'seguimiento_id', 'id');
    }
}
