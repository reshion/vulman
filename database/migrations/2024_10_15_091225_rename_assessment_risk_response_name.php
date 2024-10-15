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
        //
        Schema::table('assessments', function (Blueprint $table) {
            //
            $table->renameColumn('risk_response_name', 'risk_response');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('assessments', function (Blueprint $table) {
            //
            $table->renameColumn('risk_response', 'risk_response_name');
        });
    }
};
