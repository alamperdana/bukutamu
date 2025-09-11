<x-form.modal title="{!! isset($data->id) ? 'Edit Daftar Layanan' : 'Tambah Daftar Layanan' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-12">
            <x-form.input name="layanan" value="{{ $data->layanan }}" label="Jenis Layanan"
                placeholder="Pendaftaran dan Verifikasi Akun SPSE" />
        </div>
    </div>
</x-form.modal>
