<x-form.modal size="xl" title="Arsip Satuan Kerja" action="{{ $action ?? null }}">

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Satuan Kerja</th>
                        <th>Deleted at</th>
                        @if (auth()->user()->hasRole('super admin'))
                            <!-- Cek jika user memiliki role super-admin -->
                            <th>UserInput</th>
                        @endif
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($archivedSatker as $satker)
                        <tr>
                            <div class="d-flex justify-content-start">
                                <td>{{ $satker->kode_satker }} - {{ $satker->name }}</td>
                                <td>{{ $satker->deleted_at ? $satker->deleted_at->diffForHumans() : '-' }}</td>
                                @if (auth()->user()->hasRole('super admin'))
                                    <td>
                                        @php
                                            $session_input = json_decode($satker->session_input, true);
                                            $username = $session_input['username'] ?? 'Super Admin';
                                        @endphp
                                        {{ $username }}
                                    </td>
                                @endif
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <a href="{{ route('master-data.satker.restore', ['id' => $satker->id]) }}"
                                            class="btn btn-sm btn-warning action me-1" data-id="{{ $satker->id }}"
                                            data-method="post" data-action-type="restore" title="Restore Arsip">
                                            <span class="tf-icons ti-xs ti ti-arrow-back-up"></span>
                                        </a>
                                        <a href="{{ route('master-data.satker.forceDelete', ['id' => $satker->id]) }}"
                                            class="btn btn-sm btn-danger action me-1" data-id="{{ $satker->id }}"
                                            data-method="delete" data-action-type="force-delete"
                                            title="Delete Permanent">
                                            <span class="tf-icons ti-xs ti ti-trash"></span>
                                        </a>
                                    </div>
                                </td>
                            </div>
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
