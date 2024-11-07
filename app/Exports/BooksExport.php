<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Book::with('category')->get(); // Fetch books along with their category
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Author',
            'Publication Date',
            'Category',
        ];
    }
}