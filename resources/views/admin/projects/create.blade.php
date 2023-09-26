@extends('layouts.app')

@section('title', config('app.name').' - Add a new project')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 m-auto">
            <div class="row align-items-center">
                <div class="col-10">
                    <h1>Add a new project</h1>
                </div>
                <div class="col-2 text-end">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Projects</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-10 m-auto">
            @include('admin.projects.partials.form', ['route' => 'admin.projects.store' , 'project' => $project, 'method' => 'POST', 'buttonName' => 'Create', 'is_required' => 'required'])
        </div>
    </div>
</div>
@endsection