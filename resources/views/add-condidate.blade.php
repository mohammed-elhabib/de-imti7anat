@extends('master')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="card">
        <div class="card-header">
            <h4 class="font-weight-bolder">مترشح جديد</h4>
            <p class="mb-0">الرجاء التأكد من صحة المعلومات قبل الاضافة</p>
        </div>
        <div class="card-body">
            <form role="form" autocomplete="off" action="{{ route('store-condidate') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <h4>معلومات المترشح</h4>
                        <hr />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class=" input-group input-group-outline mb-3">
                            <label class="form-label">رقم الملف</label>
                            <input type="text" autocomplete="off" name="fileNumber" class="form-control">
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col">
                        <div class=" input-group input-group-outline mb-3">
                            <label class="form-label">الاسم و الوقت</label>
                            <input type="text" autocomplete="off" name="firstName" class="form-control">
                        </div>
                    </div>

                   <!-- <div class="col">
                        <div class=" input-group input-group-outline mb-3">
                            <label class="form-label">اللقب</label>
                            <input type="text" autocomplete="off" name="lastName" class="form-control">
                        </div>
                    </div>-->
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class=" input-group input-group-outline mb-3">
                            <label class="form-label">تاريخ الميلاد</label>
                            <input type="date" autocomplete="off" name="birthDate" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col">
                        <h4>معلومات التكوين</h4>
                        <hr />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class=" input-group input-group-outline mb-3">
                            <label class="form-label">المعدل العام للمسار الدراسي</label>
                            <input type="number" step="0.001" autocomplete="off" name="average" class="form-control">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class=" input-group input-group-outline mb-3">
                            <label class="form-label"> عدد السداسيات الدراسية و التكوينية المكملة للشهادة</label>
                            <input type="text" autocomplete="off" name="afterStady" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class=" input-group input-group-outline mb-3">
                            <label class="form-label">نسة الحصول على الشهادة</label>
                            <input type="number" autocomplete="off" name="certificateDate" class="form-control">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class=" input-group input-group-outline mb-3">
                            <label class="form-label">نقطة المقابلة الشفاهية</label>
                            <input type="text" autocomplete="off" name="interviewPiont" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4>معلومات الخبرة المهنية</h4>

                    </div>
                </div>

                <div class="card-exp">

                    <div class="row">
                        <div class="col d-flex" style="justify-content: space-between;  ">
                            <h6>الخبرة المكتسبة في المؤسسات والادارات العمومية المنظمة للمسابقة </h6>
                            <button onclick="addExp(event,1)" class="btn btn-outline-success btn-sm">إضافة</button>

                        </div>
                    </div>
                    <div id="Exp1">


                    </div>
                </div>
                <div class="card-exp">

                    <div class="row">
                        <div class="col d-flex" style="justify-content: space-between;  ">
                            <h6>الخبرة المكتسبة في المؤسسات والادارات العمومية أخرى </h6>
                            <button onclick="addExp(event,2)" class="btn btn-outline-success btn-sm">إضافة</button>

                        </div>
                    </div>
                    <div id="Exp2">


                    </div>
                </div>
                <div class="card-exp">

                    <div class="row">
                        <div class="col d-flex" style="justify-content: space-between;  ">
                            <h6>الخبرة المكتسبة في المؤسسات والادارات العمومية المنظمة للمسابقة في رتبة أدنى</h6>
                            <button onclick="addExp(event,3)" class="btn btn-outline-success btn-sm">إضافة</button>

                        </div>
                    </div>
                    <div id="Exp3">


                    </div>
                </div>
                <div class="card-exp">

                    <div class="row">
                        <div class="col d-flex" style="justify-content: space-between;  ">
                            <h6>الخبرة المكتسبة خارج قطاع الوظيف العمومي</h6>
                            <button onclick="addExp(event,4)" class="btn btn-outline-success btn-sm">إضافة</button>

                        </div>
                    </div>
                    <div id="Exp4">


                    </div>
                </div>
                <div class="card-exp">

                    <div class="row">
                        <div class="col d-flex" style="justify-content: space-between;  ">
                            <h6>الخبرة المكتسبة بصفة متعاقد بتوقيت جزئي</h6>
                            <button onclick="addExp(event,5)" class="btn btn-outline-success btn-sm">إضافة</button>
                        </div>
                    </div>
                    <div id="Exp5">


                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-lg bg-gradient-success w-100 btn-lg  mt-4 mb-0">حجز
                        العلومات</button>
                </div>
            </form>
        </div>
    </div>

    <script>
                exp = 0

    /*    exp1 = 0
        exp2 = 0
        exp3 = 0
        exp4 = 0
        exp5 = 0*/

        function addExp(event, type) {
            event.preventDefault();
            name_arry = 'experiences[' + exp + ']';
            exp++;
         /*   switch (type) {
                case 1:
                    name_arry = 'exp' + type + '[' + exp1 + ']'
                    exp1++;
                    break;
                case 2:
                    name_arry = 'exp' + type + '[' + exp2 + ']'
                    exp2++;
                    break;
                case 3:
                    name_arry = 'exp' + type + '[' + exp3 + ']'
                    exp3++;

                    break;
                case 4:
                    name_arry = 'exp' + type + '[' + exp4 + ']'
                    exp4++;

                    break;
                case 5:
                    name_arry = 'exp' + type + '[' + exp5 + ']'
                    exp5++;

                    break;
            }*/
            $("#Exp" + type).append('<div class="row"> <div class="col-5">' +
                ' <div class=" input-group input-group-outline mb-3">' +
                '      <label class="form-label">تاريخ البداية</label>' +
                '       <input type="date" name="' + name_arry +
                '[start]" autocomplete="off" class="form-control">' +
                '    </div>' +
                ' </div>' +
                '<div class="col-5">' +
                ' <div class=" input-group input-group-outline mb-3">' +
                '   <label class="form-label">   تاريخ النهاية</label>' +
                '    <input type="date" autocomplete="off" name="' + name_arry + '[end]" class="form-control">' +
                ' </div>' +
                '</div>' +
                '<input type="hidden" name="'+ name_arry +'[type]" value="' + type + '"/>' +
                '<div class="col-2 d-flex" style="justify-content: end;">' +
                '   <button class="btn btn-outline-primary btn-sm" onclick="remove(event)">حذف</button>' +
                '</div>' +
                '</div>')
        }

        function remove(event) {
            event.preventDefault();
            $(event.target).parent().parent().remove();

        }
    </script>
    <style>
        .form-control {
            border: 1px solid gray !important;
        }

        .card-exp {
            border: 1px solid black;
            padding: 21px;
            border-radius: 20px;
            margin: 15px 0px;
        }
    </style>
@endsection
