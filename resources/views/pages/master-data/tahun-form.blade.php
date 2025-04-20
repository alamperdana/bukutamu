<x-form.modal size="sm" title="{!! isset($data->id) ? 'Edit Tahun Anggaran' : 'Tambah Tahun Anggaran' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-12">
            <x-form.input name="tahun" value="{{ $data->tahun }}" label="Tahun Anggaran" placeholder="2025" />
        </div>
    </div>
</x-form.modal>
