<x-layouts.app>
    <div class="flex flex-col gap-8">
        <div>
            <flux:heading size="xl" level="1">Panel del Docente</flux:heading>
            <flux:subheading size="lg" class="mt-1">Facultad de Ingeniería • Universidad León</flux:subheading>
        </div>
        
        <flux:card>
            <flux:heading size="lg">Bienvenido, Prof. {{ auth()->user()->name }}</flux:heading>
            <flux:text class="mt-2">Aquí podrá gestionar sus secciones y cargar calificaciones.</flux:text>
        </flux:card>
    </div>
</x-layouts.app>
