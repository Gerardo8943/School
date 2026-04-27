<?php

use Livewire\Component;

new class extends Component
{
    public int $totalCredits = 150;
    public int $approvedCredits = 45;

    public function getProgressPercentageProperty()
    {
        return round(($this->approvedCredits / $this->totalCredits) * 100);
    }
};
?>

<div class="flex flex-col items-center justify-center p-4">
    <div class="relative size-32">
        <!-- Background Circle -->
        <svg class="size-full -rotate-90" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
            <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-gray-200 dark:text-zinc-700" stroke-width="3"></circle>
            <!-- Progress Circle -->
            <circle cx="18" cy="18" r="16" fill="none" class="stroke-current text-indigo-600 dark:text-indigo-400" stroke-width="3" stroke-dasharray="100" stroke-dashoffset="{{ 100 - $this->progressPercentage }}" stroke-linecap="round"></circle>
        </svg>

        <!-- Percentage Text -->
        <div class="absolute inset-0 flex items-center justify-center flex-col">
            <span class="text-2xl font-bold text-gray-800 dark:text-zinc-200">{{ $this->progressPercentage }}%</span>
        </div>
    </div>
    <div class="mt-4 text-center">
        <p class="text-sm font-medium text-gray-600 dark:text-zinc-400">{{ $approvedCredits }} de {{ $totalCredits }} Créditos Aprobados</p>
    </div>
</div>