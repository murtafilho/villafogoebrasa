<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    protected array $images = [
        'ambiente' => [
            ['title' => 'Salão Principal', 'desc' => 'Ambiente elegante e acolhedor para momentos especiais', 'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200', 'featured' => true],
            ['title' => 'Área VIP', 'desc' => 'Espaço reservado para grupos e eventos privados', 'image' => 'https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?w=1200', 'featured' => true],
            ['title' => 'Varanda Gourmet', 'desc' => 'Vista privilegiada e ar livre para dias especiais', 'image' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=1200', 'featured' => false],
            ['title' => 'Adega Climatizada', 'desc' => 'Mais de 200 rótulos para harmonizar', 'image' => 'https://images.unsplash.com/photo-1506377247377-2a5b3b417ebb?w=1200', 'featured' => false],
            ['title' => 'Mesa do Chef', 'desc' => 'Experiência exclusiva com vista para a cozinha', 'image' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1200', 'featured' => false],
            ['title' => 'Lounge Bar', 'desc' => 'Drinks e petiscos em ambiente sofisticado', 'image' => 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?w=1200', 'featured' => false],
            ['title' => 'Entrada Principal', 'desc' => 'Recepção calorosa ao estilo gaúcho', 'image' => 'https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?w=1200', 'featured' => false],
            ['title' => 'Iluminação Noturna', 'desc' => 'Ambiente mágico para jantares românticos', 'image' => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=1200', 'featured' => false],
        ],
        'pratos' => [
            ['title' => 'Picanha na Brasa', 'desc' => 'Nosso carro-chefe, preparada com perfeição', 'image' => 'https://images.unsplash.com/photo-1594041680534-e8c8cdebd659?w=1200', 'featured' => true],
            ['title' => 'Costela Premium', 'desc' => 'Costela assada lentamente por 12 horas', 'image' => 'https://images.unsplash.com/photo-1529694157872-4e0c0f3b238b?w=1200', 'featured' => true],
            ['title' => 'Buffet de Saladas', 'desc' => 'Saladas frescas e variadas diariamente', 'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=1200', 'featured' => false],
            ['title' => 'Mesa de Frios', 'desc' => 'Queijos e embutidos selecionados', 'image' => 'https://images.unsplash.com/photo-1541014741259-de529411b96a?w=1200', 'featured' => false],
            ['title' => 'Sobremesas Artesanais', 'desc' => 'Doces feitos com amor e tradição', 'image' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=1200', 'featured' => false],
            ['title' => 'Espetadas Variadas', 'desc' => 'Cortes nobres servidos na espada', 'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=1200', 'featured' => false],
            ['title' => 'Carré de Cordeiro', 'desc' => 'Cordeiro patagônico com ervas finas', 'image' => 'https://images.unsplash.com/photo-1514516345957-556ca7d90a29?w=1200', 'featured' => false],
            ['title' => 'Ancho Grelhado', 'desc' => 'Corte argentino de primeira qualidade', 'image' => 'https://images.unsplash.com/photo-1558030006-450675393462?w=1200', 'featured' => false],
            ['title' => 'Apresentação do Buffet', 'desc' => 'Variedade e qualidade em cada detalhe', 'image' => 'https://images.unsplash.com/photo-1498654896293-37aacf113fd9?w=1200', 'featured' => false],
            ['title' => 'Petit Gateau', 'desc' => 'Sobremesa quente com sorvete', 'image' => 'https://images.unsplash.com/photo-1624353365286-3f8d62daad51?w=1200', 'featured' => false],
        ],
        'eventos' => [
            ['title' => 'Confraternização Empresarial', 'desc' => 'Evento corporativo de fim de ano', 'image' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=1200', 'featured' => true],
            ['title' => 'Aniversário Especial', 'desc' => 'Celebração de 50 anos inesquecível', 'image' => 'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=1200', 'featured' => false],
            ['title' => 'Casamento Íntimo', 'desc' => 'Cerimônia e recepção em ambiente acolhedor', 'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1200', 'featured' => false],
            ['title' => 'Formatura', 'desc' => 'Celebração de conquistas acadêmicas', 'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200', 'featured' => false],
            ['title' => 'Reunião de Negócios', 'desc' => 'Ambiente perfeito para fechar negócios', 'image' => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=1200', 'featured' => false],
            ['title' => 'Happy Hour', 'desc' => 'Descontração com a equipe de trabalho', 'image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=1200', 'featured' => false],
        ],
        'equipe' => [
            ['title' => 'Chef Executivo', 'desc' => 'Mais de 20 anos de experiência em gastronomia', 'image' => 'https://images.unsplash.com/photo-1577219491135-ce391730fb2c?w=1200', 'featured' => true],
            ['title' => 'Mestre Churrasqueiro', 'desc' => 'A arte do churrasco em mãos experientes', 'image' => 'https://images.unsplash.com/photo-1585518419759-7fe2e0fbf8a6?w=1200', 'featured' => true],
            ['title' => 'Sommelier', 'desc' => 'Especialista em harmonização de vinhos', 'image' => 'https://images.unsplash.com/photo-1516594915307-8f71bcaed832?w=1200', 'featured' => false],
            ['title' => 'Equipe de Atendimento', 'desc' => 'Profissionais dedicados ao seu conforto', 'image' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=1200', 'featured' => false],
            ['title' => 'Cozinha em Ação', 'desc' => 'Bastidores da preparação dos pratos', 'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=1200', 'featured' => false],
            ['title' => 'Time Completo', 'desc' => 'Uma família dedicada a você', 'image' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=1200', 'featured' => false],
        ],
    ];

    public function run(): void
    {
        foreach ($this->images as $category => $items) {
            foreach ($items as $index => $itemData) {
                $gallery = Gallery::create([
                    'title' => $itemData['title'],
                    'description' => $itemData['desc'],
                    'category' => $category,
                    'is_featured' => $itemData['featured'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ]);

                // Add image from URL
                try {
                    $gallery->addMediaFromUrl($itemData['image'])
                        ->toMediaCollection('image');
                } catch (\Exception $e) {
                    $this->command->warn("Could not download image for: {$itemData['title']}");
                }

                $this->command->info("Created gallery: {$itemData['title']} ({$category})");
            }
        }

        $this->command->info('Total gallery images created: ' . Gallery::count());
    }
}
