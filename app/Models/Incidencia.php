<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'descripcion',
        'status'
    ];

    public function pedido_incidencia()
    {
        return $this->hasMany(Pedido_incidencia::class, 'incidencia_id', 'id');
    }
}
