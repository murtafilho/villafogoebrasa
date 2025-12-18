<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEventRequest;
use App\Http\Requests\Admin\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Event::query();

        if (request()->has('search') && request('search') !== '') {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if (request()->has('status') && request('status') !== '') {
            if (request('status') === 'active') {
                $query->where('is_active', true);
            } elseif (request('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $events = $query->orderBy('event_date', 'desc')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->paginate(15);

        return view('admin.events.index', [
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request): RedirectResponse
    {
        $event = Event::create($request->validated());

        if ($request->hasFile('photo')) {
            $event->addMediaFromRequest('photo')
                ->toMediaCollection('photo');
        }

        return redirect()
            ->route('admin.eventos.index')
            ->with('success', 'Evento criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $evento): View
    {
        return view('admin.events.show', [
            'event' => $evento,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $evento): View
    {
        return view('admin.events.edit', [
            'event' => $evento,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $evento): RedirectResponse
    {
        $evento->update($request->validated());

        if ($request->hasFile('photo')) {
            $evento->clearMediaCollection('photo');
            $evento->addMediaFromRequest('photo')
                ->toMediaCollection('photo');
        }

        return redirect()
            ->route('admin.eventos.index')
            ->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $evento): RedirectResponse
    {
        $evento->delete();

        return redirect()
            ->route('admin.eventos.index')
            ->with('success', 'Evento excluído com sucesso!');
    }
}
