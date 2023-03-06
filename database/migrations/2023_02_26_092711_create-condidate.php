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
        Schema::create('condidates', function (Blueprint $table) {
            $table->id();
            $table->text('fileNumber');
            $table->text('firstName');
            $table->text('lastName');
            $table->date('birthDate');
            $table->float('average');
            $table->integer('afterStady');
            $table->date('certificateDate');
            $table->integer('interviewPiont');
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
        Schema::dropIfExists('condidates');
    }
};
