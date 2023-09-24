@extends('layouts.app')

@section('title', config('app.name').' - '.$project->title)

@section('scripts')
    @vite(['resources/js/deleteHandler.js'])
    @vite(['resources/js/popupHandler.js'])
@endsection

@include('partials.popup')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-8 m-auto">
                <div class="row align-items-end">
                    <div class="col p-0 text-start mb-3">
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Projects</a>
                    </div>
                    <div class="col p-0 text-end mb-3">
                        @if ($trash)
                            <a href="{{ route('admin.projects.trash') }}" class="btn btn-primary">Trash ({{ $trash }})</a>
                        @endif
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-12 card g-0">
                        <div class="card-header">
                            <h6 style="color: {{ $project->category->color }}">{{ $project->category->name }}</h6>
                            <h5 class="card-title">{{ $project->title }}</h5>
                            @foreach ( $project->skills as $skill )
                                <img style="width: 50px;" src="{{ $skill->image }}" alt="">
                            @endforeach
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle">{{ $project->technologies }}</h6>
                            @if ($project->isImageAValidUrl())
                                <img src="{{ $project->image }}" alt="{{ $project->title }} image" class="img-fluid w-25">
                            @else
                                <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }} image" class="img-fluid w-25">
                            @endif
                            <p class="card-text">{{ $project->description }}</p>
                            <p class="card-text">{{ $project->date }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-around">
                            <a href="{{ route('admin.projects.show', $prevProject) }}" class="btn btn-success">< Previous</a>
                            <div class="crud-buttons">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning">Edit</a>
                                <form id="{{ $project->title }}" class="form-deleter d-inline" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="routeName" value="{{ $project->getRouteName() }}">
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                            <a href="{{ route('admin.projects.show', $nextProject) }}" class="btn btn-success">Next ></a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection