<x-form.modal title="{!! isset($data->id) ? 'Edit Lokasi Layanan' : 'Tambah Lokasi Layanan' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-12">
            <x-form.input name="lokasi_layanan" value="{{ $data->lokasi }}" label="Lokasi Pelayanan"
                placeholder="Mal Pelayanan Publik Kota Jambi" />
        </div>
    </div>
</x-form.modal>
