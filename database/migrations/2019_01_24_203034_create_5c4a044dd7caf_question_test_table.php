<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c4a044dd7cafQuestionTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('question_test')) {
            Schema::create('question_test', function (Blueprint $table) {
                $table->integer('question_id')->unsigned()->nullable();
                $table->foreign('question_id', 'fk_p_257573_257578_test_q_5c4a044dd7e4e')->references('id')->on('questions')->onDelete('cascade');
                $table->integer('test_id')->unsigned()->nullable();
                $table->foreign('test_id', 'fk_p_257578_257573_questi_5c4a044dd7f44')->references('id')->on('tests')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_test');
    }
}
