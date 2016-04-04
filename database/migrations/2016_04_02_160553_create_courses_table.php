<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('course_no');
            $table->string('course_name');
            $table->enum('status', ['completed', 'active', 'planned']);
            $table->enum('exam_mode', ['written', 'verbal', 'none']);
            $table->date('exam_date')->nullable();
            $table->float('exam_grade')->nullable();
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
        Schema::drop('courses');
    }
}
