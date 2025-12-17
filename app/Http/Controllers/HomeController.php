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
        $html = file_get_contents(base_path('teste.html'));
        $menuData = $this->parseMenuHtml($html);

        // Extrair lista de categorias para os filtros
        $categories = array_keys($menuData);

        return view('cardapio', [
            'menuData' => $menuData,
            'categories' => $categories,
        ]);
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
