<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::paginate(10);
        return response()->json(['data' => $data], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'content' => 'required'
        ]);
        $validateData['user_id'] = auth()->user()->id;

        Post::create($validateData);
        return response()->json([
            'data' => $validateData,
            'msg' => 'Created Successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $data = Post::find($post->id);

        if(is_null($data)){
            return response()->json([
                'msg' => 'Data not found',
            ], 404);
        }
        return response()->json([
            'data' => $data,
            'msg' => 'Show Successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'content' => 'required'
        ]);

        $validateData['user_id'] = auth()->user()->id;

        Post::where('id', $post->id)->update($validateData);

        return response()->json([
            'data'=> $validateData,
            'msg' => 'Updated Successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id);

        return response()->json(['msg' => 'Deleted Successfully'], 200);
    }
}
