@extends('layouts.app')

@section('title', config('app.name')." - Edit $project->title")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 py-5 ">
            <h1>Modifica il progetto <b>"{{ $project->title }}"</b></h1>
        </div>
        <div class="col">
            @include('admin.projects.partials.form', ['route' => 'admin.projects.update' , 'project' => $project, 'method' => 'PUT', 'buttonName' => 'Aggiorna', 'htmlAttribute' => ''])
        </div>
    </div>
</div>
@endsection