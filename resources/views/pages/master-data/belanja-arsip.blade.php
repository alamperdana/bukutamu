<x-form.modal size="xl" title="Arsip Rekening Belanja" action="{{ $action ?? null }}">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Rekening Belanja</th>
                        <th>Deleted at</th>
                        @if (auth()->user()->hasRole('super admin'))
                            <!-- Cek jika user memiliki role super-admin -->
                            <th>UserInput</th>
                        @endif
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($archivedBelanja as $belanja)
                        <tr>
                            <td>{{ $belanja->rekening_belanja }}</td>
                            <td>{{ $belanja->deleted_at ? $belanja->deleted_at->diffForHumans() : '-' }}</td>
                            @if (auth()->user()->hasRole('super admin'))
                                <td>
                                    @php
                                        // Mendecode JSON yang ada di kolom session_input
                                        $session_input = json_decode($belanja->session_input, true); // Mengubah JSON menjadi array
                                        // Mengambil nilai username dari array jika ada, jika tidak tampilkan 'Unknown'
                                        $username = $session_input['username'] ?? 'Unknown';
                                    @endphp
                                    {{ $username }} <!-- Menampilkan username -->
                                </td>
                            @endif
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('master-data.rekening.restore', ['id' => $belanja->id]) }}"
                                        class="btn btn-sm btn-warning action me-1" data-id="{{ $belanja->id }}"
                                        data-method="post" data-action-type="restore" title="Restore Arsip">
                                        <span class="tf-icons ti-xs ti ti-arrow-back-up"></span>
                                    </a>
                                    <a href="{{ route('master-data.rekening.forceDelete', ['id' => $belanja->id]) }}"
                                        class="btn btn-sm btn-danger action me-1" data-id="{{ $belanja->id }}"
                                        data-method="delete" data-action-type="force-delete" title="Delete Permanent">
                                        <span class="tf-icons ti-xs ti ti-trash"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->hasRole('super admin') ? 5 : 4 }}" class="text-center">Tidak
                                ada data arsip tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-form.modal>
