<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Filters\CompanyFilters;
use Auth;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'create', 'edit', 'update', 'destroy']);
    }

    public function index(CompanyFilters $filters)
    {
        if ($filters) {
            $companies = Company::filter($filters)->withCount(['plants'])->paginate(20);

            return view('companies.index', [
                'companies' => $companies,
            ]);
        }
        $companies = Company::latest()->where('is_published', true)
            ->orderBy('is_featured', 'desc')
            ->paginate(20);

        return view('companies.index', [
            'companies' => $companies,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nurseries()
    {
        $companies = Company::where('is_nursery', true)->where('is_published', true)
            ->orderBy('is_featured', 'desc')
            ->paginate(20);

        return view('companies.nurseries.index', [
            'companies' => $companies,
        ]);
    }

    public function suppliers()
    {
        $companies = Company::where('is_nursery', false)->where('is_published', true)
            ->orderBy('is_featured', 'desc')
            ->paginate(20);

        return view('companies.suppliers.index', [
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user/addcompany');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:4', 'max:255'],
                'description' => ['required', 'min::20'],
                'is_nursery' => ['required'],
            ]
        );
        $company = Company::create(
            [
                'name' => $request->name,
                'description' => $request->description,
                'is_nursery' => $request->is_nursery,
                'website' => $request->website,
                'availability_list' => $request->availability_list,
                'phone' => $request->phone,
                'email' => $request->email,
                'is_wholesale_only' => $request->is_wholesale_only,
                'main_location_id' => $request->main_location,
            ]
        );
        if ($request->ownership == true) {
            auth()->user()->companies()->attach($company->id);
        }

        return redirect('/settings/companies')->with('flash', 'Your company was successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Company $company)
    {
        $plants = $company->plants()->paginate(10);

        return view(
            'companies.show',
            [
                'company' => $company,
                'plants' => $plants,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Company $company)
    {
        return redirect('/companies');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);
        $validated = $request->validate(
            [
                'name' => ['required', 'min:4', 'max:255'],
                'description' => ['required', 'min::20'],
                'is_nursery' => ['required'],
            ]
        );
        $company->update(
            [
                'name' => $request->name,
                'description' => $request->description,
                'is_nursery' => $request->is_nursery,
                'website' => $request->website,
                'availability_list' => $request->availability_list,
                'phone' => $request->phone,
                'email' => $request->email,
                'is_wholesale_only' => $request->is_wholesale_only,
                'main_location_id' => $request->main_location,
            ]
        );

        return redirect()->back()->with('flash', 'Your company was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Company $company)
    {
        $this->authorize('update', $company);
        $company->delete();

        return redirect('/settings/companies')->with('flash', 'Your company was successfully deleted.');
    }
}
