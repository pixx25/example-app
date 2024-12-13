<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method is used to create three tables: 'jobs', 'job_batches', and 'failed_jobs'.
     * These tables are used to manage the background job processing and job batching in a Laravel application.
     */
    public function up(): void
    {
        // Creating the 'jobs' table to store job details
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for the job
            $table->string('queue')->index(); // Name of the queue (indexed for fast lookups)
            $table->longText('payload'); // Serialized job data
            $table->unsignedTinyInteger('attempts'); // Number of attempts made for the job
            $table->unsignedInteger('reserved_at')->nullable(); // Timestamp when the job was reserved (nullable)
            $table->unsignedInteger('available_at'); // Timestamp when the job will be available to process
            $table->unsignedInteger('created_at'); // Timestamp when the job was created
        });

        // Creating the 'job_batches' table to store job batch details
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary(); // Unique identifier for the batch
            $table->string('name'); // Name of the job batch
            $table->integer('total_jobs'); // Total number of jobs in the batch
            $table->integer('pending_jobs'); // Number of jobs still pending
            $table->integer('failed_jobs'); // Number of failed jobs in the batch
            $table->longText('failed_job_ids'); // List of failed job IDs
            $table->mediumText('options')->nullable(); // Optional settings for the batch (nullable)
            $table->integer('cancelled_at')->nullable(); // Timestamp for when the batch was cancelled (nullable)
            $table->integer('created_at'); // Timestamp when the batch was created
            $table->integer('finished_at')->nullable(); // Timestamp when the batch was finished (nullable)
        });

        // Creating the 'failed_jobs' table to store information about failed jobs
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for the failed job
            $table->string('uuid')->unique(); // Unique identifier for the failed job
            $table->text('connection'); // Connection used for the job (e.g., database, Redis)
            $table->text('queue'); // Name of the queue where the job was in
            $table->longText('payload'); // Serialized job data for the failed job
            $table->longText('exception'); // Exception message or stack trace for the failure
            $table->timestamp('failed_at')->useCurrent(); // Timestamp when the job failed (defaults to current time)
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method drops the three tables: 'jobs', 'job_batches', and 'failed_jobs'.
     * It is used to revert the changes made in the up() method.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs'); // Drops the 'jobs' table if it exists
        Schema::dropIfExists('job_batches'); // Drops the 'job_batches' table if it exists
        Schema::dropIfExists('failed_jobs'); // Drops the 'failed_jobs' table if it exists
    }
};
