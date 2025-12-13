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
        $this->command->info('Starting database seeding...');
        $this->command->newLine();

        // 1. Create roles first
        $this->command->info('=== Creating Roles ===');
        $this->call(RoleSeeder::class);
        $this->command->newLine();

        // 2. Create users
        $this->command->info('=== Creating Users ===');
        $this->call(UserSeeder::class);
        $this->command->newLine();

        // 3. Create menu categories
        $this->command->info('=== Creating Menu Categories ===');
        $this->call(MenuCategorySeeder::class);
        $this->command->newLine();

        // 4. Create menu items
        $this->command->info('=== Creating Menu Items ===');
        $this->call(MenuItemSeeder::class);
        $this->command->newLine();

        // 5. Create reservations
        $this->command->info('=== Creating Reservations ===');
        $this->call(ReservationSeeder::class);
        $this->command->newLine();

        // 6. Create gallery
        $this->command->info('=== Creating Gallery ===');
        $this->call(GallerySeeder::class);
        $this->command->newLine();

        $this->command->info('Database seeding completed successfully!');
    }
}
