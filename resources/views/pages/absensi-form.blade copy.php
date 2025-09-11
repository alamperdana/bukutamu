<!DOCTYPE html>

<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Buku Tamu Pelayanan</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/izitoast/css/iziToast.min.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">


            <!-- Layout container -->
            <div class="layout-page">

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <div class="main-content container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Layanan /</span> Buku Tamu</h4>

                        <div class="card">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="m-0 card-header">Buku Tamu Pelayanan</h5>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <form action="{{ route('absensi.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="lokasi_layanan" class="form-label">Lokasi Pelayanan</label>
                                            <select id="lokasi_layanan" name="lokasi_layanan_id" class="selectpicker w-100" data-style="btn-default">
                                                <option value="1">Konter LPSE Mal Pelayanan Publik Kota Jambi</option>
                                                <option value="2">Kantor LPSE</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="asal" class="form-label">Asal Instansi/Perusahaan</label>
                                            <input class="form-control" type="text" id="asal" name="asal" placeholder="UKPBJ Kota Jambi/CV. PALUGADA" required />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="jabatan" class="form-label">Jabatan</label>
                                            <input class="form-control" type="text" id="jabatan" name="jabatan" placeholder="Pranata Komputer/Direktur" required />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input class="form-control" type="text" id="nama" name="nama" placeholder="John Doe" required />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="no_telp" class="form-label">Telp</label>
                                            <input class="form-control" type="text" id="no_telp" name="no_telp" placeholder="08123456789" required />
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="layanan" class="form-label">Jenis Layanan</label>
                                            <select id="layanan" name="layanan_id" class="selectpicker w-100" data-style="btn-default">
                                                <option value="1">Pendaftaran dan Verifikasi Akun SPSE</option>
                                                <option value="2">Konsultasi eKatalog v6</option>
                                                <option value="3">Konsultasi SPSE</option>
                                                <option value="4">Janji Temu</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="photo" class="form-label">Foto Kunjungan</label>
                                            <div class="d-flex flex-column align-items-center">
                                                <video id="video" autoplay playsinline style="width: 100%; max-width: 400px; border: 1px solid #ccc;"></video>
                                                <canvas id="canvas" style="display: none;"></canvas>
                                                <img id="photoPreview" src="" alt="Preview Foto" style="width: 100%; max-width: 400px; margin-top: 10px; display: none; border: 1px solid #ccc;" />
                                                <button type="button" id="captureButton" class="btn btn-primary mt-2">Ambil Foto</button>
                                                <button type="submit" class="btn btn-success mt-3">Simpan</button>
                                            </div>
                                            <input type="hidden" id="photoInput" name="photo_path" />
                                        </div>
                                        <input type="hidden" id="latitude" name="latitude" />
                                        <input type="hidden" id="longitude" name="longitude" />
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>

            <!-- preloader -->
            <div class="preloader" style="visibility:hidden;">
                <div class="lds-ellipsis">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>

            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
        </div>
        <!-- / Layout wrapper -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/vendor/izitoast/js/iziToast.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
        <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

        <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="{{ asset('assets/js/startCamera.js') }}"></script>
        <script src="{{ asset('assets/js/getGeoLocation.js') }}"></script>
        <!-- Page JS -->
        <script>
            $(document).ready(function() {
                $(".selectpicker").selectpicker();
                startCameraInit();
                getLocation();
                showLoading();
            });
        </script>
</body>

</html>
