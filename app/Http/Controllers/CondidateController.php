<?php

namespace App\Http\Controllers;

use App\Models\Condidate;
use App\Models\ProfessionalExperience;
use Illuminate\Http\Request;

class CondidateController extends Controller
{


    public function store(Request $request)
    {
        Condidate::makeModel($request->except("_token"));
        return redirect()->route("list-condidate");
    }
    public function view($condidate_id, Request $request)
    {
        $condidate = Condidate::with("experiences")->find($condidate_id);
        $experiences = $condidate->experiences->groupBy(function ($experience) {

            return $experience->type;
        });
        return view("edit-condidate", ["condidate" => $condidate, "experiences" => $experiences]);
    }
    public function edit($condidate_id, Request $request)
    {
        $condidate = Condidate::find($condidate_id);
        $condidate->experiences()->delete();

        $condidate->update($request->except(["_token", "experiences"]));
        $experiences =  collect($request->experiences)->map(function ($experience) {
            $experience["id"] = null;
            return new ProfessionalExperience($experience);
        });
        $condidate->experiences()->saveMany($experiences);
        return redirect()->route("list-condidate");
    }
    public function list(Request $request)
    {
        $condidates = Condidate::paginate(15);

        return view("list-condidate", ["condidates" => $condidates]);
    }
}
