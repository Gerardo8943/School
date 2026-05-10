<div class="max-w-4xl mx-auto space-y-8">
    <flux:heading size="xl" level="1">{{ __('Inscripción Académica') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">
        {{ __('Periodo Activo: ') }} <strong>{{ $periodoNombre }}</strong>
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

    <form wire:submit="save" class="space-y-10">
        
        <!-- Sección A: Datos de Identidad (Congelados) -->
        <flux:fieldset>
            <flux:legend>{{ __('Datos de Identidad') }}</flux:legend>
            <flux:description>{{ __('Esta información es asignada por Control de Estudio y no puede ser modificada.') }}</flux:description>
            
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input label="{{ __('Cédula') }}" value="{{ auth()->user()->cedula }}" disabled />
                <flux:input label="{{ __('Nombre Completo') }}" value="{{ auth()->user()->name }}" disabled />
                <flux:input label="{{ __('Carrera Asignada') }}" value="{{ $carreraNombre }}" disabled />
                <flux:input label="{{ __('Sede / Campus') }}" value="Campus Principal" disabled />
            </div>
        </flux:fieldset>

        <flux:separator variant="subtle" />

        <!-- Sección B: Actualización de Contacto -->
        <flux:fieldset>
            <flux:legend>{{ __('Actualización de Contacto') }}</flux:legend>
            <flux:description>{{ __('Revisa y actualiza tus datos de contacto si es necesario para mantenerte informado.') }}</flux:description>
            
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input wire:model="email" type="email" label="{{ __('Correo Electrónico') }}" />
                <flux:input wire:model="telefono" type="tel" label="{{ __('Número de Teléfono') }}" />
            </div>
        </flux:fieldset>

        <flux:separator variant="subtle" />

        <!-- Sección C: Preferencias y Selección de Materias -->
        <flux:fieldset>
            <flux:legend>{{ __('Selección Académica') }}</flux:legend>
            <flux:description>{{ __('Selecciona las secciones en las que deseas inscribirte para este periodo.') }}</flux:description>
            
            <div class="mt-4 mb-8">
                <flux:radio.group wire:model="turno" label="{{ __('Turno Deseado') }}" variant="cards" class="flex flex-col sm:flex-row gap-4">
                    <flux:radio value="Matutino" label="Matutino (Mañana)" icon="sun" />
                    <flux:radio value="Vespertino" label="Vespertino (Tarde)" icon="cloud" />
                    <flux:radio value="Nocturno" label="Nocturno (Noche)" icon="moon" />
                </flux:radio.group>
            </div>

            <div class="space-y-4">
                <flux:heading size="md" class="mb-2">{{ __('Materias Disponibles') }}</flux:heading>

                <div class="grid grid-cols-1 gap-4">
                    @forelse($this->seccionesDisponibles as $seccion)
                        <flux:checkbox 
                            wire:model="seccionesSeleccionadas" 
                            value="{{ $seccion->id }}" 
                            label="{{ $seccion->materia->name }} ({{ $seccion->materia->codigo_materia }})"
                            description="Profesor: {{ $seccion->profesor->name ?? 'Por asignar' }} | Horario: {{ $seccion->horario }} | Cupos: {{ $seccion->cupo_maximo }}"
                        />
                    @empty
                        <div class="p-4 rounded-lg bg-yellow-50 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300 flex items-center gap-3">
                            <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                            <p class="text-sm font-medium">No hay secciones disponibles para tu carrera en este periodo académico.</p>
                        </div>
                    @endforelse
                </div>
                
                @error('seccionesSeleccionadas')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>
        </flux:fieldset>

        <flux:separator variant="subtle" />

        <!-- Términos y Botón de Envío -->
        <div class="space-y-6 pt-4">
            <flux:checkbox wire:model="aceptoTerminos" label="Acepto las normativas académicas, el reglamento estudiantil y el compromiso de pago del periodo activo." />
            
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary" icon="document-check">
                    Procesar Inscripción
                </flux:button>
            </div>
        </div>

    </form>
</div>
