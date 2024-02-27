<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Negocio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'name_encargado',
        'type_negocio',
        'type_document',
        'document',
        'departamento_id', 
        'provincia_id',
        'distrito_id',
        'address',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }

    public function distritos(): HasOne
    {
        return $this->hasOne(Distritos::class, 'id', 'distrito_id');
    }
}
