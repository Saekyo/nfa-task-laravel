<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Book;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'order_number',
        'total_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
