<?php

namespace App\Http\Controllers;

use App\Models\Schemas\Patient;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Mail\CaseStatusUpdate;
use App\Models\Schemas\Brgys;
use App\Models\Schemas\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $patients = Patient::with('brgys')->get();
        return view('patient.list', [
            "brgys_list" => Brgys::get(),
            "rep" => Patient::awarenessReport(3),
            "patients" => $patients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('patient.submit', [
            "brgys_list" => Brgys::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $patient = new Patient();
        $patient->name = $request->name;
        $patient->brgys()->associate($request->brgys_id); //it fetches the associated object
        $patient->number = $request->number;
        $patient->email = $request["email"] ?? ""; //just to be safe. I set it to "" if no email field exists in the payload
        $patient->case_type = $request->case_type;
        $patient->coronavirus_status = $request->coronavirus_status;

        $patient->save();
        return redirect("/patient");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return ViewerController::index("patient", "Patient", Patient::with('brgys')->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('patient.submit', [
            "brgys_list" => Brgys::get(),
            "selected" => Patient::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        $sendMail = $patient->case_type != $request->case_type;
    // it mails to the patient upon update on its case type

        $patient->name = $request->name;
        $patient->brgys()->associate($request->brgys_id);
        $patient->number = $request->number;
        $patient->email = $request["email"] ?? "";
        $patient->case_type = $request->case_type;
        $patient->coronavirus_status = $request->coronavirus_status;
        $patient->update();
        if($sendMail){
            $this->mailCaseStatus($patient);
        };
        return redirect("/patient");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $patient = Patient::find($id);
        $patient->delete();
        return redirect("/patient");
    }




    // this handles the payload delivery to change the url params of reports
    public function getReports(Request $request, $type){
        return redirect("/reports/$type/$request->city_id/$request->brgys_id");
    }

    // this handles report fetching according to its url params
    public function reports(string $type, int $city_id = 0, int $brgys_id = 0){

        if($type !== "awareness" && $type !== "coronavirus"){
            return redirect("/");
        };

        return view('reports', [
            "cities" => City::get(),
            "type" => $type,
            "title"=> $type == "awareness" ? "Awareness Report" : "Corona Virus Report",
            "city_id" => $city_id,
            "brgys_list" => Brgys::get(),
            "rep" => ($type == "awareness") ? Patient::awarenessReport($brgys_id) : Patient::coronaVirusReport($brgys_id)
        ]);
    }

    // search result landing page
    public function searchPatient(Request $request){
        return ViewerController::index("patient", "Patient", Patient::where("number", $request->number)->get()->first());
    }

    // search landing page
    public function search(){
        return view('patient.search');
    }

    // mailing function
    function mailCaseStatus(Patient $patient){
        Mail::to($patient->email)->send(new CaseStatusUpdate($patient));
    }

}
