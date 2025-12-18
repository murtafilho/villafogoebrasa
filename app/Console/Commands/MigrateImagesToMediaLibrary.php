<?php

namespace App\Console\Commands;

use App\Models\Gallery;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MigrateImagesToMediaLibrary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:migrate-to-media-library';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migra imagens da pasta public/img para o Spatie Media Library';

    /**
     * Mapeamento de nomes de arquivos para nomes de itens do menu
     */
    protected array $menuItemMapping = [
        'agua mineral.jpg' => ['Agua Mineral', 'Água Mineral'],
        'balde de cervejas.jpg' => ['Balde de Cervejas'],
        'banana caramelizada.jpg' => ['Banana Caramelizada', 'Cartola Pernambucana'],
        'batata frita com briscket ou pallet pork.jpg' => ['Batata Frita'],
        'batata rockford.jpg' => ['Batata Rústica', 'Batata Rockford'],
        'bife ancho.jpg' => ['Ancho Uruguaio 500g', 'Bife Ancho'],
        'burrata.jpg' => ['Burrata'],
        'café expresso.jpg' => ['Café Expresso'],
        'capuccino gelado.jpg' => ['Capuccino Gelado'],
        'capuccino.jpg' => ['Capuccino'],
        'carpaccio.jpg' => ['Carpaccio'],
        'cerveja long neck 0 alcool.jpg' => ['Cerveja Long Neck 0 Álcool'],
        'cerveja long neck.jpg' => ['Cerveja Long Neck'],
        'cerveja sem gluten.jpg' => ['Cerveja Sem Glúten'],
        'cervejas artesanais.jpg' => ['Cervejas Artesanais', 'Chopp Artesanal 500ml'],
        'cheese cake.jpg' => ['Cheese Cake', 'Petit Gateau'],
        'chocolate quente.jpg' => ['Chocolate Quente'],
        'chops.jpg' => ['Chopps Artesanais', 'Chopp Artesanal 500ml', 'Chops', 'Chop'],
        'costelão.jpg' => ['Costela de boi', 'Costela', 'Costelão', 'Costela Angus', 'Arroz de Costela'],
        'fettutine alfredo.jpg' => ['Fettuccine Com Tornedor de Filé', 'Fettuccine', 'Fettutine', 'Fettuccine Alfredo'],
        'vacio.jpg' => ['Bife de Vazio -Fraldinha', 'Vacio', 'Vazio', 'Fraldinha'],
        'vodkas.jpg' => ['Vodka Absolut', 'Vodka', 'Vodkas', 'Caipvodka'],
        'whiskys.jpg' => ['Whisky Sour', 'Whisky', 'Whiskys', 'Whiskey'],
        'tropeirão.jpg' => ['Feijão tropeiro', 'Tropeiro', 'Tropeirão'],
        'cigarros.jpg' => ['Cigarro', 'Cigarros'],
        'choripan.jpg' => ['Choripan'],
        'chorizo angus.jpg' => ['Chorizo Angus', 'Bife de Chorizo'],
        'cigarros.jpg' => ['Cigarros'],
        'costelão.jpg' => ['Costela Angus 12h', 'Costelão'],
        'dose de cachaça.jpg' => ['Dose de Cachaça'],
        'farofa de ovos.jpg' => ['Farofa da Casa', 'Farofa de Ovos'],
        'fettutine alfredo.jpg' => ['Fettutine Alfredo'],
        'frango com catupiry.jpg' => ['Peito de frango com catupiry', 'Frango com Catupiry'],
        'galeto.jpg' => ['Galeto na brasa', 'Galeto'],
        'gins.jpg' => ['Gins'],
        'irish coffee.jpg' => ['Irish Coffe', 'Irish Coffee'],
        'linguiça apimentada.jpg' => ['Linguiça Apimentada'],
        'linguiça tradicional.jpg' => ['Linguiça Tradicional'],
        'mandioca na manteiga de garrafa.jpg' => ['Mandioca Frita', 'Mandioca na Manteiga'],
        'pão de alho.jpg' => ['Pão de Alho'],
        'parmegiana.jpg' => ['Parmegiana', 'Risoto parmegiana'],
        'peito de frango.jpg' => ['Peito de frango com catupiry', 'Peito de Frango'],
        'petit gateau.jpg' => ['Petit Gateau'],
        'picanha.jpg' => ['Picanha Premium', 'Picanha'],
        'pimentovo.jpg' => ['Pimentovo'],
        'porção de arroz (sabores).jpg' => ['Arroz Carreteiro', 'Porção de Arroz'],
        'porção de batata.jpg' => ['Porção de Batata'],
        'porção de pasteis de angu.jpg' => ['Porção de Pasteis de Angu'],
        'porção de pasteis.jpg' => ['Porção de Pasteis'],
        'provoleta com abacaxi grelhado.jpg' => ['Provolone à Milanesa', 'Provoleta'],
        'pure de batata.jpg' => ['Purê de Batata'],
        'refrigerantes.jpg' => ['Refrigerante', 'Refrigerantes'],
        'risoto parmegiana.jpg' => ['Risoto de Funghi', 'Risoto Parmegiana'],
        't.bone.jpg' => ['T-Bone Especial', 'T-Bone'],
        'tornedor.jpg' => ['Tornedor Rossini', 'Tornedor'],
        'torresmo de barriga.jpg' => ['Torresmo de Barriga'],
        'tropeirão.jpg' => ['Tropeirão'],
        'vacio.jpg' => ['Bife de Vazio -Fraldinha', 'Vacio', 'Vazio', 'Fraldinha', 'Bife de Vazio'],
        'vinhos e espumantes.jpg' => ['Malbec Reserva', 'Vinhos e Espumantes'],
        'vodkas.jpg' => ['Vodkas'],
        'whiskys.jpg' => ['Whiskys'],
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Iniciando migração de imagens para Spatie Media Library...');
        $this->newLine();

        $cardapioPath = public_path('img/cardapio');
        
        if (!File::exists($cardapioPath)) {
            $this->error("Diretório não encontrado: {$cardapioPath}");
            return Command::FAILURE;
        }

        $images = File::files($cardapioPath);
        $this->info("Encontradas " . count($images) . " imagens no diretório.");
        $this->newLine();

        $migrated = 0;
        $skipped = 0;
        $errors = 0;

        foreach ($images as $imageFile) {
            $fileName = $imageFile->getFilename();
            $this->line("Processando: {$fileName}");

            // Tentar encontrar item do menu correspondente
            $menuItem = $this->findMenuItemByFileName($fileName);

            if ($menuItem) {
                // Verificar se já tem imagem
                if ($menuItem->hasMedia('photo')) {
                    $this->warn("  → Item '{$menuItem->name}' já possui imagem. Pulando...");
                    $skipped++;
                    continue;
                }

                try {
                    $filePath = $imageFile->getPathname();
                    $fileSize = filesize($filePath);
                    $maxSize = 10 * 1024 * 1024; // 10MB
                    
                    // Se o arquivo for muito grande, redimensionar
                    if ($fileSize > $maxSize) {
                        $this->warn("  → Arquivo muito grande ({$this->formatBytes($fileSize)}). Redimensionando...");
                        
                        $optimizedPath = $this->optimizeImage($filePath);
                        
                        if ($optimizedPath) {
                            $menuItem->addMedia($optimizedPath)
                                ->usingName($menuItem->name)
                                ->toMediaCollection('photo');
                            
                            // Limpar arquivo temporário
                            if ($optimizedPath !== $filePath && file_exists($optimizedPath)) {
                                unlink($optimizedPath);
                            }
                            
                            $this->info("  ✓ Imagem otimizada e adicionada ao item: {$menuItem->name}");
                        } else {
                            throw new \Exception("Não foi possível otimizar a imagem");
                        }
                    } else {
                        $menuItem->addMedia($filePath)
                            ->toMediaCollection('photo');
                        
                        $this->info("  ✓ Imagem adicionada ao item: {$menuItem->name}");
                    }
                    
                    $migrated++;
                } catch (\Exception $e) {
                    $this->error("  ✗ Erro ao adicionar imagem: {$e->getMessage()}");
                    $errors++;
                }
            } else {
                $this->warn("  → Nenhum item do menu encontrado para: {$fileName}");
                
                // Tentar busca mais ampla por palavras-chave
                $suggestions = $this->findSuggestionsByFileName($fileName);
                if (!empty($suggestions)) {
                    $this->line("  → Sugestões encontradas:");
                    foreach ($suggestions as $index => $suggestion) {
                        $this->line("    " . ($index + 1) . ". {$suggestion->name} (ID: {$suggestion->id})");
                    }
                    
                    // Perguntar se deseja associar manualmente
                    if ($this->confirm("  Deseja associar esta imagem a um dos itens sugeridos?", false)) {
                        $choice = $this->ask("  Digite o número do item (1-" . count($suggestions) . ") ou 0 para pular", 0);
                        
                        if ($choice > 0 && $choice <= count($suggestions)) {
                            $selectedItem = $suggestions[$choice - 1];
                            
                            // Verificar se já tem imagem
                            if ($selectedItem->hasMedia('photo')) {
                                if (!$this->confirm("  Item '{$selectedItem->name}' já possui imagem. Substituir?", false)) {
                                    $skipped++;
                                    continue;
                                }
                                $selectedItem->clearMediaCollection('photo');
                            }
                            
                            try {
                                $filePath = $imageFile->getPathname();
                                $fileSize = filesize($filePath);
                                $maxSize = 10 * 1024 * 1024;
                                
                                if ($fileSize > $maxSize) {
                                    $optimizedPath = $this->optimizeImage($filePath);
                                    if ($optimizedPath) {
                                        $selectedItem->addMedia($optimizedPath)
                                            ->usingName($selectedItem->name)
                                            ->toMediaCollection('photo');
                                        
                                        if ($optimizedPath !== $filePath && file_exists($optimizedPath)) {
                                            unlink($optimizedPath);
                                        }
                                        $this->info("  ✓ Imagem otimizada e adicionada ao item: {$selectedItem->name}");
                                    }
                                } else {
                                    $selectedItem->addMedia($filePath)
                                        ->toMediaCollection('photo');
                                    $this->info("  ✓ Imagem adicionada ao item: {$selectedItem->name}");
                                }
                                
                                $migrated++;
                                continue;
                            } catch (\Exception $e) {
                                $this->error("  ✗ Erro ao adicionar imagem: {$e->getMessage()}");
                                $errors++;
                                continue;
                            }
                        }
                    }
                }
                
                $skipped++;
            }
        }

        $this->newLine();
        $this->info("Migração concluída!");
        $this->table(
            ['Status', 'Quantidade'],
            [
                ['Migradas', $migrated],
                ['Puladas', $skipped],
                ['Erros', $errors],
            ]
        );

        return Command::SUCCESS;
    }

    /**
     * Encontra um item do menu baseado no nome do arquivo
     */
    protected function findMenuItemByFileName(string $fileName): ?MenuItem
    {
        $fileNameLower = mb_strtolower($fileName);
        
        // 1. Verificar mapeamento direto
        if (isset($this->menuItemMapping[$fileNameLower])) {
            $possibleNames = $this->menuItemMapping[$fileNameLower];
            
            foreach ($possibleNames as $name) {
                $item = MenuItem::where('name', 'like', "%{$name}%")->first();
                if ($item) {
                    return $item;
                }
            }
        }

        // 2. Normalizar nome do arquivo (remover extensão, caracteres especiais)
        $fileNameWithoutExt = pathinfo($fileNameLower, PATHINFO_FILENAME);
        $normalizedFileName = $this->normalizeString($fileNameWithoutExt);
        
        // 3. Buscar por correspondência exata no nome normalizado
        $allItems = MenuItem::all();
        $bestMatch = null;
        $bestScore = 0;
        
        foreach ($allItems as $item) {
            $normalizedItemName = $this->normalizeString(mb_strtolower($item->name));
            
            // Verificar se o nome do arquivo está contido no nome do item ou vice-versa
            if (str_contains($normalizedItemName, $normalizedFileName) || 
                str_contains($normalizedFileName, $normalizedItemName)) {
                $score = $this->calculateSimilarity($normalizedFileName, $normalizedItemName);
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $bestMatch = $item;
                }
            }
        }
        
        if ($bestMatch && $bestScore > 0.5) {
            return $bestMatch;
        }
        
        // 3.5. Busca por similaridade mesmo sem correspondência exata (para casos como "costelão" vs "costela")
        foreach ($allItems as $item) {
            $normalizedItemName = $this->normalizeString(mb_strtolower($item->name));
            $score = $this->calculateSimilarity($normalizedFileName, $normalizedItemName);
            
            // Se a similaridade for alta (mais de 60%), considerar como match
            if ($score > 0.6 && $score > $bestScore) {
                $bestScore = $score;
                $bestMatch = $item;
            }
        }
        
        if ($bestMatch && $bestScore > 0.6) {
            return $bestMatch;
        }

        // 4. Busca por palavras-chave (palavras significativas)
        $searchTerms = $this->extractKeywords($fileNameWithoutExt);
        
        if (!empty($searchTerms)) {
            // Buscar item que contenha todas as palavras-chave principais
            $mainTerms = array_slice($searchTerms, 0, 3); // Pegar as 3 primeiras palavras mais importantes
            
            $query = MenuItem::query();
            foreach ($mainTerms as $term) {
                if (strlen($term) > 2) {
                    $query->where(function ($q) use ($term) {
                        $q->where('name', 'like', "%{$term}%")
                          ->orWhere('description', 'like', "%{$term}%");
                    });
                }
            }
            
            $result = $query->first();
            if ($result) {
                return $result;
            }
            
            // Se não encontrou com todas, tentar com qualquer uma
            $query = MenuItem::query();
            foreach ($mainTerms as $term) {
                if (strlen($term) > 2) {
                    $query->orWhere('name', 'like', "%{$term}%");
                }
            }
            
            return $query->first();
        }

        return null;
    }

    /**
     * Normaliza string removendo acentos e caracteres especiais
     */
    protected function normalizeString(string $string): string
    {
        // Remover acentos
        $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
        
        // Converter para minúsculas
        $string = mb_strtolower($string);
        
        // Remover caracteres especiais, manter apenas letras, números e espaços
        $string = preg_replace('/[^a-z0-9\s]/', '', $string);
        
        // Remover espaços extras
        $string = preg_replace('/\s+/', ' ', trim($string));
        
        return $string;
    }

    /**
     * Extrai palavras-chave significativas do nome do arquivo
     */
    protected function extractKeywords(string $fileName): array
    {
        // Palavras comuns a ignorar
        $stopWords = ['de', 'com', 'na', 'no', 'por', 'ao', 'ou', 'e', 'da', 'do', 'das', 'dos', 'em', 'para', 'a', 'o', 'as', 'os', 'um', 'uma', 'uns', 'umas'];
        
        // Dividir em palavras
        $words = explode(' ', $fileName);
        
        // Filtrar palavras significativas
        $keywords = array_filter($words, function ($word) use ($stopWords) {
            $word = trim($word);
            return strlen($word) > 2 && !in_array($word, $stopWords);
        });
        
        // Ordenar por tamanho (palavras maiores primeiro, geralmente mais específicas)
        usort($keywords, function ($a, $b) {
            return strlen($b) <=> strlen($a);
        });
        
        return array_values($keywords);
    }

    /**
     * Calcula similaridade entre duas strings (0 a 1)
     */
    protected function calculateSimilarity(string $str1, string $str2): float
    {
        // Usar similar_text do PHP
        similar_text($str1, $str2, $percent);
        return $percent / 100;
    }

    /**
     * Encontra sugestões de itens baseado no nome do arquivo
     */
    protected function findSuggestionsByFileName(string $fileName): array
    {
        $fileNameWithoutExt = pathinfo(mb_strtolower($fileName), PATHINFO_FILENAME);
        $keywords = $this->extractKeywords($fileNameWithoutExt);
        
        if (empty($keywords)) {
            return [];
        }

        $suggestions = [];
        $mainKeyword = $keywords[0] ?? '';
        
        if (strlen($mainKeyword) > 2) {
            $items = MenuItem::where('name', 'like', "%{$mainKeyword}%")
                ->orWhere('description', 'like', "%{$mainKeyword}%")
                ->limit(5)
                ->get();
            
            foreach ($items as $item) {
                $normalizedItemName = $this->normalizeString(mb_strtolower($item->name));
                $normalizedFileName = $this->normalizeString($fileNameWithoutExt);
                $score = $this->calculateSimilarity($normalizedFileName, $normalizedItemName);
                
                if ($score > 0.3) {
                    $suggestions[] = $item;
                }
            }
        }
        
        return $suggestions;
    }

    /**
     * Formata bytes para formato legível
     */
    protected function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }

    /**
     * Otimiza imagem redimensionando se necessário
     */
    protected function optimizeImage(string $filePath): ?string
    {
        if (!function_exists('imagecreatefromjpeg')) {
            return null;
        }

        $maxWidth = 1920;
        $maxHeight = 1920;
        $quality = 85;

        $imageInfo = getimagesize($filePath);
        if (!$imageInfo) {
            return null;
        }

        [$width, $height, $type] = $imageInfo;

        // Se a imagem já é pequena o suficiente, retornar original
        if ($width <= $maxWidth && $height <= $maxHeight && filesize($filePath) <= 10 * 1024 * 1024) {
            return $filePath;
        }

        // Calcular novas dimensões mantendo proporção
        $ratio = min($maxWidth / $width, $maxHeight / $height);
        $newWidth = (int) ($width * $ratio);
        $newHeight = (int) ($height * $ratio);

        // Criar imagem baseada no tipo
        switch ($type) {
            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($filePath);
                break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($filePath);
                break;
            case IMAGETYPE_WEBP:
                $source = imagecreatefromwebp($filePath);
                break;
            default:
                return null;
        }

        if (!$source) {
            return null;
        }

        // Criar nova imagem redimensionada
        $destination = imagecreatetruecolor($newWidth, $newHeight);
        
        // Preservar transparência para PNG
        if ($type === IMAGETYPE_PNG) {
            imagealphablending($destination, false);
            imagesavealpha($destination, true);
            $transparent = imagecolorallocatealpha($destination, 255, 255, 255, 127);
            imagefilledrectangle($destination, 0, 0, $newWidth, $newHeight, $transparent);
        }

        imagecopyresampled($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Salvar em arquivo temporário
        $tempPath = sys_get_temp_dir() . '/' . uniqid('img_') . '.jpg';
        
        if ($type === IMAGETYPE_PNG) {
            imagepng($destination, $tempPath, 9);
        } else {
            imagejpeg($destination, $tempPath, $quality);
        }

        imagedestroy($source);
        imagedestroy($destination);

        return $tempPath;
    }
}
