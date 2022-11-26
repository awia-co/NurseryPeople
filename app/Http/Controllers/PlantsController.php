<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $plants = Plant::where('is_published', true)->withCount(['companies'])->orderBy('companies_count', 'desc')->paginate(25);

        return view('plants.index', ['plants' => $plants]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Plant::create($this->validatePlant($request));

        return redirect(route('plants.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Plant $plant
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Plant $plant)
    {
        $companies = $plant->companies()
            ->orderBy('is_featured', 'desc')
            ->paginate('10');

        return view('plants.show', [
            'plant' => $plant,
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Plant $plant
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Company $company)
    {
        $this->authorize('update', $company);

        if ($company->isNursery()) {
            return view('user.edit_company_plants', compact('company'));
        } else {
            return response('Page not found.', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Plant $plant
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Plant $plant)
    {
        $plant->update($this->validatePlant($request));

        return redirect(route('plants.show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Plant $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plant $plant)
    {
        //
    }

    protected function validatePlant($request)
    {
        return $request->validate([
            'name' => 'required',
        ]);
    }
}
