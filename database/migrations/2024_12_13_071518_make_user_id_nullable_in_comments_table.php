<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUserIdNullableInCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * This method is used to modify the 'comments' table by altering the 'user_id'
     * column to allow null values, making it nullable.
     * 
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Modify the 'user_id' column to allow null values
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method reverts the changes made in the up() method.
     * It will alter the 'user_id' column to not allow null values (i.e., making it non-nullable).
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Revert the 'user_id' column to not be nullable
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
}
