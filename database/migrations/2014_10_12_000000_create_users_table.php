<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('phone')->nullable(); // Optional phone number
            $table->date('birthday')->nullable(); // Optional birthday
            $table->integer('age')->nullable(); // Optional age
            $table->enum('gender', ['Male', 'Female', 'Others'])->nullable(); // Optional gender
            $table->enum('role', ['tutor', 'tutee', 'admin']); // Required role
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('about_me')->nullable(); // Optional about me section
            $table->string('profile_picture', 255)->nullable(); // Optional profile picture with character limit
            $table->boolean('verified')->default(false); // False means not verified
            $table->boolean('active')->default(1); // Adds the 'active' column with a default value of 1
            $table->string('id_photo')->nullable(); // Path to the uploaded ID
            $table->string('selfie_with_id')->nullable(); // Path to the uploaded selfie
            $table->string('diploma')->nullable(); // Path to the uploaded diploma, specific to tutors
            $table->enum('verification_status', ['not_submitted', 'pending', 'approved', 'rejected'])->default('not_submitted'); // Admin review status
            $table->text('edu')->nullable();
            $table->text('career')->nullable();
            $table->text('exp')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
