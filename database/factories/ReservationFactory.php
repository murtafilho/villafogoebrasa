<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    protected static array $occasions = [
        'Aniversário',
        'Jantar Romântico',
        'Confraternização',
        'Reunião de Negócios',
        'Celebração',
        'Encontro de Família',
        null,
    ];

    protected static array $timeSlots = [
        '11:30', '12:00', '12:30', '13:00', '13:30',
        '19:00', '19:30', '20:00', '20:30', '21:00', '21:30',
    ];

    public function definition(): array
    {
        return [
            'name' => fake('pt_BR')->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake('pt_BR')->cellphoneNumber(),
            'date' => fake()->dateTimeBetween('now', '+2 months')->format('Y-m-d'),
            'time' => fake()->randomElement(self::$timeSlots),
            'guests' => fake()->numberBetween(1, 12),
            'occasion' => fake()->randomElement(self::$occasions),
            'notes' => fake()->boolean(30) ? fake('pt_BR')->sentence() : null,
            'status' => fake()->randomElement([
                Reservation::STATUS_PENDING,
                Reservation::STATUS_CONFIRMED,
                Reservation::STATUS_COMPLETED,
            ]),
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Reservation::STATUS_PENDING,
            'date' => fake()->dateTimeBetween('+1 day', '+2 months')->format('Y-m-d'),
        ]);
    }

    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Reservation::STATUS_CONFIRMED,
            'date' => fake()->dateTimeBetween('+1 day', '+2 months')->format('Y-m-d'),
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Reservation::STATUS_COMPLETED,
            'date' => fake()->dateTimeBetween('-2 months', '-1 day')->format('Y-m-d'),
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Reservation::STATUS_CANCELLED,
        ]);
    }

    public function forToday(): static
    {
        return $this->state(fn (array $attributes) => [
            'date' => now()->format('Y-m-d'),
            'status' => Reservation::STATUS_CONFIRMED,
        ]);
    }
}
