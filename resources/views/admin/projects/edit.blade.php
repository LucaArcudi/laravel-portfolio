@extends('layouts.app')

@section('title', config('app.name')." - Edit $project->title")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 py-5 text-center">
            <h1>Edit <b>"{{ $project->title }}"</b></h1>
        </div>
        <div class="col-6 m-auto">
            @include('admin.projects.partials.form', ['route' => 'admin.projects.update' , 'project' => $project, 'method' => 'PUT', 'buttonName' => 'Update', 'is_required' => ''])
        </div>
    </div>
</div>
@endsection