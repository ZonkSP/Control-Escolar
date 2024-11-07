@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenido') }}</div>
                @if(Auth::check())
                    @php $user = Auth::user(); @endphp
                    @if($user->role === 'Administrador')
                    <a href="{{ url('/admin') }}" class="w-full bg-[#FF2D20] text-black rounded-md px-4 py-2 text-lg text-center transition hover:bg-[#e63946] focus:outline-none focus-visible:ring">
                        ← Clic para ir al Dashboard Admin →
                    </a>
                    @elseif($user->role === 'Alumno')
                    <a href="{{ url('/alumno') }}" class="w-full bg-[#FF2D20] text-black rounded-md px-4 py-2 text-lg text-center transition hover:bg-[#e63946] focus:outline-none focus-visible:ring">
                        ← Clic para ir al Dashboard Alumno →
                    </a>
                    @elseif($user->role === 'Profesor')
                    <a href="{{ url('/profesor') }}" class="w-full bg-[#FF2D20] text-black rounded-md px-4 py-2 text-lg text-center transition hover:bg-[#e63946] focus:outline-none focus-visible:ring">
                        ← Clic para ir al Dashboard Profesor →
                    </a>
                    @endif
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
   


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
