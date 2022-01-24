<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function listOrders(Request $request)
    {
        // Pobiera rekordy z tabeli Articles
        // 'with' zamienia user_id na obiekt
        $orders = Order::with('author')->orderBy('created_at', 'DESC');

        // Filtrowanie rekordów
        if($request->search)
            $orders->where('title', 'like', '%' . $request->search . '%');

        return response(['orders' => $orders->get()], 200);
    }

    public function readOrder(Request $request)
    {
        // Pobiera rekord z tabeli Articles z id podanym w ścieżce
        $order = Order::where('id', $request->id)->with('author');

        return response(['order' => $order->get()], 200);
    }

    public function deleteOrder(Request $request)
    {
        // Pobiera rekord z tabeli Articles z id podanym w ścieżce
        $order = Order::where('id', $request->id)->delete();

        return response(['message' => 'The article has been deleted.'], 200);
    }

    public function createOrder(Request $request) {

        $request->validate([
            'title' => 'required|string',
            'user_id' => 'required|integer',
            'body' => 'required'
        ]);

        $user = Order::create([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'body' => $request->body
        ]);

        return response(['message' => 'The article has been successfully created.'], 201);
    }
}
