<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeviceToAllocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allocation', function (Blueprint $table) {
            $table->foreignId('device_id')
                ->constrained('device')
                ->onDelete('cascade'); 
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('allocation', function (Blueprint $table) {
            $table->dropColumn('device_id');
        });
    }
}
