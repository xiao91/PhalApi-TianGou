<?php

class Domain_Comment {

	public function getHotAndNewComment($content_id, $user_id) {
		$model = new Model_Comment();
		$res = $model->getHotAndNewComment($content_id, $user_id);
		return $res;
	}

	public function addComment($content_id, $comment_detail, $from_uid, $to_uid) {
		$model = new Model_Comment();
        $res = $model->addComment($content_id, $comment_detail, $from_uid, $to_uid);
		return $res;
	}

	public function updateCommentGoodCount($content_id) {
		$model = new Model_Comment();
		$res = $model->updateCommentGoodCount($content_id);
		return $res;
	}

	public function getMoreNewComment($content_id, $create_time) {
		$model = new Model_Comment();
		$res = $model->getMoreNewComment($content_id, $create_time);
		return $res;
	}

}