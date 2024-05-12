<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 */
class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'city_id',
        'cpf',
        'photo',
        'cep',
        'address',
        'number',
        'complement',
        'sex_enum',
    ];

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
