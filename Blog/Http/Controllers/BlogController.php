<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Criteria\MyCriteria;
use Modules\Blog\Repositories\PostRepository;
use Modules\Blog\Requests\PostCreateRequest;
use Modules\Blog\Validators\PostValidator;

class BlogController extends Controller
{
    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * PostsController constructor.
     *
     * @param PostRepository $repository
     * @param PostValidator $validator
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        //$this->repository->setPresenter(PostPresenter::class);
        $posts = $this->repository->paginate(15, ['id', 'title', 'body', 'image', 'created_at']);

        if (request()->wantsJson()) {
            return response()->json($posts);
        }

        return view('blog::index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param PostCreateRequest $request
     * @return void
     */
    public function store(PostCreateRequest $request)
    {
        $this->repository->create($request->all());

        return response()->json([
            'data' => [],
            'meta' => [
                'message' => 'Post created.'
            ]
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $this->repository->pushCriteria(MyCriteria::class);
        $post = $this->repository->with(['user'])->skipPresenter()->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $post,
            ]);
        }

        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('blog::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
