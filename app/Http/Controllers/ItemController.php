<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Game;
use App\Models\Attribute;
use App\Models\ItemAttribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function create()
    {
        $categories = Category::with('games')->get();

        return view('frontend.items_create', compact('categories'));
    }

    public function index()
    {
        $categories = Category::all();
        return view('frontend.items_create', compact('categories'));
    }

    public function getGames(Request $request)
    {
        $games = Game::whereHas('categories', function ($query) use ($request) {
            $query->where('categories.id', $request->category_id);
        })->get();

        return response()->json(['games' => $games]);
    }

    // public function getAttributes(Request $request)
    // {
    //     // dd($request->all());
    //     $attributes = Attribute::where(function ($query) use ($request) {
    //         if ($request->category_id) {
    //             $query->where('category_id', $request->category_id);
    //         }
    //         if ($request->game_id) {
    //             $query->orWhere('game_id', $request->game_id);
    //         }
    //     })->get();
    //     // dd($attributes);
    //     return response()->json(['attributes' => $attributes]);
    // }
    
    public function getAttributes(Request $request)
    {
        $categoryId = $request->category_id;
        $gameId = $request->game_id;
        
        $attributes = Attribute::when($categoryId, function ($query) use ($categoryId) {
                return $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('category_id', $categoryId);
                });
            })
            ->when($gameId, function ($query) use ($gameId) {
                return $query->whereHas('games', function ($q) use ($gameId) {
                    $q->where('game_id', $gameId);
                });
            })
            ->get();
        
        // Group attributes by applies_to
        $gameAttributes = $attributes->where('applies_to', 1)->values();
        $categoryAttributes = $attributes->where('applies_to', 2)->values();
        
        return response()->json([
            'gameAttributes' => $gameAttributes,
            'categoryAttributes' => $categoryAttributes,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        
        // Validate the input
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'game_id' => 'nullable|exists:games,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp,bmp,svg|max:2048',
            'feature_image' => 'required|string', // Ensure feature image is provided
        ]);

        // Handle image uploads
        $imagePaths = [];
        $featureImagePath = null; // Initialize feature image path

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $randomNumber = rand(1, 99999); // Generate one random number for all images
                $filename = time() . '.' . $randomNumber . '.' . pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $filePath = 'uploads/items/' . $filename;
                $image->move(public_path('uploads/items'), $filename);
                $imagePaths[] = $filePath;

                // Check if this image matches the selected feature image
                if ($request->feature_image == $image->getClientOriginalName()) {
                    $featureImagePath = $filePath;
                }

                // If feature_image is still null, assign the first uploaded image
                if ($index === 0 && $featureImagePath === null) {
                    $featureImagePath = $filePath;
                }
            }
        }

        // Save item to database
        $item = Item::create([
            'category_id' => $request->category_id,
            'game_id' => $request->game_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'images' => json_encode($imagePaths), // Store all images in JSON format
            'feature_image' => $featureImagePath, // Set feature image from input
            'seller_id' => Auth::id(),
        ]);

        // Save attributes dynamically First Method
        $attributes = [];
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'attribute_')) {
                $attributeId = str_replace('attribute_', '', $key);
                $attributes[] = [
                    'item_id' => $item->id,
                    'attribute_id' => $attributeId, // Extracted from input name
                    'value' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($attributes)) {
            ItemAttribute::insert($attributes);
        }
        
        // Save attributes dynamically Second Method
        // foreach ($request->except(['_token', 'title', 'description', 'price', 'images', 'category_id', 'game_id', 'seller_id', 'feature_image']) as $key => $value) {
        //     if (str_starts_with($key, 'attribute_')) {
        //         $attributeId = str_replace('attribute_', '', $key);
        //         ItemAttribute::create([
        //             'item_id' => $item->id,
        //             'attribute_id' => $attributeId,
        //             'value' => $value
        //         ]);
        //     }
        // }

        return redirect()->back()->with('success', 'Item created successfully!');
    }

    public function show(Item $item)
    {
        return view('frontend.seller.items_show', compact('item'));
    }
}





