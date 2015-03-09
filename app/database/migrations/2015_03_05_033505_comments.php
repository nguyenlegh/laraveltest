<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/**
 * Comment migrations
 * @author nguyenle
 *
 */
class Comments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'comments', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->unsignedInteger ( 'post_id' );
			$table->string ( 'commenter' );
			$table->string ( 'email' );
			$table->text ( 'comment' );
			$table->boolean ( 'approved' );
			$table->timestamps ();
		} );
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'comments' );
	}

}
