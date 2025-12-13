<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    protected static array $titles = [
        'ambiente' => [
            'Salão Principal',
            'Área VIP',
            'Varanda Gourmet',
            'Adega Climatizada',
            'Mesa do Chef',
            'Espaço Kids',
            'Lounge Bar',
            'Terraço Panorâmico',
        ],
        'pratos' => [
            'Picanha Grelhada',
            'Costela Premium',
            'Buffet de Saladas',
            'Mesa de Frios',
            'Sobremesas Artesanais',
            'Espetadas Especiais',
            'Carré de Cordeiro',
            'Ancho na Brasa',
        ],
        'eventos' => [
            'Confraternização de Fim de Ano',
            'Aniversário Corporativo',
            'Casamento Íntimo',
            'Formatura Especial',
            'Reunião de Negócios',
            'Happy Hour Premium',
            'Lançamento de Produto',
            'Festa de Família',
        ],
        'equipe' => [
            'Chef Executivo',
            'Churrasqueiro Mestre',
            'Sommelier',
            'Equipe de Atendimento',
            'Cozinha em Ação',
            'Barman Especialista',
            'Time Completo',
            'Bastidores da Casa',
        ],
    ];

    public function definition(): array
    {
        $category = fake()->randomElement(array_keys(self::$titles));
        $title = fake()->randomElement(self::$titles[$category]);

        return [
            'title' => $title,
            'description' => fake('pt_BR')->sentence(10),
            'category' => $category,
            'is_featured' => fake()->boolean(25),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }

    public function ambiente(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => Gallery::CATEGORY_AMBIENTE,
                'title' => fake()->randomElement(self::$titles['ambiente']),
            ];
        });
    }

    public function pratos(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => Gallery::CATEGORY_PRATOS,
                'title' => fake()->randomElement(self::$titles['pratos']),
            ];
        });
    }

    public function eventos(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => Gallery::CATEGORY_EVENTOS,
                'title' => fake()->randomElement(self::$titles['eventos']),
            ];
        });
    }

    public function equipe(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => Gallery::CATEGORY_EQUIPE,
                'title' => fake()->randomElement(self::$titles['equipe']),
            ];
        });
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
}
