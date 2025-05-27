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
        Schema::create('vps_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vps_instance_id')->constrained()->onDelete('cascade');
            $table->timestamp('billed_at');
            $table->decimal('cost', 10, 2);
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
        Schema::dropIfExists('vps_usages');
    }
};
