@extends('layouts.app')

@section('title', config('app.name').' - Welcome')

@section('content')
<div class="container">
    @foreach ($projects as $project)
    <div class="row text-center">
            <div class="card col">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->title }}</h5>
                    <h6 class="card-subtitle">{{ $project->technologies }}</h6>
                    <p class="card-text">{{ $project->description }}</p>
                    <p class="card-text">{{ $project->date }}</p>
                </div>
            </div> 
        </div>
        @endforeach        
</div>
@endsection