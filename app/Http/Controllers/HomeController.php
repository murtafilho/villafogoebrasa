<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function cardapio()
    {
        $jsonPath = database_path('data/menu_data.json');

        if (! file_exists($jsonPath)) {
            return view('cardapio', [
                'menuData' => [],
                'categories' => [],
            ]);
        }

        $jsonContent = file_get_contents($jsonPath);
        $menuData = json_decode($jsonContent, true);

        if (! is_array($menuData)) {
            $menuData = [];
        }

        // Extrair lista de categorias para os filtros
        $categories = array_keys($menuData);

        return view('cardapio', [
            'menuData' => $menuData,
            'categories' => $categories,
        ]);
    }

    public static function getCategoryIcon(string $category): string
    {
        $iconMap = [
            'Carnes' => 'drumstick',
            'Carnes Nobres' => 'drumstick',
            'Rodízio' => 'chef-hat',
            'Rodízio Completo' => 'chef-hat',
            'Acompanhamentos' => 'salad',
            'Sobremesas' => 'cake',
            'Bebidas' => 'wine',
            'Carta de Vinhos' => 'wine',
            'Vinhos' => 'wine',
            'Entradas' => 'utensils-crossed',
            'Pratos Executivos' => 'briefcase',
            'Especiais da Casa' => 'sparkles',
            'Pratos Especiais' => 'star',
            'Saladas' => 'salad',
            'Massas' => 'utensils',
            'Peixes' => 'fish',
            'Frutos do Mar' => 'fish',
            'Aves' => 'chicken',
            'Vegetarianos' => 'leaf',
            'Kids' => 'baby',
            'Infantil' => 'baby',
            'Bebidas Não Alcoólicas' => 'glass-water',
            'Refrigerantes' => 'glass-water',
            'Sucos' => 'glass-water',
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
}
