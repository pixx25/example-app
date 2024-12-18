<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Create a migration class for creating the posts table
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   
        // Create the 'posts' table
        Schema::create(table: 'posts', callback: function (Blueprint $table): void {
            $table->id(); // Adds an auto-incrementing primary key column named 'id'
            // Adds a foreign key column that references the user table
            $table->foreignId(column: 'user_id')->constrained()->onDelete(action: 'cascade');
            $table->string(column: 'title');
            $table->text(column: 'content');
            $table->dateTime(column: 'date_time')->nullable();
            $table->timestamps();
        });
    }

     /**
     * Reverse the migrations.
     * This method is executed when rolling back the migration, dropping the 'posts' table.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'post');
    }
};
