<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }

    /**
     * Get the books
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
