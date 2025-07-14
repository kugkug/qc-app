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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('application_ref_no')->unique();
            $table->bigInteger('user_id')->constrained('users');

            $table->bigInteger('classification_id')->constrained('classification_look_ups');
            $table->bigInteger('application_type_id')->constrained('application_type_look_ups');
            $table->bigInteger('industry_id')->constrained('industry_look_ups');
            $table->bigInteger('sub_industry_id')->constrained('sub_industry_look_ups');
            $table->string('business_line_id')->nullable();

            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_owner')->nullable();
            $table->string('mayor_permit_no')->nullable();

            $table->integer('total_employees')->nullable();
            $table->integer('total_employees_with_certifiates')->nullable();
            $table->integer('total_employees_without_certificates')->nullable();
            $table->integer('total_employees_with_ppe')->nullable();


            $table->smallInteger('application_status')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};