<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Distritos extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dias',
        'status',
        'provincia_id',
        'departamento_id',
        'tarifa',
        'tarifa_motorizado',
        'detalle',
    ];

    public function destinatario(): hasMany
    {
        return $this->hasMany(Destinatario::class, 'distrito_id');
    }

    public function motorizado(): hasMany
    {
        return $this->hasMany(Motorizado::class, 'distrito_id');
    }

    public function negocio(): hasMany
    {
        return $this->hasMany(Negocio::class, 'distrito_id');
    }
}
