<x-form.modal size="xl" title="Arsip Pegawai" action="{{ $action ?? null }}">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Eselon</th>
                        <th>NIP</th>
                        <th>Pangkat</th>
                        <th>Jabatan</th>
                        <th>Instansi</th>
                        <th>Delete At</th>
                        @if (auth()->user()->hasRole('super admin'))
                            <!-- Cek jika user memiliki role super-admin -->
                            <th>UserInput</th>
                        @endif
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($archivedPegawai as $pegawai)
                        <tr>
                            <td>{{ $pegawai->nama_lengkap }}</td>
                            <td>{{ $pegawai->eselon->nama_eselon ?? '-' }}</td>
                            <td>{{ $pegawai->nip }}</td>
                            <td>{{ $pegawai->pangkat->pangkat }}</td>
                            <td>{{ $pegawai->jabatan }}</td>
                            <td>{{ $pegawai->satker->name }}</td>
                            <td>{{ $pegawai->deleted_at ? $pegawai->deleted_at->diffForHumans() : '-' }}</td>
                            @if (auth()->user()->hasRole('super admin'))
                                <td>
                                    @php
                                        $session_input = json_decode($pegawai->session_input, true);
                                        $username = $session_input['username'] ?? 'Unknown';
                                    @endphp
                                    {{ $username }}
                                </td>
                            @endif
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('master-data.pegawai.restore', ['id' => $pegawai->id]) }}"
                                        class="btn btn-sm btn-warning action me-1" data-id="{{ $pegawai->id }}"
                                        data-method="post" data-action-type="restore">
                                        <span class="tf-icons ti-xs ti ti-arrow-back-up"></span>
                                    </a>
                                    <a href="{{ route('master-data.pegawai.forceDelete', ['id' => $pegawai->id]) }}"
                                        class="btn btn-sm btn-danger action me-1" data-id="{{ $pegawai->id }}"
                                        data-method="delete" data-action-type="force-delete">
                                        <span class="tf-icons ti-xs ti ti-trash"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->hasRole('super admin') ? 9 : 8 }}" class="text-center">
                                Tidak ada data arsip tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-form.modal>
