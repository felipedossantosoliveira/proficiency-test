<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city_id',
        'cpf',
        'photo',
        'cep',
        'address',
        'number',
        'complement',
        'sex_enum'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
