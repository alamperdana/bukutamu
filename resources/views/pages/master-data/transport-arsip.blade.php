<x-form.modal title="Arsip Transport" action="{{ $action ?? null }}">

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Jenis Transportasi</th>
                        <th>Deleted at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($archivedTransport as $transport)
                        <tr>
                            <td>{{ $transport->jenis_transportasi }}</td>
                            <td>{{ $transport->deleted_at ? $transport->deleted_at->diffForHumans() : '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('master-data.transport.restore', ['id' => $transport->id]) }}"
                                        class="btn btn-sm btn-warning action me-1" data-id="{{ $transport->id }}"
                                        data-method="post" data-action-type="restore" title="Restore Arsip">
                                        <span class="tf-icons ti-xs ti ti-arrow-back-up"></span>
                                    </a>
                                    <a href="{{ route('master-data.transport.forceDelete', ['id' => $transport->id]) }}"
                                        class="btn btn-sm btn-danger action me-1" data-id="{{ $transport->id }}"
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
