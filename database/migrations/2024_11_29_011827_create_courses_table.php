<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('instructor_id')->nullable()->constrained('users')->onDelete('set null'); // Adjust for instructor
        $table->text('title');
        $table->string('image')->nullable();
        $table->string('image_path')->nullable();
        $table->text('description')->nullable();
        $table->decimal('rating', 2, 1)->nullable()->default(0);
        $table->integer('reviews_count')->default(0);
        $table->string('level')->nullable();
        $table->timestamps();
        $table->text('section');
        $table->boolean('active')->default(1); // Adds the 'active' column with a default value of 1
        $table->string('instructor_name');
        $table->string('courselanguage')->nullable();
        $table->string('requirement')->nullable();
        $table->integer('class');
        $table->integer('course_time');
        $table->text('category');
        $table->timestamp('uploaded_date')->nullable();
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
