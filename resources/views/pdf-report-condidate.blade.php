
<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <body>
    <div class="card" id="section-to-print">
        <style>
            body{
                text-align: center;
            }
            .labal {
                font-weight: 700;
                color: black;
                font-size: 18px;
            }

            .value {
                color: black;
                font-size: 16px;
            }

            .exp-table {
                margin: 10px 0px;
            }

            .exp-table thead tr td {
                background: gainsboro;
                font-weight: 700;

            }

            .exp-table tr td {
                border: 1px solid grey;
                padding: 5px;
                width: 15%;
                color: black;
                text-align: center;
            }

            .exp-table tr td:first-child {
                width: 50%;

            }

            .info-table {
                margin: 10px 0px;
                width: 100%;
            }

            .info-table thead tr td {
                background: gainsboro;
                font-weight: 700;

            }

            .info-table tr td {
                border: 1px solid grey;
                padding: 5px;
                color: black;
                text-align: center;
            }
            .row{
                display: flex;
            }
            .col{
                width: 100%;
            }
            table{
                width:100% ;
            }
    </style>
          <div class="card-header">
            <h2 class="text-center font-weight-bolder">تقرير نتائج المترشح </h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h4 class="text-center">معلومات المترشح</h4>
                </div>
            </div>
            <div class="row">
                <table class="info-table">
                    <thead>
                        <tr>
                            <td>رقم الملف</td>
                            <td>الاسم واللقب</td>
                            <td>تاريخ الميلاد</td>
                            <td>مجموع النقاط</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $sortingCondidate->condidate->fileNumber }}</td>
                            <td>{{ $sortingCondidate->condidate->firstName }}
                                {{ $sortingCondidate->condidate->lastName }}</td>
                            <td>{{ $sortingCondidate->condidate->birthDate }}</td>
                            <td>{{ $sortingCondidate->total }}</td>

                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="row">
                <div class="col">
                    <h4 class="text-center">المعاير العامة </h4>
                </div>
            </div>
            <div class="row">
                <table class="exp-table">
                    <thead>
                        <tr>
                            <td>المعيار </td>
                            <td>القيمة</td>
                            <td>النقطة </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>تطابق تخصص المؤهل أو الشهادة مع متطلبات الرتبة</td>
                            <td>متطابقة</td>
                            <td>6</td>

                        </tr>
                        <tr>
                            <td>معدل مسار الدراسة أو التكوين</td>
                            <td>{{ $sortingCondidate->condidate->average }} </td>
                            <td>{{ $sortingCondidate->PointAverage }}</td>
                        </tr>
                        <tr>
                            <td>التكوين المكمل للشهادة</td>
                            <td>{{ $sortingCondidate->condidate->afterStady }} سداسيات</td>
                            <td>{{ $sortingCondidate->PointAfterStady }}</td>
                        </tr>
                        <tr>
                            <td>تاريخ الحصول على الشهادة</td>
                            <td>{{ $sortingCondidate->condidate->certificateDate }}/06/30</td>
                            <td>{{ $sortingCondidate->PointCertificateDate }}</td>

                        </tr>
                        <tr>
                            <td>نقطة المقابلة</td>
                            <td> {{ $sortingCondidate->condidate->interviewPiont}}</td>
                            <td> {{ $sortingCondidate->PointInterview }}</td>
                        </tr>
                        <tr>
                            <td> المجموع العام للخبرة المهنية</td>
                            <td> الاقصى 6</td>
                            <td> {{ $sortingCondidate->exPoint1+$sortingCondidate->exPoint2+$sortingCondidate->exPoint3+$sortingCondidate->exPoint4+$sortingCondidate->exPoint5 }}</td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <div class="row">
                <div class="col">
                    <h4 class="text-center"> الخبرة المهنية </h4>
                </div>
            </div>
                @if ($SortingExperience->get('1'))
                <div class="row">

                    <table class="exp-table">
                        <thead>
                            <tr>
                                <td>الخبرة المكتسبة في المؤسسات والادارات العمومية المنظمة للمسابقة (اقصى علامة 6) </td>
                                <td>من</td>
                                <td>إلى </td>
                                <td>مدة العمل </td>
                                <td>النقطة</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SortingExperience->get('1') as $key => $experience)
                            <tr>
                                <td>{{ $key + 1 }}#</td>
                                <td>{{ $experience->start }}</td>
                                <td>{{ $experience->end }}</td>
                                @php
                                  $all_days=(\Carbon\Carbon::parse($experience->end)->diffInDays(\Carbon\Carbon::parse($experience->start))+1);
                                  $year=  intVal((\Carbon\Carbon::parse($experience->end)->diffInDays(\Carbon\Carbon::parse($experience->start))+1)/365);
                                  $days=  $all_days - $year*365 ;
                               @endphp
                                <td>   {{ $year  }} سنة  {{ $days }} يوم</td>
                                <td>{{ $experience->sotringExperience->point }}</td>
                            </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="4">المجموع </td>
                                <td>{{
                                 $SortingExperience->get('1')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                })>6?6: $SortingExperience->get('1')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                })
                                 }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
            </div>
                @endif

                @if ($SortingExperience->get('2'))
                <div class="row">

                    <table class="exp-table">
                        <thead>
                            <tr>
                                <td>الخبرة المكتسبة في المؤسسات والادارات العمومية أخرى (اقصى علامة 4) </td>
                                <td>من</td>
                                <td>إلى </td>
                                <td>مدة العمل </td>
                                <td>النقطة</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SortingExperience->get('2') as $key => $experience)
                            <tr>
                                <td>{{ $key + 1 }}#</td>
                                <td>{{ $experience->start }}</td>
                                <td>{{ $experience->end }}</td>
                                @php
                                  $all_days=(\Carbon\Carbon::parse($experience->end)->diffInDays(\Carbon\Carbon::parse($experience->start))+1);
                                  $year=  intVal((\Carbon\Carbon::parse($experience->end)->diffInDays(\Carbon\Carbon::parse($experience->start))+1)/365);
                                  $days=  $all_days - $year*365 ;
                               @endphp
                                <td>   {{ $year  }} سنة  {{ $days }} يوم</td>
                                <td>{{ $experience->sotringExperience->point }}</td>
                            </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="4">المجموع </td>
                                <td>{{ $SortingExperience->get('2')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                })>4?4: $SortingExperience->get('2')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                }) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endif

                @if ($SortingExperience->get('3'))
                <div class="row">

                    <table class="exp-table">
                        <thead>
                            <tr>
                                <td>الخبرة المكتسبة في المؤسسات والادارات العمومية في رتبة أدنى (اقصى علامة 3) </td>
                                <td>من</td>
                                <td>إلى </td>
                                <td>مدة العمل </td>
                                <td>النقطة</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SortingExperience->get('3') as $key => $experience)
                                <tr>
                                    <td>{{ $key + 1 }}#</td>
                                    <td>{{ $experience->start }}</td>
                                    <td>{{ $experience->end }}</td>
                                    @php
                                      $all_days=(\Carbon\Carbon::parse($experience->end)->diffInDays(\Carbon\Carbon::parse($experience->start))+1);
                                      $year=  intVal((\Carbon\Carbon::parse($experience->end)->diffInDays(\Carbon\Carbon::parse($experience->start))+1)/365);
                                      $days=  $all_days - $year*365 ;
                                   @endphp
                                    <td>   {{ $year  }} سنة  {{ $days }} يوم</td>
                                    <td>{{ $experience->sotringExperience->point }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="4"> المجموع  </td>
                                <td>{{  $SortingExperience->get('3')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                })>3?3: $SortingExperience->get('3')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                }) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endif

                @if ($SortingExperience->get('4'))
                <div class="row">

                    <table class="exp-table">
                        <thead>
                            <tr>
                                <td>الخبرة المكتسبة خارج قطاع الوظيف العمومي (اقصى علامة 2) </td>
                                <td>من</td>
                                <td>إلى </td>
                                <td>مدة العمل </td>
                                <td>النقطة</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SortingExperience->get('4') as $key => $experience)
                            <tr>
                                <td>{{ $key + 1 }}#</td>
                                <td>{{ $experience->start }}</td>
                                <td>{{ $experience->end }}</td>
                                @php
                                  $all_days=(\Carbon\Carbon::parse($experience->end)->diffInDays(\Carbon\Carbon::parse($experience->start))+1);
                                  $year=  intVal((\Carbon\Carbon::parse($experience->end)->diffInDays(\Carbon\Carbon::parse($experience->start))+1)/365);
                                  $days=  $all_days - $year*365 ;
                               @endphp
                                <td>   {{ $year  }} سنة  {{ $days }} يوم</td>
                                <td>{{ $experience->sotringExperience->point }}</td>
                            </tr>
                            @endforeach



                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="4">المجموع </td>
                                <td>{{ $SortingExperience->get('4')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                })>2?2: $SortingExperience->get('4')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                }) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endif

                @if ($SortingExperience->get('5'))
                <div class="row">

                    <table class="exp-table">
                        <thead>
                            <tr>
                                <td> الخبرة المكتسبة بصفة متعاقد بتوقيت جزئي (اقصى علامة 3)</td>
                                <td>من</td>
                                <td>إلى </td>
                                <td>مدة العمل </td>
                                <td>النقطة</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SortingExperience->get('5') as $key => $experience)
                            <tr>
                                <td>{{ $key + 1 }}#</td>
                                <td>{{ $experience->start }}</td>
                                <td>{{ $experience->end }}</td>
                                @php
                                  $all_days=(\Carbon\Carbon::parse($experience->end)->diffInDays(\Carbon\Carbon::parse($experience->start))+1);
                                  $year=  intVal((\Carbon\Carbon::parse($experience->end)->diffInDays(\Carbon\Carbon::parse($experience->start))+1)/365);
                                  $days=  $all_days - $year*365 ;
                               @endphp
                                <td>   {{ $year  }} سنة  {{ $days }} يوم</td>
                                <td>{{ $experience->sotringExperience->point }}</td>
                            </tr>
                            @endforeach



                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="4">المجموع </td>
                                <td>{{ $SortingExperience->get('5')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                })>3?3: $SortingExperience->get('5')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                }) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endif

            </div>
        </div>
    </div>

</body>
</html>
