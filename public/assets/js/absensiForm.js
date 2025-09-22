document.addEventListener("DOMContentLoaded", function () {
    // const absensiForm = document.getElementById("absensiLayanan");
    // const absensiFormSubmit = document.querySelector(".btn-submit");


    function startCameraInit() {
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const idInput = document.getElementById('idInput');
        const idPreview = document.getElementById('idPreview');
        const captureButton = document.getElementById('captureButton');
        const switchCameraButton = document.getElementById('switchCamera');
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const overlay = document.querySelector('.id-guide-overlay');
        const container = document.querySelector('.camera-container');
        const placeholderImage = document.querySelector('.camera-placeholder');
        const uploadButton = document.getElementById('uploadButton');
        const fileInput = document.getElementById('idFileInput');

        if (video) {
            video.style.display = 'none';
        }
        if (overlay) {
            overlay.style.display = 'none';
        }
        if (placeholderImage) {
            placeholderImage.style.display = 'block';
        }
        if (captureButton) {
            captureButton.textContent = 'Mulai Kamera';
        }
        if (switchCameraButton) {
            switchCameraButton.classList.remove('is-visible');
        }
        if (uploadButton) {
            uploadButton.classList.remove('upload-transparent');
        }

        let streamStarted = false;
        let currentStream = null;
        let currentFacingMode = 'environment'; // default kamera belakang
        let frontDeviceId = null;
        let backDeviceId = null;

        function stopCurrentStream() {
            if (currentStream) {
                currentStream.getTracks().forEach(t => t.stop());
                currentStream = null;
            }
            streamStarted = false;
            if (placeholderImage && (!idPreview || idPreview.style.display !== 'block')) {
                placeholderImage.style.display = 'block';
            }
            if (uploadButton) {
                uploadButton.classList.remove('upload-transparent');
            }
            if (switchCameraButton) {
                switchCameraButton.classList.remove('is-visible');
            }
        }

        function setContainerHeightFromImage(imgEl) {
            if (!container || !imgEl) return;
            const cw = container.clientWidth;
            if (!cw || !imgEl.naturalWidth || !imgEl.naturalHeight) return;
            const ch = Math.round(cw * (imgEl.naturalHeight / imgEl.naturalWidth));
            if (ch) {
                container.style.height = ch + 'px';
            }
        }

        function applyCapturedImage(dataUrl) {
            if (!dataUrl) return;
            if (idInput) {
                idInput.value = dataUrl;
            }
            if (video) {
                video.style.display = 'none';
            }
            if (overlay) {
                overlay.style.display = 'none';
            }

            if (idPreview) {
                const handlePreviewLoad = () => {
                    setContainerHeightFromImage(idPreview);
                    if (placeholderImage) {
                        placeholderImage.style.display = 'none';
                    }
                    idPreview.style.display = 'block';
                    idPreview.removeEventListener('load', handlePreviewLoad);
                };

                idPreview.addEventListener('load', handlePreviewLoad);
                idPreview.src = dataUrl;

                if (idPreview.complete && idPreview.naturalWidth) {
                    handlePreviewLoad();
                }
            }

            stopCurrentStream();
            if (captureButton) {
                captureButton.textContent = 'Ambil Ulang';
            }
        }

        async function detectDevices() {
            try {
                const devices = await navigator.mediaDevices.enumerateDevices();
                const videos = devices.filter(d => d.kind === 'videoinput');
                // Reset first
                frontDeviceId = null;
                backDeviceId = null;
                videos.forEach(d => {
                    const label = (d.label || '').toLowerCase();
                    if (!frontDeviceId && (label.includes('front') || label.includes('user'))) {
                        frontDeviceId = d.deviceId;
                    }
                    if (!backDeviceId && (label.includes('back') || label.includes('rear') || label.includes('environment'))) {
                        backDeviceId = d.deviceId;
                    }
                });
                // Fallback assignment if only one device
                if (!frontDeviceId && videos[0]) frontDeviceId = videos[0].deviceId;
                if (!backDeviceId && videos[1]) backDeviceId = videos[1].deviceId;
            } catch (e) {
                // ignore
            }
        }

        function setContainerHeightToVideo() {
            if (!container || !video) return;
            const vw = video.videoWidth;
            const vh = video.videoHeight;
            const cw = container.clientWidth || video.clientWidth;
            if (vw && vh && cw) {
                const ch = Math.round(cw * (vh / vw));
                container.style.height = ch + 'px';
            }
        }

        async function startCamera() {
            try {
                stopCurrentStream();

                let constraints = { video: true };

                // Prefer deviceId if we have it
                await detectDevices();
                if (currentFacingMode === 'environment' && backDeviceId) {
                    constraints = { video: { deviceId: { exact: backDeviceId } } };
                } else if (currentFacingMode === 'user' && frontDeviceId) {
                    constraints = { video: { deviceId: { exact: frontDeviceId } } };
                } else {
                    // Fallback to facingMode
                    constraints = { video: { facingMode: { exact: currentFacingMode } } };
                }

                let stream;
                try {
                    stream = await navigator.mediaDevices.getUserMedia(constraints);
                } catch (e1) {
                    // Fallback attempts
                    try {
                        stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: currentFacingMode } });
                    } catch (e2) {
                        stream = await navigator.mediaDevices.getUserMedia({ video: true });
                    }
                }

                currentStream = stream;
                video.srcObject = currentStream;
                streamStarted = true;
                video.style.display = 'block';
                idPreview.style.display = 'none';
                if (overlay) overlay.style.display = 'block';
                if (placeholderImage) placeholderImage.style.display = 'none';
                if (uploadButton) uploadButton.classList.add('upload-transparent');
                if (switchCameraButton) switchCameraButton.classList.add('is-visible');
                captureButton.textContent = 'Ambil Foto';

                // Pastikan container mengikuti rasio video
                const onMeta = () => {
                    setContainerHeightToVideo();
                };
                if (video.readyState >= 1) {
                    setContainerHeightToVideo();
                } else {
                    video.addEventListener('loadedmetadata', onMeta, { once: true });
                }
            } catch (err) {
                alert('Gagal mengakses kamera: ' + err.message);
                if (placeholderImage && (!idPreview || idPreview.style.display !== 'block')) {
                    placeholderImage.style.display = 'block';
                }
                if (uploadButton) {
                    uploadButton.classList.remove('upload-transparent');
                }
                if (switchCameraButton) {
                    switchCameraButton.classList.remove('is-visible');
                }
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
                applyCapturedImage(dataUrl);
            }
        });

        if (switchCameraButton) {
            switchCameraButton.addEventListener('click', function () {
                currentFacingMode = currentFacingMode === 'environment' ? 'user' : 'environment';
                // Restart camera with new facing mode
                startCamera();
            });
        }

        if (uploadButton && fileInput) {
            uploadButton.addEventListener('click', function () {
                fileInput.value = '';
                fileInput.click();
            });

            fileInput.addEventListener('change', function () {
                const file = this.files && this.files[0];
                if (!file) return;

                if (file.type && !file.type.startsWith('image/')) {
                    alert('Silakan pilih file gambar.');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (event) {
                    const dataUrl = event.target && event.target.result;
                    applyCapturedImage(dataUrl);
                };
                reader.onerror = function () {
                    alert('Gagal membaca file, coba lagi.');
                };
                reader.readAsDataURL(file);
            });
        }

        // Resize container saat ukuran viewport berubah
        window.addEventListener('resize', function () {
            setContainerHeightToVideo();
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
