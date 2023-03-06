<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condidate extends Model
{
    use HasFactory;
    protected $fillable  = [
        "fileNumber",
        "firstName",
        "lastName",
        "birthDate",
        "average",
        "afterStady",
        "certificateDate",
        "interviewPiont"
    ];
    public static function makeModel($arrags)
    {

        $condidate =  Condidate::create([
            "fileNumber" => $arrags["fileNumber"],
            "firstName" => $arrags["firstName"],
            "lastName" => $arrags["lastName"],
            "birthDate" => $arrags["birthDate"],
            "average" => $arrags["average"],
            "afterStady" => $arrags["afterStady"],
            "certificateDate" => $arrags["certificateDate"],
            "interviewPiont" => $arrags["interviewPiont"],

        ]);
        $experiences =  collect($arrags["experiences"])->map(function ($experience) {

            return new ProfessionalExperience($experience);
        });

        $condidate->experiences()->saveMany($experiences);
        return  $condidate;
    }
    public  function experiences()
    {
        return $this->hasMany(ProfessionalExperience::class);
    }
}
