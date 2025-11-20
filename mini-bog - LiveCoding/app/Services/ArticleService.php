<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    public function getAllArticles(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = Article::with('category')->latest();

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        return $query->paginate($perPage);
    }

    public function deleteArticle(int $id): bool
    {
        $article = Article::find($id);

        if (!$article) {
            return false;
        }

        return $article->delete();
    }

    public function getAllCategories()
    {
        return Category::all();
    }
}
