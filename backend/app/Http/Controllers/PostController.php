<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function posts(Request $request)
    {
        // Pobiera rekordy z tabeli Posts
        // 'with' zamienia user_id na obiekt
        $posts = Post::with('author')->orderBy('created_at', 'DESC');

        // Filtrowanie rekordów
        if($request->search)
            $posts->where('title', 'like', '%' . $request->search . '%');

        return response(['posts' => $posts->get()], 200);
    }
}
