<x-form.modal title="{!! isset($data->id) ? 'Edit Role' : 'Tambah Role' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-form.input name="name" value="{{ $data->name }}" label="Name" placeholder="Operator" />
        </div>
        <div class="col-md-6">
            <x-form.input name="guard_name" value="{{ $data->guard_name }}" label="Guard" />
        </div>
    </div>
</x-form.modal>
