<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreReservationRequest;
use App\Http\Requests\Admin\UpdateReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Reservation::query()->latest('date');

        // Filtros
        if (request()->has('status') && request('status') !== '') {
            $query->where('status', request('status'));
        }

        if (request()->has('date_from') && request('date_from') !== '') {
            $query->whereDate('date', '>=', request('date_from'));
        }

        if (request()->has('date_to') && request('date_to') !== '') {
            $query->whereDate('date', '<=', request('date_to'));
        }

        if (request()->has('search') && request('search') !== '') {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $reservations = $query->paginate(15);

        return view('admin.reservations.index', [
            'reservations' => $reservations,
            'statuses' => Reservation::statuses(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.reservations.create', [
            'statuses' => Reservation::statuses(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request): RedirectResponse
    {
        Reservation::create($request->validated());

        return redirect()
            ->route('admin.reservas.index')
            ->with('success', 'Reserva criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reserva): View
    {
        return view('admin.reservations.show', [
            'reservation' => $reserva,
            'statuses' => Reservation::statuses(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reserva): View
    {
        return view('admin.reservations.edit', [
            'reservation' => $reserva,
            'statuses' => Reservation::statuses(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reserva): RedirectResponse
    {
        $reserva->update($request->validated());

        return redirect()
            ->route('admin.reservas.index')
            ->with('success', 'Reserva atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reserva): RedirectResponse
    {
        $reserva->delete();

        return redirect()
            ->route('admin.reservas.index')
            ->with('success', 'Reserva excluída com sucesso!');
    }
}
