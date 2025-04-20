<x-form.modal title="{!! isset($data->id) ? 'Edit Eselon' : 'Tambah Eselon' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-12">
            <x-form.input name="nama_eselon" value="{{ $data->nama_eselon }}" label="Nama Eselon" placeholder="Eselon I" />
        </div>
    </div>
</x-form.modal>
