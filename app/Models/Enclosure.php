<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enclosure extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'is_open',
        'is_locked',
        'has_roof',
        'food_type',
        'food_amount',
    ];

    protected $casts = [
        'type' => 'string',
        'is_open' => 'boolean',
        'is_locked' => 'boolean',
        'has_roof' => 'boolean',
        'food_amount' => 'integer',
    ];

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
