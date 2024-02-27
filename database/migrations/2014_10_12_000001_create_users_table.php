<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('emp_code');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('designation');
            $table->foreignId('role_id')
                  ->constrained('role')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('division') 
                  ->constrained('division');
            $table->foreignId('group') 
                  ->constrained('group');
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
        Schema::dropIfExists('users');
    }
}
