<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CardType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];

    /**
     * Get all of the card_value for the CardType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function card_value(): HasMany
    {
        return $this->hasMany(CardValue::class);
    }
}
