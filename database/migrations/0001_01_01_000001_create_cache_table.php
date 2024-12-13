<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method creates two tables: 'cache' and 'cache_locks'.
     * These tables are used for caching purposes and to manage cache locking mechanisms.
     */
    public function up(): void
    {
        // Creating the 'cache' table to store cache entries
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary(); // Unique key for the cache entry (primary key)
            $table->mediumText('value'); // The value associated with the cache key (can be a large data)
            $table->integer('expiration'); // Timestamp for when the cache entry expires
        });

        // Creating the 'cache_locks' table to manage cache locks
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary(); // Unique key for the lock (primary key)
            $table->string('owner'); // Identifier for the lock owner (e.g., process or service holding the lock)
            $table->integer('expiration'); // Timestamp for when the lock will expire (to avoid deadlocks)
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method drops the 'cache' and 'cache_locks' tables.
     * It reverts the changes made in the up() method.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache'); // Drops the 'cache' table if it exists
        Schema::dropIfExists('cache_locks'); // Drops the 'cache_locks' table if it exists
    }
};
