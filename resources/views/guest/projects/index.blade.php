@extends('layouts.app')

@section('title', config('app.name').' - Welcome')

@section('content')
<div class="container">
    @forelse ($projects as $project)
        <div class="row text-center mb-5">
            <div class="card col">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->title }}</h5>
                    @if ($project->isImageAValidUrl())
                        <img src="{{ $project->image }}" alt="{{ $project->title }} image" class="img-fluid w-25">
                    @else
                        <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }} image" class="img-fluid w-25">
                    @endif
                    <h6 class="card-subtitle">{{ $project->technologies }}</h6>
                    <p class="card-text">{{ $project->description }}</p>
                    <p class="card-text">{{ $project->date }}</p>
                </div>
            </div> 
        </div>
    @empty
        <p>
            Non ci sono progetti da mostrare, <a href="{{ route('login') }}">accedi per aggiungere un nuovo progetto</a> o <a href="{{ route('register') }}">registrati</a>
        </p>
    @endforelse    
    {{ $projects->links() }}    
</div>
@endsection