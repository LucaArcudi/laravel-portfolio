@extends('layouts.app')

@section('title', config('app.name').' - '.$skill->name)

@section('scripts')
    @vite(['resources/js/deleteHandler.js'])
    @vite(['resources/js/popupHandler.js'])
@endsection


@section('content')
<div class="container">
    <div class="row">
            @include('partials.popup')
            <div class="col-12">
                <div class="row mb-3 justify-content-between align-items-end">
                    <div class="col-4">
                        <h1 class="mb-0">
                            {{ $skill->name }}

                            @if ($skill->isImageAValidUrl())
                                <img src="{{ $skill->image }}" alt="{{ $skill->name }} image" class="img-fluid w-25">
                            @else
                                <img src="{{ asset('storage/'.$skill->image) }}" alt="{{ $skill->name }} image" class="img-fluid w-25">
                            @endif
                        </h1>
                    </div>
                    <div class="crud-buttons text-end col-4">
                        <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-warning">Edit</a>
                        <form id="{{ $skill->name }}" class="form-deleter d-inline" action="{{ route('admin.skills.destroy', $skill) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="row mb-3 justify-content-between alignk-items-center">
                    <div class="col-4">
                        <a href="{{ route('admin.skills.index') }}" class="btn btn-primary">Skills</a>
                    </div>
                    <div class="col-4 nav-buttons text-end">
                        <a href="{{ route('admin.skills.show', $prevSkill ?? $skill) }}" class="btn btn-success @if (!$prevSkill) disabled @endif">< Previous</a>
                        <a href="{{ route('admin.skills.show', $nextSkill ?? $skill) }}" class="btn btn-success @if (!$nextSkill) disabled @endif">Next ></a>
                    </div>
                </div>

                <table class="table table-sm table-bordered">
                    <thead class="align-middle">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Skills</th>
                            <th scope="col">Visibility</th>
                            <th scope="col" class="d-flex justify-content-between">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($skill->projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->title }}</td>
                            <td>
                                @foreach ( $project->skills as $skill )
                                    @if ($skill->isImageAValidUrl())
                                        <img src="{{ $skill->image }}" alt="{{ $skill->name }} image" style="width: 50px">
                                    @else
                                        <img src="{{ asset('storage/'.$skill->image) }}" alt="{{ $skill->name }} image" style="width: 50px">
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('admin.projects.visibility-toggle', $project) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn">
                                        @if ($project->is_visible)
                                            <i class="fa-solid fa-toggle-on" title="visible"></i>
                                        @else
                                            <i class="fa-solid fa-toggle-off" title="invisible"></i>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td class="d-flex justify-content-between">
                                <form class="form-deleter" action="{{ route('admin.projects.clear-skills', $project) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-danger"><i class="fa-solid fa-trash"></i> Clear all skills</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan="5" class="text-start">
                                There are no projects in {{ $skill->name }} skill
                            </th>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection