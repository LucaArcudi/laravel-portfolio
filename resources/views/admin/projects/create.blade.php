@extends('layouts.app')

@section('title', config('app.name').' - Add a new project')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 py-5 ">
            <h1>Aggiungi un nuovo progetto</h1>
        </div>
        <div class="col">
            @include('admin.projects.partials.form', ['route' => 'admin.projects.store' , 'project' => $project, 'method' => 'POST', 'buttonName' => 'Aggiungi', 'htmlAttribute' => 'required'])
        </div>
    </div>
</div>
@endsection