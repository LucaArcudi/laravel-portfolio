@extends('layouts.app')

@section('title', config('app.name').' - '.$project->title)

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="alert alert-{{ session('alert-type') }}">
            {{ session('message') }}
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $project->title }}</h5>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle">{{ $project->technologies }}</h6>
                <p class="card-text">{{ $project->description }}</p>
                <p class="card-text">{{ $project->date }}</p>
            </div>
            <div class="card-footer d-flex justify-content-around">
                <a href="{{ route('admin.projects.prev', $project) }}" class="btn btn-success">< Previous</a>
                <div class="crud-buttons">
                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning">Edit</a>
                    <form class="form-deleter d-inline" action="{{ route('admin.projects.destroy', $project) }}" method="POST" data-element-name="{{ $project->title }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
                <a href="{{ route('admin.projects.next', $project) }}" class="btn btn-success">Next ></a>
            </div>
        </div> 
    </div>
</div>
@endsection