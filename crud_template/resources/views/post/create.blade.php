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

      <h4> Creating New Post </h4>

      <div class="card-body">
        <form action='{{ route('posts.store') }}' method="POST">
          @csrf
          {{ method_field('POST') }}
          <h2>Title:</h2>
          <h3><input type="text" name="posttitle" value=""><br></h3>
          <br>
          <h2>Text:</h2> <p><input type="text" name="posttext" value=""><br></p>

          <button type="submit" class="btn btn-primary btn-sm">
            Create
          </button>
        </form>
      </div>



    </div>
  </div>
</div>
@endsection
