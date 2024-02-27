<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metodo_pago extends Model
{
    use HasFactory;

    protected $table = 'metodo_pago';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $guarded = [];

    public function Pedido_pago()
    {
        return $this->hasMany(Pedido_pago::class, 'metodo_pago_id', 'id');
    }

}
