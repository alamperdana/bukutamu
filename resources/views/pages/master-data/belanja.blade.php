@extends('layouts.app', ['title' => 'Rekening Belanja'])
@push('cssLibrary')
    <link href="{{ asset('assets/vendor/libs/select2/select2.css') }}" rel="stylesheet" />
@endpush
@push('jsLibrary')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
@endpush
@section('content')
    <!-- Content -->
    <div class="main-content container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Rekening Belanja</h4>

        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Daftar Rekening Belanja</h5>
                <div class="d-flex gap-1">
                    @can('create master-data/rekening')
                        <a class="btn btn-primary action" href="{{ route('master-data.rekening.create') }}">
                            <span class="tf-icons ti-xs ti ti-plus me-2"></span>Tambah Rekening Belanja
                        </a>
                        <a class="btn btn-secondary action" href="{{ route('master-data.rekening.archive') }}">
                            <span class="tf-icons ti-xs ti ti-archive me-2"></span>Arsip
                        </a>
                    @endcan
                </div>
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
        const datatable = 'belanja-table'
        var paguItems = @json($paguItems ?? []);

        handleAction(datatable, function(res) {
            dropdownInit();
        })
        paguInit()
        handleDelete(datatable)
    </script>
@endpush
