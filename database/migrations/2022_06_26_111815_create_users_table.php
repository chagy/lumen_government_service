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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('u_prefix')->comment('คำนำหน้าชื่อ');
            $table->string('u_first_name')->comment('ชื่อ');
            $table->string('u_last_name')->comment('นามสกุล');
            $table->string('u_nick_name')->comment('ชื่อเล่น');
            $table->string('u_phone')->comment('เบอร์โทรศัพท์');
            $table->date('u_birthday')->comment('วันเกิด');
            $table->date('u_workday')->comment('วันที่เริ่มทำงาน');
            $table->date('u_officerday')->nullable()->comment('วันที่บรรจุ');
            $table->string('u_address')->comment('ที่อยู่');
            $table->foreignId('sub_district_id')->comment('relations sub_districts')->references('id')->on('sub_districts')->cascadeOnDelete();
            $table->foreignId('district_id')->comment('relations districts')->references('id')->on('districts')->cascadeOnDelete();
            $table->foreignId('province_id')->comment('relations provinces')->references('id')->on('provinces')->cascadeOnDelete();
            $table->string('u_zipcode')->comment('รหัสไปรษณีย์');
            $table->foreignId('position_id')->comment('relations positions')->references('id')->on('positions')->cascadeOnDelete();
            $table->foreignId('department_id')->comment('relations departments')->references('id')->on('departments')->cascadeOnDelete();
            $table->foreignId('sub_department_id')->comment('relations departments')->references('id')->on('departments')->cascadeOnDelete();
            $table->foreignId('leader_id')->comment('relations users')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('commander_id')->comment('relations users')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('director_id')->comment('relations users')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('users');
    }
};
