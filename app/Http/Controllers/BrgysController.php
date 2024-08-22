<?php

namespace App\Http\Controllers;

use App\Models\Schemas\Brgys;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrgysRequest;
use App\Http\Requests\UpdateBrgysRequest;
use App\Models\Schemas\City;
use Illuminate\Http\Request;

class BrgysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brgys_list = Brgys::with('city')->get();
        return view('brgys.list', [
            "brgys_list" => $brgys_list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brgys.submit', [
            "cities" => City::get(),
        ]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $brgys = new Brgys();
        $brgys->name = $request->name;
        // $brgys->city_id = $request->city_id;
        $brgys->city()->associate($request->city_id); //associates the city based in city_id
        $brgys->save();
        return redirect("/brgys");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // fetches the city too based on city_id
        return ViewerController::index("brgys", "Baranggay", Brgys::with('city')->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('brgys.submit', [
            "cities" => City::get(),
            "selected" => Brgys::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $brgys = Brgys::find($id);
        $brgys->name = $request->name;
        // $brgys->city_id = $request->city_id;
        $brgys->city()->associate($request->city_id);
        $brgys->update();
        return redirect("/brgys");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $brgys = Brgys::find($id);
        $brgys->delete();
        return redirect("/brgys");
    }

    public function getByCity(int $id)
    {
        return ["data" => Brgys::getByCity($id)];
    }
}
