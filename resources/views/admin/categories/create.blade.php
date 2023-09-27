@extends('layouts.app')

@section('title', config('app.name').' - Add a new category')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 m-auto">
            <div class="row align-items-center">
                <div class="col-10">
                    <h1>Add a new category</h1>
                </div>
                <div class="col-2 text-end">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Categories</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-10 m-auto">
            @include('admin.categories.partials.create_edit_form', ['route' => 'admin.categories.store' , 'category' => $category, 'method' => 'POST', 'buttonName' => 'Create'])
        </div>
    </div>
</div>
@endsection