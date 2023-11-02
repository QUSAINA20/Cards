<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardValue extends Model
{
    use HasFactory;
    protected $fillable = ['value','daily_price', 'placeholder', 'status','card_type_id' ];

    /**
     * Get the card_type that owns the CardValue
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card_type(): BelongsTo
    {
        return $this->belongsTo(CardType::class);
    }
}
