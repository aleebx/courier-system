<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido_seguimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'user_id',
        'seguimiento_id',
        'observacion',
    ];

    public function pedidos(): belongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function seguimientos() : belongsTo
    {
        return $this->belongsTo(Seguimiento::class, 'seguimiento_id', 'id');
    }

}
