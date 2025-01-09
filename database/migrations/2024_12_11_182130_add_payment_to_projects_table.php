<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->decimal('payment', 8, 2)->nullable(); // 8 ta raqam, 2 ta o'nlik
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('payment');
        });
    }

};
