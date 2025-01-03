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
        Schema::create('governance', function (Blueprint $table) {
            $table->id();
            $table->enum('dept_name', ['Biology','Biochemistry','Chemistry','Physics'])->unique();
            $table->unsignedInteger('dept_initial_budget');
			$table->unsignedInteger('dept_current_budget');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governance');
    }
};