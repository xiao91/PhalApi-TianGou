<?php

class Domain_Comment {

	public function getHotAndNewComment($contentsId, $userId) {
		$model = new Model_Comment();
		$res = $model->getHotAndNewComment($contentsId, $userId);

		return $res;
	}

	public function addComment($contentId, $commentDetail, $userId) {
		$model = new Model_Comment();
		$comment = $model->addComment($contentId, $commentDetail, $userId);

		return $comment;
	}

	public function updateCommentGoodCount($commentId) {
		$model = new Model_Comment();
		$row = $model->updateCommentGoodCount($commentId);

		return $row;
	}

	public function getNewComment($contentId, $createTime) {
		$model = new Model_Comment();
		$res = $model->getNewComment($contentId, $createTime);

		return $res;
	}


}