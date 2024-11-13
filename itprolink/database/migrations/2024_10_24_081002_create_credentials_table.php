<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialsTable extends Migration
{
    public function up()
    {
        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('image_path')->nullable();
            $table->timestamps();

            // Foreign key constraint for the user ID
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('credentials');
    }
}
