@extends('layouts.app')

@section('title', config('app.name').' - Add a new project')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 py-5 text-center">
            <h1>Add a new project</h1>
        </div>
        <div class="col-6 m-auto">
            @include('admin.projects.partials.form', ['route' => 'admin.projects.store' , 'project' => $project, 'method' => 'POST', 'buttonName' => 'Create', 'is_required' => 'required'])
        </div>
    </div>
</div>
@endsection