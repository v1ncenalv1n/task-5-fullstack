<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class FrontController extends Controller
{
    public function home(){
        $articles = Post::get()->toArray();
        return view(
            'front.home',[
                'title' => 'Home',
                'articles' => $articles
            ]
        );
    }

    public function detail($id){
        $article = Post::find($id);
        if(is_null($article)){
            return redirect()->back();
        }
        return view(
            'front.detail',[
                'title' => 'Detail',
                'article' => $article->toArray()
            ]
        );
    }
}
