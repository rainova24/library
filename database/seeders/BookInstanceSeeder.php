<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookInstanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\BookInstance::factory(10)->create();
    }
}
