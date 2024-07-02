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
        Schema::table('assessments', function (Blueprint $table) {
            $table->integer('company_ref_id')->unsigned()->default(1);
            $table->index('company_ref_id');
            $table->foreign('company_ref_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->dropForeign(['company_ref_id']);
            $table->dropIndex(['company_ref_id']);
            $table->dropColumn(['company_ref_id']);
        });
    }
};
