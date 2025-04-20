<x-form.modal title="{!! isset($data->id) ? 'Edit Rekening Belanja' : 'Tambah Rekening Belanja' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="subkegiatan_id" class="form-label">Sub Kegiatan</label>
                <select id="subkegiatan_id" class="form-select" name="subkegiatan_id">
                    <option value="" disabled selected>Silahkan pilih Sub Kegiatan</option>
                    @foreach ($subkegiatans as $subkegiatan)
                        <option value="{{ $subkegiatan->id }}" @selected(old('subkegiatan_id', $data->subkegiatan_id) == $subkegiatan->id)>
                            {{ $subkegiatan->subkegiatan }}
                        </option>
                    @endforeach
                </select>
            </div>
            </div>
        <div class="col-md-3">
            <x-form.input name="kode_belanja" value="{{ $data->kode_belanja }}" label="Kode Belanja" placeholder="5.1.02.04.01.0001" />
        </div>
        <div class="col-md-9">
            <x-form.input name="rekening_belanja" value="{{ $data->rekening_belanja }}" label="Rekening Belanja" placeholder="Belanja Perjalanan Dinas Biasa" />
        </div>
        </div>
</x-form.modal>
