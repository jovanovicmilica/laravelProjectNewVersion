<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function parts()
    {
        return $this->belongsToMany(Part::class, 'supplier_parts');
    }
}
