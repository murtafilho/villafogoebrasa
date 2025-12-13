<?php

namespace Database\Factories;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    protected $model = MenuItem::class;

    protected static array $carnesNobres = [
        'Picanha Premium' => ['desc' => 'Corte nobre de 400g, grelhada no ponto', 'price' => 89.90],
        'Costela Angus' => ['desc' => 'Costela bovina de 12 horas no fogo baixo', 'price' => 79.90],
        'Fraldinha Especial' => ['desc' => 'Fraldinha marinada com ervas finas', 'price' => 69.90],
        'Alcatra Completa' => ['desc' => 'Alcatra com maminha e baby beef', 'price' => 74.90],
        'Cordeiro Patagônico' => ['desc' => 'Paleta de cordeiro assada lentamente', 'price' => 94.90],
        'Ancho Uruguaio' => ['desc' => 'Bife ancho 500g com chimichurri', 'price' => 99.90],
        'T-Bone Especial' => ['desc' => 'Corte americano de 600g', 'price' => 119.90],
        'Contra-filé Premium' => ['desc' => 'Contra-filé maturado 21 dias', 'price' => 84.90],
    ];

    protected static array $acompanhamentos = [
        'Arroz Carreteiro' => ['desc' => 'Arroz tradicional gaúcho com charque', 'price' => 24.90],
        'Farofa da Casa' => ['desc' => 'Farofa especial com bacon e ovos', 'price' => 18.90],
        'Vinagrete Artesanal' => ['desc' => 'Vinagrete fresco do dia', 'price' => 12.90],
        'Batata Rústica' => ['desc' => 'Batatas ao murro com alecrim', 'price' => 22.90],
        'Salada Caesar' => ['desc' => 'Mix de folhas, croutons e parmesão', 'price' => 26.90],
        'Legumes Grelhados' => ['desc' => 'Mix de legumes da estação na brasa', 'price' => 28.90],
    ];

    protected static array $sobremesas = [
        'Petit Gateau' => ['desc' => 'Bolo quente de chocolate com sorvete', 'price' => 32.90],
        'Pudim de Leite' => ['desc' => 'Pudim cremoso tradicional', 'price' => 18.90],
        'Mousse de Maracujá' => ['desc' => 'Mousse leve e refrescante', 'price' => 22.90],
        'Cartola' => ['desc' => 'Banana, queijo coalho e canela', 'price' => 24.90],
        'Churros Recheados' => ['desc' => 'Churros com doce de leite e chocolate', 'price' => 19.90],
        'Romeu e Julieta' => ['desc' => 'Goiabada com queijo minas', 'price' => 16.90],
    ];

    protected static array $bebidas = [
        'Vinho Tinto Reserva' => ['desc' => 'Malbec argentino safra 2020', 'price' => 89.90],
        'Caipirinha de Limão' => ['desc' => 'Cachaça artesanal com limão', 'price' => 24.90],
        'Chopp Artesanal' => ['desc' => 'Chopp pilsen 500ml', 'price' => 16.90],
        'Suco Natural' => ['desc' => 'Laranja, limão ou abacaxi', 'price' => 12.90],
        'Água com Gás' => ['desc' => 'Água mineral gaseificada 500ml', 'price' => 8.90],
        'Refrigerante' => ['desc' => 'Coca-Cola, Guaraná ou Sprite', 'price' => 9.90],
    ];

    public function definition(): array
    {
        $allItems = array_merge(
            self::$carnesNobres,
            self::$acompanhamentos,
            self::$sobremesas,
            self::$bebidas
        );

        $name = $this->faker->randomElement(array_keys($allItems));
        $item = $allItems[$name];

        return [
            'category_id' => MenuCategory::factory(),
            'name' => $name . ' ' . $this->faker->unique()->numberBetween(1, 1000),
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1, 1000),
            'description' => $item['desc'],
            'price' => $item['price'],
            'is_featured' => $this->faker->boolean(20),
            'is_active' => true,
            'sort_order' => $this->faker->numberBetween(1, 100),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function forCategory(MenuCategory $category): static
    {
        return $this->state(fn (array $attributes) => [
            'category_id' => $category->id,
        ]);
    }
}
