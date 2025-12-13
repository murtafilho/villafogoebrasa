<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Creating reservations...');

        // Create 10 pending reservations for upcoming dates
        Reservation::factory()
            ->count(10)
            ->pending()
            ->create();
        $this->command->info('Created 10 pending reservations');

        // Create 20 confirmed reservations
        Reservation::factory()
            ->count(20)
            ->confirmed()
            ->create();
        $this->command->info('Created 20 confirmed reservations');

        // Create 50 completed reservations (historical)
        Reservation::factory()
            ->count(50)
            ->completed()
            ->create();
        $this->command->info('Created 50 completed reservations');

        // Create 5 cancelled reservations
        Reservation::factory()
            ->count(5)
            ->cancelled()
            ->create();
        $this->command->info('Created 5 cancelled reservations');

        // Create 3 reservations for today
        Reservation::factory()
            ->count(3)
            ->forToday()
            ->create();
        $this->command->info('Created 3 reservations for today');

        $this->command->info('Total reservations created: ' . Reservation::count());
    }
}
