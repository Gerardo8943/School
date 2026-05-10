import Swal from 'sweetalert2';

// Escuchar eventos de Livewire para SweetAlert
document.addEventListener('livewire:init', () => {
    // Éxito
    Livewire.on('swal:success', (event) => {
        console.log('Swal Success Event caught:', event);
        const data = Array.isArray(event) ? event[0] : event;
        Swal.fire({
            icon: 'success',
            title: data.title || '¡Éxito!',
            text: data.text || 'Operación completada.',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#10b981',
            timer: 10000,
            timerProgressBar: true,
            background: document.documentElement.classList.contains('dark') ? '#1e1e2e' : '#ffffff',
            color: document.documentElement.classList.contains('dark') ? '#e4e4e7' : '#1f2937',
        });
    });

    // Error
    Livewire.on('swal:error', (event) => {
        const data = Array.isArray(event) ? event[0] : event;
        Swal.fire({
            icon: 'error',
            title: data.title || 'Error',
            text: data.text || 'Algo salió mal.',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#ef4444',
            timer: 10000,
            timerProgressBar: true,
            background: document.documentElement.classList.contains('dark') ? '#1e1e2e' : '#ffffff',
            color: document.documentElement.classList.contains('dark') ? '#e4e4e7' : '#1f2937',
        });
    });
});
