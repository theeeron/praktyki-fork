<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listUsers(Request $request)
    {
        // Pobiera rekordy z tabeli users
        // 'with' zamienia user_id na obiekt
        $users = User::all();

        // Filtrowanie rekordów
        

        return response(['users' => $users], 200);
    }

    public function readUser(Request $request)
    {
        // Pobiera rekord z tabeli users z id podanym w ścieżce
       // $User = User::where('id', $request->id)->with('author');

        return response(['User' => $User->get()], 200);
    }

    public function deleteUser(Request $request)
    {
        // Pobiera rekord z tabeli users z id podanym w ścieżce
        $User = User::where('id', $request->id)->delete();

        return response(['message' => 'The User has been deleted.'], 200);
    }

    public function createUser(Request $request) {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response(['message' => 'The User has been successfully created.'], 201);
    }
}
