<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashcardsSet extends Model
{
    use HasFactory;

    protected $table = 'flashcards_sets';

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'user_id'
    ];

    public function flashcards_cards()
    {
        return $this->hasMany(FlashcardsCard::class, 'set_id');
    }
}
