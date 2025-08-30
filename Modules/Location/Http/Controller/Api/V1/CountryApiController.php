<?php

namespace Modules\Location\Http\Controller\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Location\Action\CreateCountryAction;
use Modules\Location\Contract\CountryServiceInterface;
use Modules\Location\Http\Request\StoreCountryApiRequest;
use Modules\Location\Http\Resource\Api\V1\CountryApiResource;
use Throwable;

class CountryApiController extends Controller
{
    public function __construct(
        protected CreateCountryAction $createCountryAction,
        protected CountryServiceInterface $countryService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        }
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
