<?php

namespace Modules\Letter\Http\Controller\Api\V1;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Letter\Action\Letter\CreateLetterAction;
use Modules\Letter\Action\Letter\DeleteLetterAction;
use Modules\Letter\Action\Letter\SearchLetterAction;
use Modules\Letter\Action\Letter\UpdateLetterAction;
use Modules\Letter\Contract\LetterServiceInterface;
use Modules\Letter\Http\Request\Api\Letter\StoreLetterApiRequest;
use Modules\Letter\Http\Request\Api\Letter\UpdateLetterApiRequest;
use Modules\Letter\Http\Resource\Api\V1\LetterApiResource;

class LetterApiController extends Controller
{
    public function __construct(
        protected SearchLetterAction $searchLetterAction,
        protected CreateLetterAction $createLetterAction,
        protected UpdateLetterAction $updateLetterAction,
        protected DeleteLetterAction $deleteLetterAction,
        protected LetterServiceInterface $letterService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $letters = $this->searchLetterAction->handle($request);

            return LetterApiResource::collection($letters);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLetterApiRequest $request)
    {
        try {
            $letter = $this->createLetterAction->handle($request);

            return new LetterApiResource($letter);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $letter = $this->letterService->get($id);

            return new LetterApiResource($letter);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLetterApiRequest $request, string $id)
    {
        try {
            $letter = $this->updateLetterAction->handle($request, $id);

            return new LetterApiResource($letter);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $letterName = $this->deleteLetterAction->handle($id);

            return response()->json($letterName);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }
}
