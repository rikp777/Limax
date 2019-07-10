<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ArticleResourceCollection(Article::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'excel_code' => 'required|string|min:4|max:25|unique:articles',
            'inset_gram' => 'required|int',
            'inset_limit' => 'required|int',
            'pallet_limit' => 'required|int|max:180',
            'origin' => 'required|string|min:2',
            'pallet_type_id' => 'exists:pallet_types,id|required|int',
            'cask_id' => 'exists:casks,id|required|int',
            'inset_id' => 'exists:insets,id|required|int',
            'status_id' => 'exists:statuses,id|required|int',
            'article_group_id' => 'exists:article_groups,id|required|int',
            'sort_type_id' => 'exists:sort_types,id|required|int',
        ]);

        $article = new Article();
        $article->excel_code = $request->excel_code;
        $article->inset_gram = $request->inset_gram;
        $article->inset_limit = $request->inset_limit;
        $article->pallet_limit = $request->pallet_limit;
        $article->origin = $request->origin;
        $article->pallet_type_id = $request->pallet_type_id;
        $article->cask_id = $request->cask_id;
        $article->inset_id = $request->inset_id;
        $article->status_id = $request->status_id;
        $article->article_group_id = $request->article_group_id;
        $article->sort_type_id = $request->sort_type_id;
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
        $request->validate([
            'excel_code' => 'sometimes|string|min:4|max:25|unique:articles',
            'inset_gram' => 'required|int',
            'inset_limit' => 'required|int',
            'pallet_limit' => 'required|int|max:180',
            'origin' => 'required|string|min:2',
            'pallet_type_id' => 'exists:pallet_types,id|required|int',
            'cask_id' => 'exists:casks,id|required|int',
            'inset_id' => 'exists:insets,id|required|int',
            'status_id' => 'exists:statuses,id|required|int',
            'article_group_id' => 'exists:article_groups,id|required|int',
            'sort_type_id' => 'exists:sort_types,id|required|int',
        ]);
        $article->update($request->all());

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
