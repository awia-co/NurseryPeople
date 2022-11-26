<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request, Company $company)
    {
        $this->authorize('update', $company);
        $request->validate(
            [
                'city' => ['required', 'min:4', 'max:255'],
                'state_id' => ['required', 'exists:states,id'],
                'is_physical_location' => ['boolean'],
            ]
        );
        $location = $company->locations()->create(
            [
                'name' => $request->name,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'is_physical_location' => $request->is_physical_location,
                'city' => $request->city,
                'state_id' =>$request->state_id,
                'zip' => $request->zip,
            ]
        );
        if ($request->main_location == 1) {
            $company->mainLocation()->associate($location);
            $company->save();
        }

        return redirect()->back()->with('flash', 'Your location was successfully added!');
    }

    public function edit(Company $company)
    {
        $this->authorize('update', $company);

        return view('user.edit_company_locations', compact('company'));
    }

    public function update(Request $request, Company $company, Location $location)
    {
        $this->authorize('update', $company);
        $request->validate(
            [
                'city' => ['required', 'min:4', 'max:255'],
                'state_id' => ['required', 'exists:states,id'],
                'is_physical_location' => ['boolean'],
            ]
        );
        $location->update(
            [
                'name' => $request->name,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'is_physical_location' => $request->is_physical_location,
                'city' => $request->city,
                'state_id' =>$request->state_id,
                'zip' => $request->zip,
            ]
        );
        if ($request->main_location == 1) {
            $company->mainLocation()->associate($location);
            $company->save();
        }

        return redirect()->back()->with('flash', 'Your location was successfully saved!');
    }
}
