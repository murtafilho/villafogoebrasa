@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card: Bem-vindo -->
    <div class="col-span-full bg-gradient-to-r from-villa-charcoal to-villa-espresso rounded-xl p-6 text-white">
        <h2 class="text-2xl font-heading font-bold mb-2">Bem-vindo, {{ auth()->user()->name }}!</h2>
        <p class="text-villa-cream/80">Painel administrativo Villa Fogo & Brasa</p>
    </div>

    <!-- Stats Cards -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Reservas Hoje</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
            <div class="w-12 h-12 bg-villa-ember/10 rounded-full flex items-center justify-center">
                <i data-lucide="calendar" class="w-6 h-6 text-villa-ember"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Clientes</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
            <div class="w-12 h-12 bg-villa-gold/10 rounded-full flex items-center justify-center">
                <i data-lucide="users" class="w-6 h-6 text-villa-gold"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Itens do Menu</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i data-lucide="utensils" class="w-6 h-6 text-green-600"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Fotos na Galeria</p>
                <p class="text-2xl font-bold text-gray-800">0</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                <i data-lucide="image" class="w-6 h-6 text-purple-600"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-xl shadow-sm p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Acesso Rápido</h3>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <a href="{{ asset('Proposta_Comercial.html') }}" target="_blank" class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-villa-ember bg-villa-ember/10 hover:bg-villa-ember/20 transition-colors">
            <i data-lucide="file-text" class="w-8 h-8 text-villa-ember"></i>
            <span class="text-sm text-villa-ember font-semibold">Proposta Comercial</span>
        </a>
        <a href="#" class="flex flex-col items-center gap-2 p-4 rounded-lg border border-gray-200 hover:border-villa-ember hover:bg-villa-ember/5 transition-colors">
            <i data-lucide="calendar-plus" class="w-8 h-8 text-villa-ember"></i>
            <span class="text-sm text-gray-700">Nova Reserva</span>
        </a>
        <a href="#" class="flex flex-col items-center gap-2 p-4 rounded-lg border border-gray-200 hover:border-villa-ember hover:bg-villa-ember/5 transition-colors">
            <i data-lucide="plus-circle" class="w-8 h-8 text-villa-ember"></i>
            <span class="text-sm text-gray-700">Adicionar Prato</span>
        </a>
        <a href="#" class="flex flex-col items-center gap-2 p-4 rounded-lg border border-gray-200 hover:border-villa-ember hover:bg-villa-ember/5 transition-colors">
            <i data-lucide="upload" class="w-8 h-8 text-villa-ember"></i>
            <span class="text-sm text-gray-700">Upload Foto</span>
        </a>
        <a href="{{ url('/') }}" target="_blank" class="flex flex-col items-center gap-2 p-4 rounded-lg border border-gray-200 hover:border-villa-ember hover:bg-villa-ember/5 transition-colors">
            <i data-lucide="globe" class="w-8 h-8 text-villa-ember"></i>
            <span class="text-sm text-gray-700">Ver Site</span>
        </a>
    </div>
</div>
@endsection
