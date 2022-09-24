<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdRequest;
use App\Interfaces\AdRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psy\Util\Json;

class AdController extends Controller
{

    private $adRepo;

    public function __construct(AdRepositoryInterface $adRepo)
    {
        $this->adRepo = $adRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() :JsonResponse
    {
        return response()->json([
            'data' => $this->adRepo->getAllAds()
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
    public function store(AdRequest $request) :JsonResponse
    {
        return response()->json(
            [
                'data' => $this->adRepo->createAd($request->validated()),
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
                'data' => $this->adRepo->getAdById($id),
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
    public function update(AdRequest $request, $id) :JsonResponse
    {
        return response()->json(
            [
                'data' => $this->adRepo->updateAd($id, $request->validated()),
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
                'data' => $this->adRepo->deleteAd($id),
                'message' => 'Deleted Successfully!'
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
