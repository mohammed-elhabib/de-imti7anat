<?php

namespace App\Http\Controllers;

use App\Models\Condidate;
use App\Models\ProfessionalExperience;
use App\Models\SortingCondidate;
use App\Models\SortingProfessionalExperience;
use Illuminate\Http\Request;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class SortingCondidateController extends Controller
{

    public function view()
    {
        $sortingCondidates = SortingCondidate::orderBy("total", "desc")->get();
        return view("list-sorting-condidate", ["sortingCondidates" => $sortingCondidates]);
    }
    public function reportCondidateSorting($sorting_condidate_id)
    {
        $sortingCondidate = SortingCondidate::with("condidate.experiences")->find($sorting_condidate_id);
        $SortingExperience =  $sortingCondidate->condidate->experiences->groupBy(function ($experience) {
            return  $experience->type;
        });
        return view("report-condidate", ["sortingCondidate" => $sortingCondidate,"SortingExperience"=>  $SortingExperience]);
    }
    public function store(Request $request)
    {

        DB::transaction(function () {
            $condidates = Condidate::with("experiences")->get();
            SortingCondidate::query()->delete();
            SortingProfessionalExperience::query()->delete();
            $this->sorting($condidates);
        });
        return redirect()->route("sorted-condidate-view");
    }

    protected function  sorting($condidates)
    {

        foreach ($condidates as  $condidate) {

            $sortExps =   $this->sortingProfessionalExperience($condidate);
            $pointAverage = $this->pointAverage($condidate);
            $pointAfterStady = $this->pointAfterStady($condidate);
            $pointCertificateDate = $this->pointCertificateDate($condidate) ?? 0;
            /// 6 نقاط بخصوص تطابق الشهادة
            $total = 6;
            // نقطة المعدل
            $total += $pointAverage;
            // نقة التكوين المكمل
            $total += $pointAfterStady;
            // نقطة الاقدمية
            $total += $pointCertificateDate;
            // المقابلة الشفوية
            $total += $condidate->interviewPiont;

            ///الخبرة المهنية
            $total += $sortExps["exPoint1"];
            $total += $sortExps["exPoint2"];
            $total += $sortExps["exPoint3"];
            $total += $sortExps["exPoint4"];
            $total += $sortExps["exPoint5"];
            SortingCondidate::create(
                [
                    "condidate_id" => $condidate->id,
                    "pointAverage" => $pointAverage,
                    "pointAfterStady" =>    $pointAfterStady,
                    "pointCertificateDate" =>   $pointCertificateDate,
                    "pointInterview" => $condidate->interviewPiont,
                    "exPoint1" => $sortExps["exPoint1"],
                    "exPoint2" => $sortExps["exPoint2"],
                    "exPoint3" => $sortExps["exPoint3"],
                    "exPoint4" => $sortExps["exPoint4"],
                    "exPoint5" => $sortExps["exPoint5"],
                    "total" =>  $total
                ]

            );
        }
    }



    protected function  pointAverage($condidate)
    {
        if ($condidate->average < 10.50)
            return 0;
        if ($condidate->average >= 10.50 && $condidate->average <= 10.99)
            return 1;
        if ($condidate->average >= 11 && $condidate->average <= 11.99)
            return 2;
        if ($condidate->average >= 12 && $condidate->average <= 12.99)
            return 3;
        if ($condidate->average >= 13 && $condidate->average <= 13.99)
            return 4;
        if ($condidate->average >= 14 && $condidate->average <= 14.99)
            return 5;
        if ($condidate->average >= 15 && $condidate->average <= 15.99)
            return 6;
        if ($condidate->average <= 16)
            return 7;
    }
    protected function  pointAfterStady($condidate)
    {
        $point = $condidate->afterStady * 025;
        return  $point > 2 ? 2 : $point;
    }
    protected function  pointCertificateDate($condidate)
    {
    }
    protected function  sortingProfessionalExperience($condidate)
    {
        $types = $condidate->experiences->groupBy(function ($experience) {

            return $experience->type;
        });
        $typesPoints = [
            "exPoint1" => 0,
            "exPoint2" => 0,
            "exPoint3" => 0,
            "exPoint4" => 0,
            "exPoint5" => 0
        ];
        foreach ($types as $type => $experiences) {
            $pointsTotal = 0;
            foreach ($experiences as $experience) {
                $start = Carbon::parse($experience->start);
                $end =  Carbon::parse($experience->end);
                $days = $end->diffInDays($start);
                $div = 0;
                switch ($type) {
                    case 1:
                        $div = 365;
                        break;
                    case 2:
                        $div = 365;
                        break;
                    case 3:
                        $div = 365 * 2;
                        break;
                    case 4:
                        $div = 365 * 2;
                        break;
                    case 5:
                        $div = 365 * 4;
                        break;
                }
                $point = round($days /  $div, 2);
                SortingProfessionalExperience::create([
                    "professional_experiences_id" => $experience->id,
                    "point" => $point
                ]);
                $pointsTotal = $pointsTotal + $point;
            }
            //exPoint1
            switch ($type) {
                case 1:
                    $typesPoints["exPoint1"]  =  $pointsTotal > 6 ? 6 :  $pointsTotal;
                    break;
                case 2:
                    $typesPoints["exPoint2"]  =  $pointsTotal > 4 ? 4 :  $pointsTotal;
                    break;
                case 3:
                    $typesPoints["exPoint3"]  =  $pointsTotal > 3  ? 3 :  $pointsTotal;
                    break;
                case 4:
                    $typesPoints["exPoint4"]  =  $pointsTotal > 2 ? 2 :  $pointsTotal;
                    break;
                case 5:
                    $typesPoints["exPoint5"]  =  $pointsTotal > 3 ? 3 :  $pointsTotal;
                    break;
            }
        }
        return  $typesPoints;
    }
}
