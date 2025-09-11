@foreach ($menus as $mm)
    <tr>
        <td>{{ $mm->name }}</td>
        <td>
            @foreach ($mm->permissions as $permission)
                <label class="switch" for="permission-{{ $mm->id . '-' . $permission->id }}">
                    <input type="checkbox" name="permissions[]" @checked($data->hasPermissionTo($permission->name)) class="switch-input"
                        value="{{ $permission->name }}" id="permission-{{ $mm->id . '-' . $permission->id }}" />
                    <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                    </span>
                    <span class="switch-label">{{ explode(' ', $permission->name)[0] }}</span>
                </label>
            @endforeach
        </td>
    </tr>
    @foreach ($mm->subMenus as $sm)
        <tr>
            <td><x-form.checkbox id="parent{{ $mm->id.$sm->id }}" label="{{ $sm->name }}" class="parent" /></td>
            <td>
                @foreach ($sm->permissions as $permission)
                    <label class="switch" for="permission-{{ $sm->id.'-'.$permission->id }}">
                        <input class="switch-input child" type="checkbox" name="permissions[]" @checked($data->hasPermissionTo($permission->name)) 
                            value="{{ $permission->name }}" id="permission-{{ $sm->id . '-' . $permission->id }}" />
                        <span class="switch-toggle-slider">
                            <span class="switch-on"></span>
                            <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">{{ explode(' ', $permission->name)[0] }}</span>
                    </label>
                @endforeach
            </td>
        </tr>
    @endforeach
@endforeach
