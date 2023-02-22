@extends('layouts.app')

@section('title', config('app.name').' - '.$project->title)

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="alert alert-{{ session('alert-type') }}">
            {{ session('message') }}
        </div>
        <div class="card col">
            
            <div class="card-body">
                <h5 class="card-title">{{ $project->title }}</h5>
                <h6 class="card-subtitle">{{ $project->technologies }}</h6>
                <p class="card-text">{{ $project->description }}</p>
                <p class="card-text">{{ $project->date }}</p>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Index</a>
            </div>
        </div> 
    </div>
</div>
@endsection