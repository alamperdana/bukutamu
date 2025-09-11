$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
    },
});

showLoading();
$(document).ready(function () {
    showLoading(false);
});
function showLoading(show = true) {
    const preloader = $(".preloader");

    if (show) {
        preloader.css({
            opacity: 1,
            visibility: "visible",
        });
    } else {
        preloader.css({
            opacity: 0,
            visibility: "hidden",
        });
    }
}

function handleAction(datatable, onShowAction, onSuccessAction) {
    $(document).on("click", ".action", function (e) {
        e.preventDefault();
        const button = $(this); // Tombol yang diklik
        const actionType = $(this).data("action-type");

        if (actionType === "restore" || actionType === "force-delete") {
            handleArchiveAction(button, datatable);
        } else {
            handleAjax(this.href)
                .onSuccess(function (res) {
                    onShowAction && onShowAction(res);
                    handleFormSubmit("#form_action")
                        .setDataTable(datatable)
                        .onSuccess(function (res) {
                            onSuccessAction && onSuccessAction(res);
                        })
                        .init();
                })
                .execute();
        }
    });
}

function handleFormSubmit(selector) {
    function init() {
        const _this = this; // Konteks fungsi
        _this.runDefaultSuccessCallback = true; // Set nilai default
        $(selector).on("submit", function (e) {
            e.preventDefault();
            const _form = this;
            $.ajax({
                url: this.action,
                method: this.method,
                data: new FormData(_form),
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $(_form).find(".is-invalid").removeClass("is-invalid");
                    $(_form).find(".invalid-feedback").remove();
                    submitLoader().show();
                },
                success: (res) => {
                    if (_this.runDefaultSuccessCallback) {
                        $("#modal_action").modal("hide");
                        showToast(res.status, res.message);
                    }

                    _this.onSuccessCallback && _this.onSuccessCallback(res);
                    _this.dataTableId &&
                        window.LaravelDataTables[_this.dataTableId].ajax.reload(
                            null,
                            false
                        );
                },
                complete: function () {
                    submitLoader().hide();
                },
                error: function (err) {
                    const errors = err.responseJSON?.errors;

                    if (errors) {
                        for (let [key, message] of Object.entries(errors)) {
                            console.log(key);
                            $(`[name=${key}]`).addClass("is-invalid").parent();
                            // .append(`<div class="invalid-feedback">${message}</div>`)
                        }
                    }

                    showToast("error", err.responseJSON?.message);
                },
            });
        });
    }

    function onSuccess(cb, runDefault = true) {
        this.onSuccessCallback = cb;
        this.runDefaultSuccessCallback = runDefault;
        return this;
    }

    function setDataTable(id) {
        this.dataTableId = id;
        return this;
    }

    return {
        init,
        onDefaultSuccessCallback: true,
        onSuccess,
        setDataTable,
    };
}

function showToast(status = "success", message) {
    iziToast[status]({
        title: status == "success" ? "Success" : "Error",
        message: message,
        position: "topRight",
    });
}

function submitLoader(formId = "#form_action") {
    const button = $(formId).find('button[type="submit"]');

    function show() {
        button
            .addClass("btn-load")
            .attr("disabled", true)
            .html(
                `<span class="d-flex align-items-center"><span class="spinner-border flex-shrink-0"></span><span class="flex-grow-1 ms-2"> Memproses...</span></span>`
            );
    }

    function hide(text = "Simpan") {
        button.removeClass("btn-load").removeAttr("disabled").text(text);
    }

    return {
        show,
        hide,
    };
}

function handleAjax(url, method = "get", data = {}) {
    function onSuccess(cb, runDefault = true) {
        this.onSuccessCallback = cb;
        this.runDefaultSuccessCallback = runDefault;
        return this;
    }

    function execute() {
        $.ajax({
            url,
            method,
            data,
            beforeSend: function () {
                showLoading();
            },
            complete: function () {
                showLoading(false);
            },
            success: (res) => {
                if (this.runDefaultSuccessCallback) {
                    const modal = $("#modal_action");
                    modal.html(res);
                    modal.modal("show");

                    paguInit();
                }

                this.onSuccessCallback && this.onSuccessCallback(res);
            },
            error: function (err) {
                console.log(err);
                showToast(
                    "error",
                    err.responseJSON?.message || "Terjadi kesalahan."
                );
            },
        });
    }

    function onError(cb) {
        this.onErrorCallback = cb;
        return this;
    }

    return {
        execute,
        onSuccess,
        runDefaultSuccessCallback: true,
    };
}

