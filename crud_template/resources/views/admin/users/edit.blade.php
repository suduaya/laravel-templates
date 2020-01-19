@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editing User ({{ $user->name }})</div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-body">
                  <form action='{{ route('users.update', ['user' => $user->id]) }}' method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    Username: <input type="text" name="username" value="{{ $user->name }}"><br>
                    Email:    <input type="text" name="useremail" value="{{ $user->email }}"><br>
                    Role:<br>
                    @foreach ($roles as $role)
                    <div class="form-check">
                      <input type='checkbox' name='roles[]' value='{{ $role->id }}' {{ $user->hasAnyRole($role->name)?'checked':'' }}>
                      <label>{{ $role->name }}</label>
                    </div>
                    @endforeach
                      <button type="submit" class="btn btn-primary btn-sm">
                        Update
                      </button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
