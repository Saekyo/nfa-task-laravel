<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public static function getAuthor()
    {
        $authors = [
            ['id' => 1, 'name' => 'George Orwell'],
            ['id' => 2, 'name' => 'J.K. Rowling'],
            ['id' => 3, 'name' => 'Agatha Christie'],
            ['id' => 4, 'name' => 'Stephen King'],
            ['id' => 5, 'name' => 'Isaac Asimov'],
        ];

        return $authors;
    }
}
