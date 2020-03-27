<?php

namespace App\Http\Controllers\Article;

use App\Category;
use App\Http\Controllers\Controller;
use App\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CategoryController extends Controller
{

    /**
     * Instanciation Article
     *
     * @var Article
     */
    protected Article $article;

    /**
     * Instanciation Catégorie
     *
     * @var Category
     */
    protected Category $category;

    /**
     * Constructeur
     *
     * @param Article $article
     * @param Category $category
     */
    public function __construct(Article $article, Category $category)
    {
        $this->article = $article;
        $this->category = $category;
    }

    /**
     * Page catégorie
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $articles = $this->article->where('category_id', $request->category_id)->get();
        return view('category.index', compact('articles'));
    }

    /**
     * Page de création d'une catégorie
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Création de la catégorie
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:500'
        ]);
        $this->category->create($request->all());
        return redirect(route('article.index'));
    }

    /**
     * Édition d'une catégorie
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $category = $this->category->findOrFail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Modification d'une catégorie
     *
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request)
    {
        $category = $this->category->findOrFail($id);
        $category->update($request->all());

        return redirect()->route('admin.index')
            ->with('success','Product updated successfully');
    }

    /**
     * Suppression d'une catégorie
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();
        return redirect()->route('admin.index')
            ->with('success', 'Catégorie supprimé');
    }

}
