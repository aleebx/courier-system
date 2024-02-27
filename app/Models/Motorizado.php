<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Motorizado extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'namefull',
        'email',
        'phone',
        'status',
        'type_document',
        'document',
        'photo_document',
        'departamento_id',
        'provincia_id',
        'distrito_id',
        'address',
        'placa',
        'color',
        'brand',
        'model',
        'year',
        'photo',
        'license_expiration',
        'photo_license',
        'soat_expiration',
        'photo_soat',
    ];

    /**
     * Get the user associated with the motorizado. $motorizado->user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function distritos()
    {
        return $this->hasOne(Distritos::class, 'id', 'distrito_id');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

}
