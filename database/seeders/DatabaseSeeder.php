<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Note::factory(10)->create();
    }
}
