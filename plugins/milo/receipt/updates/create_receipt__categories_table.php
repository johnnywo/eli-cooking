<?php namespace Milo\Receipt\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateReceiptCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('milo_receipt_receipt__categories', function(Blueprint $table) {
            $table->engine = 'InnoDB';
			$table->integer('receipt_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->primary(['receipt_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('milo_receipt_receipt__categories');
    }
}
