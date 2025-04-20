@extends('layouts.app', ['title' => 'Eselon'])

@section('content')
    <!-- Content -->
    <div class="main-content container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Eselon</h4>

        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">Eselon</h5>
                <div class="d-flex gap-1">
                    @can('create master-data/eselon')
                        <a class="btn btn-primary action" href="{{ route('master-data.eselon.create') }}">
                            <span class="tf-icons ti-xs ti ti-plus me-2"></span>Tambah Eselon
                        </a>
                        <a class="btn btn-secondary action" href="{{ route('master-data.eselon.archive') }}">
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
        const datatable = 'eselon-table'

        handleAction(datatable)
        handleDelete(datatable)
    </script>
@endpush
