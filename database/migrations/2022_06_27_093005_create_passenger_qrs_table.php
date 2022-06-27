<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('passenger_qrs', function (Blueprint $table) {
            $table->id();
            $table->string('plate_no');
            $table->foreignId('station_id')
                ->constrained('stations')
                ->cascadeOnDelete();
            $table->string('bound');
            $table->string('qr_code');
            $table->string('mode')
                ->nullable();
            $table->timestamp('scanned_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('user_id')
                ->nullable();
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
        Schema::dropIfExists('passenger_qrs');
    }
};
