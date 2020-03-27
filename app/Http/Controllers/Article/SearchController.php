<?php

namespace App\Http\Controllers\Article;

use App\Article;
use App\Http\Controllers\Controller;
use App\Skill;
use App\Skill_pivot;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function GuzzleHttp\Psr7\str;

class SearchController extends Controller
{

    /**
     * Instanciation Article
     *
     * @var Article
     */
    protected Article $article;

    /**
     * Constructeur
     * .
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Résultat de la recherche
     *
     * @param Request $request
     * @return array|int
     */
    public function search(Request $request)
    {
        $articles = '';
        $error = ['error' => 'Aucun résultat.'];

        if($request->has('all') || $request->has('article_title') ||  $request->has('category_id') || $request->has('tags')) {

            // Plan algolia dépassé, en faire part à dimitri
            if($request->has('all')) {
                $articles = $this->article->search($request->input('all'))->get();
                $search = $request->input('all');
            }
            if($request->only('category_id')) {
                $articles = $this->article->where('category_id', $request->input('category_id'))->get();
                $search = $request->input('category_id');
            }
            // TODO: Finir la recherche par article
            if($request->has('category_id') && $request->has('article_title')) {
                $articles_category = $this->article->where('category_id', $request->input('category_id'));
                $articles = $articles_category->where('title', $request->input('article_title'))->get();
            }
            if($request->has('tags')) {
                $articles = Article::withAnyTag($request->input('tags'))->get();
                $search = $request->input('tags');
            }
            return $articles->count() ? view('article.search.result', compact(['articles', 'search'])) : $error;
        }

        if($request->has('question')) {

            /* On rend chaque terme de la question unique
            $terms = array_filter(
                array_map(
                    'trim',
                    preg_split("/[\s,\d?%*ù$]+/", $request->input('question'))
                )
            );*/

            /*$sub = substr($terms[0], 0, -3);
            dd($sub);
            //dd(Skill::query()->where('name', 'LIKE',  . "%")->get());
            for ($i = 0; $i < count($terms); $i++) {
                $skill_count = Skill::where('name', 'LIKE', '%' . $terms[$i] . '%')->get();
                if (count($skill_count) > 0) {
                    $count++;
                }
            }*/

            // On récupére la catégorie
            $skills_request = $request->input('skills');

            $skill_id = Skill::where('name', $skills_request)->get('id');

            $count = 0;
            $agents[] = '';
            foreach ($skill_id as $skill) {
                foreach (Skill_pivot::where('skill_id', $skill->id)->get() as $skill_value) {
                    $agents[] = User::where('id', $skill_value->user_id)->get();
                    $count++;
                }
            }
            array_shift($agents);

            // TODO: implémenter avec les termes
            return view('question-answer', compact('agents'));
        }

    }

}
