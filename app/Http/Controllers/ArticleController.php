<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Services\Requestable;
use App\Services\Validable;
use App\Traits\Forms\Request\Article\HasRequestData;
use App\Traits\Forms\Validate\Article\HasValidator;
use Illuminate\Http\Request;

class ArticleController extends Controller implements Validable, Requestable
{
    use HasValidator, HasRequestData;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('user')->paginate(12);
        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all());
        //TODO: el identificador debe ser dinámico
        $user = User::find(1);
        $user->articles()->create($this->build($request));

        return response()->json('Artículo creado con éxito', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::with('user')->where('id', $id)->first();
        return response()->json($article);
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
        $this->validator($request->all(), $id);
        $article = Article::findOrFail($id);
        $article->update($this->build($request));

        return response()->json('Artículo actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
