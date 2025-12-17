<?php

namespace App\Http\Controllers;

use DOMDocument;
use DOMXPath;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function cardapio()
    {
        $htmlPath = base_path('teste.html');

        if (! file_exists($htmlPath)) {
            return view('cardapio', [
                'menuData' => [],
                'categories' => [],
            ]);
        }

        $html = file_get_contents($htmlPath);
        $menuData = $this->parseMenuHtml($html);

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

    private function parseMenuHtml(string $html): array
    {
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">'.$html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $rows = $xpath->query('//table//tr[position() > 1]');
        $menuData = [];

        foreach ($rows as $row) {
            $cells = $xpath->query('.//td', $row);

            if ($cells->length >= 4) {
                $nome = trim($cells->item(0)->textContent);
                $preco = trim($cells->item(1)->textContent);
                $cardapio = trim($cells->item(2)->textContent);
                $categoria = trim($cells->item(3)->textContent);
                $subcategoria = $cells->length > 4 ? trim($cells->item(4)->textContent) : '';
                $descricao = $cells->length > 5 ? trim($cells->item(5)->textContent) : '';

                // Filtrar apenas itens do Cardápio Principal
                if ($cardapio === 'Cardápio Principal' && ! empty($nome)) {
                    $categoriaKey = trim($categoria);

                    if (empty($categoriaKey)) {
                        $categoriaKey = 'Outros';
                    }

                    if (! isset($menuData[$categoriaKey])) {
                        $menuData[$categoriaKey] = [];
                    }

                    $menuData[$categoriaKey][] = [
                        'nome' => $nome,
                        'preco' => $preco,
                        'subcategoria' => $subcategoria,
                        'descricao' => $descricao,
                    ];
                }
            }
        }

        // Ordenar categorias
        ksort($menuData);

        return $menuData;
    }
}
