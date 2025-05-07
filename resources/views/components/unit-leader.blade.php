@props(['unit'])

@php
    $currentLeader = $unit->leaders->first();
@endphp

<div class="leader-info">
    @if($currentLeader && $currentLeader->person)
        <div class="text-sm text-gray-900">
            {{ $currentLeader->person->name }}
            <div class="text-xs text-gray-500">
                <span>Desde: {{ $currentLeader->pivot->start_date->format('d/m/Y') }}</span>
                @if($currentLeader->pivot->end_date)
                    <br><span>Hasta: {{ $currentLeader->pivot->end_date->format('d/m/Y') }}</span>
                @endif
            </div>
        </div>
    @else
        <div class="flex items-center">
            <span class="text-red-500">Sin encargado</span>
            <button onclick="showLeaderAssignmentModal({{ $unit->id }})" 
                    class="ml-2 text-xs text-blue-600 hover:underline">
                Asignar
            </button>
        </div>
    @endif
</div>