<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_parts');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
