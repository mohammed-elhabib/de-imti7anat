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
        if (auth()->user()->canAny(["admin", "reader"])) {

            $sortingCondidates = SortingCondidate::orderBy("total", "desc")->get();
            return view("list-sorting-condidate", ["sortingCondidates" => $sortingCondidates]);
        }
    }
    public function reportCondidateSorting($sorting_condidate_id)
    {
        if (auth()->user()->canAny(["admin", "reader"])) {
            $sortingCondidate = SortingCondidate::with("condidate.experiences")->find($sorting_condidate_id);
            $SortingExperience =  $sortingCondidate->condidate->experiences->groupBy(function ($experience) {
                return  $experience->type;
            });
            return view("report-condidate", ["sortingCondidate" => $sortingCondidate, "SortingExperience" =>  $SortingExperience]);
        } else
            return  "ليس لديك صلاحية الدخول إلى هنا";
    }
    public function pdfReportCondidateSorting($sorting_condidate_id)
    {
        if (auth()->user()->canAny(["admin", "reader"])) {
            $sortingCondidate = SortingCondidate::with("condidate.experiences")->find($sorting_condidate_id);
            $SortingExperience =  $sortingCondidate->condidate->experiences->groupBy(function ($experience) {
                return  $experience->type;
            });
            return view("pdf-report-condidate", ["sortingCondidate" => $sortingCondidate, "SortingExperience" =>  $SortingExperience]);
        } else
            return  "ليس لديك صلاحية الدخول إلى هنا";
    }
    public function store(Request $request)
    {
        if (auth()->user()->canAny(["admin"])) {

            DB::transaction(function () {
                $condidates = Condidate::with("experiences")->get();
                SortingCondidate::query()->delete();
                SortingProfessionalExperience::query()->delete();
                $this->sorting($condidates);
            });
            return redirect()->route("sorted-condidate-view");
        } else
            return  "ليس لديك صلاحية الدخول إلى هنا";
    }

    protected function  sorting($condidates)
    {

        foreach ($condidates as  $condidate) {
            $pointInterview = $condidate->interviewPiont > 3 ? 3 : $condidate->interviewPiont;
            if ($pointInterview > 0) {
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
                $pointCertificateDate = $pointCertificateDate < 0 ? 0 : $pointCertificateDate;
                $total += $pointCertificateDate;
                // المقابلة الشفوية
                $pointInterview = $condidate->interviewPiont > 3 ? 3 : $condidate->interviewPiont;
                $total += $pointInterview;
                ///الخبرة المهنية
                $e_total = 0;
                $e_total += $sortExps["exPoint1"];
                $e_total += $sortExps["exPoint2"];
                $e_total += $sortExps["exPoint3"];
                $e_total += $sortExps["exPoint4"];
                $e_total += $sortExps["exPoint5"];
                $e_total = $e_total > 6 ? 6 : $e_total;
                $e_total = $e_total < 0 ? 0 : $e_total;
                $total += $e_total;
                SortingCondidate::create(
                    [
                        "condidate_id" => $condidate->id,
                        "pointAverage" => $pointAverage,
                        "pointAfterStady" =>    $pointAfterStady,
                        "pointCertificateDate" =>   $pointCertificateDate,
                        "pointInterview" => $pointInterview,
                        "exPoint1" => $sortExps["exPoint1"],
                        "exPoint2" => $sortExps["exPoint2"],
                        "exPoint3" => $sortExps["exPoint3"],
                        "exPoint4" => $sortExps["exPoint4"],
                        "exPoint5" => $sortExps["exPoint5"],
                        "total" =>  $total
                    ]
                );
            } else {
                SortingCondidate::create(
                    [
                        "condidate_id" => $condidate->id,
                        "pointAverage" => 0,
                        "pointAfterStady" =>    0,
                        "pointCertificateDate" =>   0,
                        "pointInterview" => 0,
                        "exPoint1" => 0,
                        "exPoint2" => 0,
                        "exPoint3" => 0,
                        "exPoint4" => 0,
                        "exPoint5" => 0,
                        "total" =>  0
                    ]

                );
            }
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
        $years = 0;
        $start_year =$condidate->certificateDate;
        if ($start_year!=null&&$start_year <= 2022) {
            $years = (2022 - $start_year) * 0.5;
            $additon_points = (0.5 / 365) * 180;
            $years =  $years + $additon_points;
        }
        //dd( $years , $start_year);

        return $years > 5 ? 5 : $years;
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
            foreach ($experiences as $experience) {
                $start = Carbon::parse($experience->start);
                $end =  Carbon::parse($experience->end);
                $days = $end->diffInDays($start) + 1;

                $point = round($days /  $div, 4);
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
