@extends('layouts.app')

@section('title', config('app.name').' - Trash')

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
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-primary w-50">Index</a>
                            <a href="" class="btn btn-primary w-50">Restore all</a>
                        </th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @forelse ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td class="d-flex justify-content-between">
                            <a href="" class="btn btn-sm btn-primary" style="width: 50%">Restore</a>
                            <form class="form-deleter" action="" method="POST" data-element-name="{{ $project->title }}" style="width: 50%">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100">Delete perma</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="5" class="text-start">
                            Il cestino è vuoto
                        </th>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection