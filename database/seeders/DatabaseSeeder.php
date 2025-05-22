<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CvSeeder::class,
            ListModelSeeder::class,
            NoteSeeder::class,
            RedirectSeeder::class,
            RedirectHitSeeder::class,
            PortfolioSeeder::class,
            FileReferenceSeeder::class,
            TestobjectSeeder::class,
            TestrunSeeder::class,
            TestinstanceSeeder::class,
            DiffstoreSeeder::class,
            TimetrackSeeder::class,
        ]);
    }
}
