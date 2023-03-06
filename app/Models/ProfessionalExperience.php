<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        "condidate_id",
        "start",
        "end",
        "type"
    ];
    public  function sotringExperience()
    {
        return $this->hasOne(SortingProfessionalExperience::class,"professional_experiences_id","id");
    }
}
