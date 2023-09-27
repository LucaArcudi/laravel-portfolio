@extends('layouts.app')

@section('title', config('app.name').' - Dashboard')

@section('content')
<div class="container">
    {{-- <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2> --}}
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark">Profile</a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="col-4">
                            <img src="{{ Auth::user()->userDetail?->user_image }}" alt="user-image" style="width: 100px">
                        </div>
                        <div class="col-8">
                            <h2 class="m-0">{{Auth::user()->name}}</h2>
                            <p class="m-0">{{Auth::user()->email}}</p>
                        </div>
                    </div>
                    <div>
                        <p>
                            <em>{{ Auth::user()->userDetail?->bio }}</em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-dark">Projects</a>
                </div>
                <div class="card-body d-flex flex-column">
                    <a href="{{ route('admin.projects.create') }}" style="color: black;">Add a new project</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