function paguInit() {
    const paguItemsContainer = document.getElementById("pagu_items");
    if (!paguItemsContainer) return;

    let paguIndex = document.querySelectorAll(".pagu-item").length || 0;

    /**
     * Fungsi untuk menambahkan baris input baru
     */
    function addPaguItem() {
        const newItem = `
            <div class="row mb-3 pagu-item" id="pagu_item_${paguIndex}">
                <div class="col-md-5">
                    <label class="form-label" for="pagu[${paguIndex}][amount]">Pagu (Rp)</label>
                    <input type="text" name="pagu[${paguIndex}][amount]" class="form-control" placeholder="100.000.000" data-format="currency" />
                    <div id="paguInputHelp" class="form-text text-danger">masukkan angka tanpa pemisah (titik).</div>
                </div>
                <div class="col-md-5">
                    <label class="form-label" for="pagu[${paguIndex}][description]">Keterangan</label>
                    <input type="text" name="pagu[${paguIndex}][description]" class="form-control" placeholder="APBD" />
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-label-danger mt-4 remove-pagu" data-target="#pagu_item_${paguIndex}">
                        Hapus
                    </button>
                </div>
            </div>
        `;
        paguItemsContainer.insertAdjacentHTML("beforeend", newItem);
        paguIndex++;
    }

    /**
     * Event listener untuk tombol "Tambah Pagu"
     */
    const addPaguButton = document.getElementById("add_pagu_item");
    if (addPaguButton) {
        addPaguButton.removeEventListener("click", addPaguItem); // Hindari duplikasi listener
        addPaguButton.addEventListener("click", addPaguItem);
    }

    /**
     * Event listener global untuk tombol "Hapus"
     */
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-pagu")) {
            const target = e.target.dataset.target;
            const itemToRemove = document.querySelector(target);
            if (itemToRemove) itemToRemove.remove();
        }
    });

    // Aktifkan format currency
    formatCurrencyInput();
}

function formatCurrencyInput() {
    document.addEventListener("input", function (event) {
        // Cek jika elemen memiliki atribut data-format="currency"
        if (event.target.matches('[data-format="currency"]')) {
            const input = event.target;
            const value = input.value.replace(/\D/g, ""); // Hapus karakter non-digit
            const formattedValue = new Intl.NumberFormat("id-ID", {
                style: "decimal",
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
            }).format(value);

            input.value = formattedValue;
        }
    });
}

function handleArchiveAction(button, datatable) {
    console.log("Received DataTable ID:", datatable);
    console.log("Received Button:", button);

    const url = button.attr("href"); // URL dari tombol
    const method = button.data("method") || "get"; // Method (default GET, bisa POST/DELETE)

    handleAjax(url, method) // Kirim AJAX request sesuai method
        .onSuccess(function (res) {
            console.log("Success:", res);
            showToast("success", res.message);
            $("#modal_action").modal("hide");

            window.LaravelDataTables[datatable].ajax.reload(null, false);
        })
        .execute();
}

function handleDelete(datatable, onSuccessAction) {
    $("#" + datatable).on("click", ".delete", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Anda akan menghapus data ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Batal",
            confirmButtonText: "Ya, Hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                handleAjax(this.href, "delete")
                    .onSuccess(function (res) {
                        onSuccessAction && onSuccessAction(res);
                        showToast(res.status, res.message);
                        window.LaravelDataTables[datatable].ajax.reload(
                            null,
                            false
                        );
                    }, false)
                    .execute();
            }
        });
    });
}

function select2Init() {
    $(".select2").each(function () {
        const placeholder = $(this).attr("placeholder") || "Pilih opsi";
        const isRoles = $(this).attr("id") === "roles";

        $(this).select2({
            dropdownParent: $(this).parents(".modal-content"),
            placeholder: placeholder,
            allowClear: true,
            language: isRoles
                ? {}
                : {
                      noResults: function () {
                          return "Tidak ada hasil yang ditemukan.";
                      },
                      searching: function () {
                          return "Sedang mencari...";
                      },
                  },
        });
    });
}

function flatpickrIndoInit() {
    $(".flatpickr-date").each(function () {
        let existingDate = $(this).val(); // Ambil nilai yang sudah ada

        $(this).flatpickr({
            monthSelectorType: "dropdown",
            minDate: existingDate ? null : "today", // Jika ada nilai, jangan kunci minDate
            disable: [
                function (date) {
                    return date.getDay() === 0 || date.getDay() === 6; // Nonaktifkan Sabtu & Minggu
                },
            ],
            locale: "id",
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "j F Y",
            defaultDate: existingDate || null, // Gunakan nilai yang ada dari database
            onReady: function (selectedDates, dateStr, instance) {
                if (existingDate) {
                    let formattedDate = formatTanggalIndo(existingDate);
                    instance.altInput.value = formattedDate; // Pastikan altInput diperbarui
                }
            },
        });
    });
}

