<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function itemDetail(Item $item)
    {
        $item->load(['game', 'category', 'attributes']);
    
        // Detect if category is explicitly 'Gold' or attribute named 'Gold'
        $isGold = strtolower($item->category->name) === 'gold'
            || $item->attributes->contains(fn($attr) => strtolower($attr->name) === 'gold');
    
        return view('frontend.item-detail', [
            'item' => $item,
            'game' => $item->game,
            'category' => $item->category,
            'isGold' => $isGold
        ]);
    }
}
