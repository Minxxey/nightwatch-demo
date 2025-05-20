<?php

namespace App\Http\Controllers;

use App\Exceptions\CandybarAlreadyExistsException;
use App\Http\Requests\StoreCandybarRequest;
use App\Http\Requests\UpdateCandybarRequest;
use App\Jobs\LogCandybarDeletionJob;
use App\Models\Candybar;

class CandybarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Candybar::all()->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCandybarRequest $request)
    {
        $validated = $request->validated();
        $candybar = Candybar::where('name', $validated['name'])->first();

        if ($candybar) {
            throw new CandybarAlreadyExistsException("The candybar you're trying to create already exists", 409);
        }
        $candybar = Candybar::create($validated);

        return $candybar->id;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Candybar::where('id', $id)->first()->toJson();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandybarRequest $request, string $id)
    {
        $validated = $request->validated();
        $candybar = Candybar::where('id', $id)->first();
        $candybar->update($validated);

        return $candybar->refresh()->toJson();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $candybar = Candybar::where('id', $id)->first();
        $candybarName = $candybar->name;
        $candyBarDeleted = $candybar->delete();

        if($candyBarDeleted) {
            LogCandybarDeletionJob::dispatch(auth()->user(), $candybarName);
            return json_encode("Candybar {$candybar->name} was successfully deleted");
        }

        return json_encode('Something went wrong');
    }
}
