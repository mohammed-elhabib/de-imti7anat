@extends('master')
@section('content')

    <div class="card shade  mb-3">
        <div class="card-header">
            <h3>قائمة المترشحين </h3>
        </div>
        <div class="card-body">
            <form method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <label>بحث</label>
                    </div>
                    <div class="col-10">
                        <input type="text" style="width: 100%" name="search" value="{{ $search }}" placeholder="ابحث .....">
                    </div>
                    <div class="col ">
                        <button style="    border: 1px solid green;
                        /* background: white; */
                        background: green;
                        color: white;
                        font-weight: 600;
                        padding: 2px 10px;" type="submit" class="">عرض</button>
                    </div>
                </div>



            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header">
                    {!! $condidates->appends(['search' => $search])->links() !!}
                </div>
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
