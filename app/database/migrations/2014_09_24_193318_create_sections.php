<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSections extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sections', function($table) {
			$table->increments('id');
			$table->string('title', 50)->nullable();
			$table->text('content');
			$table->smallInteger('order')->unsigned();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->integer('page_id')->unsigned()->nullable();
			$table->integer('section_type_id')->unsigned();
			$table->foreign('page_id')->references('id')->on('pages');
			$table->foreign('section_type_id')->references('id')->on('section_types');
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
		Schema::drop('sections');
		
	}

}
