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
        Schema::create('vps_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->unsignedInteger('cpu'); 
            $table->unsignedInteger('ram'); 
            $table->unsignedInteger('storage'); 
            $table->decimal('price_per_hour', 10, 2);
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
        Schema::dropIfExists('vps_packages');
    }
};
