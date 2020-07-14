<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
//    public function __construct()
//    {
//        $this->authorizeResource(Article::class);
//    }


    public function index()
    {
        return ArticleResource::collection(Article::all());
    }

    /**
     * store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ArticleResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'excel_code' => 'required|string|min:4|max:25|unique:articles',
            'inset_gram' => 'required',
            'inset_limit' => 'required',
            'pallet_limit' => 'required',
            'origin' => 'required|string|min:2',
            'pallet_type_id' => 'required',
            'cask_id' => 'required',
            'status_id' => 'required|int',
            'article_group_id' => 'required',
            'sort_type_id' => 'required',
        ]);

        $article = new Article();
        $article->excel_code = $request->excel_code;
        $article->inset_gram = $request->inset_gram;
        $article->inset_limit = $request->inset_limit;
        $article->pallet_limit = $request->pallet_limit;
        $article->origin = $request->origin;
        $article->pallet_type_id = $request->pallet_type_id['id'];
        $article->cask_id = $request->cask_id['id'];
        if(sizeof($request->inset_id)){
            $article->inset_id = $request->inset_id['id'];
        }
        $article->status_id = $request->status_id;
        $article->article_group_id = $request->article_group_id['id'];
        $article->sort_type_id = $request->sort_type_id['id'];
        $article->user_id = Auth::id();
        $article->save();

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article) : ArticleResource
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Article $article, Request $request) : ArticleResource
    {

        $authUser = auth()->user();
//        dd($request->article['excel_code']);
        $article->excel_code = $request->article['excel_code'];
        $article->inset_gram = $request->article['inset_gram'];
        $article->inset_limit = $request->article['inset_limit'];
        $article->pallet_limit = $request->article['pallet_limit'];
        $article->origin = $request->article['origin'];
        $article->pallet_type_id = $request->article['pallet_type_id']['id'];
        $article->cask_id = $request->article['cask_id']['id'];
        $article->inset_id = $request->article['inset_id']['id'];
        $article->status_id = 8;
        $article->article_group_id = $request->article['article_group_id']['id'];
        $article->sort_type_id = $request->article['sort_type_id']['id'];
        $article->user_id = $authUser->id;


        $article->save();

        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::withTrashed()->where('id', $id)->first();

        if ($article->trashed()){
            $article->restore();
        }
        else {
            $article->delete();
        }
        return new ArticleResource($article);
    }
}
