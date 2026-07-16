<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->search;

        $medicines = Medicine::with(['category','pharmacy'])
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->where('quantity', '>', 0)
            ->paginate(9);

        return view('search.index', compact('medicines'));
    }
}