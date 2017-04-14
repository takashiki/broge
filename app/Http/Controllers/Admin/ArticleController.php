<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Post;
use App\Repositories\ArticleRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ArticleController extends Controller
{
    protected $articleRepository;

    /**
     * PostController constructor.
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
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
        return view('admin.article.create');
    }

    public function store(CreateArticleRequest $request)
    {
        $input = $request->all();
        $input['type'] = PostType::ARTICLE;

        if ($article = $this->articleRepository->create($input)) {
            /* @var Post|null $article */
            $article->tag($input['tags']);
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
        $input = $request->all();
        if ($article = $this->articleRepository->update($input, $id)) {
            /* @var Post|null $article */
            $article->tag($input['tags']);
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
        if ($this->articleRepository->find($id) && $this->articleRepository->delete($id)) {
            Flash::success('Article deleted successfully.');
        } else {
            Flash::error('Article deleted unsuccessfully.');
        }

        return redirect(route('admin.article.index'));
    }
}
