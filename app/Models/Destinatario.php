<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Destinatario extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'namefull',
        'phone',
        'email',
        'departamento_id',
        'provincia_id',
        'distrito_id',
        'address',
    ];

    public function pedido(): belongsTo
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function distritos(): HasOne
    {
        return $this->hasOne(Distritos::class, 'id', 'distrito_id');
    }
}
