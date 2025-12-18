<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicReservationRequest;
use App\Models\MenuCategory;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function cardapio()
    {
        // Buscar categorias ativas com seus itens ativos (excluindo "Indicações do Chef")
        $categoriesFromDb = MenuCategory::query()
            ->where('is_active', true)
            ->where('slug', '!=', 'indicacoes-do-chef')
            ->orderBy('sort_order')
            ->with(['items' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('is_featured', 'desc') // Itens em destaque primeiro
                    ->orderBy('name', 'asc'); // Ordem alfabética
            }])
            ->get();

        // Função auxiliar para processar item
        $processItem = function ($item) {
            $imageUrl = null;

            if ($item->hasMedia('photo')) {
                try {
                    $media = $item->getFirstMedia('photo');

                    // Usar URL original diretamente - mais confiável
                    $imageUrl = $media->getUrl();

                    // Se a URL retornada contém 'http://localhost', remover para usar relativa
                    if (str_contains($imageUrl, 'http://localhost')) {
                        $imageUrl = str_replace('http://localhost', '', $imageUrl);
                    }

                    // Garantir que comece com /storage
                    if (! str_starts_with($imageUrl, '/storage')) {
                        // Se não começa com /storage, construir manualmente
                        $imageUrl = '/storage/'.$media->id.'/'.$media->file_name;
                    }
                } catch (\Exception $e) {
                    // Se houver erro, não definir imagem
                    $imageUrl = null;
                }
            }

            return [
                'id' => $item->id,
                'nome' => $item->name,
                'preco' => $item->price ? number_format($item->price, 2, ',', '.') : '',
                'descricao' => $item->description ?? '',
                'subcategoria' => $item->subcategory ?? '',
                'imagem' => $imageUrl,
                'is_featured' => $item->is_featured,
                'categoria' => $item->category->name ?? '',
            ];
        };

        // Separar itens destacados (is_featured) para a seção "Indicações do Chef"
        $featuredItems = [];
        $menuData = [];
        $categories = [];
        $categorySubcategories = [];

        foreach ($categoriesFromDb as $category) {
            if ($category->items->isEmpty()) {
                continue;
            }

            // Ignorar categoria "Indicações do Chef" - não é mais uma categoria de menu
            if ($category->slug === 'indicacoes-do-chef') {
                continue;
            }

            $categories[] = $category->name;

            // Coletar subcategorias únicas desta categoria
            $subcategories = $category->items
                ->pluck('subcategory')
                ->filter(fn ($sub) => ! empty($sub))
                ->unique()
                ->values()
                ->toArray();

            $categorySubcategories[$category->name] = $subcategories;

            // Separar itens destacados dos regulares
            $featuredInCategory = $category->items->filter(fn ($item) => $item->is_featured);
            $regularItems = $category->items->filter(fn ($item) => ! $item->is_featured);

            // Adicionar itens destacados à seção especial "Indicações do Chef"
            foreach ($featuredInCategory as $item) {
                $featuredItems[] = $processItem($item);
            }

            // Adicionar TODOS os itens (destacados + regulares) ao menu normal para duplicação
            // Ordenar por nome alfabeticamente
            $sortedItems = $category->items->sortBy('name')->values();
            $menuData[$category->name] = $sortedItems->map($processItem)->toArray();
        }

        return view('cardapio', [
            'featuredItems' => $featuredItems,
            'menuData' => $menuData,
            'categories' => $categories,
            'categorySubcategories' => $categorySubcategories,
        ]);
    }

    public static function getCategoryIcon(string $category): string
    {
        $iconMap = [
            'Carnes' => 'drumstick',
            'Carnes Nobres' => 'drumstick',
            'Parrilla' => 'flame',
            'Rodízio' => 'chef-hat',
            'Rodízio Completo' => 'chef-hat',
            'Acompanhamentos' => 'salad',
            'Guarnições' => 'salad',
            'Sobremesas' => 'cake',
            'Bebidas' => 'wine',
            'Carta de Vinhos' => 'wine',
            'Vinhos' => 'wine',
            'Cervejas' => 'beer',
            'Chopps' => 'beer',
            'Doses' => 'glass-water',
            'Drinks' => 'martini',
            'Entradas' => 'utensils-crossed',
            'Pratos Executivos' => 'briefcase',
            'Especiais da Casa' => 'sparkles',
            'Pratos Especiais' => 'star',
            'Saladas' => 'leaf',
            'Massas' => 'utensils',
            'Peixes' => 'fish',
            'Frutos do Mar' => 'fish',
            'Aves' => 'egg',
            'Vegetarianos' => 'leaf',
            'Kids' => 'baby',
            'Infantil' => 'baby',
            'Serviços' => 'concierge-bell',
            'Cafeteria' => 'coffee',
            'Cafés' => 'coffee',
            'Café' => 'coffee',
        ];

        // Buscar correspondência exata ou parcial
        foreach ($iconMap as $key => $icon) {
            if (stripos($category, $key) !== false) {
                return $icon;
            }
        }

        // Ícone padrão
        return 'utensils';
    }

    public function showMenuItem($id)
    {
        $item = \App\Models\MenuItem::with('category')
            ->where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        $imageUrl = null;
        if ($item->hasMedia('photo')) {
            try {
                $media = $item->getFirstMedia('photo');
                $imageUrl = $media->getUrl();

                if (str_contains($imageUrl, 'http://localhost')) {
                    $imageUrl = str_replace('http://localhost', '', $imageUrl);
                }

                if (! str_starts_with($imageUrl, '/storage')) {
                    $imageUrl = '/storage/'.$media->id.'/'.$media->file_name;
                }
            } catch (\Exception $e) {
                $imageUrl = null;
            }
        }

        return view('menu-item-show', [
            'item' => $item,
            'imageUrl' => $imageUrl,
        ]);
    }

    public function storeReservation(StorePublicReservationRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['status'] = Reservation::STATUS_PENDING;

        // Processar número de convidados se vier como "2 pessoas"
        if (isset($data['guests']) && is_string($data['guests'])) {
            $guestsStr = trim($data['guests']);
            // Extrair número do texto "2 pessoas" ou "7+ pessoas"
            if (preg_match('/(\d+)/', $guestsStr, $matches)) {
                $data['guests'] = (int) $matches[1];
            } else {
                $data['guests'] = 2; // Default
            }
        }

        Reservation::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Reserva enviada com sucesso! Entraremos em contato em breve.',
        ]);
    }
}
