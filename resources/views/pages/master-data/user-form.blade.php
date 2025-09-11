<x-form.modal title="{!! isset($data->id) ? 'Edit User' : 'Tambah User' !!}" action="{{ $action ?? null }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-7">
            <x-form.input name="name" value="{{ $data->name }}" label="Name" placeholder="John Doe" />
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label for="roles" class="form-label">Roles</label>
                <select id="roles" name="roles[]" class="select2 form-select" multiple>
                    @foreach ($roles as $item)
                        <option value="{{ $item }}" @selected(in_array($item, $data->roles->pluck('name')->toArray()))>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <x-form.input name="username" value="{{ $data->username }}" label="Username" placeholder="johndoe" />
        </div>
        <div class="col-md-6">
            <x-form.input name="email" value="{{ $data->email }}" label="Email" placeholder="john.doe@mail.com" />
        </div>
        @if (request()->routeIs('master-data.users.create'))
            <div class="col-md-6">
                <x-form.input name="password" type="password" value="{{ $data->password }}" label="Password" />
            </div>
            <div class="col-md-6">
                <x-form.input name="password_confirmation" type="password" value="" label="Konfirmasi Password" />
            </div>
        @endif
        @if (request()->routeIs('master-data.users.show'))
            <div class="col-md-6">
                <x-form.input name="last_login" value="{{ $last_login }}" label="Terakhir login" readonly />
            </div>
            <div class="col-md-6">
                <x-form.input name="login_ip" value="{{ $data->login_ip }}" label="IP login terakhir" readonly />
            </div>
        @endif
    </div>
</x-form.modal>
