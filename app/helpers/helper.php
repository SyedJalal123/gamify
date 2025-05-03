<?php
use App\Models\Category;
use App\Models\Seller;
use Carbon\Carbon;

function categories(){
    $categories = Category::with('categoryGames.game')->get();
    return $categories;
}

function get_seller(){
    $seller = Seller::where('user_id', auth()->user()->id)->first();
    return $seller;
}


function shortTimeAgo($datetime) {
    $diff = Carbon::parse($datetime)->diff(Carbon::now());

    if ($diff->y > 0) return $diff->y . 'y';
    if ($diff->m > 0) return $diff->m . 'mo';
    if ($diff->d > 0) return $diff->d . 'd';
    if ($diff->h > 0) return $diff->h . 'h';
    if ($diff->i > 0) return $diff->i . 'min';
    return 'now';
}