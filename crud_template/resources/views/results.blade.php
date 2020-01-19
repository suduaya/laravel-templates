@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-body">


                  @foreach ($users as $user)
                  <div class="card-body">
                    <label>User=> </label></br>
                    <label>---- Name=>  {{ $user->name }}</label></br>
                    <label>---- Email=>  {{ $user->email }}</label></br>
                    <label>---- Role=>  {{ $user->roles()->get()->first()->name }}</label></br>
                  </div>
                  @endforeach
                  </br>
                  @foreach ($posts as $post)
                  <div class="card-body">
                    <label>Post=> </label></br>
                    <label>---- Title=>  {{ $post->title }}</label></br>
                    <label>---- Text=>  {{ $post->text }}</label></br>
                    <label>---- Author=>  {{ $post->user()->get()->first()->name }}</label></br>
                  </div>
                  @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
