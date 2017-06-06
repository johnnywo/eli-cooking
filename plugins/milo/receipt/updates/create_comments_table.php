<?php namespace Milo\Receipt\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('milo_receipt_comments', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('receipt_id')->unsigned();
            $table->string('comment');
            $table->string('your_name');
            $table->string('email')->nullable();
            $table->boolean('approved');
            $table->timestamps();
            $table->foreign('receipt_id')->references('id')->on('milo_receipt_receipts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('milo_receipt_comments');
    }
}
