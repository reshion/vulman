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
        Schema::create('assessments', function (Blueprint $table) {
            // Assessment
            $table->id();
            $table->string('name');
            $table->enum('lifecycle_status', ['OPEN', 'CLOSED']);

            // References
            $table->unsignedBigInteger('vulnerability_id');
            // $table->unsignedBigInteger('company_id');
            // $table->unsignedBigInteger('system_group_id');
            // $table->unsignedBigInteger('asset_id');
           
            $table->foreign('vulnerability_id')->references('id')->on('vulnerabilities')->onDelete('cascade');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('system_group_id')->nullable()->constrained('system_groups')->onDelete('cascade');
            $table->foreignId('asset_id')->nullable()->constrained('assets')->onDelete('cascade');

            // Risk Response
            $table->string('risk_response_name')->nullable();
            $table->enum('risk_response_lifecycle_status', ['OPEN', 'IN_PROGRESS', 'CLOSED'])->nullable();
            $table->timestamp('risk_response_created')->nullable()->useCurrent();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
