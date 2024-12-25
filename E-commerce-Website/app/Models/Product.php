<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    public function brand():BelongsTo
    {
        return $this->BelongsTo(Brand::class);
    }

    public function category():BelongsTo
    {
      return $this->BelongsTo(Category::class);
    }
}
