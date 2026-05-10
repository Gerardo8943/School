<div class="max-w-4xl mx-auto space-y-6">
    <flux:heading size="xl" level="1">{{ __('Inscripción Académica') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">
        {{ __('Periodo Activo: ') }} <strong>{{ $periodoActivo->name ?? 'No hay periodo activo' }}</strong>
    </flux:subheading>

    @if (session()->has('error'))
        <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-800 dark:bg-red-900/50 dark:text-red-300 flex items-center gap-3">
            <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <p class="text-sm font-medium">{{ session('error') }}</p>
        </div>
    @endif

    @error('inscripcion')
        <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-800 dark:bg-red-900/50 dark:text-red-300 flex items-center gap-3">
            <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <p class="text-sm font-medium">{{ $message }}</p>
        </div>
    @enderror

    <form wire:submit="save" class="space-y-8">
        
        <!-- Sección A: Datos de Identidad (Congelados) -->
        <flux:card>
            <flux:heading size="lg" class="mb-4">{{ __('Datos de Identidad') }}</flux:heading>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input label="{{ __('Cédula') }}" value="{{ auth()->user()->cedula }}" disabled />
                <flux:input label="{{ __('Nombre Completo') }}" value="{{ auth()->user()->name }}" disabled />
                <flux:input label="{{ __('Carrera Asignada') }}" value="{{ $carrera->name ?? 'Sin asignar' }}" disabled />
                <flux:input label="{{ __('Sede / Campus') }}" value="Campus Principal" disabled />
            </div>
        </flux:card>

        <!-- Sección B: Actualización de Contacto -->
        <flux:card>
            <flux:heading size="lg" class="mb-4">{{ __('Actualización de Contacto') }}</flux:heading>
            <flux:subheading class="mb-4">{{ __('Revisa y actualiza tus datos de contacto si es necesario.') }}</flux:subheading>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input wire:model="email" type="email" label="{{ __('Correo Electrónico') }}" />
                <flux:input wire:model="telefono" type="tel" label="{{ __('Número de Teléfono') }}" />
            </div>
        </flux:card>

        <!-- Sección C: Preferencias y Selección de Materias -->
        <flux:card>
            <flux:heading size="lg" class="mb-4">{{ __('Selección Académica') }}</flux:heading>
            
            <div class="mb-6">
                <flux:radio.group wire:model="turno" label="{{ __('Turno Deseado') }}">
                    <flux:radio value="Matutino" label="Matutino (Mañana)" />
                    <flux:radio value="Vespertino" label="Vespertino (Tarde)" />
                    <flux:radio value="Nocturno" label="Nocturno (Noche)" />
                </flux:radio.group>
            </div>

            <div class="space-y-4">
                <flux:heading size="md">{{ __('Materias Disponibles') }}</flux:heading>
                <flux:subheading>{{ __('Selecciona las secciones en las que deseas inscribirte para este periodo.') }}</flux:subheading>

                @forelse($this->seccionesDisponibles as $seccion)
                    <div class="flex items-start space-x-3 p-4 border rounded-lg border-zinc-200 dark:border-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                        <flux:checkbox wire:model="seccionesSeleccionadas" value="{{ $seccion->id }}" id="seccion-{{ $seccion->id }}" />
                        <div class="flex-1">
                            <label for="seccion-{{ $seccion->id }}" class="cursor-pointer font-semibold text-zinc-900 dark:text-white">
                                {{ $seccion->materia->name }} ({{ $seccion->materia->codigo_materia }})
                            </label>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">
                                <strong>Profesor:</strong> {{ $seccion->profesor->name ?? 'Por asignar' }} | 
                                <strong>Horario:</strong> {{ $seccion->horario }}
                            </p>
                        </div>
                        <div class="text-sm">
                            <flux:badge variant="primary" size="sm">Cupos: {{ $seccion->cupo_maximo }}</flux:badge>
                        </div>
                    </div>
                @empty
                    <div class="p-4 rounded-lg bg-yellow-50 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300 flex items-center gap-3">
                        <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        <p class="text-sm font-medium">No hay secciones disponibles para tu carrera en este periodo académico.</p>
                    </div>
                @endforelse
                
                @error('seccionesSeleccionadas')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>
        </flux:card>

        <!-- Términos y Botón de Envío -->
        <div class="space-y-4 mt-6">
            <flux:checkbox wire:model="aceptoTerminos" label="Acepto las normativas académicas, el reglamento estudiantil y el compromiso de pago del periodo activo." />
            
            <div class="flex justify-end pt-4">
                <flux:button type="submit" variant="primary" icon="document-check">
                    Procesar Inscripción
                </flux:button>
            </div>
        </div>

    </form>
</div>
