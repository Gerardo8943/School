<x-layouts.app>
    <div class="flex flex-col gap-8">
        <div>
            <flux:heading size="xl" level="1">Panel de Control de Estudios</flux:heading>
            <flux:subheading size="lg" class="mt-1">Administración Central • Universidad León</flux:subheading>
        </div>
        
        <flux:card>
            <flux:heading size="lg">Bienvenido, {{ auth()->user()->name }}</flux:heading>
            <flux:text class="mt-2">Esta es el área de Control de Estudios. Aquí podrás gestionar inscripciones y calendarios.</flux:text>
        </flux:card>
    </div>
</x-layouts.app>
