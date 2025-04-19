<?php
use App\Models\Category;
use App\Models\Seller;

function categories(){
    $categories = Category::with('games')->get();
    return $categories;
}

function get_seller(){
    $seller = Seller::where('user_id', auth()->user()->id)->first();
    return $seller;
}