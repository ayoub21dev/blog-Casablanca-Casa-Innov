<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'slug', 'excerpt', 'user_id', 'category_id', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

public function user():BelongsTo{
return $this->belongsTo(User::class);
}


 public function tags():BelongsToMany{
    return $this->belongsToMany(Tag::class);
 }
}
