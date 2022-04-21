<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as EloquentModel;

class Book extends EloquentModel
{
    protected $connection = 'mongodb';
    protected $collection = 'my_books_collection';
    protected $fillable = ['name', 'tahun'];
}
