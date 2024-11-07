@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profesor Dashboard</h1>

    <!-- Mensaje de éxito -->
    @if (session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <p></p>
    <!-- Tabla para mostrar grupos y alumnos -->
    <div class="bg-white rounded shadow-sm p-4 border">
        <h2 class="mb-4">Grupos</h2>
        @if($grupos->isEmpty())
        <p>No tienes grupos asignados.</p>
        @else
        @foreach($grupos as $grupo)

        <!-- Display materia details -->
        @if ($grupo->materia)
        <p><strong>Materia:</strong> {{ $grupo->materia->nombre }}</p>
        @else
        <p><strong>Materia:</strong> No asignada</p>
        @endif

        <p><strong>Hora de inicio:</strong> {{ $grupo->hora_inicio }}</p>
        <p><strong>Hora de fin:</strong> {{ $grupo->hora_fin }}</p>

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th class="text-center">Alumnos</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Calificación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grupo->alumnos as $alumno)
                <tr>
                    <td class="text-center">{{ $alumno->name }}</td>
                    <td class="text-center">{{ $alumno->email }}</td>
                    <td class="text-center">
                        <form action="{{ route('profesor.calificacion.store', [$grupo->id, $alumno->id]) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <input type="text" name="calificacion"
                                value="{{ optional($alumno->calificaciones->firstWhere('grupo_id', $grupo->id))->calificacion }}"
                                class="form-control me-2" placeholder="Ingrese calificación">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
        @endif
    </div>



</div>
@endsection