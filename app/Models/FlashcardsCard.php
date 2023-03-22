<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashcardsCard extends Model
{
    use HasFactory;

    protected $table = 'flashcards_cards';

    protected $fillable = [
        'term',
        'definition',
        'user_id'
    ];
}
