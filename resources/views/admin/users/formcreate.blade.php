<form method="POST" action="{{ route('admin.users.store') }}" role="form" enctype="multipart/form-data">
    @csrf

    <div class="box box-info padding-1">
        <div class="box-body">

            <div class="form-group">
                <label for="email" class="required">Correo</label>
                <input type="email" name="email" id="email"
                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" autofocus
                    placeholder="Ingrese el Email del nuevo usuario" value="{{ old('email', '') }}">
                @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>


            <div class="form-group">
                <label for="username" class="required">Username</label>
                <input type="text" name="username" id="username"
                    class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                    placeholder="Ingres el nuevo Username" value="{{ old('username', '') }}">
                @if ($errors->has('username'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password" class="required">Contraseña </label>
                <input type="password" name="password" id="password"
                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    placeholder="Ingrese la contraseña del usuario">
                @if ($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="password-confirmation" class="required">Repita la Contraseña </label>
                <input type="password" name="password_confirmation" id="password-confirmation" class="form-control"
                    placeholder="Repita la contraseña del usuario">
            </div>

            {{-- <small id="helpId" class="text-muted">Help text</small> --}}

            {{-- <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small> --}}

            {{-- <label for="password_confirmation">Password Confirmation</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Password Confirmation" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small> --}}



            {{-- <div class="form-group">
        <label for="roles" class="required">Roles</label>
        <select class="form-control {{ $errors->has('roles') ? 'is-invalidad' : '' }}" name="roles[]" id="roles" multiple>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
            <option value="rol 1" @selected(old('')) >Paciente</option>
            <option value="rol 1">Admin</option>
            <option value="rol 1">Secretaria Perra</option>
        </select>
    </div> --}}


            {{-- <div class="form-group">
        <label for="permissions">Permissions</label>
        <select class="form-control" name="permissions[]" id="permissions" multiple>
            @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
            @endforeach 
        </select>
    </div> --}}

            {{-- <label for="persona">Persona</label>
        <select class="form-control" name="persona" id="persona">
            @foreach ($personas as $persona)
                <option value="{{ $persona->id }}">{{ $persona->nombres . ' ' . $persona->apellidos }}</option>
            @endforeach
        </select> --}}

            {{-- 
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" id="avatar" class="form-control" placeholder="Avatar" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small> --}}

            {{-- <div class="form-group">
        <label for="active">Active</label>
        <input type="checkbox" name="active" id="active" class="form-control" placeholder="Active">
    </div> --}}


            {{-- <label for="confirmed">Confirmed</label>
        <input type="checkbox" name="confirmed" id="confirmed" class="form-control" placeholder="Confirmed" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small> --}}

            {{--

        <label for="confirmation_code">Confirmation Code</label>
        <input type="text" name="confirmation_code" id="confirmation_code" class="form-control" placeholder="Confirmation Code" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small>

        <label for="remember_token">Remember Token</label>
        <input type="text" name="remember_token" id="remember_token" class="form-control" placeholder="Remember Token" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small>

        <label for="created_at">Created At</label>
        <input type="text" name="created_at" id="created_at" class="form-control" placeholder="Created At" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small>

        <label for="updated_at">Updated At</label>
        <input type="text" name="updated_at" id="updated_at" class="form-control" placeholder="Updated At" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small>

        <label for="deleted_at">Deleted At</label>
        <input type="text" name="deleted_at" id="deleted_at" class="form-control" placeholder="Deleted At" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small>

        <label for="created_by">Created By</label>
        <input type="text" name="created_by" id="created_by" class="form-control" placeholder="Created By" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small>

        <label for="updated_by">Updated By</label>
        <input type="text" name="updated_by" id="updated_by" class="form-control" placeholder="Updated By" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small>

        <label for="deleted_by">Deleted By</label>
        <input type="text" name="deleted_by" id="deleted_by" class="form-control" placeholder="Deleted By" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small> --}}
        </div>


        <div class="row">
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                    Crear Usuario
                </button>
            </div>
        </div>


    </div>
</form>
