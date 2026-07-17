<?php

namespace App\Http\Controllers;

use App\StockHistory;
use Illuminate\Http\Request;

class StockHistoryController extends Controller
{
    public function index()
    {
        $search = request('search');

        $histories = StockHistory::with(
                'medicine',
                'user'
            )
            ->when($search, function ($query) use ($search) {

                $query->whereHas('medicine', function ($q) use ($search) {

                    $q->where('name', 'like', "%{$search}%");

                });

            })
            ->latest()
            ->paginate(10)
            ->appends(request()->query());

        return view(
            'stock-history.index',
            compact('histories')
        );
    }
}