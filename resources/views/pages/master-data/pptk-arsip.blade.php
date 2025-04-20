<x-form.modal size="xl" title="Arsip PPTK" action="{{ $action ?? null }}">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>NIP</th>
                        <th>Pangkat</th>
                        <th>Jabatan</th>
                        <th>Delete At</th>
                        @if (auth()->user()->hasRole('super admin'))
                            <!-- Cek jika user memiliki role super-admin -->
                            <th>UserInput</th>
                        @endif
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($archivedPptk as $pptk)
                        <tr>
                            <td>{{ $pptk->nama_lengkap }}</td>
                            <td>{{ $pptk->nip }}</td>
                            <td>{{ $pptk->pangkat->pangkat . ' (' . $pptk->pangkat->golongan . ')' }}</td>
                            <td>{{ $pptk->jabatan }}</td>
                            <td>{{ $pptk->deleted_at ? $pptk->deleted_at->diffForHumans() : '-' }}</td>
                            @if (auth()->user()->hasRole('super admin'))
                                <td>
                                    @php
                                        $session_input = json_decode($pptk->session_input, true);
                                        $username = $session_input['username'] ?? 'Super Admin';
                                    @endphp
                                    {{ $username }}
                                </td>
                            @endif
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('master-data.pptk.restore', ['id' => $pptk->id]) }}"
                                        class="btn btn-sm btn-warning action me-1" data-id="{{ $pptk->id }}"
                                        data-method="post" data-action-type="restore" title="Restore Arsip">
                                        <span class="tf-icons ti-xs ti ti-arrow-back-up"></span>
                                    </a>
                                    <a href="{{ route('master-data.pptk.forceDelete', ['id' => $pptk->id]) }}"
                                        class="btn btn-sm btn-danger action me-1" data-id="{{ $pptk->id }}"
                                        data-method="delete" data-action-type="force-delete" title="Delete Permanent">
                                        <span class="tf-icons ti-xs ti ti-trash"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->hasRole('super admin') ? 7 : 6 }}" class="text-center">
                                Tidak ada data arsip tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-form.modal>
