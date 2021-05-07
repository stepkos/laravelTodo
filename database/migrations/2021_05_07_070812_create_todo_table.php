<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // utworzenie columny
            $table->unsignedBigInteger('user_id');

            // więz integralnosc
            $table->foreign('user_id')->references('id')->on('users');
            
            // 2 powyzsze liniki w jednej
            // $table->foreignId('user_id')->constrained();

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
        Schema::table('todos', function(Blueprint $table) {
            $table->dropForeign([
                'user_id'
            ]);
        });

        Schema::dropIfExists('todos');
    }
}
