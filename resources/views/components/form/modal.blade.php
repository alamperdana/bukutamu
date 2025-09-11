@props(['size' => 'lg', 'title', 'action' => null ])
<div class="modal-dialog modal-{{ $size }}">
    <form id="form_action" {{ $attributes->merge(['class' => 'modal-content']) }} action="{{ $action }}" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">{{ $title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
            @if ($action)
                <button type="submit" class="btn btn-primary">Simpan</button>
            @endif
        </div>
    </form>
</div>