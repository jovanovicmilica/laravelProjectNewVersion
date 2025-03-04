<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parts()
    {
        return $this->hasMany(Part::class, 'category_id');
    }
}
