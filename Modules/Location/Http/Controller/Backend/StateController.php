<?php

namespace Modules\Location\Http\Controller\Backend;

use App\Constant\Constant;
use App\Enums\FlagType;
use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Location\Action\State\CreateStateAction;
use Modules\Location\Action\State\SearchStateAction;
use Modules\Location\Http\Request\Backend\State\StoreStateRequest;
use Modules\Location\Http\Resource\Backend\StateBackendResource;
use Throwable;

class StateController extends Controller
{
    public function __construct(
        protected SearchStateAction $searchStateAction,
        protected CreateStateAction $createStateAction
    ) {}

    public const parentPath = 'State';

    public const indexPath = self::parentPath . '/Index';

    public const editPath = self::parentPath . '/Edit';

    public const createPath = self::parentPath . '/Create';

    protected $backendRelation = [State::country];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $states = $this->searchStateAction->handle($request, $this->backendRelation);

            return Inertia::render(self::indexPath, [
                'states' => StateBackendResource::collection($states)
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
    public function store(StoreStateRequest $request)
    {
        try {
            $this->createStateAction->handle($request);

            return redirectView('states.index', 'State created successfully!', FlagType::SUCCESS);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
