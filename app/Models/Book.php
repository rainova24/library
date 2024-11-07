<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'author', 'publication_date', 'category_id'];

    protected $casts = [
        'publication_date' => 'date:Y-m-d',
    ];

    /**
     * Get the category of the book.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the book instances.
     */
    public function book_instances()
    {
        return $this->hasMany(BookInstance::class);
    }
}
