<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Candybar extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'amount',
        'candybarTreshhold',
        'isAvailable'
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
