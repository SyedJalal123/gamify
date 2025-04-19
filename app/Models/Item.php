<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['seller_id','category_id', 'game_id', 'title', 'description', 'price', 'delivery_type', 'images', 'feature_image'];

    protected $casts = [
        'images' => 'array',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'item_attributes')
                    ->withPivot('value') // If you have extra column(s) in pivot
                    ->withTimestamps();   // If you have timestamps in pivot
    }
}
