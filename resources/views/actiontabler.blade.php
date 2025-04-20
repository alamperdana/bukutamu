<a class="btn btn-sm btn-danger rounded-pill btn-icon open-pdf-modal" href="#"
    data-id="{{ $row->id }}" title="Lihat Nota Dinas">
    <i class="ti ti-file-type-pdf" style="font-size: 24px;"></i>
</a>

<div class="btn-group">
    <button type="button" class="btn btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i class="ti ti-dots-vertical"></i>
    </button>
    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item edit"
                href="{{ route('nota.nodin.edit', $row->id) }}" data-id="{{ $row->id }}" title="Edit Nota Dinas">Edit
            </a>
            <a class="dropdown-item delete"
                href="{{ route('nota.nodin.destroy', $row->id) }}" data-id="{{ $row->id }}"
                title="Hapus Nota Dinas" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus
            </a>
        </li>
    </ul>
</div>