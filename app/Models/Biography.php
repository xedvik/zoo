<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    use HasFactory;
    protected $fillable = [
        'animal_id',
        'message',
    ];
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
