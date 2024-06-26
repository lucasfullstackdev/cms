<?php

namespace App\Domains\Admin\Tags;

use App\Domains\Admin\Tags\Dtos\TagReceived;
use App\Domains\Admin\Tags\Requests\{Store, Update};
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    public function __construct(private TagService $tagService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->tagService->index(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        return response()->json([
            'message' => 'Tag created successfully',
            'data' => $this->tagService->store(
                new TagReceived(
                    name: $request->name,
                    active: $request->active
                )
            )
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($this->tagService->show($id), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, string $id)
    {
        return response()->json([
            'message' => 'Tag updated successfully',
            'data' => $this->tagService->update(
                new TagReceived(
                    name: $request->name,
                    active: $request->active
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
            'message' => 'Tag deleted successfully',
            'data' => $this->tagService->destroy($id)
        ], Response::HTTP_OK);
    }

    public function inactivate(string $id)
    {
        return response()->json([
            'message' => 'Tag inactivated successfully',
            'data' => $this->tagService->inactivate($id)
        ], Response::HTTP_OK);
    }

    public function activate(string $id)
    {
        return response()->json([
            'message' => 'Tag activated successfully',
            'data' => $this->tagService->activate($id)
        ], Response::HTTP_OK);
    }
}
