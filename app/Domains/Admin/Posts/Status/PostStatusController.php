<?php

namespace App\Domains\Admin\Posts\Status;

use App\Domains\Admin\Posts\Status\Dtos\PostStatusReceived;
use App\Domains\Admin\Posts\Status\Requests\{Store, Update};
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class PostStatusController extends Controller
{
    public function __construct(private PostStatusService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->service->index(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        return response()->json([
            'message' => 'Post Status created successfully',
            'data' => $this->service->store(
                new PostStatusReceived(
                    name: $request->name
                )
            )
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($this->service->show($id), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, string $id)
    {
        return response()->json([
            'message' => 'Post Status updated successfully',
            'data' => $this->service->update(
                new PostStatusReceived(
                    name: $request->name
                ),
                $id
            )
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            'message' => 'Post Status deleted successfully',
            'data' => $this->service->destroy($id)
        ], Response::HTTP_OK);
    }
}
