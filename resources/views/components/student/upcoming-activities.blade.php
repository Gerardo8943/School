<?php

use Livewire\Component;
use Carbon\Carbon;

new class extends Component
{
    public array $activities = [
        ['title' => 'Examen de Matemáticas', 'date' => '2026-05-02', 'type' => 'Examen', 'color' => 'purple'],
        ['title' => 'Entrega Proyecto Web', 'date' => '2026-05-05', 'type' => 'Proyecto', 'color' => 'indigo'],
        ['title' => 'Exposición Historia', 'date' => '2026-05-10', 'type' => 'Exposición', 'color' => 'green'],
    ];
};
?>

<div class="space-y-4">
    @foreach($activities as $activity)
        <div class="flex items-start justify-between p-3 rounded-lg border border-gray-100 dark:border-zinc-700/50 bg-gray-50/50 dark:bg-zinc-800/50 hover:bg-gray-50 dark:hover:bg-zinc-800 transition">
            <div class="flex flex-col">
                <span class="font-medium text-gray-800 dark:text-zinc-200">{{ $activity['title'] }}</span>
                <span class="text-xs text-gray-500 dark:text-zinc-400 mt-1 flex items-center gap-1">
                    <flux:icon.calendar class="size-3" />
                    {{ \Carbon\Carbon::parse($activity['date'])->format('d M, Y') }}
                </span>
            </div>
            <div>
                <flux:badge color="{{ $activity['color'] }}" size="sm" variant="solid">{{ $activity['type'] }}</flux:badge>
            </div>
        </div>
    @endforeach
</div>