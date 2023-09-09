@extends('layouts.app')

@section('title', config('app.name').' - Trash')

@section('scripts')
    @vite(['resources/js/deleteHandler.js'])
    @vite(['resources/js/popupHandler.js'])
@endsection

@include('partials.popup')

@section('content')
    <div class="container w-75">
        <div class="row">
            <div class="col-12">
                <div class="col p-0 text-start mb-3">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Projects</a>
                </div>
                <table class="table table-sm table-bordered">
                    <thead class="align-middle">
                        <tr>
                            <th scope="col" style="width: 1%;">ID</th>
                            <th scope="col" style="width: 75%;">Title</th>
                            <th scope="col" style="width: 1%;">Visibility</th>
                            <th scope="col" class="d-flex justify-content-between">
                                <form action="{{ route('admin.projects.restore-all') }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fa-solid fa-recycle"></i> Restore all
                                    </button>
                                </form>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->is_visible }}</td>
                            <td class="d-flex justify-content-between">
                                <form action="{{ route('admin.projects.restore', $project) }}" method="POST" class="w-50">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-sm btn-success w-100">
                                        <i class="fa-solid fa-recycle"></i>
                                    </button>
                                </form>
                                <form id="{{ $project->title }}" class="form-deleter double-confirm w-50" action="{{ route('admin.projects.force-delete', $project) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
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