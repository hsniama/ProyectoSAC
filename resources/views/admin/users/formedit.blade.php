<form method="POST" action="{{ route('admin.users.update', $user->id) }}"  role="form" enctype="multipart/form-data">
    @csrf
    @method('PUT')

<div class="box box-info padding-1">

    <div class="box-body">

        <div class="form-group">
            <label for="email" class="required">Correo</label>
            <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" 
                autofocus placeholder="Ingrese el Email del nuevo usuario" 
                value="{{ old('email', $user->email) }}">
            @if ($errors->has('email'))
                <span class="text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>


        <div class="form-group">
            <label for="username" class="required">Username</label>
            <input type="text" name="username" id="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : ''}}" 
                placeholder="Ingres el nuevo Username" 
                value="{{ old('username', $user->username) }}">
            @if ($errors->has('username'))
                <span class="text-danger">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="password" class="required">Contraseña </label>
            <input type="password" name="password" id="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" 
                placeholder="Ingrese la contraseña del usuario">
            @if ($errors->has('password'))
                <span class="text-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="password-confirmation" class="required">Repita la Contraseña </label>
            <input type="password" name="password_confirmation" id="password-confirmation" 
                class="form-control" placeholder="Repita la contraseña del usuario">
        </div>
    
    </div>


    <div class="row">
        <div class="col-12 text-right">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-fw fa-lg fa-check-circle"></i>
                Actualizar Usuario
            </button>
        </div>
    </div>


</div>
</form>

