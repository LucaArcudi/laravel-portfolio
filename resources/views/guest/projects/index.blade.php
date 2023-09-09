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
                    <p class="card-text">{{ $project->description }}</p>
                </div>
            </div> 
        </div>
    @empty
        <p>
            There are no projects to show, <a href="{{ route('login') }}" class="text-black">login</a> to add a new project or <a href="{{ route('register') }}" class="text-black">register.</a>
        </p>
    @endforelse       
</div>
@endsection