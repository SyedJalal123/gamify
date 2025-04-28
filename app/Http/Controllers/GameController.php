<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Game;
use App\Models\Category;
use App\Models\CategoryGame;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index(Request $request, $category_game_id)
    {
        $categoryGame = CategoryGame::findOrFail($category_game_id);
    
        // Get all relevant attributes for this game-category pair
        $attributes = Attribute::whereHas('categoryGames', fn($q) => $q->where('category_game_id', $category_game_id))->get();
    
        // Build base query
        $itemsQuery = Item::where('category_game_id', $category_game_id);
    
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
    
        return view('frontend.catalog', compact('categoryGame', 'items', 'attributes'));
    }
    public function liveSearch(Request $request)
    {
        $query = $request->get('q');
        
        if ($query) {
            $results = DB::table('category_game') // Query from category_game table
                ->join('games', 'category_game.game_id', '=', 'games.id') // Join with games table to get game details
                ->join('categories', 'category_game.category_id', '=', 'categories.id') // Join with categories table to get category details
                ->where(function ($q1) use ($query) {
                    $q1->where('category_game.title', 'LIKE', "%{$query}%") // Search in category_game.title
                       ->orWhere('games.name', 'LIKE', "%{$query}%"); // Search in games.name
                })
                ->select(
                    DB::raw("CONCAT(games.name, ' ', category_game.title) as name"), // Combine game name and category game title
                    'category_game.id as category_game_id', // Return category_game.id instead of category_id or game_id
                    'games.image', // Include game image
                    'category_game.title', // Return title from category_game
                )
                ->limit(10) // Limit the number of results
                ->get();
        } else {
            // Default behavior when no query is provided
            $results = DB::table('category_game')
                ->join('games', 'category_game.game_id', '=', 'games.id')
                ->join('categories', 'category_game.category_id', '=', 'categories.id')
                ->whereIn('category_game.id', function ($query) {
                    $query->selectRaw('MIN(id)')
                          ->from('category_game')
                          ->groupBy('game_id');
                })
                ->select(
                    DB::raw("CONCAT(games.name, ' ', category_game.title) as name"),
                    'category_game.id as category_game_id', // Return category_game.id instead
                    'games.image',
                    'category_game.title',
                )
                ->limit(8) // Limit the number of results
                ->get();
        }
    
        // Map results to return in the desired format
        $mapped = $results->map(function ($item) {
            return [
                'name' => $item->name, // Combined name of game and category game title
                'image' => asset(($item->image ?? 'default.png')), // Fallback image if none exists
                'link' => route('catalog.index', [$item->category_game_id]) // Pass category_game_id for route
            ];
        });
        
        return response()->json($mapped);
    }
    
    
}
