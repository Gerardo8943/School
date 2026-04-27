<x-layouts.app>
    <div class="flex flex-col gap-8">
        <!-- Header Section -->
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl" level="1">Hola, {{ auth()->user()->name ?? 'Peter Parker' }}</flux:heading>
                <flux:subheading size="lg" class="mt-1">Ingeniería Informática • Período 2026-I</flux:subheading>
            </div>
            <div class="text-right hidden sm:block">
                <div class="text-sm font-medium text-gray-500 dark:text-zinc-400">{{ \Carbon\Carbon::now()->translatedFormat('l, d \d\e F \d\e Y') }}</div>
            </div>
        </div>
        
        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Columna Principal (Izquierda, Ocupa 2 espacios en pantallas grandes) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Tarjeta de Progreso -->
                <flux:card>
                    <flux:heading size="lg">Progreso Académico</flux:heading>
                    <div class="mt-4">
                        <livewire:student.academic-progress />
                    </div>
                </flux:card>
                
                <!-- Tarjeta de Actividades -->
                <flux:card>
                    <div class="flex items-center justify-between">
                        <flux:heading size="lg">Próximas Actividades</flux:heading>
                        <flux:button variant="ghost" size="sm">Ver calendario</flux:button>
                    </div>
                    <div class="mt-4">
                        <livewire:student.upcoming-activities />
                    </div>
                </flux:card>
            </div>

            <!-- Columna Secundaria (Derecha) -->
            <div class="space-y-6">
                <!-- Tarjeta de Horario de Hoy -->
                <flux:card>
                    <flux:heading size="lg">Clases de Hoy</flux:heading>
                    <div class="mt-4">
                        <livewire:student.today-schedule />
                    </div>
                </flux:card>

                <!-- Tarjeta de Enlaces Rápidos -->
                <flux:card>
                    <flux:heading size="lg">Accesos Rápidos</flux:heading>
                    <div class="mt-4 flex flex-col gap-2">
                        <flux:button variant="subtle" icon="document-text" class="w-full justify-start">Constancia de Estudio</flux:button>
                        <flux:button variant="subtle" icon="academic-cap" class="w-full justify-start">Historial de Notas</flux:button>
                        <flux:button variant="subtle" icon="book-open" class="w-full justify-start">Biblioteca Virtual</flux:button>
                    </div>
                </flux:card>
            </div>
        </div>
    </div>
</x-layouts.app>
