<?php

namespace Modules\Location\Http\Controller\Backend;

use App\Enums\FlagType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Location\Action\Country\CreateCountryAction;
use Modules\Location\Action\Country\DeleteCountryAction;
use Modules\Location\Action\Country\SearchCountryAction;
use Modules\Location\Action\Country\UpdateCountryAction;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Location\Http\Request\Backend\Country\StoreCountryRequest;
use Modules\Location\Http\Request\Backend\Country\UpdateCountryRequest;
use Modules\Location\Http\Resource\Backend\CountryBackendResource;
use Throwable;

class CountryController extends Controller
{
    public function __construct(
        protected SearchCountryAction $searchCountryAction,
        protected CreateCountryAction $createCountryAction,
        protected UpdateCountryAction $updateCountryAction,
        protected DeleteCountryAction $deleteCountryAction,
        protected CountryServiceInterface $countryService
    ) {}

    public const parentPath = 'Country';

    public const indexPath = self::parentPath . '/Index';

    public const editPath = self::parentPath . '/Edit';

    public const createPath = self::parentPath . '/Create';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $countries = $this->searchCountryAction->handle($request);

            return Inertia::render(self::indexPath, [
                'countries' => CountryBackendResource::collection($countries)
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
    public function store(StoreCountryRequest $request)
    {
        try {
            $this->createCountryAction->handle($request);

            return redirectView('countries.index', 'Country created successfully!', FlagType::SUCCESS);
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
            $country = $this->countryService->get($id);

            return Inertia::render(self::editPath, [
                'country' => new CountryBackendResource($country)
            ]);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, string $id)
    {
        try {
            $this->updateCountryAction->handle($request, $id);

            return redirectView('countries.index', 'Country updated successfully!', FlagType::SUCCESS);
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
            $name = $this->deleteCountryAction->handle($id);

            return redirectView('countries.index', "$name deleted successfully!", FlagType::SUCCESS);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }
}
