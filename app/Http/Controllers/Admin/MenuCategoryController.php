<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMenuCategoryRequest;
use App\Http\Requests\Admin\UpdateMenuCategoryRequest;
use App\Models\MenuCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = MenuCategory::query()
            ->withCount('items')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.menu-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.menu-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuCategoryRequest $request): RedirectResponse
    {
        $category = MenuCategory::create($request->validated());

        if ($request->hasFile('cover')) {
            $category->addMediaFromRequest('cover')
                ->toMediaCollection('cover');
        }

        return redirect()
            ->route('admin.cardapio.categorias.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuCategory $categoria): View
    {
        return view('admin.menu-categories.edit', [
            'category' => $categoria,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuCategoryRequest $request, MenuCategory $categoria): RedirectResponse
    {
        $categoria->update($request->validated());

        if ($request->hasFile('cover')) {
            $categoria->clearMediaCollection('cover');
            $categoria->addMediaFromRequest('cover')
                ->toMediaCollection('cover');
        }

        return redirect()
            ->route('admin.cardapio.categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuCategory $categoria): RedirectResponse
    {
        if ($categoria->items()->count() > 0) {
            return redirect()
                ->route('admin.cardapio.categorias.index')
                ->with('error', 'Não é possível excluir uma categoria que possui itens.');
        }

        $categoria->delete();

        return redirect()
            ->route('admin.cardapio.categorias.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }
}
