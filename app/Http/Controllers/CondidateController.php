<?php

namespace App\Http\Controllers;

use App\Models\Condidate;
use App\Models\ProfessionalExperience;
use Illuminate\Http\Request;

class CondidateController extends Controller
{


    public function store(Request $request)
    {
        $validated = $request->validate([
            "fileNumber"=> 'required',
            "firstName"=> 'required',
            "birthDate"=> 'required',
            "average"=> 'required',
            "certificateDate"=> 'required',
            "interviewPiont"=> 'required',
        ]);
        if($validated)
        Condidate::makeModel($request->except("_token"));
        return redirect()->route("list-condidate");
    }
    public function view($condidate_id, Request $request)
    {
        $condidate = Condidate::with("experiences")->find($condidate_id);
        $experiences =[];
        if( $condidate->experiences->count()>0)
        $experiences = $condidate->experiences->groupBy(function ($experience) {

            return $experience->type;
        });
        return view("edit-condidate", ["condidate" => $condidate, "experiences" => $experiences]);
    }
    public function edit($condidate_id, Request $request)
    {
        $validated = $request->validate([
            "fileNumber"=> 'required',
            "firstName"=> 'required',
            "birthDate"=> 'required',
            "average"=> 'required',
            "certificateDate"=> 'required',

        ]);
        if($validated)

        $condidate = Condidate::find($condidate_id);
        $condidate->experiences()->delete();

        $condidate->update($request->except(["_token", "experiences","interviewPiont"]));
        $experiences =  collect($request->experiences)->map(function ($experience) {
            $experience["id"] = null;
            return new ProfessionalExperience($experience);
        });
        $condidate->experiences()->saveMany($experiences);
        return redirect()->route("list-condidate");
    }
    public function list(Request $request)
    {
        $condidates = null;
        if (isset($request->search) && !empty($request->search))
            $condidates   = Condidate::where(function ($q) use ($request) {
                $q->where("firstName", "like", "%" . $request->search . "%")
                    ->orWhere("lastName", "like", "%" . $request->search . "%")
                    ->orWhere("fileNumber", "like", "%" . $request->search . "%");
            });

        $condidates =  $condidates == null ? Condidate::paginate(15) : $condidates->paginate(15);
        return view("list-condidate", ["condidates" => $condidates, "search" => $request->search ?? ""]);
    }
}
