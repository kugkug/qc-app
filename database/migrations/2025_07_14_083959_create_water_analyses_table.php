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
        Schema::create('water_analyses', function (Blueprint $table) {
            $table->id();
            $table->string('application_ref_no', 50);
            $table->string('water_analysis_result')->nullable();
            $table->string('water_analysis_result_photo')->nullable();
            $table->bigInteger('status');
            $table->string('created_by')->constrained('admin_users')->nullable();
            $table->string('checked_by')->constrained('admin_users')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_analyses');
    }
};