<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller {

    /**
     * Instanciation du modèle Article
     *
     * @var Article
     */
    protected Article $article;

    /**
     * Constructeur
     *
     * ArticleController constructor.
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Page principale
     *
     * @return Factory|View
     */
    public function index(): View
    {
        return view('article.index');
    }

    /**
     * Page de création d'un post
     *
     * @return Factory|View
     */
    public function create(): View
    {
        return view('article.create');
    }

    /**
     * Sauvegarde d'un nouveau post
     *
     * @param ArticleRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(ArticleRequest $request): RedirectResponse
    {
        $article = $this->article;
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->slug = Str::slug($request->input('title'));
        $article->user_id = Auth::user()->id;
        $article->category_id = $request->input('category_id');
        $article->image = $request->input('image');
        $article->save();
        $article->tag(explode(',', $request->input('tags')));
        $article->save();

        return redirect(route('home') . '/article/' . Article::all()->last()->id . '/' . Article::all()->last()->slug);
    }

    /**
     * Affichage d'un post
     *
     * @param $id
     * @param $slug
     * @return Factory|View|void
     */
    public function show($id, $slug): View
    {
        $articles = $this->article->where([
            'id' => $id,
            'slug' => $slug
        ])->get();

        return view('article.show', compact('articles', $articles));
    }

    /**
     * Page d'édition d'un post
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id): View
    {
        $article = $this->article->findOrFail($id);
        return view('article.edit', compact('article'));
    }

    /**
     * Mise à jour d'un post
     *
     * @param int $id
     * @param ArticleRequest $request
     * @return Factory|View
     */
    public function update(int $id, ArticleRequest $request): View
    {
        $article = $this->article->findOrFail($id);
        $article->slug = Str::slug($request->input('title'));
        $article->retag($request->input('tags'));
        $article->update($request->all());

        return redirect()->back()->with('success', 'Article modifié');
    }

    /**
     * Supprime un post
     *
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id): RedirectResponse
    {
        $article = $this->article->findOrFail($id);
        $article->delete();

        return redirect(route('article.index'));
    }

}
