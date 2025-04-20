<x-form.modal title="{!! isset($data->id) ? 'Edit Pegawai' : 'Tambah Pegawai' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-7">
            <x-form.input name="nama_lengkap" value="{{ $data->nama_lengkap }}" label="Nama Lengkap"
                placeholder="John Doe, S.Kom" />
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label for="eselon_id" class="form-label">Tingkat</label>
                <select id="eselon_id" class="form-select" name="eselon_id" placeholder="Silahkan pilih Eselon">
                    <option></option>
                    @foreach ($eselon as $eselon)
                        <option value="{{ $eselon->id }}" @selected(old('eselon_id', $data->eselon_id) == $eselon->id)>
                            {{ $eselon->nama_eselon }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <x-form.input name="nip" value="{{ $data->nip }}" label="NIP" placeholder="198012122006011001" help="Isikan '-' apabila Non-ASN " />
        </div>
        <div class="col-md-7">
            <div class="mb-3">
                <label for="pangkat_id" class="form-label">Pangkat/Golongan</label>
                <select id="pangkat_id" class="select2 form-select" name="pangkat_id" placeholder="Silahkan pilih Pangkat dan Golongan">
                    <option></option>
                    @foreach ($pangkat as $pangkat)
                        <option value="{{ $pangkat->id }}" @selected(old('pangkat_id', $data->pangkat_id) == $pangkat->id)>
                            {{ $pangkat->pangkat }} @if ($pangkat->id != 34) ({{ $pangkat->golongan }}) @endif
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted mt-1">Pilih Non-ASN apabila Non-ASN</small>
            </div>
        </div>
        <div class="col-md-12">
            <x-form.input name="jabatan" value="{{ $data->jabatan }}" label="Jabatan" placeholder="Sekretaris Daerah Kota Jambi" />
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label for="satker_id" class="form-label">Instansi</label>
                <select id="satker_id" class="select2 form-select" name="satker_id"
                    placeholder="Silahkan pilih Instansi">
                    <option></option> <!-- Placeholder kosong -->
                    @foreach ($satker as $satker)
                        <option value="{{ $satker->id }}" @selected(old('satker_id', $data->satker_id) == $satker->id)>
                            {{ $satker->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</x-form.modal>
