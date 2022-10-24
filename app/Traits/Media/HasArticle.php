<?php

namespace App\Traits\Media;

use App\Models\Article;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasArticle
{
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
