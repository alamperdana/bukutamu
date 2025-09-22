@extends('layouts.app', ['title' => 'Buku Tamu Layanan'])
@push('cssLibrary')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endpush
@push('jsLibrary')
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endpush
@section('content')
    <div class="main-content @auth container-xxl @else container-fluid @endauth flex-grow-1 container-p-y">
        {{-- <div class="main-content container-xxl flex-grow-1 container-p-y"> --}}
        {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Layanan /</span> Buku Tamu</h4> --}}
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="m-0 card-header">Buku Tamu Pelayanan</h5>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <form id="absensiLayanan" action="{{ route('absensi.store') }}" method="POST">
                    @csrf
                    @if ($data->id)
                        @method('PUT')
                    @endif
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="lokasi_layanan_id" class="form-label">Lokasi Pelayanan</label>
                            <select id="lokasi_layanan_id" name="lokasi_layanan_id" class="select2 form-select"
                                placeholder="Silahkan pilih Lokasi Pelayanan">
                                <option></option>
                                @foreach ($lokasi as $lokasi)
                                    <option value="{{ $lokasi->id }}" @selected(old('lokasi_layanan_id', $data->lokasi_layanan_id) == $lokasi->id)>
                                        {{ $lokasi->lokasi_layanan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <x-form.input name="asal" id="asal" value="" label="Asal Instansi/Perusahaan"
                                placeholder="UKPBJ Kota Jambi/CV. PALUGADA" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <x-form.input name="jabatan" id="jabatan" value="{{ old('jabatan', $data->jabatan) }}"
                                label="Jabatan" placeholder="Pranata Komputer/Direktur" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <x-form.input name="nama" id="nama" value="{{ old('nama', $data->nama) }}"
                                label="Nama Lengkap" placeholder="John Doe" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <x-form.input name="no_telp" id="no_telp" value="{{ old('no_telp', $data->no_telp) }}"
                                label="No Telp" placeholder="08123456789" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="layanan_id" class="form-label">Jenis Layanan</label>
                            <select id="layanan_id" name="layanan_id" class="select2 form-select"
                                placeholder="Silahkan pilih Jenis Layanan">
                                <option></option>
                                @foreach ($layanan as $layanan)
                                    <option value="{{ $layanan->id }}" @selected(old('layanan_id', $data->layanan_id) == $layanan->id)>
                                        {{ $layanan->layanan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <x-form.textarea name="catatan" id="catatan" value="{{ old('catatan', $data->catatan) }}"
                                label="Catatan Tambahan" placeholder="Silahkan isi Jenis Layanan Catatan Tambahan" />
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="photo" class="form-label">Foto Identitas</label>
                            <div class="d-flex flex-column align-items-center">
                                <div class="camera-container" style="position: relative; width: 100%; max-width: 480px;">
                                    <img src="{{ asset('assets/img/illustrations/ktp.png') }}" alt="Panduan posisi KTP"
                                        class="camera-placeholder">
                                    <video id="video" autoplay playsinline
                                        style="width: 100%; border-radius: 16px; background:#000;"></video>
                                    <img id="idPreview" class="camera-still" src="" alt="Preview Foto" />
                                    <canvas id="canvas" style="display: none;"></canvas>
                                    <div class="id-guide-overlay" aria-hidden="true">
                                        <div class="id-guide-text">Sesuaikan KTP Anda dengan bingkai dan pastikan terlihat
                                            jelas</div>
                                    </div>
                                    <button type="button" id="switchCamera" class="camera-switch-btn"
                                        aria-label="Balik kamera">
                                        <img src="{{ asset('assets/img/icons/cam-rotate.png') }}" alt="Balik kamera" />
                                    </button>
                                </div>
                                <div class="camera-actions">
                                    <button type="button" id="uploadButton"
                                        class="btn btn-outline-primary camera-upload-btn">
                                        <i class="ti ti-upload"></i>
                                        <span class="ms-1">Unggah Foto</span>
                                    </button>
                                </div>
                                <hr class="w-100 my-4" />
                                <button type="button" id="captureButton" class="btn btn-capture btn-action mt-0">
                                    Mulai Kamera
                                </button>
                            </div>
                            <input type="hidden" id="idInput" name="id_path" />
                            <input type="file" id="idFileInput" accept="image/*" class="d-none" />
                        </div>
                        <input type="hidden" id="latitude" name="latitude" />
                        <input type="hidden" id="longitude" name="longitude" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-submit btn-action">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="content-backdrop fade"></div>
    </div>
@endsection

@push('css')
    <style>
        /* Preview container */
        .camera-container {
            margin-bottom: 18px;
        }

        .camera-container video {
            height: auto;
            display: block;
            object-fit: cover;
        }

        .camera-placeholder {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 16px;
            background: #f5f5f5;
            padding: 16px;
        }

        .camera-still {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 16px;
            display: none;
            z-index: 2;
        }

        .camera-actions {
            width: 100%;
            max-width: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 12px;
        }

        .camera-upload-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            gap: 8px;
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }

        .camera-upload-btn.upload-transparent {
            background-color: transparent;
            color: #0d6efd;
            border-color: rgba(13, 110, 253, 0.5);
            box-shadow: none;
        }

        .camera-switch-btn {
            position: absolute;
            left: 50%;
            bottom: 16px;
            transform: translateX(-50%);
            display: none;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 1px solid rgba(13, 110, 253, 0.35);
            background-color: rgba(255, 255, 255, 0.12);
            align-items: center;
            justify-content: center;
            padding: 0;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .camera-switch-btn.is-visible {
            display: inline-flex;
        }

        .camera-switch-btn img {
            width: 22px;
            height: 22px;
        }

        .camera-switch-btn:hover {
            background-color: rgba(13, 110, 253, 0.2);
            border-color: rgba(13, 110, 253, 0.5);
        }

        /* Overlay garis bantu untuk KTP (perkiraan rasio kartu 1.58:1) */
        .id-guide-overlay {
            position: absolute;
            inset: 0 0 60px 0;
            pointer-events: none;
            border-radius: 16px;
            z-index: 3;
        }

        /* Corner guides */
        .id-guide-overlay::before,
        .id-guide-overlay::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 86%;
            height: 90%;
        }

        .id-guide-overlay::before {
            border-radius: 12px;
            box-shadow: 0 0 0 200vmax rgba(0, 0, 0, 0.18) inset;
            /* gelapkan area luar */
        }

        .id-guide-overlay::after {
            border-radius: 12px;
            background:
                linear-gradient(90deg, rgba(255, 255, 255, 0.9) 22px, transparent 0) top left / 34% 3px no-repeat,
                linear-gradient(180deg, rgba(255, 255, 255, 0.9) 22px, transparent 0) top left / 3px 34% no-repeat,
                linear-gradient(270deg, rgba(255, 255, 255, 0.9) 22px, transparent 0) top right / 34% 3px no-repeat,
                linear-gradient(180deg, rgba(255, 255, 255, 0.9) 22px, transparent 0) top right / 3px 34% no-repeat,
                linear-gradient(90deg, rgba(255, 255, 255, 0.9) 22px, transparent 0) bottom left / 34% 3px no-repeat,
                linear-gradient(0deg, rgba(255, 255, 255, 0.9) 22px, transparent 0) bottom left / 3px 34% no-repeat,
                linear-gradient(270deg, rgba(255, 255, 255, 0.9) 22px, transparent 0) bottom right / 34% 3px no-repeat,
                linear-gradient(0deg, rgba(255, 255, 255, 0.9) 22px, transparent 0) bottom right / 3px 34% no-repeat;
        }

        .id-guide-text {
            position: absolute;
            left: 50%;
            bottom: 16px;
            transform: translateX(-50%);
            color: rgba(255, 255, 255, 0.95);
            text-align: center;
            font-size: 0.95rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
            padding: 0 16px;
            line-height: 1.2;
        }

        /* Gradient capture button */
        .btn-capture {
            color: #fff;
            background: linear-gradient(90deg, #ff3d3d, #ff1e56);
            border: none;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 6px 16px rgba(255, 30, 86, 0.3);
        }

        .btn-capture:hover {
            filter: brightness(0.98);
            color: #fff;
        }

        /* Samakan ukuran kedua tombol */
        .btn-action {
            width: clamp(220px, 60%, 120px);
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('assets/js/absensiForm.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
        });

        // // Menangkap event perubahan pada dropdown Select2 untuk 'layanan_id'
        // $('#layanan_id').on('change', function() {
        //     const selectedLayananId = $(this).val();  // Mendapatkan nilai yang dipilih pada Select2
        //     console.log("Pilihan Layanan ID:", selectedLayananId);  // Menampilkan pilihan ID di console

        //     // Menyembunyikan atau menampilkan textarea "lainnya" berdasarkan pilihan
        //     const lainnyaTextarea = document.getElementById("lainnya");
        //     if (selectedLayananId === "8") {
        //         // Tampilkan textarea "lainnya" jika layanan_id adalah 8
        //         lainnyaTextarea.closest('.col-sm-12').style.display = "block";
        //     } else {
        //         // Sembunyikan textarea "lainnya" jika layanan_id bukan 8
        //         lainnyaTextarea.closest('.col-sm-12').style.display = "none";
        //     }
        // });

        // Form submission logic
        $('#absensiLayanan').on('submit', function(e) {
            e.preventDefault();

            const _form = this;
            const formData = new FormData(_form);

            // Mendapatkan tombol submit dan menyimpan teks asli
            const submitButton = $(this).find('.btn-submit');
            const originalButtonText = submitButton.text();

            // Nonaktifkan tombol dan ubah teks
            submitButton.prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: _form.action,
                method: _form.method,
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    // Redirect setelah sukses
                    window.location.href = "/absensi";
                },
                error: function(err) {
                    // Menghapus pesan kesalahan sebelumnya
                    if (err.responseJSON && err.responseJSON.errors) {
                        $(".invalid-feedback").remove();
                        $(".is-invalid").removeClass("is-invalid");

                        // Menampilkan kesalahan pada masing-masing field
                        for (let [key, message] of Object.entries(err.responseJSON.errors)) {
                            let inputField = $(`[name=${key}]`);
                            inputField
                                .addClass("is-invalid")
                                .parent()
                                .append(
                                    `<div class="invalid-feedback">${message}</div>`
                                );
                        }
                    } else {
                        console.error(err);
                        alert('Terjadi kesalahan, coba lagi nanti.');
                    }
                },
                complete: function() {
                    // Mengaktifkan kembali tombol dan mengembalikan teks ke semula
                    submitButton.prop('disabled', false).text(originalButtonText);
                }
            });
        });
    </script>
@endpush
