<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{

    public function index(){
        //get articles
        $articles = Article::orderBy('created_at','desc')->paginate(5);
        //return the collection of articles as a resource
        return ArticleResource::collection($articles);
    }


    public function create()
    {
        //
    }


    public function store(Request $request){
        $article = $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;
        $article->id = $request->input('article_id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if($article->save()){
            return new ArticleResource($article);
        }
    }


    public function show($id){
        //get single article
        $article = Article::findOrFail($id);
        //return single article as resource
        return new ArticleResource($article);
    }


    public function destroy($id){
           //get single article
           $article = Article::findOrFail($id);

           if($article->delete()){
            return new ArticleResource($article);
           }
    }
}
