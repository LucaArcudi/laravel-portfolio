@extends('layouts.app')

@section('title', config('app.name').' - '.$category->name)

@section('scripts')
    @vite(['resources/js/deleteHandler.js'])
    @vite(['resources/js/popupHandler.js'])
@endsection

@section('content')
    <div class="container w-75">
        <div class="row">

            @include('partials.popup')
            <div class="col-12">
                <div class="row mb-3 justify-content-between align-items-end">
                    <div class="col-4">
                        <h1 class="mb-0">
                            <b style="color: {{ $category->color }}">{{ $category->name }}</b>
                        </h1>
                    </div>
                    <div class="crud-buttons text-end col-4">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">Edit</a>
                        <form id="{{ $category->name }}" class="form-deleter d-inline" action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="routeName" value="{{ $category->getRouteName() }}">
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="row mb-3 justify-content-between alignk-items-center">
                    <div class="col-4">
                        <a class="btn btn-success" href="{{route('admin.categories.index') }}">Categories</a>
                    </div>
                    <div class="col-4 nav-buttons text-end">
                        <a href="{{ route('admin.categories.show', $prevCategory) }}" class="btn btn-success">< Previous</a>
                        <a href="{{ route('admin.categories.show', $nextCategory) }}" class="btn btn-success">Next ></a>
                    </div>
                </div>


                <table class="table table-sm table-bordered">
                    <thead class="align-middle">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" style="width: 55%">Title</th>
                            <th scope="col">Skills</th>
                            <th scope="col">Visibility</th>
                            <th scope="col" class="d-flex justify-content-between">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($category->projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->title }}</td>
                            <td>
                                @foreach ( $project->skills as $skill )
                                    <img style="width: 50px;" src="{{ $skill->image }}" alt="{{ $skill->name }} image">
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
                                <form action="{{ route('admin.projects.clear-category', $project, $category->name) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-danger"><i class="fa-solid fa-trash"></i> Remove from {{ $category->name }} category</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan="5" class="text-start">
                                There are no projects in {{ $category->name }} category
                            </th>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- {{ $categories->links() }} --}}
            </div>
        </div>
    </div>
@endsection