<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

public function user():BelongsTo{
return $this->belongsTo(User::class);
}


 public function tags():BelongsToMany{
    return $this->belongsToMany(Tag::class);
 }
}
