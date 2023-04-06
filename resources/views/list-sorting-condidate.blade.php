@extends('master')
@section('content')
    <div class="row">
        <div class="col">
            <h3> قائمة الترتيبية للمترشحين </h3>
        </div>
    </div>
    @can("admin")
    <div class="row">
        <div class="col d-flex" style="    justify-content: end;        ">
            <a class="sorting-btn" href="{{ route('sorting-condidate') }}">إعادة ترتيب</a>
        </div>
    </div>
    @endcan

    <div class="row">
        <div class="col-12">
            <div class="card my-4">

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary  font-weight-bolder  text-center"> رقم
                                        الرتبة
                                    </th>
                                    <th class="text-uppercase text-secondary  font-weight-bolder  text-center"> رقم
                                        الملف
                                    </th>
                                    <th class="text-uppercase text-secondary  font-weight-bolder text-center ">الاسم
                                        واللقب
                                    </th>
                                    <th class="text-uppercase text-secondary  font-weight-bolder  text-center "> النقاط
                                    </th>

                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($sortingCondidates->count() > 0)
                                    @foreach ($sortingCondidates as $key => $sortingCondidate)
                                        <tr>
                                            <td class="text-center">
                                                {{ $key + 1 }}
                                            </td>
                                            <td class="text-center">
                                                {{ $sortingCondidate->condidate->fileNumber ?? '/' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $sortingCondidate->condidate->firstName ?? '/' }}
                                                {{ $sortingCondidate->condidate->lastName ?? '/' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $sortingCondidate->total }}
                                            </td>


                                            <td class="align-middle text-center">
                                                <a href="{{ route('sorted-condidate-report', $sortingCondidate->id) }}"
                                                    class="text-secondary font-weight-bold text-xs"
                                                    style="    color: green !important;
                                                    border: 1px solid green;
                                                    padding: 5px;
                                                    border-radius: 5px;"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    عرض التفاصيل
                                                </a>
                                                <a href="{{ route('pdf-sorted-condidate-report', $sortingCondidate->id) }}"
                                                    class="text-secondary font-weight-bold text-xs"
                                                    style="    color: orange !important;
                                                    border: 1px solid orange;
                                                    padding: 5px;
                                                    border-radius: 5px;"
                                                    target="_blank"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    طباعة
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="5"> لم يتم حجز مترشحين بعد </td>
                                    </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .sorting-btn {
            padding: 5px 18px;
            background: green;
            color: white;
            border-radius: 5px;
            font-size: 20px;
            font-weight: 700;

        }

        .sorting-btn:hover {
            background: white !important;
            color: green !important;
            border: 1px solid green;
        }
    </style>
@endsection
