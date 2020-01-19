@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <h3>Latest Posts by Users</h3>

      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif

      <form action='{{ route('posts.create') }}'>
        <button type="submit" class="btn btn-primary btn-sm">
          Create New Post
        </button>
      </form>

      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">

            @foreach ($posts as $post)
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <div class="card-body">
                  <small class="text-muted">post id:{{ $post->id }}<br> </small>

                  <p class="card-text">
                    <h3> {{ $post->title }} </h3><br>

                    <p>{{ $post->text }}</p>
                  </p>


                  <form action='{{ route('posts.show', ['post' => $post->id]) }}'>
                    <button type="submit" class="btn btn-primary btn-sm">
                      View Post
                    </button>
                  </form>
                  @if($post->user()->get()->first()->email == Auth::user()->email)
                    <small class="text-muted">(your post) <br> </small>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="{{ route('posts.edit', $post->id) }}">
                          <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                        </a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method='POST'>
                          @csrf
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-sm btn-outline-secondary">Remove</button>
                        </form>
                      </div>

                    </div>
                  @else
                    <small class="text-muted">by: {{ $post->user()->get()->first()->name }}<br> </small>
                  @endif
                  <small class="text-muted">{{ $post->updated_at->diffForHumans() }}<br> </small>
                </div>
              </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
