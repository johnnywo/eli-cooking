<?php namespace Milo\Receipt\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateReceiptsTable extends Migration
{
    public function up()
    {
        Schema::create('milo_receipt_receipts', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->json('incredients');
            $table->text('preparation');
            $table->string('slug');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('milo_receipt_receipts');
    }
}
