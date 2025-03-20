<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_industry_look_ups', function (Blueprint $table) {
            $table->id();
            $table->string('sub_industry');
            $table->bigInteger('industry_id')->constrained('industry_look_ups');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_industry_look_ups');
    }
};