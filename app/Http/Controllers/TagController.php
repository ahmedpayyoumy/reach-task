<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Interfaces\TagRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TagController extends Controller
{
    private $tagRepo;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepo = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : JsonResponse
    {
        return response()->json([
            'data' => $this->tagRepo->getAllTags()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request) :JsonResponse
    {
        return response()->json(
            [
                'data' => $this->tagRepo->createTag($request->validated()),
                'message' => 'Created Successfully!'
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) :JsonResponse
    {
        return response()->json(
            [
                'data' => $this->tagRepo->getTagById($id),
                'message' => 'Success!'
            ],
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id) :JsonResponse
    {
        return response()->json(
            [
                'data' => $this->tagRepo->updateTag($id, $request->validated()),
                'message' => 'Updated Successfully!'
            ],
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) :JsonResponse
    {
        return response()->json(
            [
                'data' => $this->tagRepo->deleteTag($id),
                'message' => 'Deleted Successfully!'
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
