<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorting_condidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('condidate_id');
            $table->float('PointAverage');
            $table->float('PointAfterStady');
            $table->float('PointCertificateDate');
            $table->float('PointInterview');
            $table->float('exPoint1');
            $table->float('exPoint2');
            $table->float('exPoint3');
            $table->float('exPoint4');
            $table->float('exPoint5');
            $table->float('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sorting_condidates');
    }
};
