<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Create a migration class for creating the comments table
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   
        // Create the 'comments' table
        Schema::create(table: 'comments', callback: function (Blueprint $table){
            $table->id(); // Adds an auto-incrementing primary key column named 'id'
            // Adds a foreign key column that references the corresponding table
            $table->foreignId(column: 'user_id')->constrained()->onDelete(action: 'cascade');
            $table->foreignId(column: 'post_id')->constrained()->onDelete(action: 'cascade');
            $table->text(column: 'content');
            $table->dateTime(column: 'date_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Called when the migration is rolled back.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'comment');
    }
};
