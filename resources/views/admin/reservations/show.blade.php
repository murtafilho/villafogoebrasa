@extends('layouts.admin')

@section('title', 'Detalhes da Reserva')
@section('header', 'Detalhes da Reserva')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Informações da Reserva</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.reservas.edit', $reservation) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                <i data-lucide="edit" class="w-4 h-4"></i>
                Editar
            </a>
            <form action="{{ route('admin.reservas.destroy', $reservation) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta reserva?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    Excluir
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-500 mb-1">Nome</label>
            <p class="text-lg text-gray-900">{{ $reservation->name }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 mb-1">E-mail</label>
            <p class="text-lg text-gray-900">{{ $reservation->email }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 mb-1">Telefone</label>
            <p class="text-lg text-gray-900">{{ $reservation->phone }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'confirmed' => 'bg-green-100 text-green-800',
                    'cancelled' => 'bg-red-100 text-red-800',
                    'completed' => 'bg-blue-100 text-blue-800',
                ];
            @endphp
            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$reservation->status] ?? 'bg-gray-100 text-gray-800' }}">
                {{ $reservation->status_label }}
            </span>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 mb-1">Data</label>
            <p class="text-lg text-gray-900">{{ $reservation->date->format('d/m/Y') }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 mb-1">Horário</label>
            <p class="text-lg text-gray-900">{{ $reservation->time }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 mb-1">Número de Convidados</label>
            <p class="text-lg text-gray-900">{{ $reservation->guests }}</p>
        </div>

        @if($reservation->occasion)
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Ocasião</label>
                <p class="text-lg text-gray-900">{{ $reservation->occasion }}</p>
            </div>
        @endif

        @if($reservation->notes)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-500 mb-1">Observações</label>
                <p class="text-lg text-gray-900 whitespace-pre-wrap">{{ $reservation->notes }}</p>
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium text-gray-500 mb-1">Criado em</label>
            <p class="text-lg text-gray-900">{{ $reservation->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-500 mb-1">Atualizado em</label>
            <p class="text-lg text-gray-900">{{ $reservation->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>
</div>

<div class="flex items-center gap-4">
    <a href="{{ route('admin.reservas.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
        Voltar para Lista
    </a>
</div>

<script>
    lucide.createIcons();
</script>
@endsection


