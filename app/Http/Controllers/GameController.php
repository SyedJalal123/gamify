<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Game;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index(Request $request, $category_id, $game_id)
    {
        $game = Game::findOrFail($game_id);
        $category = Category::findOrFail($category_id);
    
        // Get all relevant attributes for this game-category pair
        $attributes = Attribute::whereHas('categories', fn($q) => $q->where('category_id', $category_id))
            ->whereHas('games', fn($q) => $q->where('game_id', $game_id))
            ->get();
    
        // Build base query
        $itemsQuery = Item::where('category_id', $category_id)
            ->where('game_id', $game_id);
    
        // Attribute filtering
        foreach ($request->query() as $key => $value) {
            if (str_starts_with($key, 'attr_') && !is_null($value) && $value !== '') {
                $attributeId = str_replace('attr_', '', $key);
                $itemsQuery->whereHas('attributes', function ($q) use ($attributeId, $value) {
                    $q->where('attribute_id', $attributeId)
                        ->where('value', $value);
                });
            }
        }
    
        // Text search
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $itemsQuery->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', "%$searchTerm%")
                    ->orWhereHas('attributes', function ($q) use ($searchTerm) {
                        $q->where('value', 'like', "%$searchTerm%");
                    })
                    ->orWhere('price', 'like', "%$searchTerm%");
            });
        }
    
        // Price sorting
        if ($request->sort === 'price_asc') {
            $itemsQuery->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $itemsQuery->orderBy('price', 'desc');
        } else {
            $itemsQuery->latest(); // default: newest first
        }
    
        // Get items with their attributes
        $items = $itemsQuery->with('attributes')->paginate(12)->withQueryString();

        // Handle AJAX partial load
        if ($request->ajax()) {
            return view('frontend._items', compact('items'))->render();
        }
    
        return view('frontend.catalog', compact('game', 'category', 'items', 'attributes'));
    }
    public function liveSearch(Request $request)
    {
        $query = $request->get('q');
    
        if ($query) {
            $results = DB::table('games')
                ->join('category_game', 'games.id', '=', 'category_game.game_id')
                ->join('categories', 'categories.id', '=', 'category_game.category_id')
                ->where(function ($q1) use ($query) {
                    $q1->where('games.name', 'LIKE', "%{$query}%")
                       ->orWhere('categories.name', 'LIKE', "%{$query}%");
                })
                ->select(
                    DB::raw("CONCAT(categories.name, ' ', games.name) as name"),
                    'games.image',
                    'categories.id as category_id',
                    'games.id as game_id'
                )
                ->limit(10)
                ->get();
        } else {
            // Use subquery to only get one category per game (the first match)
            $results = DB::table('games')
                ->join('category_game', 'games.id', '=', 'category_game.game_id')
                ->join('categories', 'categories.id', '=', 'category_game.category_id')
                ->whereRaw('category_game.id IN (
                    SELECT MIN(id)
                    FROM category_game
                    GROUP BY game_id
                )')
                ->select(
                    DB::raw("CONCAT(categories.name, ' ', games.name) as name"),
                    'games.image',
                    'categories.id as category_id',
                    'games.id as game_id'
                )
                ->limit(8)
                ->get();
        }
    
        $mapped = $results->map(function ($item) {
            return [
                'name' => $item->name,
                'image' => asset(($item->image ?? 'default.png')),
                'link' => route('catalog.index', [$item->category_id, $item->game_id])
            ];
        });
    
        return response()->json($mapped);
    }
    
    
}
