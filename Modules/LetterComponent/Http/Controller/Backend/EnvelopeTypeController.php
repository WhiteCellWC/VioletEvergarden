<?php

namespace Modules\LetterComponent\Http\Controller\Backend;

use App\Enums\FlagType;
use App\Http\Controllers\Controller;
use App\Models\EnvelopeType;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\LetterComponent\Action\EnvelopeType\CreateEnvelopeTypeAction;
use Modules\LetterComponent\Action\EnvelopeType\DeleteEnvelopeTypeAction;
use Modules\LetterComponent\Action\EnvelopeType\SearchEnvelopeTypeAction;
use Modules\LetterComponent\Action\EnvelopeType\UpdateEnvelopeTypeAction;
use Modules\LetterComponent\Contract\EnvelopeTypeServiceInterface;
use Modules\LetterComponent\Http\Request\Backend\EnvelopeType\StoreEnvelopeTypeRequest;
use Modules\LetterComponent\Http\Request\Backend\EnvelopeType\UpdateEnvelopeTypeRequest;
use Modules\LetterComponent\Http\Resource\Backend\EnvelopeTypeBackendResource;
use Throwable;

class EnvelopeTypeController extends Controller
{
    public function __construct(
        protected SearchEnvelopeTypeAction $searchEnvelopeTypeAction,
        protected CreateEnvelopeTypeAction $createEnvelopeTypeAction,
        protected UpdateEnvelopeTypeAction $updateEnvelopeTypeAction,
        protected DeleteEnvelopeTypeAction $deleteEnvelopeTypeAction,
        protected EnvelopeTypeServiceInterface $envelopeTypeService
    ) {}

    public const parentPath = 'EnvelopeType';

    public const indexPath = self::parentPath . '/Index';

    public const editPath = self::parentPath . '/Edit';

    public const createPath = self::parentPath . '/Create';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $envelopeTypes = $this->searchEnvelopeTypeAction->handle($request);

            return Inertia::render(self::indexPath, [
                'envelopeTypes' => EnvelopeTypeBackendResource::collection($envelopeTypes)
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
    public function store(StoreEnvelopeTypeRequest $request)
    {
        try {
            $this->createEnvelopeTypeAction->handle($request);

            return redirectView('envelope-types.index', 'Envelope type created successfully!', FlagType::SUCCESS);
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
            $envelopeType = $this->envelopeTypeService->get($id, [EnvelopeType::images]);

            return Inertia::render(self::editPath, [
                'envelopeType' => new EnvelopeTypeBackendResource($envelopeType)
            ]);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnvelopeTypeRequest $request, string $id)
    {
        try {
            $this->updateEnvelopeTypeAction->handle($request, $id);

            return redirectView('envelope-types.index', 'Envelope type updated successfully!', FlagType::SUCCESS);
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
            $name = $this->deleteEnvelopeTypeAction->handle($id);

            return redirectView('envelope-types.index', "$name deleted successfully!", FlagType::SUCCESS);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }
}