function flatpickrRangeIndo() {
    $(".flatpickr-range").each(function () {
        let lamaInput = $("#lama");
        let tglSptInput = $("#tgl_spt"); // Ambil elemen tgl_spt

        function getMinDate() {
            let tglSptVal = tglSptInput.val();
            return tglSptVal ? tglSptVal : "today"; // Gunakan tgl_spt atau today
        }

        function getMaxDate() {
            let tglSptVal = tglSptInput.val();
            if (!tglSptVal) return null;

            let minDate = new Date(tglSptVal);
            let maxDate = new Date(minDate);
            maxDate.setDate(minDate.getDate() + 5); // Maksimal 5 hari dari tgl_spt
            return maxDate;
        }

        // Inisialisasi Flatpickr dengan minDate dan maxDate dari tgl_spt
        let instance = $(this).flatpickr({
            mode: "range",
            monthSelectorType: "dropdown",
            minDate: getMinDate(),
            maxDate: getMaxDate(),
            locale: "id",
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "j F Y",
            onChange: function (selectedDates) {
                if (selectedDates.length === 2) {
                    const startDate = selectedDates[0];
                    const endDate = selectedDates[1];

                    if (!isNaN(startDate) && !isNaN(endDate)) {
                        const timeDiff = (endDate - startDate) / (1000 * 3600 * 24);
                        const daysDiff = timeDiff + 1; // Hitungan inklusif

                        // Jika lebih dari 5 hari, tampilkan notifikasi dan reset input
                        if (daysDiff > 5) {
                            alert("Perjalanan dinas tidak boleh lebih dari 5 hari!");
                            instance.clear();
                            lamaInput.val("");
                            $(".flatpickr-range").css("border", "1px solid red"); // Opsi B: Ubah warna merah
                            return;
                        } else {
                            $(".flatpickr-range").css("border", "1px solid #ced4da"); // Reset warna jika valid
                        }

                        lamaInput.val(daysDiff + " (" + numberToWords(daysDiff) + ") Hari");
                    }
                } else {
                    lamaInput.val("");
                }
            },
        });

        // Perbarui minDate dan maxDate SETELAH tgl_spt berubah
        tglSptInput.on("change", function () {
            let minDate = getMinDate();
            let maxDate = getMaxDate();
            instance.set("minDate", minDate); // Perbarui minDate di Flatpickr
            instance.set("maxDate", maxDate); // Perbarui maxDate agar maksimal 5 hari
            instance.clear(); // Reset tanggal jika minDate berubah
        });
    });
}

function numberToWords(number) {
    const words = [
        "nol",
        "satu",
        "dua",
        "tiga",
        "empat",
        "lima",
        "enam",
        "tujuh",
        "delapan",
        "sembilan",
        "sepuluh",
    ];
    return number <= 10 ? words[number] : number;
}

function formatTanggalIndo(dateStr) {
    let date = new Date(dateStr);
    let options = { day: "numeric", month: "long", year: "numeric" };
    return date.toLocaleDateString("id-ID", options); // Format tanggal ke 2 Februari 2025
}

function dropdownInit() {
    const instansiDropdown = document.getElementById("instansi_anggaran");
    const subKegiatanDropdown = document.getElementById("subkegiatan_id");

    if (instansiDropdown && subKegiatanDropdown) {
        instansiDropdown.addEventListener("change", function () {
            const selectedInstansi = this.value;

            // Kosongkan Sub Kegiatan Dropdown
            subKegiatanDropdown.innerHTML =
                '<option value="" disabled selected>Silahkan pilih Sub Kegiatan</option>';
            subKegiatanDropdown.disabled = true;

            // Ambil semua opsi sub kegiatan
            const subKegiatanOptions = Array.from(
                subKegiatanDropdown.querySelectorAll("option[data-instansi]")
            );

            // Filter opsi berdasarkan instansi
            subKegiatanOptions.forEach((option) => {
                if (option.getAttribute("data-instansi") === selectedInstansi) {
                    subKegiatanDropdown.appendChild(option);
                }
            });

            subKegiatanDropdown.disabled =
                subKegiatanDropdown.children.length <= 1; // Nonaktifkan jika kosong
        });
    }
}

function nodinFormInit() {
    $("#nodin_id").on("change", function () {
        let selectedOption = $("#nodin_id option:selected"); // Ambil option yang dipilih
        let selectedNodin = selectedOption.val();

        if (!selectedNodin) {
            // Kosongkan form jika tidak ada pilihan
            $("#tgl_nodin, #kepada, #dari, #perihal").val("");
            return;
        }

        // Ambil data dari atribut data-*
        let tglNodin = selectedOption.data("tgl");
        let kepada = selectedOption.data("kepada");
        let dari = selectedOption.data("dari");
        let perihal = selectedOption.data("perihal");

        // Ubah format tanggal
        let formattedTglNodin = formatTanggalIndo(tglNodin);

        // Masukkan data ke dalam form
        $("#tgl_nodin").val(formattedTglNodin);
        $("#kepada").val(kepada);
        $("#dari").val(dari);
        $("#perihal").val(perihal);
    });
}