<?php

namespace Modules\LetterComponent\Http\Controller\Backend;

use App\Enums\FlagType;
use App\Http\Controllers\Controller;
use App\Models\FragranceType;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\LetterComponent\Action\FragranceType\CreateFragranceTypeAction;
use Modules\LetterComponent\Action\FragranceType\DeleteFragranceTypeAction;
use Modules\LetterComponent\Action\FragranceType\SearchFragranceTypeAction;
use Modules\LetterComponent\Action\FragranceType\UpdateFragranceTypeAction;
use Modules\LetterComponent\Contract\FragranceTypeServiceInterface;
use Modules\LetterComponent\Http\Request\Backend\FragranceType\StoreFragranceTypeRequest;
use Modules\LetterComponent\Http\Request\Backend\FragranceType\UpdateFragranceTypeRequest;
use Modules\LetterComponent\Http\Resource\Backend\FragranceTypeBackendResource;
use Throwable;

class FragranceTypeController extends Controller
{
    public function __construct(
        protected SearchFragranceTypeAction $searchFragranceTypeAction,
        protected CreateFragranceTypeAction $createFragranceTypeAction,
        protected UpdateFragranceTypeAction $updateFragranceTypeAction,
        protected DeleteFragranceTypeAction $deleteFragranceTypeAction,
        protected FragranceTypeServiceInterface $fragranceTypeService
    ) {}

    public const parentPath = 'FragranceType';

    public const indexPath = self::parentPath . '/Index';

    public const editPath = self::parentPath . '/Edit';

    public const createPath = self::parentPath . '/Create';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $fragranceTypes = $this->searchFragranceTypeAction->handle($request);

            return Inertia::render(self::indexPath, [
                'fragranceTypes' => FragranceTypeBackendResource::collection($fragranceTypes)
            ]);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return Inertia::render(self::createPath);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFragranceTypeRequest $request)
    {
        try {
            $this->createFragranceTypeAction->handle($request);

            return redirectView('fragrance-types.index', 'Fragrance type created successfully!', FlagType::SUCCESS);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $fragranceType = $this->fragranceTypeService->get($id, [FragranceType::images]);

            return Inertia::render(self::editPath, [
                'fragranceType' => new FragranceTypeBackendResource($fragranceType)
            ]);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFragranceTypeRequest $request, string $id)
    {
        try {
            $this->updateFragranceTypeAction->handle($request, $id);

            return redirectView('fragrance-types.index', 'Fragrance type updated successfully!', FlagType::SUCCESS);
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
            $name = $this->deleteFragranceTypeAction->handle($id);

            return redirectView('fragrance-types.index', "$name deleted successfully!", FlagType::SUCCESS);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }
}
