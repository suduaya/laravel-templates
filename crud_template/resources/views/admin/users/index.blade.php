@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif
            <div class="card">
                <div class="card-header">Manage Users</div>

                <div class="card-body">

                  <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Role</th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                      <td>
                          <a href="{{ route('users.edit', $user->id) }}">
                              <button type="button" class="btn btn-primary btn-sm">Edit</button>
                          </a>
                      </td>
                      <td>
                          <form action="{{ route('users.destroy', $user->id) }}" method='POST'>
                              @csrf
                              {{ method_field('DELETE') }}
                              <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                          </form>
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
