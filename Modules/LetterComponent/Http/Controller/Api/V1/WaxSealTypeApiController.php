<?php

namespace Modules\LetterComponent\Http\Controller\Api\V1;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\LetterComponent\Action\WaxSealType\CreateWaxSealTypeAction;
use Modules\LetterComponent\Action\WaxSealType\DeleteWaxSealTypeAction;
use Modules\LetterComponent\Action\WaxSealType\SearchWaxSealTypeAction;
use Modules\LetterComponent\Action\WaxSealType\UpdateWaxSealTypeAction;
use Modules\LetterComponent\Contract\WaxSealTypeServiceInterface;
use Modules\LetterComponent\Http\Request\Api\V1\WaxSealType\StoreWaxSealTypeApiRequest;
use Modules\LetterComponent\Http\Request\Api\V1\WaxSealType\UpdateWaxSealTypeApiRequest;
use Modules\LetterComponent\Http\Resource\Api\V1\WaxSealTypeApiResource;

class WaxSealTypeApiController extends Controller
{
    public function __construct(
        protected SearchWaxSealTypeAction $searchWaxSealTypeAction,
        protected CreateWaxSealTypeAction $createWaxSealTypeAction,
        protected UpdateWaxSealTypeAction $updateWaxSealTypeAction,
        protected DeleteWaxSealTypeAction $deleteWaxSealTypeAction,
        protected WaxSealTypeServiceInterface $waxSealTypeService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $waxSealTypes = $this->searchWaxSealTypeAction->handle($request);

            return WaxSealTypeApiResource::collection($waxSealTypes);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWaxSealTypeApiRequest $request)
    {
        try {
            $waxSealType = $this->createWaxSealTypeAction->handle($request);

            return new WaxSealTypeApiResource($waxSealType);
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
            $waxSealType = $this->waxSealTypeService->get($id);

            return new WaxSealTypeApiResource($waxSealType);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWaxSealTypeApiRequest $request, string $id)
    {
        try {
            $waxSealType = $this->updateWaxSealTypeAction->handle($request, $id);

            return new WaxSealTypeApiResource($waxSealType);
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
            $waxSealTypeName = $this->deleteWaxSealTypeAction->handle($id);

            return response()->json($waxSealTypeName);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }
}
