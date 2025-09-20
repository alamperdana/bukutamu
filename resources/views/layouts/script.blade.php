<!-- Core JS -->
<!-- build:jsassets/vendor/js/core.js -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('assets/vendor/izitoast/js/iziToast.min.js') }}"></script>

<script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Stack for JavaScript Libraries -->
@stack('jsLibrary')

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    Main.init()
</script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    })

    showLoading()
    $(document).ready(function() {
    showLoading(false)
    })

    function showToast(status = 'success', message) {
    iziToast[status]({
        title: status == 'success' ? 'Success' : 'Error',
        message: message,
        position: 'topRight'
    });
    }

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

    function submitLoader(formId = '#form_action') {
    const button = $(formId).find('button[type="submit"]');

    function show() {
        button.addClass("btn-load")
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

    function handleFormSubmit(selector) {
    function init() {
        const _this = this; // Konteks fungsi
        _this.runDefaultSuccessCallback = true; // Set nilai default
        $(selector).on('submit', function(e) {
            e.preventDefault()
            const _form = this
            $.ajax({
                url:this.action,
                method: this.method,
                data: new FormData(_form),
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $(_form).find('.is-invalid').removeClass('is-invalid')
                    $(_form).find('.invalid-feedback').remove()
                    submitLoader().show()
                },
                success: (res) => {
            
                    if (_this.runDefaultSuccessCallback) {
                        $('#modal_action').modal('hide')
                        showToast(res.status, res.message)
                    }

                    _this.onSuccessCallback && _this.onSuccessCallback(res)
                    _this.dataTableId && window.LaravelDataTables[_this.dataTableId].ajax.reload()
                },
                complete: function() {
                    submitLoader().hide()
                },
                error: function(err) {
                    const errors = err.responseJSON?.errors
                    
                    if (errors) {
                        for (let [key, message] of Object.entries(errors)) {
                            console.log(key, message);
                            $(`[name=${key}]`).addClass('is-invalid')
                            .parent()
                            .append(`<div class="invalid-feedback">${message}</div>`)
                        }
                    }

                    showToast('error', err.responseJSON?.message)
                }
            })
        })

    }

    function onSuccess(cb, runDefault = true) {
        this.onSuccessCallback = cb
        this.runDefaultSuccessCallback = runDefault
        return this
    }

    function setDataTable(id) {
        this.dataTableId = id
        return this
    }

    return {
        init,
        onDefaultSuccessCallback: true,
        onSuccess,
        setDataTable
    }
    }
    function handleAjax(url, method = 'get') {
        function onSuccess(cb, runDefault = true) {
            this.onSuccessCallback = cb
            this.runDefaultSuccessCallback = runDefault
            return this
        }

        function execute() {
            $.ajax({
                url,
                method,
                beforeSend: function() {
                    showLoading()
                },
                complete: function() {
                    showLoading(false)
                },
                success: (res) => {
                    if (this.runDefaultSuccessCallback) {
                        const modal = $('#modal_action')
                        modal.html(res)
                        modal.modal('show')
                    }

                    this.onSuccessCallback && this.onSuccessCallback(res)
                },
                error: function (err) {
                    console.log(err);
                    
                }
            })
        }

        function onError(cb) {
            this.onErrorCallback = cb
            return this
        }

        return {
            execute,
            onSuccess,
            runDefaultSuccessCallback: true
        }
    }

</script>

<!-- Page JS -->
{{-- <script src="{{ asset('assets/js/dashboards-crm.js') }}"></script> --}}
<script src="{{ asset('assets/js/tables-datatables-advanced.js') }}"></script>

<!-- Stack for custom JavaScript per page -->
@stack('js')

