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
		Schema::create('research', function (Blueprint $table) {
            $table->id();
            $table->string('researcher_id',5);
			$table->enum('dept_name',['Biology','Biochemistry','Chemistry','Physics']);
            $table->string('research_title',60)->unique();
			$table->text('research_description');
            $table->unsignedInteger('grant_amount_requested');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research');
    }
};