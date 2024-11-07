<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookInstance extends Model
{
    use HasFactory;

    protected $fillable = [
        'due_back',
        'is_available',
        'book_id',
        'borrower_id',
    ];

    /**
     * Get the Book.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the Borrower User.
     */
    public function borrower()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1);
    }
    
    public function scopeBorrowed($query)
    {
        return $query->where('is_available', 0);
    }
}
