@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    {{ Form::model($user, ['route' => 'profile-update','enctype' => 'multipart/form-data']) }}
                    @csrf
                    @method('patch')
                    <img src="{{ asset('storage/assets/images/' . $user->avatar) }}" class="p-3" style="width:150px;height:150px;" alt="Avatar">
                    <div class="form-group">
                        {{ Form::label('avatar', 'Change Avatar') }}
                        {{ Form::file('avatar', ['class' => 'form-control']) }}
                       @error('avatar') 
                       <span class="text-danger" role="alert">
                           <strong>{{ $message }} </strong>
                       </span>
                       @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'autofocus']) }}
                        @error('name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('alamat', 'Alamat') }}
                        {{ Form::text('alamat', null, ['class' => 'form-control']) }}
                        @error('alamat')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', null, ['class' => 'form-control', 'readonly']) }}
                    </div>
                    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
