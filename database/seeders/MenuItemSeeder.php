<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuItemSeeder extends Seeder
{
    protected array $items = [
        'Carnes Nobres' => [
            ['name' => 'Picanha Premium', 'desc' => 'Corte nobre de 400g grelhado no ponto, acompanha farofa e vinagrete', 'price' => 89.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1594041680534-e8c8cdebd659?w=600'],
            ['name' => 'Costela Angus 12h', 'desc' => 'Costela bovina assada lentamente por 12 horas no fogo baixo', 'price' => 79.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1529694157872-4e0c0f3b238b?w=600'],
            ['name' => 'Fraldinha na Brasa', 'desc' => 'Fraldinha marinada com ervas finas e assada na brasa', 'price' => 69.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1588168333986-5078d3ae3976?w=600'],
            ['name' => 'Alcatra Completa', 'desc' => 'Alcatra com maminha e baby beef, servida fatiada', 'price' => 74.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1546833998-877b37c2e5c6?w=600'],
            ['name' => 'Cordeiro Patagônico', 'desc' => 'Paleta de cordeiro assada lentamente com alecrim', 'price' => 94.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1514516345957-556ca7d90a29?w=600'],
            ['name' => 'Ancho Uruguaio 500g', 'desc' => 'Bife ancho importado com chimichurri artesanal', 'price' => 99.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1558030006-450675393462?w=600'],
            ['name' => 'T-Bone Especial', 'desc' => 'Corte americano de 600g com osso', 'price' => 119.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1615937722923-67f6deaf2cc9?w=600'],
            ['name' => 'Contra-filé Maturado', 'desc' => 'Contra-filé maturado por 21 dias, sabor intenso', 'price' => 84.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e?w=600'],
            ['name' => 'Bife de Chorizo', 'desc' => 'Corte argentino suculento de 450g', 'price' => 92.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1432139555190-58524dae6a55?w=600'],
            ['name' => 'Maminha ao Ponto', 'desc' => 'Maminha temperada e grelhada ao ponto', 'price' => 64.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1504973960431-1c467e159aa4?w=600'],
        ],
        'Rodízio Completo' => [
            ['name' => 'Rodízio Tradicional', 'desc' => 'Mais de 20 cortes de carnes + buffet completo de saladas e acompanhamentos', 'price' => 129.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600'],
            ['name' => 'Rodízio Premium', 'desc' => 'Rodízio tradicional + carnes nobres especiais e carta de vinhos', 'price' => 179.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600'],
            ['name' => 'Rodízio Kids (até 10 anos)', 'desc' => 'Rodízio completo para crianças', 'price' => 64.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=600'],
            ['name' => 'Rodízio Executivo', 'desc' => 'Versão almoço com 15 cortes + buffet (seg-sex)', 'price' => 89.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1498654896293-37aacf113fd9?w=600'],
        ],
        'Acompanhamentos' => [
            ['name' => 'Arroz Carreteiro', 'desc' => 'Arroz tradicional gaúcho com charque desfiado', 'price' => 24.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1536304993881-ff6e9eefa2a6?w=600'],
            ['name' => 'Farofa da Casa', 'desc' => 'Farofa especial com bacon crocante e ovos', 'price' => 18.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1574484284002-952d92456975?w=600'],
            ['name' => 'Vinagrete Artesanal', 'desc' => 'Vinagrete fresco preparado diariamente', 'price' => 12.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1608897013039-887f21d8c804?w=600'],
            ['name' => 'Batata Rústica', 'desc' => 'Batatas ao murro com alecrim e alho', 'price' => 22.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1518013431117-eb1465fa5752?w=600'],
            ['name' => 'Salada Caesar', 'desc' => 'Mix de folhas, croutons, parmesão e molho caesar', 'price' => 26.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1546793665-c74683f339c1?w=600'],
            ['name' => 'Legumes Grelhados', 'desc' => 'Mix de legumes da estação grelhados na brasa', 'price' => 28.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=600'],
            ['name' => 'Polenta Frita', 'desc' => 'Polenta cremosa empanada e frita', 'price' => 19.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1551326844-4df70f78d0e9?w=600'],
            ['name' => 'Mandioca Frita', 'desc' => 'Mandioca cozida e frita, crocante por fora', 'price' => 21.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1528750997573-59b89d56f4f7?w=600'],
        ],
        'Sobremesas' => [
            ['name' => 'Petit Gateau', 'desc' => 'Bolo quente de chocolate com sorvete de creme', 'price' => 32.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1624353365286-3f8d62daad51?w=600'],
            ['name' => 'Pudim de Leite', 'desc' => 'Pudim cremoso tradicional com calda de caramelo', 'price' => 18.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1528975604071-b4dc52a2d18c?w=600'],
            ['name' => 'Mousse de Maracujá', 'desc' => 'Mousse leve e refrescante de maracujá', 'price' => 22.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=600'],
            ['name' => 'Cartola Pernambucana', 'desc' => 'Banana caramelizada, queijo coalho e canela', 'price' => 24.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=600'],
            ['name' => 'Churros Recheados', 'desc' => 'Churros com doce de leite e chocolate', 'price' => 19.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1624371414361-e670edf4898d?w=600'],
            ['name' => 'Romeu e Julieta', 'desc' => 'Goiabada cascão com queijo minas artesanal', 'price' => 16.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=600'],
        ],
        'Carta de Vinhos' => [
            ['name' => 'Malbec Reserva', 'desc' => 'Vinho argentino encorpado, safra 2020', 'price' => 89.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1510812431401-41d2bd2722f3?w=600'],
            ['name' => 'Cabernet Sauvignon', 'desc' => 'Vinho chileno com notas de frutas vermelhas', 'price' => 79.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1553361371-9b22f78e8b1d?w=600'],
            ['name' => 'Tannat Uruguaio', 'desc' => 'Vinho intenso com taninos marcantes', 'price' => 94.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1586370434639-0fe43b2d32e6?w=600'],
            ['name' => 'Espumante Brut', 'desc' => 'Espumante brasileiro para celebrar', 'price' => 69.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1549497538-303791108f95?w=600'],
            ['name' => 'Vinho Branco Chardonnay', 'desc' => 'Refrescante e frutado, ideal com entradas', 'price' => 74.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1566754436893-1c1e8526e0eb?w=600'],
        ],
        'Entradas' => [
            ['name' => 'Tábua de Frios', 'desc' => 'Seleção de queijos, presunto, salame e azeitonas', 'price' => 59.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1541014741259-de529411b96a?w=600'],
            ['name' => 'Coxinha de Costela', 'desc' => 'Coxinha recheada com costela desfiada', 'price' => 34.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=600'],
            ['name' => 'Bolinho de Carne Seca', 'desc' => 'Bolinhos crocantes com carne seca e cream cheese', 'price' => 32.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600'],
            ['name' => 'Bruschetta de Tomate', 'desc' => 'Pão italiano com tomate, manjericão e azeite', 'price' => 24.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1572695157366-5e585ab2b69f?w=600'],
            ['name' => 'Provolone à Milanesa', 'desc' => 'Queijo provolone empanado e frito', 'price' => 38.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=600'],
        ],
        'Bebidas' => [
            ['name' => 'Caipirinha de Limão', 'desc' => 'Cachaça artesanal com limão tahiti', 'price' => 24.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1551538827-9c037cb4f32a?w=600'],
            ['name' => 'Chopp Artesanal 500ml', 'desc' => 'Chopp pilsen gelado, servido na caneca', 'price' => 16.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1535958636474-b021ee887b13?w=600'],
            ['name' => 'Suco Natural', 'desc' => 'Laranja, limão, abacaxi ou maracujá', 'price' => 12.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1534353473418-4cfa6c56fd38?w=600'],
            ['name' => 'Água com Gás 500ml', 'desc' => 'Água mineral gaseificada', 'price' => 8.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1559839914-17aae19cec71?w=600'],
            ['name' => 'Refrigerante Lata', 'desc' => 'Coca-Cola, Guaraná Antarctica ou Sprite', 'price' => 9.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1581006852262-e4307cf6283a?w=600'],
            ['name' => 'Drink Moscow Mule', 'desc' => 'Vodka, gengibre e limão na caneca de cobre', 'price' => 34.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=600'],
        ],
        'Especiais do Chef' => [
            ['name' => 'Medalhão ao Molho Madeira', 'desc' => 'Filé mignon em medalhões com molho madeira e cogumelos', 'price' => 109.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1558030006-450675393462?w=600'],
            ['name' => 'Risoto de Funghi', 'desc' => 'Risoto cremoso com mix de cogumelos frescos', 'price' => 74.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1476124369491-e7addf5db371?w=600'],
            ['name' => 'Salmão Grelhado', 'desc' => 'Salmão fresco grelhado com ervas e limão siciliano', 'price' => 89.90, 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=600'],
            ['name' => 'Tornedor Rossini', 'desc' => 'Filé mignon com foie gras e molho trufado', 'price' => 149.90, 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e?w=600'],
        ],
    ];

    public function run(): void
    {
        foreach ($this->items as $categoryName => $items) {
            $category = MenuCategory::where('name', $categoryName)->first();

            if (!$category) {
                $this->command->warn("Category not found: {$categoryName}");
                continue;
            }

            foreach ($items as $index => $itemData) {
                $menuItem = MenuItem::create([
                    'category_id' => $category->id,
                    'name' => $itemData['name'],
                    'slug' => Str::slug($itemData['name']),
                    'description' => $itemData['desc'],
                    'price' => $itemData['price'],
                    'is_featured' => $itemData['featured'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ]);

                // Add photo from URL
                try {
                    $menuItem->addMediaFromUrl($itemData['image'])
                        ->toMediaCollection('photo');
                } catch (\Exception $e) {
                    $this->command->warn("Could not download image for: {$itemData['name']}");
                }

                $this->command->info("Created item: {$itemData['name']}");
            }
        }
    }
}
