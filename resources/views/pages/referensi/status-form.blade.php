<x-form.modal title="{!! isset($data->id) ? 'Edit Status Layanan' : 'Tambah Status Layanan' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-12">
            <x-form.input name="status" value="{{ $data->lokasi }}" label="Status Pelayanan"
                placeholder="Dalam Pelayanan" />
        </div>
    </div>
</x-form.modal>
