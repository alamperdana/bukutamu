<x-form.modal size="xl" title="Arsip Bendahara Pengeluaran" action="{{ $action ?? null }}">
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
                    @forelse ($archivedBendahara as $bendahara)
                        <tr>
                            <td>{{ $bendahara->nama_lengkap }}</td>
                            <td>{{ $bendahara->nip }}</td>
                            <td>{{ $bendahara->pangkat->pangkat . ' (' . $bendahara->pangkat->golongan . ')' }}</td>
                            <td>{{ $bendahara->jabatan }}</td>
                            <td>{{ $bendahara->deleted_at ? $bendahara->deleted_at->diffForHumans() : '-' }}</td>
                            @if (auth()->user()->hasRole('super admin'))
                                <td>
                                    @php
                                        $session_input = json_decode($bendahara->session_input, true);
                                        $username = $session_input['username'] ?? 'Super Admin';
                                    @endphp
                                    {{ $username }}
                                </td>
                            @endif
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('master-data.bendahara.restore', ['id' => $bendahara->id]) }}"
                                        class="btn btn-sm btn-warning action me-1" data-id="{{ $bendahara->id }}"
                                        data-method="post" data-action-type="restore" title="Restore Arsip">
                                        <span class="tf-icons ti-xs ti ti-arrow-back-up"></span>
                                    </a>
                                    <a href="{{ route('master-data.bendahara.forceDelete', ['id' => $bendahara->id]) }}"
                                        class="btn btn-sm btn-danger action me-1" data-id="{{ $bendahara->id }}"
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
