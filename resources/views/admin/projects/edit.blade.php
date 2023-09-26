@extends('layouts.app')

@section('title', config('app.name')." - Edit $project->title")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 m-auto">
            <div class="row align-items-center">
                <div class="col-10">
                    <h1>Edit <b>"{{ $project->title }}"</b></h1>
                </div>
                <div class="col-2 text-end">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Projects</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-10 m-auto">
            @include('admin.projects.partials.form', ['route' => 'admin.projects.update' , 'project' => $project, 'method' => 'PUT', 'buttonName' => 'Update', 'is_required' => ''])
        </div>
    </div>
</div>
@endsection