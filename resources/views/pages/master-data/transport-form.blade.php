<x-form.modal size="sm" title="{!! isset($data->id) ? 'Edit Transportasi' : 'Tambah Transportasi' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-12">
            <x-form.input name="jenis_transportasi" value="{{ $data->jenis_transportasi }}" label="Jenis Transportasi" placeholder="Pesawat Udara" />
        </div>
    </div>
</x-form.modal>
