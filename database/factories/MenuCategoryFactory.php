<?php

namespace Database\Factories;

use App\Models\MenuCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuCategory>
 */
class MenuCategoryFactory extends Factory
{
    protected $model = MenuCategory::class;

    protected static array $categories = [
        'Carnes Nobres' => 'As melhores carnes selecionadas para você',
        'Rodízio' => 'Nosso famoso rodízio de carnes premium',
        'Acompanhamentos' => 'Buffet completo com saladas e acompanhamentos',
        'Sobremesas' => 'Doces artesanais para finalizar sua experiência',
        'Bebidas' => 'Carta de vinhos e bebidas selecionadas',
        'Entradas' => 'Petiscos e entradas especiais',
        'Pratos Executivos' => 'Opções rápidas para o dia a dia',
        'Especiais da Casa' => 'Criações exclusivas do nosso chef',
    ];

    protected static int $categoryIndex = 0;

    public function definition(): array
    {
        $categories = array_keys(self::$categories);
        $name = $categories[self::$categoryIndex % count($categories)];
        $description = self::$categories[$name];
        self::$categoryIndex++;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $description,
            'sort_order' => self::$categoryIndex,
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
