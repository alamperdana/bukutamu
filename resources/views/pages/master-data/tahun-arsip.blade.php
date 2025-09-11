<x-form.modal title="Arsip Tahun" action="{{ $action ?? null }}">

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Deleted at</th>
                        @if (auth()->user()->hasRole('super admin'))
                            <th>UserInput</th>
                        @endif
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($archivedTahun as $tahun)
                        <tr>
                            <td>{{ $tahun->tahun }}</td>
                            <td>{{ $tahun->deleted_at ? $tahun->deleted_at->diffForHumans() : '-' }}</td>
                            @if (auth()->user()->hasRole('super admin'))
                                <td>
                                    @php
                                        $session_input = json_decode($tahun->session_input, true);
                                        $username = $session_input['username'] ?? 'Super Admin';
                                    @endphp
                                    {{ $username }}
                                </td>
                            @endif
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('master-data.tahun.restore', ['id' => $tahun->id]) }}"
                                        class="btn btn-sm btn-warning action me-1" data-id="{{ $tahun->id }}"
                                        data-method="post" data-action-type="restore" title="Restore Arsip">
                                        <span class="tf-icons ti-xs ti ti-arrow-back-up"></span>
                                    </a>
                                    <a href="{{ route('master-data.tahun.forceDelete', ['id' => $tahun->id]) }}"
                                        class="btn btn-sm btn-danger action me-1" data-id="{{ $tahun->id }}"
                                        data-method="delete" data-action-type="force-delete" title="Delete Permanent">
                                        <span class="tf-icons ti-xs ti ti-trash"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->hasRole('super admin') ? 4 : 3 }}" class="text-center">
                                Tidak ada data arsip tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-form.modal>
