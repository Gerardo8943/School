<?php

use Livewire\Component;

new class extends Component
{
    public array $classes = [
        ['subject' => 'Programación IV', 'time' => '08:00 AM - 09:30 AM', 'room' => 'Lab 3'],
        ['subject' => 'Bases de Datos', 'time' => '10:00 AM - 11:30 AM', 'room' => 'Aula 102'],
        ['subject' => 'Inglés II', 'time' => '01:00 PM - 02:30 PM', 'room' => 'Aula 204'],
    ];
};
?>

<div class="space-y-4">
    <div class="relative border-l-2 border-indigo-200 dark:border-indigo-900/50 ml-3 space-y-6">
        @foreach($classes as $index => $class)
            <div class="relative pl-6">
                <!-- Timeline Dot -->
                <div class="absolute -left-[9px] top-1.5 size-4 rounded-full bg-white dark:bg-zinc-900 border-2 border-indigo-500 dark:border-indigo-400"></div>
                
                <div class="flex flex-col">
                    <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">{{ $class['time'] }}</span>
                    <span class="font-medium text-gray-800 dark:text-zinc-200 mt-0.5">{{ $class['subject'] }}</span>
                    <span class="text-xs text-gray-500 dark:text-zinc-400 flex items-center gap-1 mt-1">
                        <flux:icon.map-pin class="size-3" />
                        {{ $class['room'] }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>