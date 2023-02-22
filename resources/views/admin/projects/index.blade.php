@extends('layouts.app')

@section('title', config('app.name').' - Projects')

@section('content')
<div class="container">
    <div id="as" class="row">

        @if (session('message'))
        <div class="col-12">
            <div class="alert alert-{{ session('alert-type') }} mb-3">
                    {{ session('message') }}
            </div>
        </div>
        @endif

        <div class="col-12">
            
        </div>
        <div class="col-12">
            <table class="table table-bordered table-hover text-center">
                <thead class="align-middle">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">title</th>
                        <th scope="col">technologies</th>
                        <th scope="col">date</th>
                        <th scope="col">
                            <a href="{{ route('admin.projects.create') }}" class="btn btn-lg btn-primary my-3 w-100">Add a new project</a>
                        </th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->technologies }}</td>
                        <td>{{ $project->date }}</td>
                        <td>
                            <a href="{{ route('admin.projects.show', $project->id ) }}" class="btn btn-primary btn-sm w-100">Show</a>
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning btn-sm w-100">Edit</a>
                            <form class="form-deleter" action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" data-element-name="{{ $project->title }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection