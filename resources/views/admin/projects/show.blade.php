@extends('layouts.app')

@section('title', config('app.name').' - '.$project->title)

@section('deleteHandler')
    @vite(['resources/js/deleteHandler.js'])
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 m-auto">
                <div class="row align-items-end">
                    <div class="col-12 p-0 text-end mb-3">
                        @if ($trash)
                            <a href="{{ route('admin.projects.trash') }}" class="btn btn-primary">Trash ({{ $trash }})</a>
                        @endif
                    </div>
                    <div class="col-12 p-0">
                        @if (session('message'))
                        <div class="alert alert-{{ session('alert-type') }}">
                            {{ session('message') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-12 card g-0">
                        <div class="card-header">
                            <h5 class="card-title">{{ $project->title }}</h5>
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
                            @if (!is_null($prevProject))
                                <a href="{{ route('admin.projects.show', $prevProject) }}" class="btn btn-success">< Previous</a>
                            @else
                                <a href="" class="btn btn-success disabled">< Previous</a>
                            @endif
                            
                            <div class="crud-buttons">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning">Edit</a>
                                <form id="{{ $project->title }}" class="form-deleter d-inline" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                            @if (!is_null($nextProject))
                                <a href="{{ route('admin.projects.show', $nextProject) }}" class="btn btn-success">Next ></a>
                            @else
                                <a href="" class="btn btn-success disabled">Next ></a>
                            @endif
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection