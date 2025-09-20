<?php $__env->startPush('cssLibrary'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/select2/select2.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('jsLibrary'); ?>
    <script src="<?php echo e(asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/libs/select2/select2.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content <?php if(auth()->guard()->check()): ?> container-xxl <?php else: ?> container-fluid <?php endif; ?> flex-grow-1 container-p-y">
        
        
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="m-0 card-header">Buku Tamu Pelayanan</h5>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <form id="absensiLayanan" action="<?php echo e(route('absensi.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php if($data->id): ?>
                        <?php echo method_field('PUT'); ?>
                    <?php endif; ?>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="lokasi_layanan_id" class="form-label">Lokasi Pelayanan</label>
                            <select id="lokasi_layanan_id" name="lokasi_layanan_id" class="select2 form-select"
                                placeholder="Silahkan pilih Lokasi Pelayanan">
                                <option></option>
                                <?php $__currentLoopData = $lokasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lokasi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($lokasi->id); ?>" <?php if(old('lokasi_layanan_id', $data->lokasi_layanan_id) == $lokasi->id): echo 'selected'; endif; ?>>
                                        <?php echo e($lokasi->lokasi_layanan); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['name' => 'asal','id' => 'asal','value' => '','label' => 'Asal Instansi/Perusahaan','placeholder' => 'UKPBJ Kota Jambi/CV. PALUGADA']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'asal','id' => 'asal','value' => '','label' => 'Asal Instansi/Perusahaan','placeholder' => 'UKPBJ Kota Jambi/CV. PALUGADA']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['name' => 'jabatan','id' => 'jabatan','value' => ''.e(old('jabatan', $data->jabatan)).'','label' => 'Jabatan','placeholder' => 'Pranata Komputer/Direktur']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'jabatan','id' => 'jabatan','value' => ''.e(old('jabatan', $data->jabatan)).'','label' => 'Jabatan','placeholder' => 'Pranata Komputer/Direktur']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['name' => 'nama','id' => 'nama','value' => ''.e(old('nama', $data->nama)).'','label' => 'Nama Lengkap','placeholder' => 'John Doe']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'nama','id' => 'nama','value' => ''.e(old('nama', $data->nama)).'','label' => 'Nama Lengkap','placeholder' => 'John Doe']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['name' => 'no_telp','id' => 'no_telp','value' => ''.e(old('no_telp', $data->no_telp)).'','label' => 'No Telp','placeholder' => '08123456789']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'no_telp','id' => 'no_telp','value' => ''.e(old('no_telp', $data->no_telp)).'','label' => 'No Telp','placeholder' => '08123456789']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="layanan_id" class="form-label">Jenis Layanan</label>
                            <select id="layanan_id" name="layanan_id" class="select2 form-select"
                                placeholder="Silahkan pilih Jenis Layanan">
                                <option></option>
                                <?php $__currentLoopData = $layanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($layanan->id); ?>" <?php if(old('layanan_id', $data->layanan_id) == $layanan->id): echo 'selected'; endif; ?>>
                                        <?php echo e($layanan->layanan); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <?php if (isset($component)) { $__componentOriginalcd97a59301ba78d56b3ed60dd41409ab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.textarea','data' => ['name' => 'catatan','id' => 'catatan','value' => ''.e(old('catatan', $data->catatan)).'','label' => 'Catatan Tambahan','placeholder' => 'Silahkan isi Jenis Layanan Catatan Tambahan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'catatan','id' => 'catatan','value' => ''.e(old('catatan', $data->catatan)).'','label' => 'Catatan Tambahan','placeholder' => 'Silahkan isi Jenis Layanan Catatan Tambahan']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab)): ?>
<?php $attributes = $__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab; ?>
<?php unset($__attributesOriginalcd97a59301ba78d56b3ed60dd41409ab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd97a59301ba78d56b3ed60dd41409ab)): ?>
<?php $component = $__componentOriginalcd97a59301ba78d56b3ed60dd41409ab; ?>
<?php unset($__componentOriginalcd97a59301ba78d56b3ed60dd41409ab); ?>
<?php endif; ?>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="photo" class="form-label">Foto Identitas</label>
                            <div class="d-flex flex-column align-items-center">
                                <div class="camera-container" style="position: relative; width: 100%; max-width: 480px;">
                                    <video id="video" autoplay playsinline
                                        style="width: 100%; border-radius: 16px; background:#000;"></video>
                                    <img id="idPreview" class="camera-still" src="" alt="Preview Foto" />
                                    <canvas id="canvas" style="display: none;"></canvas>
                                    <div class="id-guide-overlay" aria-hidden="true">
                                        <div class="id-guide-text">Sesuaikan KTP Anda dengan bingkai dan pastikan terlihat
                                            jelas</div>
                                    </div>
                                </div>
                                <button type="button" id="switchCamera" class="btn btn-outline-secondary btn-action">
                                    <i class="ti ti-camera-rotate"></i>
                                    <span class="ms-1">Balik kamera</span>
                                </button>
                                <hr class="w-100 my-4" />
                                <button type="button" id="captureButton" class="btn btn-capture btn-action mt-0">
                                    Ambil Foto
                                </button>
                            </div>
                            <input type="hidden" id="idInput" name="id_path" />
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
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

        .camera-still {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 16px;
            display: none;
        }

        /* Overlay garis bantu untuk KTP (perkiraan rasio kartu 1.58:1) */
        .id-guide-overlay {
            position: absolute;
            inset: 0;
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
            height: 75%;
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
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('assets/js/absensiForm.js')); ?>"></script>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Buku Tamu Layanan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/perdana/Work/LaravelApp/bukutamu/resources/views/pages/absensi-form.blade.php ENDPATH**/ ?>