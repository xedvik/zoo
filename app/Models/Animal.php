<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'gender',
        'age',
        'satiety',
        'is_alive',
        'class',
        'species',
        'enclosure_id',
    ];
    protected $casts = [
        'is_alive' => 'boolean',
        'age' => 'integer',
        'satiety' => 'integer',
    ];
    /**
     * Получить вольер, в котором находится животное
     * @return BelongsTo
     */
    public function enclosure(): BelongsTo
    {
        return $this->belongsTo(Enclosure::class);
    }
    /**
     * Получить биографии животного
     * @return HasMany
     */
    public function biographies(): HasMany
    {
        return $this->hasMany(Biography::class);
    }
}
