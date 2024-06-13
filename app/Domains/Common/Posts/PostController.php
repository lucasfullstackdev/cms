<?php

namespace App\Domains\Common\Posts;

use App\Domains\Common\Posts\Dtos\{PostFilters, PostReceived, PostStatusReceived, PostTagsReceived};
use App\Domains\Common\Posts\Requests\{Store, Update, UpdateStatus, UpdateTags};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function __construct(private PostService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json(
            $this->service->index(
                new PostFilters(
                    tags: $request->tags
                )
            ),
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        return response()->json([
            'message' => 'Post Status created successfully',
            'data' => $this->service->store(
                $this->postReceived($request)
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
            'data' => $this->service->update($this->postReceived($request), $id)
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

    public function updateTags(UpdateTags $request, string $id)
    {
        return response()->json([
            'message' => 'Post Tags updated successfully',
            'data' => $this->service->updateTags(
                new PostTagsReceived(
                    tags: $request->tags
                ),
                $id
            )
        ], Response::HTTP_OK);
    }

    public function updateStatus(UpdateStatus $request, string $id)
    {
        return response()->json([
            'message' => 'Post Status updated successfully',
            'data' => $this->service->updateStatus(
                new PostStatusReceived(
                    status_id: $request->status_id
                ),
                $id
            )
        ], Response::HTTP_OK);
    }

    private function postReceived(Request $request): PostReceived
    {
        return new PostReceived(
            title: $request->title,
            content: $request->content,
            status_id: $request->status_id,
            tags: $request->tags
        );
    }
}
