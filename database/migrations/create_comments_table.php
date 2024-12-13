<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * This method creates the 'comments' table in the database.
     * The table includes fields for the comment's content, associations to a post and a user, 
     * and timestamps for tracking when comments are created or updated.
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Primary key for the table
            $table->text('content'); // Field for the comment's content
            $table->foreignId('post_id') // Foreign key referencing the 'posts' table
                  ->constrained()
                  ->onDelete('cascade'); // Delete comments if the associated post is deleted
            $table->foreignId('user_id') // Foreign key referencing the 'users' table
                  ->nullable() // Allow comments to have no associated user (e.g., guest comments)
                  ->constrained()
                  ->onDelete('set null'); // Set 'user_id' to null if the associated user is deleted
            $table->timestamps(); // Fields for 'created_at' and 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method drops the 'comments' table from the database.
     * It is used when rolling back the migration.
     */
    public function down()
    {
        Schema::dropIfExists('comments'); // Drop the 'comments' table
    }
}
