<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMenuItemRequest;
use App\Http\Requests\Admin\UpdateMenuItemRequest;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = MenuItem::query()->with('category');

        if (request()->has('category_id') && request('category_id') !== '') {
            $query->where('category_id', request('category_id'));
        }

        if (request()->has('search') && request('search') !== '') {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $items = $query->orderBy('sort_order')->orderBy('name')->paginate(15);
        $categories = MenuCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.menu-items.index', [
            'items' => $items,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = MenuCategory::orderBy('sort_order')->orderBy('name')->get();
        
        // Buscar categoria "Indicações do Chef" como padrão
        $defaultCategory = MenuCategory::where('slug', 'indicacoes-do-chef')->first();

        return view('admin.menu-items.create', compact('categories', 'defaultCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuItemRequest $request): RedirectResponse
    {
        $item = MenuItem::create($request->validated());

        if ($request->hasFile('photo')) {
            $item->addMediaFromRequest('photo')
                ->toMediaCollection('photo');
        }

        return redirect()
            ->route('admin.cardapio.itens.index')
            ->with('success', 'Item criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $item): View
    {
        $categories = MenuCategory::orderBy('sort_order')->orderBy('name')->get();
        
        // Buscar categoria "Indicações do Chef" como padrão (para referência)
        $defaultCategory = MenuCategory::where('slug', 'indicacoes-do-chef')->first();

        return view('admin.menu-items.edit', [
            'item' => $item,
            'categories' => $categories,
            'defaultCategory' => $defaultCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuItemRequest $request, MenuItem $item): RedirectResponse
    {
        $item->update($request->validated());

        if ($request->hasFile('photo')) {
            $item->clearMediaCollection('photo');
            $item->addMediaFromRequest('photo')
                ->toMediaCollection('photo');
        }

        return redirect()
            ->route('admin.cardapio.itens.index')
            ->with('success', 'Item atualizado com sucesso!');
    }

    /**
     * Toggle featured status of the specified resource.
     */
    public function toggleFeatured(MenuItem $item): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $item->update([
            'is_featured' => !$item->is_featured,
        ]);

        $status = $item->is_featured ? 'ativado' : 'desativado';

        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Destaque {$status} com sucesso!",
                'is_featured' => $item->is_featured,
            ]);
        }

        return redirect()
            ->route('admin.cardapio.itens.index')
            ->with('success', "Destaque {$status} com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $item): RedirectResponse
    {
        $item->delete();

        return redirect()
            ->route('admin.cardapio.itens.index')
            ->with('success', 'Item excluído com sucesso!');
    }
}
