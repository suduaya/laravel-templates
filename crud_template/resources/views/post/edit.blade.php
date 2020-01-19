@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">


      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}a
      </div>
      @endif



      <h4> Editing </h4> (Posted by: {{ $post->user()->first()->name }})

      <div class="card-body">
        <form action='{{ route('posts.update', ['post' => $post->id]) }}' method="POST">
          @csrf
          {{ method_field('PUT') }}
          <h2>Title:</h2>
          <h3><input type="text" name="posttitle" value="{{ $post->title }}"><br></h3>
          <br>
          <h2>Text:</h2> <p><input type="text" name="posttext" value="{{ $post->text }}"><br></p>

          <button type="submit" class="btn btn-primary btn-sm">
            Update
          </button>
        </form>
      </div>



    </div>
  </div>
</div>
@endsection
