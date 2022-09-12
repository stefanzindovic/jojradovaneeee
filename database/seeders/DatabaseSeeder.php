<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BookCategory;
use App\Models\BookGenre;
use App\Models\Format;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            GenreSeeder::class,
            PublishersSeeder::class,
            CoverSeeder::class,
            FormatSeeder::class,
            ScriptSeeder::class,
            LanguageSeeder::class,
            AuthorSeeder::class,
            UserSeeder::class,
            BookSeeder::class,
            BookCategoriesSeeder::class,
            BookGenresSeeder::class,
            BookAuthorsSeeder::class,
        ]);
    }
}
