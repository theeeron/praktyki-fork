<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function listArticles(Request $request)
    {
        // Pobiera rekordy z tabeli Articles
        // 'with' zamienia user_id na obiekt
        $articles = Article::with('author')->orderBy('created_at', 'DESC');

        // Filtrowanie rekordów
        if($request->search)
            $articles->where('title', 'like', '%' . $request->search . '%');

        return response(['articles' => $articles->get()], 200);
    }

    public function readArticle(Request $request)
    {
        // Pobiera rekord z tabeli Articles z id podanym w ścieżce
        $article = Article::where('id', $request->id)->with('author');

        return response(['article' => $article->get()], 200);
    }

    public function deleteArticle(Request $request)
    {
        // Pobiera rekord z tabeli Articles z id podanym w ścieżce
        $article = Article::where('id', $request->id)->delete();

        return response(['message' => 'The article has been deleted.'], 200);
    }

    public function createArticle(Request $request) {

        $request->validate([
            'title' => 'required|string',
            'user_id' => 'required|integer',
            'body' => 'required'
        ]);

        $user = Article::create([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'body' => $request->body
        ]);

        return response(['message' => 'The article has been successfully created.'], 201);
    }
}
