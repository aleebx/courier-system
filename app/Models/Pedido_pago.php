<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido_pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'user_id',
        'metodo_pago_id',
        'monto',
        'status',
    ];

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    public function metodo_pago(): BelongsTo
    {
        return $this->belongsTo(Metodo_pago::class);
    }
}
