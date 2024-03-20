<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_recojo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pedido_id',
        'motorizado_id',
        'negocio_id',
        'motorizado_id_old',
        'status',
        'observacion',
    ];

    public function pedidos()
    {
        return $this->belongsTo(Pedido::class);
    }
}
