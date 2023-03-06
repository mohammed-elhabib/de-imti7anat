@extends('master')
@section('content')
    <div>
        <h1> قائمة المترشحين </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary  font-weight-bolder  text-center"> رقم
                                        الملف
                                    </th>
                                    <th class="text-uppercase text-secondary  font-weight-bolder text-center ">الاسم
                                        واللقب
                                    </th>
                                    <th class="text-uppercase text-secondary  font-weight-bolder  text-center "> المعدل
                                    </th>
                                    <th class="text-uppercase text-secondary  font-weight-bolder  text-center"> نقطة
                                        المقابلة
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($condidates->count() > 0)
                                    @foreach ($condidates as $condidate)
                                        <tr>
                                            <td class="text-center">
                                                {{ $condidate->fileNumber }}
                                            </td>
                                            <td class="text-center">
                                                {{ $condidate->firstName }} {{ $condidate->lastName }}
                                            </td>
                                            <td class="text-center">
                                                {{ $condidate->average }}
                                            </td>
                                            <td class="text-center">
                                                {{ $condidate->interviewPiont }}

                                            </td>

                                            <td class="align-middle text-center">
                                                <a href="{{ route('view-condidate', $condidate->id) }}"
                                                    class="text-secondary font-weight-bold text-xs"
                                                    style="    color: orange !important;
                                                    border: 1px solid orange;
                                                    padding: 5px;
                                                    border-radius: 5px;"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    تعديل
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
@endsection
