@extends('layouts.admin')

@section('title', $event->title)
@section('header', 'Detalhes do Evento')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            @if($event->hasMedia('photo'))
                @php
                    $media = $event->getFirstMedia('photo');
                    $url = '/storage/' . $media->id . '/' . $media->file_name;
                @endphp
                <img src="{{ $url }}" alt="{{ $event->title }}" class="w-full rounded-lg">
            @else
                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                    <i data-lucide="calendar" class="w-24 h-24 text-gray-400"></i>
                </div>
            @endif
        </div>

        <div>
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $event->title }}</h2>
                @if($event->is_featured)
                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-villa-gold/20 text-villa-gold mb-2">Destaque</span>
                @endif
                @if($event->is_active)
                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Ativo</span>
                @else
                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">Inativo</span>
                @endif
            </div>

            @if($event->description)
                <div class="mb-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-1">Descrição</h3>
                    <p class="text-gray-900">{{ $event->description }}</p>
                </div>
            @endif

            <div class="space-y-3">
                <div>
                    <span class="text-sm font-medium text-gray-700">Data:</span>
                    <span class="ml-2 text-gray-900">{{ $event->event_date->format('d/m/Y') }}</span>
                </div>

                @if($event->event_time)
                    <div>
                        <span class="text-sm font-medium text-gray-700">Horário:</span>
                        <span class="ml-2 text-gray-900">{{ $event->event_time }}</span>
                    </div>
                @endif

                @if($event->location)
                    <div>
                        <span class="text-sm font-medium text-gray-700">Local:</span>
                        <span class="ml-2 text-gray-900">{{ $event->location }}</span>
                    </div>
                @endif

                @if($event->price)
                    <div>
                        <span class="text-sm font-medium text-gray-700">Preço:</span>
                        <span class="ml-2 text-gray-900">R$ {{ number_format($event->price, 2, ',', '.') }}</span>
                    </div>
                @endif

                @if($event->max_guests)
                    <div>
                        <span class="text-sm font-medium text-gray-700">Máximo de Convidados:</span>
                        <span class="ml-2 text-gray-900">{{ $event->max_guests }}</span>
                    </div>
                @endif

                <div>
                    <span class="text-sm font-medium text-gray-700">Ordem:</span>
                    <span class="ml-2 text-gray-900">{{ $event->sort_order }}</span>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-4">
                <a href="{{ route('admin.eventos.edit', $event) }}" class="px-6 py-2 bg-villa-ember text-white rounded-lg hover:bg-villa-ember/90 transition-colors flex items-center gap-2">
                    <i data-lucide="edit" class="w-4 h-4"></i>
                    Editar
                </a>
                <a href="{{ route('admin.eventos.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Voltar
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    lucide.createIcons();
</script>
@endpush
@endsection

