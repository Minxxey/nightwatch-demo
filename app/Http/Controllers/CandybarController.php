<?php

namespace App\Http\Controllers;

use App\Exceptions\CandybarAlreadyExistsException;
use App\Http\Requests\StoreCandybarRequest;
use App\Http\Requests\UpdateCandybarRequest;
use App\Jobs\LogCandybarDeletionJob;
use App\Jobs\NotifyAdminAboutCandybarFailureJob;
use App\Models\Candybar;
use Illuminate\Support\Facades\Log;

class CandybarController extends Controller
{
    /**
     * Display a listing of tall candybars with their ratings + tags.
     */
    public function index()
    {
        $candybars = Candybar::all();

        foreach ($candybars as $candybar) {
            $ratings = $candybar->ratings;
            $tags    = $candybar->tags;

            $avg = $ratings->pluck('score')->avg();
            $candybar->setAttribute('avg_rating', $avg);

            foreach ($ratings as $rating) {
                $user = $rating->user;
                $rating->setAttribute('user_info', [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                ]);
            }

            $candybar->setAttribute('ratings', $ratings);
            $candybar->setAttribute('tags', $tags);
        }

        $candybars->load(['ratings.user', 'tags.category']);

        return response()->json($candybars);

        /*$candybars = Candybar::with(['ratings.user'])->get();

        return response()->json($candybars);*/
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCandybarRequest $request)
    {
        $validated = $request->validated();
        $candybar = null;

        try {
            $candybar = Candybar::create(
                $validated
            );

            return response()->json(['id' => $candybar->id], 201);

        } catch (\Exception $e) {

            Log::info("Tried creating new Candybar {$validated['name']}");
            NotifyAdminAboutCandybarFailureJob::dispatchIf(!empty($validated['name']), $validated['name'], $e->getMessage());

            return response()->json([
                'message' => 'Failed to create candybar',
                'error' => $e->getMessage(),
            ], 500);
        }
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

        if ($candyBarDeleted) {
            LogCandybarDeletionJob::dispatch(auth()->user(), $candybarName);
            return json_encode("Candybar {$candybarName} was successfully deleted");
        }

        return json_encode('Something went wrong');
    }
}
