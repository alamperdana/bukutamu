<x-form.modal title="Arsip Eselon" action="{{ $action ?? null }}">

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Transportasi</th>
                        <th>Deleted at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($archivedEselon as $eselon)
                        <tr>
                            <td>{{ $eselon->nama_eselon }}</td>
                            <td>{{ $eselon->deleted_at ? $eselon->deleted_at->diffForHumans() : '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('master-data.eselon.restore', ['id' => $eselon->id]) }}"
                                        class="btn btn-sm btn-warning action me-1" data-id="{{ $eselon->id }}"
                                        data-method="post" data-action-type="restore" title="Restore Arsip">
                                        <span class="tf-icons ti-xs ti ti-arrow-back-up"></span>
                                    </a>
                                    <a href="{{ route('master-data.eselon.forceDelete', ['id' => $eselon->id]) }}"
                                        class="btn btn-sm btn-danger action me-1" data-id="{{ $eselon->id }}"
                                        data-method="delete" data-action-type="force-delete" title="Delete Permanent">
                                        <span class="tf-icons ti-xs ti ti-trash"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                Tidak ada data arsip tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-form.modal>
