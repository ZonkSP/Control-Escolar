@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alumno Dashboard</h1>

    <!-- Success message -->
    @if (session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <!-- Table for displaying available groups -->
    <div class="bg-white rounded shadow-sm p-4 border">
        <p>Grupos disponibles</p>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">Materia</th>
                        <th class="text-center">Profesor</th>
                        <th class="text-center">Hora de Inicio</th>
                        <th class="text-center">Hora de Fin</th>
                        <th class="text-center">Acción</th>
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
                            @if(in_array($grupo->id, $pendingRequests))
                            <!-- Si la solicitud está pendiente, mostrar el estado -->
                            <span>Solicitud pendiente</span>
                            @else
                            <!-- Si no existe una solicitud, mostrar el botón de inscripción -->
                            <form action="{{ route('enrollment.request.store', $grupo->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Solicitar inscripción
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <p></p>
    <!-- Table for displaying enrolled groups -->
    <div class="bg-white rounded shadow-sm p-4 border">
        <p>Mis Materias Inscritas</p>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">Materia</th>
                        <th class="text-center">Profesor</th>
                        <th class="text-center">Hora de Inicio</th>
                        <th class="text-center">Hora de Fin</th>
                        <th class="text-center">Calificaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrolledGroups as $grupo)
                    <tr>
                        <td class="text-center">{{ $grupo->materia->nombre }}</td>
                        <td class="text-center">{{ $grupo->profesor->name }}</td>
                        <td class="text-center">{{ $grupo->hora_inicio }}</td>
                        <td class="text-center">{{ $grupo->hora_fin }}</td>
                        <td class="text-center">
                            <!-- Display the calificación for the student in this group -->
                            @php
                            $calificacion = $grupo->calificaciones->firstWhere('alumno_id', Auth::id());
                            @endphp
                            @if($calificacion)
                            {{ $calificacion->calificacion }}
                            @else
                            <span>No disponible</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



</div>
@endsection