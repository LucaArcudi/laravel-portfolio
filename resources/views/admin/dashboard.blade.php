@extends('layouts.app')

@section('title', config('app.name').' - Dashboard')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card mb-3">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="list-group">
                <a href="{{ route('admin.projects.index') }}" class="list-group-item list-group-item-action active disabled" aria-current="true">
                    Resources links
                </a>
                <a href="{{ route('admin.projects.index') }}" class="list-group-item list-group-item-action" aria-current="true">
                    Projects index
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
