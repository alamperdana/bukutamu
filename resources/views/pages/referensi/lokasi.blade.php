@extends('layouts.app', ['title' => 'Daftar Lokasi Pelayanan'])
@push('cssLibrary')
    <link href="{{ asset('assets/vendor/libs/select2/select2.css') }}" rel="stylesheet" />
@endpush
@push('jsLibrary')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endpush
@section('content')
    <!-- Content -->
    <div class="main-content container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Referensi /</span> Lokasi Pelayanan</h4>

        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Daftar Lokasi Pelayanan</h5>
                <div class="d-flex gap-1" style="width: 60%;">
                    @can('create referensi/lokasi')
                        <a class="btn btn-primary action" href="{{ route('referensi.lokasi.create') }}">
                            <span class="tf-icons ti-xs ti ti-plus me-2"></span>Tambah Lokasi
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-body p-2 d-flex gap-3">
                <div class="flex-grow-1 min-w-0" style="width: 60%;">
                    <div class="card-datatable text-nowrap">
                        <div class="table-responsive">
                            <table class="datatables-ajax table">
                                {!! $dataTable->table() !!}
                            </table>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 40%;">
                    <img src="{{ asset('assets/img/cartoon/lokasi.png') }}" class="img-fluid" alt="Gambar Pendamping" style="max-height: 300px;" />
                </div>
            </div>
        </div>
    </div>

    <!-- / Content -->
@endsection

@push('js')
    {!! $dataTable->scripts() !!}

    <script>
        const datatable = 'lokasilayanan-table'

        handleAction(datatable, function(res) {
            select2Init()
        })
        handleDelete(datatable)
    </script>
@endpush
