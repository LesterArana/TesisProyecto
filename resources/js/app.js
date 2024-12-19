import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();


// Importa la librería del lector QR
import { Html5Qrcode } from 'html5-qrcode';

// Configuración del lector QR con Livewire
document.addEventListener('livewire:load', function () {
    const qrReaderElementId = 'qr-reader';

    if (document.getElementById(qrReaderElementId)) {
        const qrReader = new Html5Qrcode(qrReaderElementId);

        qrReader
            .start(
                { facingMode: 'environment' }, // Usa la cámara trasera
                {
                    fps: 10, // Frames por segundo
                    qrbox: { width: 250, height: 250 }, // Área de escaneo
                },
                (decodedText) => {
                    // Enviar el texto decodificado al componente Livewire
                    Livewire.dispatch('scanQrCode', decodedText);
                },
                (errorMessage) => {
                    console.warn(`Error de escaneo: ${errorMessage}`);
                }
            )
            .catch((err) => {
                console.error('Error al iniciar el lector de QR:', err);
            });
    }
});
