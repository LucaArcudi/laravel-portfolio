@extends('layouts.app')

@section('title', config('app.name').' - categories')

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
                            <th scope="col">Color</th>
                            <th scope="col">N. of projects</th>
                            <th scope="col" class="d-flex justify-content-between">
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">
                                    New <i class="fa-solid fa-plus"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td style="background-color: {{ $category->color }}">{{ $category->color }}</td>
                            <td>{{ count($category->projects) }}</td>
                            <td class="d-flex justify-content-between">
                                <a href="{{ route('admin.categories.show', $category ) }}" class="btn btn-sm btn-info" style="width: 33%;">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning" style="width: 33%;">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @if ($category->name != 'No category')
                                    <form id="{{ $category->title }}" class="form-deleter" action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="width: 33%;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger w-100" style="width: 100%;">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <th colspan="5" class="text-start">
                                No categories to show
                            </th>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection