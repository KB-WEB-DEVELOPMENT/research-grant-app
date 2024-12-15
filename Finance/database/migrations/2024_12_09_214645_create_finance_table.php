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
        Schema::create('finance', function (Blueprint $table) {
            $table->id();
			/*
			Note that researcher_grant_id in the Finance table is technically a foreign key and matches a primary key value in 
			the Research table.
			I am not using Models relationships in this project (because it is not its goal) so this is just a workaround.
			*/
            $table->integer('researcher_grant_id')->unique();
			$table->enum('researcher_grant_status',['approved','rejected']);
            $table->text('staff_comment');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance');
    }
};