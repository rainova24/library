<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_instances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->date('due_back');
            $table->boolean('is_available');

            $table->foreignId('book_id');
            $table->foreignId('borrower_id');

            $table
                ->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');
            $table
                ->foreign('borrower_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_instances');
    }
}
