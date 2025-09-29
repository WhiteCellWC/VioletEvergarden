<?php

namespace Modules\LetterComponent\Http\Controller\Backend;

use App\Enums\FlagType;
use App\Http\Controllers\Controller;
use App\Models\PaperType;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\LetterComponent\Action\PaperType\CreatePaperTypeAction;
use Modules\LetterComponent\Action\PaperType\DeletePaperTypeAction;
use Modules\LetterComponent\Action\PaperType\SearchPaperTypeAction;
use Modules\LetterComponent\Action\PaperType\UpdatePaperTypeAction;
use Modules\LetterComponent\Contract\PaperTypeServiceInterface;
use Modules\LetterComponent\Http\Request\Backend\PaperType\StorePaperTypeRequest;
use Modules\LetterComponent\Http\Request\Backend\PaperType\UpdatePaperTypeRequest;
use Modules\LetterComponent\Http\Resource\Backend\PaperTypeBackendResource;
use Throwable;

class PaperTypeController extends Controller
{
    public function __construct(
        protected SearchPaperTypeAction $searchPaperTypeAction,
        protected CreatePaperTypeAction $createPaperTypeAction,
        protected UpdatePaperTypeAction $updatePaperTypeAction,
        protected DeletePaperTypeAction $deletePaperTypeAction,
        protected PaperTypeServiceInterface $paperTypeService
    ) {}

    public const parentPath = 'PaperType';

    public const indexPath = self::parentPath . '/Index';

    public const editPath = self::parentPath . '/Edit';

    public const createPath = self::parentPath . '/Create';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $paperTypes = $this->searchPaperTypeAction->handle($request);

            return Inertia::render(self::indexPath, [
                'paperTypes' => PaperTypeBackendResource::collection($paperTypes)
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
    public function store(StorePaperTypeRequest $request)
    {
        try {
            $this->createPaperTypeAction->handle($request);

            return redirectView('paper-types.index', 'Paper type created successfully!', FlagType::SUCCESS);
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
            $paperType = $this->paperTypeService->get($id, [PaperType::images]);

            return Inertia::render(self::editPath, [
                'paperType' => new PaperTypeBackendResource($paperType)
            ]);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaperTypeRequest $request, string $id)
    {
        try {
            $this->updatePaperTypeAction->handle($request, $id);

            return redirectView('paper-types.index', 'Paper type updated successfully!', FlagType::SUCCESS);
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
            $name = $this->deletePaperTypeAction->handle($id);

            return redirectView('paper-types.index', "$name deleted successfully!", FlagType::SUCCESS);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }
}
