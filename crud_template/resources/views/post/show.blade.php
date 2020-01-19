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



      <h4> Post </h4> (Posted by: {{ $post->user()->first()->name }})

      <div class="card-body">
        <div class="card mb-4 box-shadow">
        <h4>Title:</h4>
        <h5>{{ $post->title }}<br></h5>
        <br>
        <h4>Text:</h4> <p>{{ $post->text }}<br></p>


</div>
        <h4> Comments </h4>

        @foreach ($comments as $comment)
        <div class="card-body">
          <div class="card mb-4 box-shadow">
              {{ $comment->text }}
          </div>
        </div>
        @endforeach



        <form action='{{ route('comments.createcomment', ['postid' => $post->id]) }}' method="POST">
          @csrf
          {{ method_field('PUT') }}
          <input type="text" name="commenttext" value=""><br>
          <button type="submit" class="btn btn-primary btn-sm">
            Add Comment
          </button>
        </form>

      </div>



    </div>
  </div>
</div>
@endsection
