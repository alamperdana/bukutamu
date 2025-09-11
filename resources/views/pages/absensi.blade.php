@extends('layouts.app', ['title' => 'Buku Tamu Pelayanan'])
@push('cssLibrary')
    <link href="{{ asset('assets/vendor/libs/select2/select2.css') }}" rel="stylesheet" />
@endpush
@push('jsLibrary')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endpush
@section('content')
    <!-- Content -->
    <div class="main-content container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Layanan /</span>Buku Tamu</h4>

        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Buku Tamu Pelayanan</h5>
                {{-- <div class="d-flex gap-1" style="width: 60%;">
                    @can('create referensi/status')
                        <a class="btn btn-primary action" href="{{ route('referensi.status.create') }}">
                            <span class="tf-icons ti-xs ti ti-plus me-2"></span>Tambah Status
                        </a>
                    @endcan
                </div> --}}
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
        const datatable = 'absensi-table'

        handleAction(datatable, function(res) {
            select2Init()
        })
        handleDelete(datatable)
    </script>
@endpush
