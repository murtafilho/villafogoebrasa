<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\MenuItem;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = now()->startOfDay();

        $stats = [
            'reservations_today' => Reservation::whereDate('date', $today)->count(),
            'reservations_total' => Reservation::count(),
            'reservations_pending' => Reservation::where('status', Reservation::STATUS_PENDING)->count(),
            'menu_items_total' => MenuItem::count(),
            'menu_items_active' => MenuItem::where('is_active', true)->count(),
            'gallery_total' => Gallery::count(),
            'gallery_active' => Gallery::where('is_active', true)->count(),
            'users_total' => User::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
