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
        Schema::create('government_service_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('government_service_id')->comment('relations government_services')->references('id')->on('government_services')->cascadeOnDelete();
            $table->foreignId('user_id')->comment('relations users')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('position_id')->comment('relations positions')->references('id')->on('positions')->cascadeOnDelete();
            $table->string('gose_item_full_name')->comment('ชื่อ-สกุล');
            $table->string('gose_item_position')->comment('ตำแหน่ง');
            $table->tinyInteger('gose_type')->default(2)->comment('สถานะ 1-ผู้ขออนุญาต 2-ผู้ร่วมเดินทาง');

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
        Schema::dropIfExists('government_service_items');
    }
};
