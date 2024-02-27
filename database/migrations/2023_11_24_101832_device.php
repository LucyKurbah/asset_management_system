<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Device extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category')
                    ->constrained('category');
            $table->foreignId('item_type')
                    ->constrained('item_type');
            $table->foreignId('oem')
                    ->constrained('oem');
        });
    }

    public function down()
    {
        Schema::dropIfExists('device');
    }
}
