@extends('master')
@section('content')
    <div class="card" id="section-to-print">
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
                            <td>{{ $sortingCondidate->condidate->average }} / 20</td>
                            <td>{{ $sortingCondidate->PointAverage }}</td>
                        </tr>
                        <tr>
                            <td>التكوين المكمل للشهادة</td>
                            <td>{{ $sortingCondidate->condidate->afterStady }} سداسيات</td>
                            <td>{{ $sortingCondidate->PointAfterStady }}</td>
                        </tr>
                        <tr>
                            <td>تاريخ الحصول على الشهادة</td>
                            <td>{{ $sortingCondidate->condidate->certificateDate }}</td>
                            <td>{{ $sortingCondidate->PointCertificateDate }}</td>

                        </tr>
                        <tr>
                            <td>نقطة المقابلة</td>
                            <td> {{ $sortingCondidate->PointInterview }}</td>
                            <td> {{ $sortingCondidate->PointInterview }}</td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <div class="row">
                <div class="col">
                    <h4 class="text-center"> الخبرة المهنية </h4>
                </div>
            </div>
            <div class="row">
                @if ($SortingExperience->get('1'))
                    <table class="exp-table">
                        <thead>
                            <tr>
                                <td>الخبرة المكتسبة في المؤسسات والادارات العمومية المنظمة للمسابقة </td>
                                <td>من</td>
                                <td>إلى </td>
                                <td>النقطة</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SortingExperience->get('1') as $key => $experience)
                                <tr>
                                    <td>{{ $key + 1 }}#</td>
                                    <td>{{ $experience->start }}</td>
                                    <td>{{ $experience->end }}</td>
                                    <td>{{ $experience->sotringExperience->point }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="3">المجموع </td>
                                <td>{{ $SortingExperience->get('1')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                }) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                @endif

                @if ($SortingExperience->get('2'))
                    <table class="exp-table">
                        <thead>
                            <tr>
                                <td>الخبرة المكتسبة في المؤسسات والادارات العمومية أخرى </td>
                                <td>من</td>
                                <td>إلى </td>
                                <td>النقطة</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SortingExperience->get('2') as $key => $experience)
                                <tr>
                                    <td>{{ $key + 1 }}#</td>
                                    <td>{{ $experience->start }}</td>
                                    <td>{{ $experience->end }}</td>
                                    <td>{{ $experience->sotringExperience->point }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="3">المجموع </td>
                                <td>{{ $SortingExperience->get('2')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                }) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                @endif

                @if ($SortingExperience->get('3'))
                    <table class="exp-table">
                        <thead>
                            <tr>
                                <td>الخبرة المكتسبة في المؤسسات والادارات العمومية المنظمة للمسابقة في رتبة أدنى </td>
                                <td>من</td>
                                <td>إلى </td>
                                <td>النقطة</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SortingExperience->get('3') as $key => $experience)
                                <tr>
                                    <td>{{ $key + 1 }}#</td>
                                    <td>{{ $experience->start }}</td>
                                    <td>{{ $experience->end }}</td>
                                    <td>{{ $experience->sotringExperience->point }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="3">المجموع </td>
                                <td>{{ $SortingExperience->get('3')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                }) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                @endif

                @if ($SortingExperience->get('4'))
                    <table class="exp-table">
                        <thead>
                            <tr>
                                <td>الخبرة المكتسبة خارج قطاع الوظيف العمومي </td>
                                <td>من</td>
                                <td>إلى </td>
                                <td>النقطة</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SortingExperience->get('4') as $key => $experience)
                                <tr>
                                    <td>{{ $key + 1 }}#</td>
                                    <td>{{ $experience->start }}</td>
                                    <td>{{ $experience->end }}</td>
                                    <td>{{ $experience->sotringExperience->point }}</td>
                                </tr>
                            @endforeach



                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="3">المجموع </td>
                                <td>{{ $SortingExperience->get('4')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                }) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                @endif

                @if ($SortingExperience->get('5'))
                    <table class="exp-table">
                        <thead>
                            <tr>
                                <td>الخبرة المكتسبة بصفة متعاقد بتوقيت جزئي </td>
                                <td>من</td>
                                <td>إلى </td>
                                <td>النقطة</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SortingExperience->get('5') as $key => $experience)
                                <tr>
                                    <td>{{ $key + 1 }}#</td>
                                    <td>{{ $experience->start }}</td>
                                    <td>{{ $experience->end }}</td>
                                    <td>{{ $experience->sotringExperience->point }}</td>
                                </tr>
                            @endforeach



                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="3">المجموع </td>
                                <td>{{ $SortingExperience->get('5')->sum(function ($experience) {
                                    return $experience->sotringExperience->point;
                                }) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                @endif

            </div>
        </div>
    </div>


    <style>
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

</style>

@endsection