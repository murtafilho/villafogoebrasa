<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/menu_data.json');

        if (! file_exists($jsonPath)) {
            $this->command->error('Arquivo menu_data.json não encontrado!');
            return;
        }

        $menuData = json_decode(file_get_contents($jsonPath), true);

        if (! is_array($menuData)) {
            $this->command->error('Erro ao decodificar JSON!');
            return;
        }

        // Limpar dados existentes
        MenuItem::query()->delete();
        MenuCategory::query()->delete();

        $sortOrder = 0;

        foreach ($menuData as $categoryName => $items) {
            $sortOrder++;

            // Criar categoria
            $category = MenuCategory::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'description' => null,
                'sort_order' => $sortOrder,
                'is_active' => true,
            ]);

            $itemSortOrder = 0;

            foreach ($items as $item) {
                $itemSortOrder++;

                // Converter preço de "75,00" para 75.00
                $price = null;
                if (! empty($item['preco'])) {
                    $price = (float) str_replace(',', '.', $item['preco']);
                }

                MenuItem::create([
                    'category_id' => $category->id,
                    'name' => $item['nome'],
                    'slug' => Str::slug($item['nome']) . '-' . uniqid(),
                    'description' => $item['descricao'] ?? null,
                    'subcategory' => ! empty($item['subcategoria']) ? $item['subcategoria'] : null,
                    'price' => $price,
                    'is_featured' => false,
                    'is_active' => true,
                    'sort_order' => $itemSortOrder,
                ]);
            }

            $this->command->info("Categoria '{$categoryName}' importada com {$itemSortOrder} itens.");
        }

        $this->command->info('Importação concluída!');
    }
}
