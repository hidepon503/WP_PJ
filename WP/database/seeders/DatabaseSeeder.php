<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(GendersTableSeeder::class);
        $this->call(KindsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ManagersTableSeeder::class);
        $this->call(GovernmentsTableSeeder::class);
        $this->call(CatsTableSeeder::class);
        $this->call(RelationsTableSeeder::class);
        $this->call(RequestsTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(DiseasesTableSeeder::class);
        $this->call(TreatmentHistoriesTableSeeder::class);
        $this->call(AreasTableSeeder::class);
    }
}
