<?php

namespace App\Http\Controllers;

use App\Models\Schemas\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This returns the listing page of the cities providing the list of cities from the database
        // The same is true for the others
        $city = new City();
        return view('city.list', [
            "cities" => $city->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // This returns the submission page for the cities. No arguments/resources provided meaning the view will store new data
        // The same is true for the others
        return view('city.submit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // This is responsible for saving/storing payload to database. It redirects to the list after
        // The same is true for the others
        $city = new City();
        $city->name = $request->name;
        $city->save();
        return redirect("/city");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // This is responsible for creating a simple view of single row of data
        // The same is true for the others
        return ViewerController::index("city", "City", City::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        // This returns the submission page for the cities. The difference being it passes the selected city or object from the url params
        // The same is true for the others
        return view('city.submit', [
            "selected" => City::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
            // This is responsible for saving/updating data to database. 
            // It fetches the object or data using the given id param from the url
            // It then updates the object using the payload from the request
            // It redirects to the list after
        // The same is true for the others
        $city = City::find($id);
        $city->name = $request->name;
        $city->update();
        return redirect("/city");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        // This is responsible for deleting data from database by fetching it first from tha database using the given id param. It redirects to the list after
        // The same is true for the others
        $city = City::find($id);
        $city->delete();
        return redirect("/city");
    }

    



}
