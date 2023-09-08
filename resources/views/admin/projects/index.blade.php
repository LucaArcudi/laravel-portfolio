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
                        <th scope="col">ID</th>
                        <th scope="col">Titolo</th>
                        <th scope="col" class="d-flex justify-content-between">
                            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Add a new project</a>
                            @if ($trash)
                            <a href="{{ route('admin.projects.trash') }}" class="btn btn-primary">Trash ({{ $trash }})</a>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @forelse ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td class="d-flex justify-content-between">
                            <a href="{{ route('admin.projects.show', $project ) }}" class="btn btn-sm btn-info" style="width: 33%">Show</a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-warning" style="width: 33%">Edit</a>
                            <form id="{{ $project->title }}" class="form-deleter" action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="width: 33%">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100">Archive</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="5" class="text-start">
                            Nessun progetto da mostrare
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