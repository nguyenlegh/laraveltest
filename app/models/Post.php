<?php

/**
 * Post entity
 * @author nguyenle
 *
 */
class Post extends Eloquent {
	/**
	 * comment
	 */
	public function comments() {
		return $this->hasMany('Comment');
	}
}