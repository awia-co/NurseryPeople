<?php

namespace App\Http\Controllers;

use App\Models\PlantCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PlantCategory  $plantCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(PlantCategory $plantCategory)
    {
        $plants = $plantCategory->plants()->paginate(25);

        return view(
            'plants.categories.show',
            [
                'plants' => $plants,
                'category' => $plantCategory,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PlantCategory  $plantCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PlantCategory $plantCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlantCategory  $plantCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlantCategory $plantCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlantCategory  $plantCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlantCategory $plantCategory)
    {
        //
    }
}
