<x-form.modal title="{!! isset($data->id) ? 'Edit Satuan Kerja' : 'Tambah Satuan Kerja' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-form.input name="kode_satker" value="{{ $data->kode_satker }}" label="Kode Satker" placeholder="4.01.0.00.0.00.01.0000" />
        </div>
        <div class="col-md-6">
            <x-form.input name="name" value="{{ $data->name }}" label="Satuan Kerja" placeholder="Sekretariat Daerah Kota Jambi" />
        </div>
    </div>
</x-form.modal>
