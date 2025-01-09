<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('participant');
            $table->date('date_added');
            $table->date('deadline')->nullable();
            $table->string('priority'); // "High", "Medium", or "Low"
            $table->enum('status', ['to_do', 'in_progress', 'closed', 'frozen']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
