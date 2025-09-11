@php($hideMenuNavbar = true)
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
    <div class="main-content container-xxl flex-grow-1 container-p-y">
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
                            <label for="photo" class="form-label">Foto Kunjungan</label>
                            <div class="d-flex flex-column align-items-center">
                                <video id="video" autoplay playsinline
                                    style="width: 100%; max-width: 400px; border: 1px solid #ccc;"></video>
                                <canvas id="canvas" style="display: none;"></canvas>
                                <img id="photoPreview" src="" alt="Preview Foto"
                                    style="width: 100%; max-width: 400px; margin-top: 10px; display: none; border: 1px solid #ccc;" />
                                <button type="button" id="captureButton" class="btn btn-primary mt-2">Ambil Foto</button>
                            </div>
                            <input type="hidden" id="photoInput" name="photo_path" />
                        </div>
                        <input type="hidden" id="latitude" name="latitude" />
                        <input type="hidden" id="longitude" name="longitude" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="content-backdrop fade"></div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/absensiForm.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
        });

        // Menangkap event perubahan pada dropdown Select2 untuk 'layanan_id'
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
                    window.location.href = "/bukutamu/absensi";
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
