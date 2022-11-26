<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Plan;

class PlantsController extends Controller
{
    public function index()
    {
        $search = request('query');
        $plants = Plant::search($search)
            ->take(100)
            ->get();

        return  $plants;
    }

    public function update(Plant $plant, Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $plant->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        //Since we are looking for plants by slug, and the slug is being updated
        // (due to name change) we are finding the plant by id.
        $newPlant = DB::table('plants')
            ->where('id', $request->id)->get();

        return $newPlant->toJson(JSON_PRETTY_PRINT);
    }

    public function destroy(Plant $plant, Request $request)
    {
        $plant->delete();

        return response([], 204);
    }
}
