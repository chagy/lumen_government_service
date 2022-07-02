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
        Schema::create('sub_districts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->comment('relations districts')->references('id')->on('districts')->cascadeOnDelete();
            $table->string('subd_name')->comment('ชื่อตำบล');
            $table->text('subd_desc')->nullable()->comment('รายละเอียด');
            $table->string('subd_zipcode')->comment('รหัสไปรษณีย์');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_districts');
    }
};
