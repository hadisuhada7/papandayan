<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy('id')->get();
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }
            
            $newDataRecord = Article::create($validated);
        });
        
        return redirect()->route('admin.articles.index')->with('toast', ['type' => 'success', 'message' => 'Article created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        // Closure-based transaction
        DB::transaction(function () use ($request, $article) {
            $validated = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $article->update($validated);
        });

        return redirect()->route('admin.articles.index')->with('toast', ['type' => 'success', 'message' => 'Article updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // Closure-based transaction
        DB::transaction(function () use ($article) {
            $article->delete();
        });
        
        return redirect()->route('admin.articles.index')->with('toast', ['type' => 'success', 'message' => 'Article deleted successfully.']);
    }
}
