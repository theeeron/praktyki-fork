<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function articles(Request $request)
    {
        // Pobiera rekordy z tabeli Articles
        // 'with' zamienia user_id na obiekt
        $articles = Article::with('author')->orderBy('created_at', 'DESC');

        // Filtrowanie rekordów
        if($request->search)
            $articles->where('title', 'like', '%' . $request->search . '%');

        return response(['articles' => $articles->get()], 200);
    }
}
