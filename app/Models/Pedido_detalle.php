<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido_detalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'detalle',
        'monto_cobrar',
        'metodo_pago_id',
        'observacion',
        'type_pedido_id',
        'type_paquete',
        'medida_largo',
        'medida_ancho',
        'medida_alto',
        'photo',
    ];

    public function pedidos(): belongsTo
    {
        return $this->belongsTo(Pedido::class);
    }
}
