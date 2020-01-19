<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('post.index')->with("posts", Post::latest('updated_at')->take(-1)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }



    public function search(Request $request)
    {
        #dd($request->queryterm);
        if ($request->queryterm == null){
          return view('search')->with(['users' => [], 'posts' => []]);
        }

      $queryUsers = User::query()
       ->where('name', 'LIKE', "%$request->queryterm%")
       ->orWhere('email', 'LIKE', "%$request->queryterm%")
       ->get();

       $queryPosts = Post::query()
      ->where('title', 'LIKE', "%$request->queryterm%")
      ->orWhere('text', 'LIKE', "%$request->queryterm%")
      ->get();

      #dd($queryPosts->first());

      return view('search')->with(['users' => $queryUsers, 'posts' => $queryPosts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=new Post;
        $post->title=$request->posttitle;
        $post->text=$request->posttext;
        $post->user_id=Auth::user()->id;
        $post->save();

        return redirect()->route('posts.index')->with("posts", Post::latest('updated_at')->take(-1)->get())->with("status", "post created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('post.show')->with(["post" => Post::find($id), "comments" => Post::find($id)->comments()->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return view('post.edit')->with("post", Post::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->posttitle;
        $post->text = $request->posttext;
        $post->save();

        return redirect()->route('posts.index')->with("posts", Post::latest('updated_at')->take(-1)->get())->with("status", "post edited!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index')->with("posts", Post::latest('updated_at')->take(-1)->get())->with("status", "post deleted!");
    }
}
