<?php

namespace Modules\Location\Http\Controller\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Location\Action\Country\CreateCountryAction;
use Modules\Location\Action\Country\DeleteCountryAction;
use Modules\Location\Action\Country\SearchCountryAction;
use Modules\Location\Action\Country\UpdateCountryAction;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Location\Http\Request\Api\V1\Country\StoreCountryApiRequest;
use Modules\Location\Http\Request\Api\V1\Country\UpdateCountryApiRequest;
use Modules\Location\Http\Resource\Api\V1\CountryApiResource;
use Throwable;

class CountryApiController extends Controller
{
    public function __construct(
        protected SearchCountryAction $searchCountryAction,
        protected CreateCountryAction $createCountryAction,
        protected UpdateCountryAction $updateCountryAction,
        protected DeleteCountryAction $deleteCountryAction,
        protected CountryServiceInterface $countryService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $countries = $this->searchCountryAction->handle($request);

            $countriesResource = CountryApiResource::collection($countries);

            return response()->json($countriesResource);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryApiRequest $request)
    {
        try {
            $country = $this->createCountryAction->handle($request);

            $countryResource = new CountryApiResource($country);

            return response()->json($countryResource);
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
            $country = $this->countryService->get($id);

            $countryResource = new CountryApiResource($country);

            return response()->json($countryResource);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryApiRequest $request, string $id)
    {
        try {
            $country = $this->updateCountryAction->handle($request, $id);

            $countryResource = new CountryApiResource($country);

            return response()->json($countryResource);
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
            $countryName = $this->deleteCountryAction->handle($id);

            return response()->json($countryName);
        } catch (Throwable $e) {
            dd($e->getMessage());
        }
    }
}
