document.addEventListener("DOMContentLoaded", function () {
    // const absensiForm = document.getElementById("absensiLayanan");
    // const absensiFormSubmit = document.querySelector(".btn-submit");


    function startCameraInit() {
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const photoInput = document.getElementById('photoInput');
        const photoPreview = document.getElementById('photoPreview');
        const captureButton = document.getElementById('captureButton');
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');

        let streamStarted = false;

        async function startCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
                streamStarted = true;
                video.style.display = 'block';
                photoPreview.style.display = 'none';
                captureButton.textContent = 'Ambil Foto';
            } catch (err) {
                alert('Gagal mengakses kamera: ' + err.message);
            }
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        $('#latitude').val(position.coords.latitude);
                        $('#longitude').val(position.coords.longitude);
                    },
                    (error) => {
                        console.error('Gagal mendapatkan lokasi:', error.message);
                        alert('Gagal mendapatkan lokasi. Pastikan izin lokasi diaktifkan.');
                    }
                );
            } else {
                alert('Geolocation tidak didukung oleh browser Anda.');
            }
        }

        getLocation();

        captureButton.addEventListener('click', function () {
            if (!streamStarted || captureButton.textContent === 'Ambil Ulang') {
                startCamera();
            } else {
                const context = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                const dataUrl = canvas.toDataURL('image/png');
                photoInput.value = dataUrl;

                photoPreview.src = dataUrl;
                photoPreview.style.display = 'block';
                video.style.display = 'none';

                captureButton.textContent = 'Ambil Ulang';
            }
        });
    }

    $(function () {
        const select2 = $('.select2'),
            selectPicker = $('.selectpicker');

        if (selectPicker.length) {
            selectPicker.selectpicker();
        }

        if (select2.length) {
            select2.each(function () {
                var $this = $(this);
                var placeholderText = $this.attr("placeholder") || "Select value";
                $this.wrap('<div class="position-relative"></div>');
                $this.select2({
                    placeholder: placeholderText,
                    dropdownParent: $this.parent(),
                    allowClear: $this.data("allow-clear") || false
                });
            });
        }
    });

    startCameraInit();

});