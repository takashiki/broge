<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppPostsRequest;
use App\Http\Requests\UpdateAppPostsRequest;
use App\Repositories\AppPostsRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AppPostsController extends AppBaseController
{
    /** @var AppPostsRepository */
    private $appPostsRepository;

    public function __construct(AppPostsRepository $appPostsRepo)
    {
        $this->appPostsRepository = $appPostsRepo;
    }

    /**
     * Display a listing of the AppPosts.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->appPostsRepository->pushCriteria(new RequestCriteria($request));
        $appPosts = $this->appPostsRepository->all();

        return view('app_posts.index')
            ->with('appPosts', $appPosts);
    }

    /**
     * Show the form for creating a new AppPosts.
     *
     * @return Response
     */
    public function create()
    {
        return view('app_posts.create');
    }

    /**
     * Store a newly created AppPosts in storage.
     *
     * @param CreateAppPostsRequest $request
     *
     * @return Response
     */
    public function store(CreateAppPostsRequest $request)
    {
        $input = $request->all();

        $appPosts = $this->appPostsRepository->create($input);

        Flash::success('App Posts saved successfully.');

        return redirect(route('appPosts.index'));
    }

    /**
     * Display the specified AppPosts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appPosts = $this->appPostsRepository->findWithoutFail($id);

        if (empty($appPosts)) {
            Flash::error('App Posts not found');

            return redirect(route('appPosts.index'));
        }

        return view('app_posts.show')->with('appPosts', $appPosts);
    }

    /**
     * Show the form for editing the specified AppPosts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appPosts = $this->appPostsRepository->findWithoutFail($id);

        if (empty($appPosts)) {
            Flash::error('App Posts not found');

            return redirect(route('appPosts.index'));
        }

        return view('app_posts.edit')->with('appPosts', $appPosts);
    }

    /**
     * Update the specified AppPosts in storage.
     *
     * @param int                   $id
     * @param UpdateAppPostsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAppPostsRequest $request)
    {
        $appPosts = $this->appPostsRepository->findWithoutFail($id);

        if (empty($appPosts)) {
            Flash::error('App Posts not found');

            return redirect(route('appPosts.index'));
        }

        $appPosts = $this->appPostsRepository->update($request->all(), $id);

        Flash::success('App Posts updated successfully.');

        return redirect(route('appPosts.index'));
    }

    /**
     * Remove the specified AppPosts from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $appPosts = $this->appPostsRepository->findWithoutFail($id);

        if (empty($appPosts)) {
            Flash::error('App Posts not found');

            return redirect(route('appPosts.index'));
        }

        $this->appPostsRepository->delete($id);

        Flash::success('App Posts deleted successfully.');

        return redirect(route('appPosts.index'));
    }
}
