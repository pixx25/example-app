<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Anonymous migration class for creating the users, password_reset_tokens, and sessions tables
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method creates three tables: 'users', 'password_reset_tokens', and 'sessions'.
     * These tables handle user management, password reset functionality, and session tracking.
     */
    public function up(): void
    {
        // Creating the 'users' table to store user information
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Adds an auto-incrementing primary key column 'id'
            $table->string('name'); // Stores the name of the user
            $table->string('email')->unique(); // Stores the user's email address, ensuring it is unique
            // Adds an optional 'email_verified_at' column to track the email verification timestamp
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('password'); // Stores the user's hashed password
            $table->rememberToken(); // Adds a 'remember_token' column for "remember me" functionality
            $table->timestamps(); // Adds 'created_at' and 'updated_at' timestamp columns
        });
        
        // Creating the 'password_reset_tokens' table to store password reset tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Uses email as the primary key for the table
            $table->string('token'); // Stores the password reset token
            $table->timestamp('created_at')->nullable(); // Stores the timestamp when the token was created
        });
        
        // Creating the 'sessions' table to store session data
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Unique session ID (primary key)
            // Adds an indexed 'user_id' column (nullable) to link sessions to users
            $table->foreignId('user_id')->nullable()->index(); // Creates a foreign key reference to the 'users' table
            $table->string('ip_address', 45)->nullable(); // Stores the user's IP address (nullable, supports IPv6)
            $table->text('user_agent')->nullable(); // Stores the user agent string to identify the browser/device
            $table->longText('payload'); // Stores any additional session data as a serialized string
            $table->integer('last_activity')->index(); // Stores the last activity timestamp for the session and indexes it
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method is executed when rolling back the migration, dropping the tables.
     * It removes the 'users', 'password_reset_tokens', and 'sessions' tables from the database.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Drops the 'users' table if it exists
        Schema::dropIfExists('password_reset_tokens'); // Drops the 'password_reset_tokens' table if it exists
        Schema::dropIfExists('sessions'); // Drops the 'sessions' table if it exists
    }
};
