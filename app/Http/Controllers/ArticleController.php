<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Post::where('user_id', auth()->user()->id)->get()->toArray();
        return view('admin.article.index',[
            'title'=> 'Article',
            'articles'=> $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create',[
            'title' => 'Article',
            'id'=> auth()->user()->id,
            'categories'=> Category::all()->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'content'   => 'required',
            'category_id'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $image = $request->file('image');
        $imageName = $image->hashName();
        $image->storeAs('public/posts', $imageName);

        $post = Post::create([
            'image'     => $imageName,
            'title'     => $request->title,
            'content'   => $request->content,
            'user_id'   => $request->user_id,
            'category_id' => $request->category_id,
        ]);

        return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Post::find($id);
        return view('admin.article.view',[
            'title' => 'Article',
            'article' => $article->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Post::find($id);

        return view('admin.article.update',[
            'title' => 'Article',
            'id' => auth()->user()->id,
            'article' => $article->toArray(),
            'categories'=> Category::all()->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'content'   => 'required',
            'category_id'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $post = Post::find($id);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imagename = $image->hashName();
            $image->storeAs('public/posts', $imagename);

            Storage::delete('public/posts/'.$post->image);

            Post::where('id', $id)->update([
                'image'     => $imagename,
                'title'     => $request->title,
                'content'   => $request->content,
            ]);

        } else {
            Post::where('id', $id)->update([
                'title'     => $request->title,
                'content'   => $request->content,
                'category_id' => $request->category_id
            ]);
        }

        return redirect('/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        Storage::delete('public/posts/'.$post->image);
        $post->delete();

        return redirect('/articles');
    }
}
