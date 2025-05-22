<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandybarRating extends Model
{
    /** @use HasFactory<\Database\Factories\CandybarRatingFactory> */
    use HasFactory;

    protected $fillable = [
        'candybar_id',
        'user_id',
        'score',
        'comment',
    ];

    public function candybar(): BelongsTo
    {
        return $this->belongsTo(Candybar::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
