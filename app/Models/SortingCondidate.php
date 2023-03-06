<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortingCondidate extends Model
{
    use HasFactory;
    protected $fillable  = [
        "condidate_id",
        "pointAverage",
        "pointAfterStady",
        "pointCertificateDate",
        "pointInterview",
        "exPoint1",
        "exPoint2",
        "exPoint3",
        "exPoint4",
        "exPoint5",
        "total"
    ];


    public function condidate(){
      return $this->hasOne(Condidate::class,"id","condidate_id");
    }
}
