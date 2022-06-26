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
        Schema::create('government_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->comment('relations departments')->references('id')->on('departments')->cascadeOnDelete();
            $table->foreignId('sub_department_id')->comment('relations departments')->references('id')->on('departments')->cascadeOnDelete();
            $table->string('gose_num')->comment('เลขตก.');
            $table->date('gose_save')->comment('วันที่บันทึก');
            $table->date('gose_date')->comment('วันที่ใบ');
            $table->foreignId('user_id')->comment('relations users ผู้ขออนุญาต')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('position_id')->comment('relations positions ตำแหน่ง')->references('id')->on('positions')->cascadeOnDelete();
            $table->tinyInteger('gose_category')->default(99)->comment('สถานะไปราชการ 1-ไปราชการ 2-อบรม 3-ประชุม 99-อื่นๆ');
            $table->tinyInteger('gose_inout_province')->default(99)->comment('สถานะ 1-ไปราชการในจังหวัด 2-ไปราชการต่างจังหวัด 99-อื่นๆ');
            $table->tinyInteger('gose_withdraw')->default(99)->comment('สถานะเบิก 1-ไม่เบิก 2-เบิกงบจากผู้จัด 3-เบิกงบจากเงินบำรุง 99-อื่นๆ');
            $table->tinyInteger('gose_withdraw_na')->defalt(0)->comment('สถานะเบิกเบี้ยเลี้ยง 1-เบิก 0-ไม่เบิก');
            $table->tinyInteger('gose_withdraw_allowance')->default(0)->comment('สถานะเบิกค่าเช่าพาหนะ 1-เบิก 0-ไม่เบิก');
            $table->tinyInteger('gose_withdraw_rest')->default(0)->comment('สถานะเบิกค่าเช่าที่พัก 1-เบิก 0-ไม่เบิก');
            $table->string('gose_withdray_other')->nullable()->comment('เบิกอื่นๆ');
            $table->date('gose_date_start')->comment('วันที่ไป');
            $table->time('gose_time_start')->comment('เวลาไป');
            $table->date('gose_date_end')->comment('วันที่กลับ');
            $table->time('gose_time_end')->comment('เวลากลับ');
            $table->tinyInteger('gose_vehicle')->comment('สถานะ พาหนะ 1-ยานพาหนะประจำทาง 2-พาหนะรับจ้าง 3-รถยนต์ส่วนตัว 4-รถราชการ');
            $table->string('gose_car_regis')->nullable()->comment('ทะเบียนรถ');
            $table->foreignId('driver_id')->nullable()->comment('relations users พขร.')->references('id')->on('users')->nullOnDelete();
            $table->string('gose_about')->comment('เรื่อง / งานที่ไปราชการ / ประชุม / อบรม');
            $table->string('gose_place')->comment('สถานที่');
            $table->string('gose_district')->comment('อำเภอ');
            $table->string('gose_province')->comment('จังหวัด');
            $table->integer('gose_traveler')->default(0)->comment('ผู้ร่วมเดินทาง');
            $table->foreignId('leader_id')->comment('relations users หัวหน้าหน่วย')->references('id')->on('users')->cascadeOnDelete();
            $table->text('leader_comment')->nullable()->comment('ความเห็น หัวหน้าหน่วย');
            $table->tinyInteger('leader_status')->default(99)->comment('สถานะ อนุมัติ 0-ไม่อนุมัติ 1-อนุมัติ 99-รออนุมัติ');
            $table->datetime('leader_date')->nullable()->comment('หัวหน้าหน่วย เวลาอนุมัติ');
            $table->foreignId('commander_id')->comment('relations users หัวหน้ากลุ่มงาน')->references('id')->on('users')->cascadeOnDelete();
            $table->text('commander_comment')->nullable()->comment('ความเห็น หัวหน้ากลุ่มงาน');
            $table->tinyInteger('commander_status')->default(99)->comment('สถานะ อนุมัติ 0-ไม่อนุมัติ 1-อนุมัติ 99-รออนุมัติ');
            $table->datetime('commander_date')->nullable()->comment('หัวหน้ากลุ่มงาน เวลาอนุมัติ');
            $table->foreignId('director_id')->comment('relations users ผู้อำนวยงาน')->references('id')->on('users')->cascadeOnDelete();
            $table->text('director_comment')->nullable()->comment('ความเห็น ผู้อำนวยงาน');
            $table->tinyInteger('director_status')->default(99)->comment('สถานะ อนุมัติ 0-ไม่อนุมัติ 1-อนุมัติ 99-รออนุมัติ');
            $table->datetime('director_date')->nullable()->comment('ผู้อำนวยงาน เวลาอนุมัติ');
            $table->tinyInteger('gose_status')->default(99)->comment('สถานะ 0-ไม่อนุมัติ 1-อนุมัติ 99-รออนุมัติ');
            $table->tinyInteger('gose_send')->default(4)->comment('การส่ง 1-จบกระบวนการ 2-ผู้อำนวยการ 3-หัวหน้ากลุ่ม 4-หัวหน้าหน่วย');
            $table->text('gose_desc')->nullable()->comment('รายละเอียดเพิ่มเติม');
            $table->string('gose_file')->nullable()->comment('ไฟล์ pdf');
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
        Schema::dropIfExists('government_services');
    }
};
