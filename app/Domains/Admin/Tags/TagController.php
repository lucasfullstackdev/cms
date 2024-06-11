<?php

namespace App\Domains\Admin\Tags;

use App\Domains\Admin\Tags\Dtos\TagReceived;
use App\Domains\Admin\Tags\Requests\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        dd('Hello from TagController@show');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd('Hello from TagController@update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd('Hello from TagController@destroy');
    }
}
