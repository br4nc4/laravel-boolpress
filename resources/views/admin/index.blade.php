@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <h2>@{{helloMessage}}</h2>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    {{ __('You are logged in') }} {{$users = Auth::user()->name}}
                    <div class="d-flex mt-2">
                        <div style="margin-right: 10px">   
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Tutti gli utenti</a>
                        </div>
                        
                        <div>
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Tutti i post</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
