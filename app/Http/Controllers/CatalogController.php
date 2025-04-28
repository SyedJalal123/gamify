<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function itemDetail(Item $item)
    {
        $item->load(['attributes','categoryGame.game']);

        // Detect if category is explicitly 'Gold'
        $isCurrency = strtolower($item->categoryGame->category->id) == 1;
        return view('frontend.item-detail', [
            'item' => $item,
            'categoryGame' => $item->categoryGame,
            'isCurrency' => $isCurrency
        ]);
    }
}
