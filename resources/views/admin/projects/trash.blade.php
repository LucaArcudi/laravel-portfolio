@extends('layouts.app')

@section('title', config('app.name').' - Trash')
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
                        <th scope="col">Title</th>
                        <th scope="col" class="d-flex justify-content-between">
                            <form action="{{ route('admin.projects.restore-all') }}" method="POST" class="w-100">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">Restore all</button>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @forelse ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td class="d-flex justify-content-between">
                            <form action="{{ route('admin.projects.restore', $project->id) }}" method="POST" class="w-50">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-sm btn-success w-100">Restore</button>
                            </form>
                            <form id="{{ $project->title }}" class="form-deleter w-50" action="{{ route('admin.projects.force-delete', $project->id) }}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="5" class="text-start">
                            The trash is empty
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