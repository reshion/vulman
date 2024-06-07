<?php

use App\Models\Assessment;
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
        Schema::create('risk_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Assessment::class)->constrained()->onDelete('cascade');
            $table->string('name');
            $table->date('created');
            $table->enum('lifecycle_status', ['OPEN', 'IN_PROGRESS', 'CLOSED']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_responses');
    }
};
