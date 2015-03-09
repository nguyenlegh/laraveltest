<?php
/**
 * PostComment seed
 * @author nguyenle
 *
 */
class PostCommentSeeder extends Seeder {
	/**
	 * Run the seeder
	 */
	public function run() {
		Eloquent::unguard ();
		
		$content = 'Test post content.';
		for($i = 1; $i <= 20; $i ++) {
			$post = new Post ();
			$post->title = "Post no $i";
			$post->read_more = substr ( $content, 0, 120 );
			$post->content = $content;
			$post->save ();
			
			$maxComments = mt_rand ( 3, 15 );
			for($j = 1; $j <= $maxComments; $j ++) {
				$comment = new Comment ();
				$comment->commenter = 'xyz';
				$comment->comment = substr ( $content, 0, 7 );
				$comment->email = 'xyz@xmail.com';
				$comment->approved = 1;
				$post->comments ()->save ( $comment );
				$post->increment ( 'comment_count' );
			}
		}
	}
}