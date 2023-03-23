<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashcardsCategory extends Model
{
    use HasFactory;

    protected $table = 'flashcards_categories';

    protected $fillable = [
        'category',
        'color',
        'user_id'
    ];

    public function flashcards_sets()
    {
        return $this->hasMany(FlashcardsSet::class, 'category_id');
    }
}
