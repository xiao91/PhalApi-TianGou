<?php

class Domain_Comment {

	public function fromComment($topical_id, $comment_detail, $from_uid) {
		$model = new Model_Comment();
		$comment_id = $model->fromComment($topical_id, $comment_detail, $from_uid);

		return $comment_id;
	}
}