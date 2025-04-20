@extends('layouts.app', ['title' => 'User'])

@section('content')
    <!-- Content -->
    <div class="main-content container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Konfigurasi /</span> Akses User</h4>

        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Ajax Sourced Server-side</h5>
            </div>
            <div class="card-body">
                <div class="card-datatable text-nowrap">
                    <div class="table-responsive">
                        <table class="datatables-ajax table">
                            {!! $dataTable->table() !!}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- / Content -->
@endsection

@push('js')
    {!! $dataTable->scripts() !!}

    <script>
        const datatable = 'user-table'

        function handleCheckMenu() {
            $('.parent').on('click', function() {
                const childs = $(this).parents('tr').find('.child')
                childs.prop('checked', this.checked) 
            })

            $('.child').on('click', function() {
                const parent = $(this).parents('tr')
                const childs = parent.find('.child')
                const checked = parent.find('.child:checked')

                parent.find('.parent').prop('checked', childs.length == checked.length)
            })

            $('.parent').each(function() {
                const parent = $(this).parents('tr')
                const childs = parent.find('.child')
                const checked = parent.find('.child:checked')

                parent.find('.parent').prop('checked', childs.length == checked.length)
            })
        }

        handleAction(datatable, function() {
            handleCheckMenu()
            $('.search').on('keyup', function() {
                const value = this.value.toLowerCase()
                $('#menu_permissions tr').show().filter(function(i, item) {
                    return item.innerText.toLowerCase().indexOf(value) == '-1'
                }).hide()
            })

            $('.copy').on('change', function() {
                handleAjax(`{{ url('konfigurasi/akses-user') }}/${this.value}/user`)
                .onSuccess(function(res) {
                    $('#menu_permissions').html(res)
                    handleCheckMenu()
                }, false)
                .execute()
            })
        })
        handleDelete(datatable)
    </script>
@endpush
