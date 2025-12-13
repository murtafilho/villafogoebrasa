<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuCategorySeeder extends Seeder
{
    protected array $categories = [
        [
            'name' => 'Carnes Nobres',
            'description' => 'As melhores carnes selecionadas, cortes nobres preparados na brasa com a tradição gaúcha',
            'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=800',
        ],
        [
            'name' => 'Rodízio Completo',
            'description' => 'Nosso famoso rodízio com mais de 20 cortes de carnes premium e buffet completo',
            'image' => 'https://images.unsplash.com/photo-1558030006-450675393462?w=800',
        ],
        [
            'name' => 'Acompanhamentos',
            'description' => 'Buffet completo com saladas frescas, pratos quentes e guarnições especiais',
            'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800',
        ],
        [
            'name' => 'Sobremesas',
            'description' => 'Doces artesanais e sobremesas tradicionais para finalizar sua experiência',
            'image' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=800',
        ],
        [
            'name' => 'Carta de Vinhos',
            'description' => 'Seleção especial de vinhos nacionais e importados para harmonizar com sua refeição',
            'image' => 'https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?w=800',
        ],
        [
            'name' => 'Entradas',
            'description' => 'Petiscos e entradas para abrir o apetite com sabores marcantes',
            'image' => 'https://images.unsplash.com/photo-1541014741259-de529411b96a?w=800',
        ],
        [
            'name' => 'Bebidas',
            'description' => 'Drinks, sucos naturais, cervejas artesanais e refrigerantes',
            'image' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=800',
        ],
        [
            'name' => 'Especiais do Chef',
            'description' => 'Criações exclusivas do nosso chef executivo com ingredientes premium',
            'image' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e?w=800',
        ],
    ];

    public function run(): void
    {
        foreach ($this->categories as $index => $categoryData) {
            $category = MenuCategory::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);

            // Add cover image from URL
            try {
                $category->addMediaFromUrl($categoryData['image'])
                    ->toMediaCollection('cover');
            } catch (\Exception $e) {
                $this->command->warn("Could not download image for: {$categoryData['name']}");
            }

            $this->command->info("Created category: {$categoryData['name']}");
        }
    }
}
