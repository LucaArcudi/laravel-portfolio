@extends('layouts.app')

@section('title', config('app.name').' - Projects')
@section('deleteHandler')
@vite(['resources/js/deleteHandler.js'])
@endsection
@section('content')
<div class="container w-75">
    <div class="row">

        @if (session('message'))
        <div class="col-12">
            <div class="alert alert-{{ session('alert-type') }} mb-3">
                    {{ session('message') }}
            </div>
        </div>
        @endif
        <div class="col-12">
            <table class="table table-sm table-bordered">
                <thead class="align-middle">
                    <tr>
                        <th scope="col" style="width: 1%;">ID</th>
                        <th scope="col" style="width: 78%;">Title</th>
                        <th scope="col" style="width: 1%;">Visibility</th>
                        <th scope="col" class="d-flex justify-content-between">
                            <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-primary">
                                New <i class="fa-solid fa-plus"></i>
                            </a>
                            @if ($trash)
                            <a href="{{ route('admin.projects.trash') }}" class="btn btn-sm btn-primary">Trash ({{ $trash }})</a>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @forelse ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>
                            <form action="{{ route('admin.projects.visibility-toggle', $project) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit">
                                    {{ $project->is_visible }}
                                </button>
                            </form>
                        </td>
                        <td class="d-flex justify-content-between">
                            <a href="{{ route('admin.projects.show', $project ) }}" class="btn btn-sm btn-info" style="width: 33%;">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-warning" style="width: 33%;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form id="{{ $project->title }}" class="form-deleter" action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="width: 33%;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100" style="width: 100%;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="5" class="text-start">
                            No projects to show
                        </th>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection