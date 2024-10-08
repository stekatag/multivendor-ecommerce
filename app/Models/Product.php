<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory() {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function childCategory() {
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }
}
