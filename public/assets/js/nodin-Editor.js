document.addEventListener("DOMContentLoaded", function () {
    // Inisialisasi TinyMCE
    tinymce.init({
        selector: "textarea.konten",
        height: 300,
        promotion: false,
        license_key: "gpl",
        statusbar: false,
        skin: "oxide",
        plugins: "lists fullscreen pagebreak",
        toolbar: [
            "undo redo | fontfamily fontsize | bold italic underline",
            "alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blocks | pagebreak fullscreen | table link image",
        ],
        content_style:
            "hr.page-break { border: 0; border-top: 2px dashed #999; margin: 20px 0; }",
        setup: function (editor) {
            editor.on("init", function () {
                let isiNodinElement = document.getElementById("isiNodinData");
                let isiNodin = isiNodinElement
                    ? JSON.parse(isiNodinElement.textContent || '""')
                    : "";

                editor.setContent(
                    isiNodin ||
                        `<p>
                    Berdasarkan surat dari OPTIMUS TEKNOLOGI PRO Nomor: 026/SP/OTP/I/2024
                    tanggal 07 Februari 2024 hal undangan rapat "Sosialisasi Penerapan Backup Server
                    untuk pengamanan data serta percepatan pencapaian 17 Standar pada UKPBJ/LPSE Seluruh
                    Kab/Kota di Provinsi Jambi Sesuai dengan Keputusan Deputi Nomor 27 Tahun 2022",
                    di Gedung NDC Moratellindo Kota Denpasar Bali.
                </p>`
                );
            });
        },
    });

    // Inisialisasi Form Wizard
    function formNodinWizard() {
        const wizardValidation = document.querySelector("#wizard-validation");
        if (!wizardValidation) return;

        const wizardValidationForm = wizardValidation.querySelector(
            "#wizard-validation-form"
        );
        const wizardValidationFormStep1 = wizardValidationForm.querySelector(
            "#info-nodin-validation"
        );
        const wizardValidationFormStep2 = wizardValidationForm.querySelector(
            "#detail-nodin-validation"
        );

        const wizardValidationNext = [
            ...wizardValidationForm.querySelectorAll(".btn-next"),
        ];
        const wizardValidationPrev = [
            ...wizardValidationForm.querySelectorAll(".btn-prev"),
        ];
        const wizardValidationSubmit =
            wizardValidationForm.querySelector(".btn-submit");

        const validationStepper = new Stepper(wizardValidation, {
            linear: true,
        });

        const commonValidators = {
            notEmpty: { message: "Isian wajib diisi." },
            stringLength: {
                min: 6,
                max: 255,
                message:
                    "Isian harus lebih dari 6 dan kurang dari 255 karakter.",
            },
            regexp: {
                regexp: /^[a-zA-Z\s/]+$/,
                message: "Isian hanya terdiri dari huruf, spasi, dan tanda /.",
            },
        };

        // Validasi Step 1
        const FormValidation1 = FormValidation.formValidation(
            wizardValidationFormStep1,
            {
                fields: {
                    kepada: { validators: commonValidators },
                    melalui: { validators: commonValidators },
                    dari: { validators: commonValidators },
                    nomor: {
                        validators: {
                            notEmpty: { message: "Nomor Surat wajib diisi" },
                        },
                    },
                    tgl_nodin: {
                        validators: {
                            notEmpty: { message: "Tanggal Surat wajib diisi" },
                        },
                    },
                    sifat: {
                        validators: {
                            notEmpty: { message: "Sifat Surat wajib diisi" },
                        },
                    },
                    lampiran: {
                        validators: {
                            notEmpty: { message: "lampiran Surat wajib diisi" },
                        },
                    },
                    perihal: {
                        validators: {
                            notEmpty: { message: "Perihal Surat wajib diisi" },
                            stringLength: {
                                min: 10,
                                message:
                                    "Perihal harus lebih dari 10 karakter.",
                            },
                        },
                    },
                    pejabat_id: {
                        validators: {
                            notEmpty: {
                                message: "Penandatangan Surat wajib diisi",
                            },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-6, .col-sm-12",
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                },
            }
        ).on("core.form.valid", function () {
            validationStepper.next();
        });

        // Validasi Step 2
        const FormValidation2 = FormValidation.formValidation(
            wizardValidationFormStep2,
            {
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-6, .col-sm-12",
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                },
            }
        );

        // Navigasi antar langkah
        wizardValidationNext.forEach((button) => {
            button.addEventListener("click", () => {
                if (validationStepper._currentIndex === 0) {
                    FormValidation1.validate();
                } else if (validationStepper._currentIndex === 1) {
                    FormValidation2.validate();
                }
            });
        });

        wizardValidationPrev.forEach((button) => {
            button.addEventListener("click", () => {
                validationStepper.previous();
            });
        });

        // Event Submit
        wizardValidationSubmit.addEventListener("click", function (e) {
            e.preventDefault();

            FormValidation1.validate().then((status1) => {
                if (status1 === "Valid") {
                    FormValidation2.validate().then((status2) => {
                        if (status2 === "Valid") {
                            submitForm();
                        }
                    });
                }
            });
        });

        function submitForm() {
            // Pastikan TinyMCE telah diinisialisasi dan mengambil kontennya
            const fullEditorContent = tinymce.get("isi_nodin")
                ? tinymce.get("isi_nodin").getContent()
                : "";

            // Pastikan hidden input ada untuk menyimpan data TinyMCE sebelum dikirim
            let inputHidden = document.querySelector('input[name="isi_nodin"]');
            if (!inputHidden) {
                inputHidden = document.createElement("input");
                inputHidden.setAttribute("type", "hidden");
                inputHidden.setAttribute("name", "isi_nodin");
                wizardValidationForm.appendChild(inputHidden);
            }
            inputHidden.value = fullEditorContent;

            // Buat FormData untuk pengiriman
            const formData = new FormData(wizardValidationForm);

            $.ajax({
                url: wizardValidationForm.action,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    wizardValidationSubmit.disabled = true;
                    wizardValidationSubmit.innerHTML = "Menyimpan...";
                },
                success: function () {
                    window.location.href = "/nota/nodin";
                },
                error: function (err) {
                    wizardValidationSubmit.disabled = false;
                    wizardValidationSubmit.innerHTML = "Submit";

                            const errors = err.responseJSON?.errors;
                            if (errors) {
                                $(".invalid-feedback").remove();
                                $(".is-invalid").removeClass("is-invalid");

                                for (let [key, message] of Object.entries(errors)) {
                                    let inputField = $(`[name=${key}]`);
                                    inputField
                                        .addClass("is-invalid")
                                        .parent()
                                        .append(
                                            `<div class="invalid-feedback">${message}</div>`
                                        );
                                }
                            }
                },
            });
        }
    }

    formNodinWizard();

    $(function () {
        const select2 = $(".select2"),
            selectPicker = $(".selectpicker");

        // Bootstrap select
        if (selectPicker.length) {
            selectPicker.selectpicker();
        }

        // select2
        if (select2.length) {
            select2.each(function () {
                var $this = $(this);
                var placeholderText = $this.attr("placeholder") || "Select value"; // Ambil placeholder dari atribut jika ada
                $this.wrap('<div class="position-relative"></div>');
                $this.select2({
                    placeholder: placeholderText,
                    dropdownParent: $this.parent(),
                    allowClear: $this.data("allow-clear") || false // Gunakan data-allow-clear jika ada
                });
            });
        }
    });
});
