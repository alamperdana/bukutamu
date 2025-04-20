<x-form.modal title="{!! isset($data->id) ? 'Edit Sub Kegiatan' : 'Tambah Sub Kegiatan' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="instansi_anggaran" class="form-label">Instansi Pembeban Anggaran</label>
                <select id="instansi_anggaran" class="select2 form-select" name="instansi_anggaran"
                    placeholder="Silahkan pilih Instansi Pembeban Anggaran">
                    <option></option>
                    @foreach ($satkers as $satker)
                        <option value="{{ $satker->kode_satker }}" @selected(old('instansi_anggaran', $data->instansi_anggaran) == $satker->kode_satker)>
                            {{ $satker->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <x-form.input name="kode_subkegiatan" value="{{ $data->kode_subkegiatan }}" label="Kode SubKegiatan" placeholder="4.01.03.2.03.0003"/>
        </div>
        <div class="col-md-9">
            <x-form.input name="subkegiatan" value="{{ $data->subkegiatan }}" label="SubKegiatan" placeholder="Pembinaan dan Advokasi Pengadaan Barang dan Jasa" />
        </div>
    </div>
</x-form.modal>
