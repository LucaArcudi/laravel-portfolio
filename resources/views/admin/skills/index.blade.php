@extends('layouts.app')

@section('title', config('app.name').' - skills')

@section('scripts')
    @vite(['resources/js/deleteHandler.js'])
    @vite(['resources/js/popupHandler.js'])
@endsection

@section('content')
    <div class="container w-75">
        <div class="row">

            @include('partials.popup')
            <div class="col-12">
                <table class="table table-sm table-bordered">
                    <thead class="align-middle">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">N. of projects</th>
                            <th scope="col" class="d-flex justify-content-between">
                                <a href="{{ route('admin.skills.create') }}" class="btn btn-sm btn-primary">
                                    New <i class="fa-solid fa-plus"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($skills as $skill)
                            <tr>
                                <th scope="row">{{ $skill->id }}</th>
                                <td>{{ $skill->name }}</td>
                                <td>
                                    @if ($skill->isImageAValidUrl())
                                        <img src="{{ $skill->image }}" alt="{{ $skill->name }} image" style="width: 50px">
                                    @else
                                        <img src="{{ asset('storage/'.$skill->image) }}" alt="{{ $skill->name }} image" style="width: 50px">
                                    @endif
                                </td>
                                <td>{{ count($skill->projects) }}</td>
                                <td class="d-flex justify-content-between">
                                    <a href="{{ route('admin.skills.show', $skill ) }}" class="btn btn-sm btn-info" style="width: 33%;">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-sm btn-warning" style="width: 33%;">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form id="{{ $skill->name }}" class="form-deleter" action="{{ route('admin.skills.destroy', $skill) }}" method="POST" style="width: 33%;">
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
                                    No skills to show
                                </th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection