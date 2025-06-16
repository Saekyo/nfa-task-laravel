<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Author;
use App\Models\Transaction;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'genre_id',
        'published_year',
        'description',
        'cover_image'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
