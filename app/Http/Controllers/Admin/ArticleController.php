<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ArticleController extends Controller
{
    protected $articleRepository;
    protected $tagRepository;

    /**
     * PostController constructor.
     *
     * @param ArticleRepository $articleRepository
     * @param TagRepository     $tagRepository
     */
    public function __construct(ArticleRepository $articleRepository, TagRepository $tagRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index(Request $request)
    {
        $this->articleRepository->pushCriteria(new RequestCriteria($request));
        $articles = $this->articleRepository->all();

        return view('admin.article.index', [
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        return view('admin.article.create', [
            'tags' => $this->tagRepository->all(),
        ]);
    }

    public function store(CreateArticleRequest $request)
    {
        $input = $request->all();

        $article = $this->articleRepository->create($input);

        if ($article) {
            Flash::success('Article saved successfully.');
        } else {
            Flash::error('Article saved unsuccessfully.');
        }

        return redirect(route('admin.article.index'));
    }

    public function edit($id)
    {
        $article = $this->articleRepository->find($id);

        return view('admin.article.edit')->with('article', $article);
    }

    /**
     * Update the specified article in storage.
     *
     * @param int                  $id
     * @param UpdatearticleRequest $request
     *
     * @return \Response
     */
    public function update($id, UpdateArticleRequest $request)
    {
        if ($this->articleRepository->update($request->all(), $id)) {
            Flash::success('Article updated successfully.');
        } else {
            Flash::error('Article updated unsuccessfully.');
        }

        return redirect(route('admin.article.index'));
    }

    /**
     * Remove the specified article from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $article = $this->articleRepository->find($id);

        if ($this->articleRepository->delete($id)) {
            Flash::success('Article deleted successfully.');
        } else {
            Flash::error('Article deleted unsuccessfully.');
        }

        return redirect(route('admin.article.index'));
    }
}
