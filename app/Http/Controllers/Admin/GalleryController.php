<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Gallery::query();

        if (request()->has('category') && request('category') !== '') {
            $query->where('category', request('category'));
        }

        if (request()->has('search') && request('search') !== '') {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $galleries = $query->orderBy('sort_order')->orderBy('title')->paginate(15);

        return view('admin.galleries.index', [
            'galleries' => $galleries,
            'categories' => Gallery::categories(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.galleries.create', [
            'categories' => Gallery::categories(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $gallery = Gallery::create($request->validated());

        if ($request->hasFile('image')) {
            $gallery->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.galeria.index')
            ->with('success', 'Foto adicionada à galeria com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $galeria): View
    {
        return view('admin.galleries.edit', [
            'gallery' => $galeria,
            'categories' => Gallery::categories(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $galeria): RedirectResponse
    {
        $galeria->update($request->validated());

        if ($request->hasFile('image')) {
            $galeria->clearMediaCollection('image');
            $galeria->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('admin.galeria.index')
            ->with('success', 'Foto atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $galeria): RedirectResponse
    {
        $galeria->delete();

        return redirect()
            ->route('admin.galeria.index')
            ->with('success', 'Foto excluída com sucesso!');
    }
}
