<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    use HasFactory;
    
    public function articles():BelongsToMany{
        return $this->belongsToMany(Article::class);
    }
}
