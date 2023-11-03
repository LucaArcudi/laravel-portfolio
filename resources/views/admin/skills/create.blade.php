@extends('layouts.app')

@section('title', config('app.name').' - Add a new skill')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 m-auto">
            <div class="row align-items-center">
                <div class="col-10">
                    <h1>Add a new skill</h1>
                </div>
                <div class="col-2 text-end">
                    <a href="{{ route('admin.skills.index') }}" class="btn btn-primary">Skills</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-10 m-auto">
            @include('admin.skills.partials.create_edit_form', ['route' => 'admin.skills.store' , 'skill' => $skill, 'method' => 'POST', 'buttonName' => 'Create', 'isRequired' => 'required'])
        </div>
    </div>
</div>
@endsection