<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('products', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('title', 256);
                $table->text('description');
                $table->string('image', 64);
                $table->decimal('amount', 10, 2);
                $table->boolean('isActive');
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
            Schema::dropIfExists('products');
	}

}
