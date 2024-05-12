<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class City
 */
class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state_id',
    ];

    /**
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * @return HasMany
     */
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
