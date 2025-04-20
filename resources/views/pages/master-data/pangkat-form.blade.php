<x-form.modal title="{!! isset($data->id) ? 'Edit Pangkat & Golongan' : 'Tambah Pangkat & Golongan' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-12">
            <x-form.input name="pangkat" value="{{ $data->pangkat }}" label="Pangkat" placeholder="Ahli Pertama" />
        </div>
        <div class="col-md-6">
            <x-form.input name="golongan" value="{{ $data->golongan }}" label="Golongan" placeholder="IX" />
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="jenis" class="form-label">ASN</label>
                <select id="pnsyes" name="pnsyes" class="select2 form-select">
                    <option value="1" @selected($data->pnsyes == 1)>PNS</option>
                    <option value="0" @selected($data->pnsyes == 0)>PPPK</option>
                </select>
            </div>
        </div>
    </div>
</x-form.modal>
