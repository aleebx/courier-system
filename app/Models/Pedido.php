<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'negocio_id',
        'motorizado_id',
        'type_pedido_id',
        'fecha_entrega',
        'fecha_asignado',
        'servicio',
        'extra',
        'reutilizado',
        'reagendado'
    ];

    public function pedido_detalles(): HasOne
    {
        return $this->hasOne(Pedido_detalle::class);
    }

    public function pedido_pagos(): hasMany
    {
        return $this->hasMany(Pedido_pago::class);
    }

    public function pedido_seguimientos(): HasMany
    {
        return $this->hasMany(Pedido_seguimiento::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function negocio(): belongsTo
    {
        return $this->belongsTo(Negocio::class);
    }

    public function destinatario(): HasOne
    {
        return $this->hasOne(Destinatario::class);
    }

    public function pedido_incidencias(): HasMany
    {
        return $this->hasMany(Pedido_incidencia::class);
    }

    public function motorizado(): belongsTo
    {
        return $this->belongsTo(Motorizado::class);
    }

}

