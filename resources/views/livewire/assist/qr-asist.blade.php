<div class="flex flex-col items-center p-6">
    <h2 class="text-2xl font-bold text-center mb-4">Registro de Asistencia</h2>

    <div id="alert-container" class="w-full max-w-lg">
        @if (session()->has('error'))
            <div id="error-alert" class="bg-red-500 text-white p-2 rounded-md mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div id="success-alert" class="bg-green-500 text-white p-2 rounded-md mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="flex justify-center">
        <div id="qr-reader" class="border border-gray-300 rounded-md p-2 w-72 h-72"></div>
    </div>

    <input type="hidden" wire:model="codigo_empleado" id="codigo_empleado">
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        iniciarLectorQR();

        function iniciarLectorQR() {
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader",
                {fps: 10, qrbox: {width: 250, height: 250}}
            );

            html5QrcodeScanner.render(onScanSuccess, onScanError);
        }

        function onScanSuccess(qrCodeMessage) {
            try {
                let qrData = JSON.parse(qrCodeMessage);
                if (qrData.employee_id) {
                    @this.
                    set('codigo_empleado', qrData.employee_id);
                    @this.
                    call('registrarAsistencia');
                } else {
                    alert("Código QR inválido. Escanea un código válido.");
                }
            } catch (error) {
                alert("Error al leer el código QR.");
                console.error(error);
            }
        }

        function onScanError(errorMessage) {
            console.warn(errorMessage);
        }

        Livewire.on('reloadPageWithDelay', function () {
            setTimeout(() => {
                location.reload();
            }, 3000);
        });

        setTimeout(() => {
            let successAlert = document.getElementById('success-alert');
            let errorAlert = document.getElementById('error-alert');
            if (successAlert) successAlert.style.display = 'none';
            if (errorAlert) errorAlert.style.display = 'none';
        }, 4000);
    });
</script>
