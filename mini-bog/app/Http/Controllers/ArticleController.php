<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['category_id']);
        $articles = $this->articleService->getAllArticles($filters);
        $categories = $this->articleService->getAllCategories();

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->articleService->deleteArticle($id);

        if ($deleted) {
            return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
        }

        return redirect()->route('articles.index')->with('error', 'Article not found.');
    }
}
