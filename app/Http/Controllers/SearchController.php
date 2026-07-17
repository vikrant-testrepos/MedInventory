<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $medicines = Medicine::with(['category', 'pharmacy'])
            ->where('quantity', '>', 0)
            ->when($keyword, function ($query) use ($keyword) {

                $query->where(function ($q) use ($keyword) {

                    $q->where('name', 'LIKE', "%{$keyword}%")
                      ->orWhere('company', 'LIKE', "%{$keyword}%")
                      ->orWhereHas('category', function ($category) use ($keyword) {

                          $category->where('name', 'LIKE', "%{$keyword}%");

                      });

                });

            })
            ->latest()
            ->paginate(9);

        return view('search.index', compact('medicines', 'keyword'));
    }
}