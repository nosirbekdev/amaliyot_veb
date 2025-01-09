<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilePathToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Fayl yo'lini saqlash uchun yangi 'file_path' ustuni qo'shilyapti
            $table->string('file_path')->nullable(); // Fayl yo'li bo'sh bo'lishi mumkin
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // 'file_path' ustunini o'chirish
            $table->dropColumn('file_path');
        });
    }
}
