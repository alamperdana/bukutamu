<x-form.modal title="{!! isset($data->id) ? 'Edit PA/KPA' : 'Tambah PA/KPA' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-9">
            <x-form.input name="nama_lengkap" value="{{ $data->nama_lengkap }}" label="Nama Lengkap"
                placeholder="John Doe, S.Kom" />
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="payes" class="form-label">Status</label>
                <select id="payes" class="select2" name="payes" placeholder="Silahkan pilih Status">
                    <option></option>
                    <option value="1" @selected(old('payes', $data->payes) == 1)>PA</option>
                    <option value="0" @selected(old('payes', $data->payes) == 0)>KPA</option>
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <x-form.input name="nip" value="{{ $data->nip }}" label="NIP" placeholder="198012122006011001" />
        </div>
        <div class="col-md-7">
            <div class="mb-3">
                <label for="pangkat_id" class="form-label">Pangkat/Golongan</label>
                <select id="pangkat_id" class="select2 form-select" name="pangkat_id"
                    placeholder="Silahkan pilih Pangkat dan Golongan">
                    <option></option>
                    @foreach ($pangkat as $pangkat)
                        <option value="{{ $pangkat->id }}" @selected(old('pangkat_id', $data->pangkat_id) == $pangkat->id)>
                            {{ $pangkat->pangkat }} ({{ $pangkat->golongan }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <x-form.input name="jabatan" value="{{ $data->jabatan }}" label="Jabatan"
                placeholder="Sekretaris Daerah Kota Jambi" />
        </div>
    </div>
</x-form.modal>
