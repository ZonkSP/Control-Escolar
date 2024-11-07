@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Administrador</h1>

    <!-- Success message for Readers -->
    @if (session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
    @endif
</div>

<div class="container mt-4">
    <div class="row justify-content-center">
        <!-- Form Section -->
        <div class="col-md-5 mb-4">
            <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.create') }}" method="POST" class="p-4 bg-white rounded shadow-sm border">
                @csrf
                @if(isset($user))
                @method('PUT') <!-- Add the PUT method for updating -->
                <h2 class="text-center mb-4">Editar Usuario</h2>
                @else
                <h2 class="text-center mb-4">Crear Usuario</h2>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ isset($user) ? $user->name : old('name') }}" required class="form-control" placeholder="Ingresa el nombre">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" id="email" value="{{ isset($user) ? $user->email : old('email') }}" required class="form-control" placeholder="Ingresa el correo electrónico">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Ingresa la contraseña">
                    @if(isset($user))
                    <small class="text-muted">Deja en blanco si no deseas cambiar la contraseña</small>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Rol</label>
                    <select name="role" id="role" required class="form-select">
                        <option value="Administrador" {{ isset($user) && $user->role == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        <option value="Alumno" {{ isset($user) && $user->role == 'Alumno' ? 'selected' : '' }}>Alumno</option>
                        <option value="Profesor" {{ isset($user) && $user->role == 'Profesor' ? 'selected' : '' }}>Profesor</option>

                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    {{ isset($user) ? 'Actualizar Usuario' : 'Crear Usuario' }}
                </button>
            </form>
        </div>

        <!-- Table Section -->
        <div class="col-md-7 mb-4">
            <div class="bg-white rounded shadow-sm p-4 border">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Correo Electrónico</th>
                                <th class="text-center">Rol</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->role }}</td>
                                <td class="text-center">
                                    <!-- Trigger Modal for Editing -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">Editar</button>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for editing a user -->
    @foreach ($users as $user)
    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit User Form -->
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña (Deja vacío si no deseas cambiarla)</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <select name="role" id="role" required class="form-select">
                                <option value="Administrador" {{ $user->role == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                <option value="Alumno" {{ $user->role == 'Alumno' ? 'selected' : '' }}>Alumno</option>
                                <option value="Profesor" {{ $user->role == 'Profesor' ? 'selected' : '' }}>Profesor</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach



    <div class="container mt-4">
        <div class="row justify-content-center">
            <!-- Form Section -->
            <div class="col-md-5 mb-4">
                <form action="{{ isset($materia) ? route('materias.update', $materia->id) : route('materias.create') }}" method="POST" class="p-4 bg-white rounded shadow-sm border">
                    @csrf
                    @if(isset($materia))
                    @method('PUT')
                    <h2 class="text-center mb-4">Editar Materia</h2>
                    @else
                    <h2 class="text-center mb-4">Agregar Materia</h2>
                    @endif

                    <div class="mb-3">
                        <label for="clave" class="form-label">Clave</label>
                        <input type="text" name="clave" id="clave" value="{{ isset($materia) ? $materia->clave : old('clave') }}" required class="form-control" placeholder="Ingresa la clave">
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ isset($materia) ? $materia->nombre : old('nombre') }}" required class="form-control" placeholder="Ingresa el nombre">
                    </div>

                    <div class="mb-3">
                        <label for="creditos" class="form-label">Créditos</label>
                        <input type="number" name="creditos" id="creditos" value="{{ isset($materia) ? $materia->creditos : old('creditos') }}" required class="form-control" placeholder="Ingresa los créditos">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        {{ isset($materia) ? 'Actualizar Materia' : 'Agregar Materia' }}
                    </button>
                </form>
            </div>

            <!-- Table Section -->
            <div class="col-md-7 mb-4">
                <div class="bg-white rounded shadow-sm p-4 border">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Clave</th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Créditos</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materias as $materia)
                                <tr>
                                    <td class="text-center">{{ $materia->clave }}</td>
                                    <td class="text-center">{{ $materia->nombre }}</td>
                                    <td class="text-center">{{ $materia->creditos }}</td>
                                    <td class="text-center">
                                        <!-- Trigger Modal for Editing -->
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMateriaModal{{ $materia->id }}">Editar</button>

                                        <form action="{{ route('materias.destroy', $materia->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for editing a materia -->
        @foreach ($materias as $materia)
        <div class="modal fade" id="editMateriaModal{{ $materia->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $materia->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $materia->id }}">Editar Materia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Edit Materia Form -->
                        <form action="{{ route('materias.update', $materia->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="clave" class="form-label">Clave</label>
                                <input type="text" name="clave" id="clave" value="{{ old('clave', $materia->clave) }}" required class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $materia->nombre) }}" required class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="creditos" class="form-label">Créditos</label>
                                <input type="number" name="creditos" id="creditos" value="{{ old('creditos', $materia->creditos) }}" required class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Actualizar Materia</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="container mt-4">
            <div class="row justify-content-center">
                <!-- Form Section -->
                <div class="col-md-5 mb-4">
                    <form action="{{ isset($grupo) ? route('grupos.update', $grupo->id) : route('grupos.create') }}" method="POST" class="p-4 bg-white rounded shadow-sm border">
                        @csrf
                        @if(isset($grupo))
                        @method('PUT')
                        <h2 class="text-center mb-4">Editar Grupo</h2>
                        @else
                        <h2 class="text-center mb-4">Agregar Grupo</h2>
                        @endif

                        <div class="mb-3">
                            <label for="materia_id" class="form-label">Materia</label>
                            <select name="materia_id" id="materia_id" class="form-control" required>
                                <option value="">Seleccionar Materia</option>
                                @foreach($materias as $materia)
                                <option value="{{ $materia->id }}" {{ isset($grupo) && $grupo->materia_id == $materia->id ? 'selected' : '' }}>
                                    {{ $materia->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="profesor_id" class="form-label">Profesor</label>
                            <select name="profesor_id" id="profesor_id" class="form-control" required>
                                <option value="">Seleccionar Profesor</option>
                                @foreach($profesores as $profesor)
                                <option value="{{ $profesor->id }}" {{ isset($grupo) && $grupo->profesor_id == $profesor->id ? 'selected' : '' }}>
                                    {{ $profesor->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                            <input type="time" name="hora_inicio" id="hora_inicio" value="{{ isset($grupo) ? $grupo->hora_inicio : old('hora_inicio') }}" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="hora_fin" class="form-label">Hora de Fin</label>
                            <input type="time" name="hora_fin" id="hora_fin" value="{{ isset($grupo) ? $grupo->hora_fin : old('hora_fin') }}" required class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            {{ isset($grupo) ? 'Actualizar Grupo' : 'Agregar Grupo' }}
                        </button>
                    </form>
                </div>

                <!-- Table Section -->
                <div class="col-md-7 mb-4">
                    <div class="bg-white rounded shadow-sm p-4 border">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">Materia</th>
                                        <th class="text-center">Profesor</th>
                                        <th class="text-center">Hora de Inicio</th>
                                        <th class="text-center">Hora de Fin</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grupos as $grupo)
                                    <tr>
                                        <td class="text-center">{{ $grupo->materia->nombre }}</td>
                                        <td class="text-center">{{ $grupo->profesor->name }}</td>
                                        <td class="text-center">{{ $grupo->hora_inicio }}</td>
                                        <td class="text-center">{{ $grupo->hora_fin }}</td>
                                        <td class="text-center">
                                            <!-- Trigger Modal for Editing -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editGrupoModal{{ $grupo->id }}">Editar</button>

                                            <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for editing a grupo -->
            @foreach($grupos as $grupo)
            <div class="modal fade" id="editGrupoModal{{ $grupo->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $grupo->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $grupo->id }}">Editar Grupo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit Grupo Form -->
                            <form action="{{ route('grupos.update', $grupo->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="materia_id" class="form-label">Materia</label>
                                    <select name="materia_id" id="materia_id" class="form-control" required>
                                        <option value="">Seleccionar Materia</option>
                                        @foreach($materias as $materia)
                                        <option value="{{ $materia->id }}" {{ $grupo->materia_id == $materia->id ? 'selected' : '' }}>
                                            {{ $materia->nombre }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="profesor_id" class="form-label">Profesor</label>
                                    <select name="profesor_id" id="profesor_id" class="form-control" required>
                                        <option value="">Seleccionar Profesor</option>
                                        @foreach($profesores as $profesor)
                                        <option value="{{ $profesor->id }}" {{ $grupo->profesor_id == $profesor->id ? 'selected' : '' }}>
                                            {{ $profesor->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                                    <input type="time" name="hora_inicio" id="hora_inicio" value="{{ $grupo->hora_inicio }}" required class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="hora_fin" class="form-label">Hora de Fin</label>
                                    <input type="time" name="hora_fin" id="hora_fin" value="{{ $grupo->hora_fin }}" required class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary">Actualizar Grupo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <h2>Solicitudes de Inscripción Pendientes</h2>
        <div class="bg-white rounded shadow-sm p-4 border">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Alumno</th>
                        <th>Grupo</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->Alumno->name }}</td>

                        <td>{{ $request->grupo->materia->nombre }}</td>
                        <td>
                            <form action="{{ route('enrollment.request.approve', $request->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Aprobar</button>
                            </form>
                            <form action="{{ route('enrollment.request.reject', $request->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>


    </div>
    @endsection