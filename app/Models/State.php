<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class State
 */
class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abbreviation',
    ];

    /**
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
