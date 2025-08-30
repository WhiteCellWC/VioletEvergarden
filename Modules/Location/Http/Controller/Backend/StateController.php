<?php

namespace Modules\Location\Http\Controller\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StateController extends Controller
{
    const parentPath = 'State';

    const indexPath = self::parentPath . '/Index';

    const editPath = self::parentPath . '/Edit';

    const createPath = self::parentPath . '/Create';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render(self::indexPath);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
