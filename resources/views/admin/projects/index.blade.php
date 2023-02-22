@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' '.'- dashboard')

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
            {{-- <a href="{{ route('admin.projects.create') }}" class="btn btn-lg btn-secondary my-3">Create a new comic</a> --}}
        </div>
        <div class="col-12">
            <table class="table table-sm ">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">title</th>
                        <th scope="col">description</th>
                        <th scope="col">technologies</th>
                        <th scope="col">date</th>
                        <th scope="col">created_at</th>
                        <th scope="col">updated_at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->technologies }}</td>
                        <td>{{ $project->date }}</td>
                        <td>{{ $project->created_at }}</td>
                        <td>{{ $project->updated_at }}</td>
                        {{-- <td>
                            <a href="{{ route('admin.projects.show', $projects->id ) }}" class="btn btn-primary btn-sm w-100">Show</a>
                            <a href="{{ route('admin.projects.edit', $projects->id) }}" class="btn btn-warning btn-sm w-100">Edit</a>
                            <form class="form-deleter" action="{{ route('admin.projects.destroy', $projects->id) }}" method="POST" data-element-name="{{ $projects->title }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100">Delete</button>
                            </form>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection